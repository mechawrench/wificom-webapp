<?php

namespace App\Console\Commands;

use App\Models\RealtimeBattle;
use App\Models\User;
use App\Models\WifiDevice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class MqttListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $wifiDevice = WifiDevice::where('user_id', $user->id)
                    ->where('uuid', $device_uuid)
                    ->first();

        if (! $wifiDevice) {
            return response()->json(['error' => 'Invalid device UUID.'], 404);
        }
        $mqtt = new \PhpMqtt\Client\MqttClient(config('mqtt-client.connections.default.host'), config('mqtt-client.connections.default.port'));

        $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
            ->setUsername(config('mqtt-client.connections.default.connection_settings.auth.username'))
            ->setPassword(config('mqtt-client.connections.default.connection_settings.auth.password'))
            ->setConnectTimeout(3)
            ->setUseTls(true)
            ->setTlsSelfSignedAllowed(true);

        $mqtt->connect($connectionSettings, true);

        $mqtt->subscribe('#', function (string $topic, string $message) {

            $message_json = json_decode($message, true);
            if (array_key_exists('ack_id', $message_json)) {
//                Cache::put($message_json['ack_id'], true, 60);
                $this->info("Ack ID: " . $message_json['ack_id'] . ' received from device_uuid: ' . $message_json['device_uuid']);

                $ack_request = \App\Models\AckRequest::create([
                    'ack_id' => $message_json['ack_id'],
                ])->save();
            }

            if (Str::endsWith($topic, 'wificom-output')) {
                $message = json_decode($message, true);
                $name = substr($topic, 0, strpos($topic, '/f'));

                $user_uuid = substr($topic, strpos($topic, '/f/') + 3, 16);
                $user_uuid = str_replace('/', '', $user_uuid);
                $device_uuid = substr($topic, strpos($topic, '-') + 1, 16);

                $user = User::where('name', $name)->where('uuid', $user_uuid)->first();


                \Log::info($message);
                \Log::info($message['output']);
                if (strpos($message['output'], 'r:') !== false) {
                    Log::info('Received message from wifi com module user name: '.$name);
                    $wifiDevice->last_output = str($message['output']);
                    $wifiDevice->last_valid_output = str($message['output']);

                    // Put in cache the last_output
                    $cache_key = $user_uuid.'-'.$device_uuid.'-'.$message['application_uuid'].'_last_output';
                    Log::info($cache_key);
                    Cache::put($cache_key, str($message['output']), $seconds = 600);
                }
                $wifiDevice->last_ping_at = now();
                $wifiDevice->save();
            } elseif (Str::endsWith($topic, 'realtime-battle')) {
                $this->info('Received message from wifi com realtime battle module');
//                dd($message);
                $name = substr($topic, 0, strpos($topic, '/f'));
                $battle_id = substr($topic, strpos($topic, '/f/') + 3, 16);

                $this->info($name);
                $this->info($battle_id);
                $message_json = json_decode($message, true);

                // Check that output is valid, containing r:
                if (strpos($message_json['output'], 'r:') !== false) {
                    $realtime_battle = RealtimeBattle::where('battle_id', $battle_id)->first();

                    $realtime_battle->last_activity_at = now();

                    // Put in cache the last_output
                    $cache_key = $name.'-'.$battle_id.'_realtime_output';
                    $this->info($cache_key);
                    // Add to existing cache if exists
                    if (Cache::has($cache_key)) {
                        $cache_value = Cache::get($cache_key);
                        $cache_value .= str($message_json['output'].'\n');
                        Cache::put($cache_key, $cache_value, $seconds = 600);
                    } else {
                        Cache::put($cache_key, str($message_json['output']), $seconds = 600);
                    }
                    
                    $realtime_battle->save();
                }
            } else {
                $this->info("Received message without parseable topic on  [$topic]: $message");
            }
        }, 0);

        $mqtt->loop(true);

        return 0;
    }
}
