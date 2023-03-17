<div x-data="{ isOpen: @entangle('isOpen') }">

  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" @click="isOpen = true">
    Get Credentials
  </button>

  <div class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5)" @click.self="isOpen = false" x-show="isOpen">
    <div class="bg-white p-6 w-full max-w-md mx-auto rounded shadow-lg" @click.stop>
      <h2 class="text-xl font-semibold mb-4">Credentials for Application {{ $application->name }} by {{$application->user->name}}</h2>
      <p>Here are your credentials:</p>
      <pre class="bg-gray-100 p-4 rounded">API Key:  {{$apiKey ??  \App\Models\AppApiKey::generateUniqueKey($application->id)}}</pre>
      <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4" @click="isOpen = false">
        Close
      </button>
    </div>
  </div>
</div>