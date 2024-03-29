<?php

namespace App\Console\Commands;

use App\Models\RealtimeBattle;
use App\Models\User;
use App\Models\WifiDevice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

                // Log user device info from MQTT message
                if (isset($message_json['version'], $message_json['circuitpython_version'], $message_json['circuitpython_board_id'], $message_json['has_display'])) {
                    $infoMessage = "User: {$name}, Version: {$message_json['version']}, CircuitPython Version: {$message_json['circuitpython_version']}, Board ID: {$message_json['circuitpython_board_id']}, Has Display: " . ($message_json['has_display'] ? 'Yes' : 'No');
                    $this->info($infoMessage);
                    \Log::info($infoMessage);
                }

                $wifiDevice = WifiDevice::where('user_id', $user->id)
                    ->where('uuid', $device_uuid)
                    ->first();

                if (strpos($message['output'], 'r:') !== false || strpos($message['output'], 'Error') !== false || strpos($message['output'], '=') !== false) {
                    $this->info('Received message from wifi com module user name: ' . $name);
                    $wifiDevice->last_output = str($message['output']);
                    $wifiDevice->last_valid_output = str($message['output']);

                    if ($message['application_uuid'] == 0) {
                        $wifiDevice->last_output_web = str($message['output']);
                        $wifiDevice->last_output_web_updated_at = Carbon::now();
                    }

                    // Put in cache the last_output
                    $cache_key = $user_uuid . '-' . $device_uuid . '-' . $message['application_uuid'] . '_last_output';
                    $this->info($cache_key);
                    Cache::put($cache_key, str($message['output']), $seconds = 600);
                }
                $wifiDevice->last_ping_at = now();
                $wifiDevice->save();
            } elseif (Str::endsWith($topic, 'realtime-battle')) {
                $this->info('Received message from wifi com realtime battle module');
                $name = substr($topic, 0, strpos($topic, '/f'));
                $battle_id = substr($topic, strpos($topic, '/f/') + 3, 16);

                $this->info($name);
                $this->info($battle_id);
                $message_json = json_decode($message, true);

                // Check that output is valid, containing r:
                if (strpos($message_json['output'], 'r:') !== false || strpos($message_json['output'], 'Error') !== false) {
                    $realtime_battle = RealtimeBattle::where('battle_id', $battle_id)->first();

                    $realtime_battle->last_activity_at = now();

                    // Put in cache the last_output
                    $cache_key = $name . '-' . $battle_id . '_realtime_output';
                    $this->info($cache_key);
                    // Add to existing cache if exists
                    if (Cache::has($cache_key)) {
                        $cache_value = Cache::get($cache_key);
                        $cache_value .= str($message_json['output'] . '\n');
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