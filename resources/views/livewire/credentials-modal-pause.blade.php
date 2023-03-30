<div x-data="{ isOpen: @entangle('isOpen') }">
  @if(!is_null($application->subscribedV2) && $application->subscribedV2->is_paused == false)
  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" @click="isOpen = true">
    Pause App Access
  </button>
  @else
  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" @click="isOpen = true">
    Resume App Access
  </button>
  @endif
  <div class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5)" @click.self="isOpen = false" x-show="isOpen">
    <div class="bg-white p-6 w-full max-w-md mx-auto rounded shadow-lg" @click.stop>
      <h2 class="text-xl font-semibold mb-4">Credentials for Application {{ $application->name }} by {{$application->user->name}}</h2>
      <button wire:click="pauseCredentials({{$application->id}})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mt-4" @click="isOpen = false">>
        Are you sure you wish to PAUSE your API Key?
      </button>
    </div>
  </div>
</div>