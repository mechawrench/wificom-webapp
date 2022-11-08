<?php

namespace App\Filament\Resources\WifiDeviceResource\Widgets;

use Carbon\Carbon;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use PhpMqtt\Client\Facades\MQTT;

class SendDigirom extends Widget
{
    protected static string $view = 'filament.resources.wifi-device-resource.widgets.send-digirom';

    public ?Model $record = null;

    public $digirom;

    public $successMessage;

    public $lastAckId;
    public $lastAckUuid;

    protected $rules = [
        'digirom' => 'required|string',
    ];

    public function updated($propertyName)
    {
        $this->successMessage = '';
        $this->validateOnly($propertyName);
    }

    public function saveDigirom()
    {
        $validatedData = $this->validate();

        // TODO: No longer using pending_digirom, remove this?
        $this->record->pending_digirom = $validatedData['digirom'];
        $this->record->last_code_sent_at = Carbon::now();
        $this->record->save();

        // Create ack record in cache for 1 minute
        $this->lastAckUuid = Str::random(6);
        cache()->put($this->lastAckUuid, false, 60);

        $message_data = [
            'digirom' => $validatedData['digirom'],
            'application_id' => 0,
            'hide_output' => false,
            'ack_id' => $this->lastAckUuid,
        ];

        // TODO: Make mqtt setup a function
        $mqtt = new \PhpMqtt\Client\MqttClient(config('mqtt-client.connections.default.host'), config('mqtt-client.connections.default.port'));

        $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
            ->setUsername(config('mqtt-client.connections.default.connection_settings.auth.username'))
            ->setPassword(config('mqtt-client.connections.default.connection_settings.auth.password'))
            ->setConnectTimeout(3)
            ->setUseTls(true)
            ->setTlsSelfSignedAllowed(true);

        $mqtt->connect($connectionSettings, true);
        $mqtt->publish(auth()->user()->name.'/f/'.auth()->user()->uuid.'-'.$this->record->uuid.'/wificom-input', json_encode($message_data));

        $this->clearCachedResults();

        $this->successMessage = 'Digirom sent, try a scan in 6 seconds from now';

        return 0;
    }

    public function checkAckReceived()
    {
        $ackRequest = $this->record->ackRequests()->where('request_type', 'digirom_send')->latest()->first();
        if ($ackRequest->ack_received) {
            $this->successMessage = 'Digirom sent successfully';
        } else {
            $this->successMessage = 'Digirom send failed';
        }
    }



    public function clearCachedResults()
    {
        \Illuminate\Support\Facades\Cache::forget($this->record->user->uuid.'-'.$this->record->uuid.'-'.'0'.'_last_output');

        return 0;
    }
}
