<?php

namespace App\Http\Livewire;

use App\Models\AppApiKey;
use App\Models\Application;
use Livewire\Component;

class CredentialsModalDelete extends Component
{
    public $application;
    public $applicationId;

    public function mount($applicationId)
    {
        $this->applicationId = $applicationId;
        $this->application = Application::find($applicationId);
    }

    public function deleteCredentials($app_id)
    {
        AppApiKey::where('app_id', $app_id)
            ->where('user_id', auth()->user()->id)
            ->delete();

        $this->emit('deleteTriggered');

        return true;
    }

    public function render()
    {
        return view('livewire.credentials-modal-delete');
    }
}
