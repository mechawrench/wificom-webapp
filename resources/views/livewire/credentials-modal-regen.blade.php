<div x-data="{ isOpen: @entangle('isOpen') }">
  <button class="w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2" @click="isOpen = true">
    Get New API Key
  </button>

  <div class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5)" @click.self="isOpen = false" x-show="isOpen">
    <div class="bg-white p-6 w-full max-w-md mx-auto rounded shadow-lg" @click.stop>
    <h2 class="text-xl font-semibold mb-4 text-center">Get New API Key<br/> <span class="font-bold"> {{$application->name }}</span> <span class="italic text-sm"> by {{$application->user->name}}</span></h2>
      <div class="text-center">
        <button wire:click="regenCredentials({{$application->id}})" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4">
          Okay
        </button>
      </div>
      @if($apiKey)
      <div x-data="clipboardHandler()">
        <pre class="py-4 rounded">New API Key:</pre>
        <div class="flex items-center pb-4">
          <button @click="copyToClipboard('{{$this->getCredentials()}}')" class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded" title="Copy to Clipboard">
            Copy
          </button>
          <pre class="bg-gray-100 p-2 rounded inline">{{$apiKey}}</pre>
        </div>
      </div>
      <pre class="py-4 rounded">Registered Device Names:</pre>
      <div x-data="clipboardHandler()">
        @if(count($device_names) > 0)
        <div>
          @foreach($device_names as $index=>$device_name)
          <div class="flex items-center py-2">
            <button @click="copyToClipboard('{{$device_name}}')" class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded" title="Copy to Clipboard">
              Copy
            </button>
            <div class="bg-gray-100 p-2">{{$device_name}}</div>
          </div>
          @endforeach
        </div>
        @else
          No WiFiCom's added yet!
        @endif
      </div>
      @endif
      <div class="flex justify-end pt-4">
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4" @click="isOpen = false" wire:click="clearKey">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  function clipboardHandler() {
    return {
      copyToClipboard(deviceName) {
        const el = document.createElement('textarea');
        el.value = deviceName;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
      }
    }
  }
</script>