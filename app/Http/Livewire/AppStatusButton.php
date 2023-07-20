<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AppStatusButton extends Component
{
    public $applicationId;

    public $user_subscribed;

    public function mounted($application)
    {
        // $this->applicationId = $applicationId;
        // dd(\App\Models\AppApiKey::where('app_id', $this->applicationId)
        //     // ->where('user_id', auth()->user()->id)
        //     ->first());

        // dd($application);
    }

    public function render()
    {
        return view('livewire.app-status-button', [
            'user_subscribed' => $this->user_subscribed,
            'applicationId' => $this->applicationId,
        ]);
    }
}
