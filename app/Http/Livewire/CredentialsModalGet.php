<?php

namespace App\Http\Livewire;

use App\Filament\Resources\ApplicationResource\Pages\AppCredentials;
use App\Models\AppApiKey;
use App\Models\Application;
use App\Models\User;
use Livewire\Component;

class CredentialsModalGet extends Component
{
    public $isOpen = false;
    public $applicationId;
    public $regenerate = false;
    public $application;
    public $apiKey;

    public function mount($applicationId)
    {
        $this->applicationId = $applicationId;
        $this->application = Application::find($applicationId);
        $this->apiKey = $this->getCredentials()->api_key ??  null;
    }

    public function getCredentials()
    {
        $creds = AppApiKey::where('app_id', $this->applicationId)
            ->where('user_id', auth()->user()->id)
            ->first();

        $this->emit('refreshStatusBadge');


        return $creds->api_key ?? null;
    }

    public function generateKey()
    {
        if ($this->getCredentials() == null) {
            $this->apiKey = \App\Models\AppApiKey::generateUniqueKey($this->application->id);
        }
    }

    public function getDeviceNames()
    {
        $devices = User::find(auth()->user()->id)->wifiDevices->pluck('device_name');

        return $devices;
    }

    public function render()
    {
        $apiKey = $this->getCredentials();
        $device_names = $this->getDeviceNames();

        return view('livewire.credentials-modal-get', [
            'application' => $this->application,
            'apiKey' => $this->getCredentials(),
            'device_names' => $device_names,
        ]);
    }
}
