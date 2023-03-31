  @if(!is_null($application->subscribedV2) && $application->subscribedV2->is_paused == 0)
  <button wire:click="pauseCredentials({{$application}})" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2  rounded" @click="isOpen = true">
    Pause
  </button>
  @else
  <button wire:click="pauseCredentials({{$application}})" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="isOpen = true">
    Resume
  </button>
  @endif