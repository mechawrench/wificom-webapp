<?php

namespace App\Http\Livewire;

use App\Filament\Resources\ApplicationResource\Pages\AppCredentials;
use App\Models\AppApiKey;
use App\Models\Application;
use Livewire\Component;

class CredentialsModalGet extends Component
{
    public $isOpen = false;
    public $applicationId;
    public $regenerate = false;
    public $application;

    public function mount($applicationId)
    {
        $this->applicationId = $applicationId;
        $this->application = Application::find($applicationId);
    }

    public function getCredentials()
    {
        $creds = AppApiKey::where('app_id', $this->applicationId)
            ->where('user_id', auth()->user()->id)
            ->first();

        return $creds;
    }

    public function render()
    {
        $apiKey = $this->getCredentials();


        return view('livewire.credentials-modal-get', [
            'application' => $this->application,
            'apiKey' => $apiKey->api_key ?? null
        ]);
    }
}
