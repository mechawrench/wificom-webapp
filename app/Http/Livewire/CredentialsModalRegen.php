<?php

namespace App\Http\Livewire;

use App\Models\AppApiKey;
use App\Models\Application;
use App\Models\User;
use Livewire\Component;

class CredentialsModalRegen extends Component
{
    public $isOpenRegen = false;

    public $applicationId;

    public $application;

    public $apiKey;

    public function mount($applicationId, $regenerate = false)
    {
        $this->application = Application::where('id', $applicationId)->where('api_version', 2)->first();
        $this->applicationId = $applicationId;
    }

    public function getDeviceNames()
    {
        $devices = User::find(auth()->user()->id)->wifiDevices->pluck('device_name');

        return $devices;
    }

    public function clearKey()
    {
        $this->apiKey = null;
    }

    public function regenCredentials($applicationId)
    {
        $creds = AppApiKey::generateUniqueKey($applicationId);
        $this->apiKey = $creds;

        return $creds;
    }

    public function getCredentials()
    {
        $creds = AppApiKey::where('app_id', $this->applicationId)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (! $creds) {
            return null;
        }

        $this->apiKey = $creds->api_key;

        return $creds->api_key;
    }

    public function render()
    {
        $device_names = $this->getDeviceNames();

        return view('livewire.credentials-modal-regen', [
            'application_id' => $this->applicationId,
            'apiKey' => $this->apiKey,
            'device_names' => $device_names,
        ]);
    }
}
