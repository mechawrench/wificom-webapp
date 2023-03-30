<div x-data="{ isOpen: @entangle('isOpen') }">
  @if(!is_null($application->subscribedV2) && $application->subscribedV2->is_paused == 0)
  <button wire:click="pauseCredentials({{$application}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" @click="isOpen = true">
    Pause App Access
  </button>
  @elseif(!is_null($application->subscribedV2) && $application->subscribedV2->is_paused == 1)
  <button wire:click="pauseCredentials({{$application}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" @click="isOpen = true">
    Resume App Access
  </button>
  @endif