<?php

namespace App\Http\Livewire;

use App\Filament\Resources\ApplicationResource\Pages\AppCredentials;
use App\Models\AppApiKey;
use App\Models\Application;
use Livewire\Component;

class CredentialsModalRegen extends Component
{
    public $isOpenRegen = false;
    public $applicationId;
    public $application;
    public $apiKey;

    public function mount($applicationId, $regenerate = false)
    {
        $this->application = Application::find($applicationId);
        $this->applicationId = $applicationId;
        $this->apiKey = $this->getCredentials();
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

        if (!$creds) {
            return null;
        }   

        $this->apiKey = $creds->api_key;
        return $creds->api_key;
    }

    public function render()
    {
        // refresh the livewire component


        return view('livewire.credentials-modal-regen', [
            'application_id' => $this->applicationId,
            'apiKey' => $this->apiKey
        ]);
    }
}
