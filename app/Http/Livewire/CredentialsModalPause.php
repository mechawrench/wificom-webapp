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

    public function pauseCredentials($application)
    {
        $found = AppApiKey::where('app_id', $application['id'])
            ->where('user_id', auth()->user()->id)
            ->first();

        $found->is_paused = $found->is_paused == 0 ? 1 : 0;

        // Save the changes to the database
        $found->save();

        $this->application = \App\Models\Application::with('subscribedV2')->find($this->applicationId);
    }

    public function render()
    {
        return view('livewire.credentials-modal-pause');
    }
}
