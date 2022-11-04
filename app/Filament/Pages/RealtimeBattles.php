<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OnlineWifiDevices;
use App\Models\RealtimeBattle;
use App\Models\User;
use Filament\Pages\Page;
use PhpMqtt\Client\Facades\MQTT;

class RealtimeBattles extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-lightning-bolt';

    protected static ?string $navigationGroup = 'Online Battles';

    protected static string $view = 'filament.pages.realtime-battles';

    protected static ?string $model = RealtimeBattle::class;

    public $successMessageAccept = '';

    public $successMessageInitiate = '';

    public $battle_type;

    public $opponent_name;

    public $current_rtb_model;

    public $user_selected_com_host;

    public $user_selected_com_guest;

    public $user_coms;

    public $errorMessage = '';

    public $invite_code;

    public $guest_connected = false;

    public $host_connected = false;

    public $initial_invite_code;

    public $show_guest_message = false;
    public $show_host_message = false;

    public function mount(): void
    {
        $this->user_coms = auth()->user()->wifiDevices()->get();
    }

    // Widgets
    protected function getHeaderWidgets(): array
    {
        return [
            OnlineWifiDevices::class,
        ];
    }

    public function genRtbInvite()
    {
        $this->successMessageInitiate = '';
        $this->errorMessage = '';

        if ($this->user_selected_com_host == 'DUMMY') {
            $this->validate([
                'battle_type' => 'required|in:digimon-penx-battle,legendz',
                'user_selected_com_host' => 'required|in:DUMMY',
            ]);
        } else {
            $this->validate([
                'battle_type' => 'required|in:digimon-penx-battle,legendz',
                'user_selected_com_host' => 'required|exists:wifi_devices,uuid,user_id,'.auth()->id(),
            ]);
        }

        $rtb = new RealtimeBattle();
        $rtb->device_type = $this->battle_type;
        $rtb->initiator_com_uuid = $this->user_selected_com_host;
        $rtb->save();

        $this->current_rtb_model = $rtb;

        // Generate mqtt_acl for topic
        $mqtt_acl = new \App\Models\MqttAcl();
        $mqtt_acl->topic = strtolower(auth()->user()->name).'/f/'.$rtb->topic;
        $mqtt_acl->user_id = auth()->id();
        $mqtt_acl->save();

        // Lookup WifiDevice by UUID
        $wifi_device = auth()->user()->wifiDevices()->where('uuid', $rtb->initiator_com_uuid)->first();

        if ($this->user_selected_com_host != 'DUMMY') {
            $this->hostAccept($wifi_device, $rtb);
        }

        $this->successMessageInitiate = 'Success!  Pass the code to your partner.';
        $this->show_host_message = true;

        $this->host_connected = true;

        return 0;
    }

    public function hide_output()
    {
        $this->show_host_message = false;
        $this->show_guest_message = false;

        $this->successMessageAccept = '';
        $this->successMessageInitiate = '';
        $this->errorMessage = '';
    }

    public function accept_rtb()
    {
        $this->successMessageAccept = '';
        $this->errorMessage = '';

        $this->invite_code = trim($this->invite_code);

        $this->validate([
            'invite_code' => 'required|exists:realtime_battles,invite_code',
            'user_selected_com_guest' => 'required|exists:wifi_devices,uuid,user_id,'.auth()->id(),
        ]);

        $model = RealtimeBattle::where('invite_code', $this->invite_code)
            ->where('opponent_id', null)
            ->first();

        if (! $model) {
            $this->errorMessage = 'Invalid invite code or already used';
            $this->show_guest_message = true;

            return;
        }

        $model->opponent_id = auth()->id();
        $model->opponent_com_uuid = $this->user_selected_com_guest;
        $model->save();

        // Generate mqtt_acl for topic
        $mqtt_acl = new \App\Models\MqttAcl();
        $mqtt_acl->topic = strtolower($model->user->name).'/f/'.$model->topic;
        $mqtt_acl->user_id = auth()->id();
        $mqtt_acl->save();

        $this->guestAccept();

        $this->guest_connected = true;
        $this->initial_invite_code = $this->invite_code;

        $this->successMessageAccept = 'Success!  You are now connected to your partner.';
        $this->show_guest_message = true;
    }

    public function retryGuest()
    {
        $this->guestAccept();
    }

    public function retryHost()
    {
        $wifi_device  = \App\Models\WifiDevice::where('uuid', $this->user_selected_com_host)->first();
        $this->hostAccept($wifi_device, $this->current_rtb_model);
    }

    public function guestAccept()
    {
        $this->successMessageAccept = '';
        $this->errorMessage = '';

        $model = RealtimeBattle::where('invite_code', $this->invite_code)
            ->first();

        if(!$model) {
            $this->errorMessage = 'Invalid invite code or already used';

            return;
        }

        if($model->opponent_id && $model->opponent_id != auth()->id()) {
            $this->errorMessage = 'Invalid invite code or already used';

            return;
        }

        $message_data = [
            'digirom' => null,
            'application_id' => 1,
            'hide_output' => false,
            'topic' => $model->topic,
            'topic_action' => 'subscribe',
            'battle_type' => $model->device_type, // TODO: Change the model column to battle_type instead of device_type
            'user_type' => 'guest',
            'host' => $model->user->name,
        ];

        // Lookup WifiDevice by UUID
        $wifi_device = auth()->user()->wifiDevices()->where('uuid', $model->opponent_com_uuid)->first();

        // Send MQTT message to device
        // TODO: Make mqtt setup a function
        $mqtt = new \PhpMqtt\Client\MqttClient(config('mqtt-client.connections.default.host'), config('mqtt-client.connections.default.port'));

        $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
            ->setUsername(config('mqtt-client.connections.default.connection_settings.auth.username'))
            ->setPassword(config('mqtt-client.connections.default.connection_settings.auth.password'))
            ->setConnectTimeout(3)
            ->setUseTls(true)
            ->setTlsSelfSignedAllowed(true);

        $mqtt->connect($connectionSettings, true);
        $mqtt->publish(strtolower(auth()->user()->name).'/f/'.auth()->user()->uuid.'-'.$wifi_device->uuid.'/wificom-input', json_encode($message_data));

        $this->successMessageAccept = 'Retried to send battle code to device.';
        $this->show_guest_message = true;
    }

    public function hostAccept($wifi_device, $rtb)
    { ;
        $message_data = [
            'digirom' => null,
            'application_id' => 1,
            'hide_output' => false,
            'topic' => $rtb->topic,
            'topic_action' => 'subscribe',
            'battle_type' => $this->battle_type,
            'user_type' => 'host',
            'host' => strtolower(auth()->user()->name),
        ];

        $mqtt = new \PhpMqtt\Client\MqttClient(config('mqtt-client.connections.default.host'), config('mqtt-client.connections.default.port'));

        $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
            ->setUsername(config('mqtt-client.connections.default.connection_settings.auth.username'))
            ->setPassword(config('mqtt-client.connections.default.connection_settings.auth.password'))
            ->setConnectTimeout(3)
            ->setUseTls(true)
            ->setTlsSelfSignedAllowed(true);

        $mqtt->connect($connectionSettings, true);
        $mqtt->publish(strtolower(auth()->user()->name).'/f/'.auth()->user()->uuid.'-'.$wifi_device->uuid.'/wificom-input', json_encode($message_data));
        $this->successMessageInitiate = 'Successfully retried to send battle request to device!';
        $this->show_host_message = true;
    }
}
