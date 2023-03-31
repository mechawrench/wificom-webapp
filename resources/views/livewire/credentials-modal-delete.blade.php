<div x-data="{ isOpen: @entangle('isOpen') }">
  <button class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2" @click="isOpen = true">
    Delete API Key
  </button>

  <div class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5)" @click.self="isOpen = false" x-show="isOpen">
    <div class="bg-white p-6 w-full max-w-md mx-auto rounded shadow-lg" @click.stop>
      <h2 class="text-xl font-semibold mb-4">Credentials for Application {{ $application->name }} by {{$application->user->name}}</h2>
      <button wire:click="deleteCredentials({{$application->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4" @click="isOpen = false">
        Are you sure you wish to delete your API Key?
      </button>
    </div>
  </div>
</div>