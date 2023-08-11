<div x-data="{ isOpen: @entangle('isOpen') }">
  <button class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2" @click="isOpen = true">
    Delete API Key
  </button>

  <div class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5)" @click.self="isOpen = false" x-show="isOpen">
    <div class="bg-white p-6 w-full max-w-md mx-auto rounded shadow-lg" @click.stop>
    <h2 class="text-xl font-semibold mb-4 text-center">Delete API Key<br/> <span class="font-bold"> {{$application->name }}</span> <span class="italic text-sm"> by {{$application->user->name}}</span></h2>
      <div class="text-center">
        <button wire:click="deleteCredentials({{$application->id}})" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4">
          Okay
        </button>
      </div>
      <div class="flex justify-end pt-4">
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4" @click="isOpen = false">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>