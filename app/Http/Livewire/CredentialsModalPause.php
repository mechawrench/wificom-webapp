<?php

namespace App\Http\Livewire;

use App\Models\AppApiKey;
use App\Models\Application;
use Livewire\Component;

class CredentialsModalPause extends Component
{
    public $application;
    public $isOpen = false;
    public $applicationId;

    public function mount($application)
    {   
        $this->application = $application;
        $this->applicationId = $this->application->id;
    }

    public function pauseCredentials($applicationId)
    {
        $found = AppApiKey::where('app_id', $applicationId)
            ->where('user_id', auth()->user()->id)->first();
        $found->is_paused = !$found->is_paused;
        
        // Save the changes to the database
        $found->save();

        $this->emit('refreshAppCredentials');

        return true;
    }

    public function render()
    {
        return view('livewire.credentials-modal-pause');
    }
}
