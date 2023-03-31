<div x-data="{ isOpen: @entangle('isOpen') }">

  <button class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2  rounded mr-2" @click="isOpen = true; @this.call('generateKey')">
    View API Key
  </button>

  <div class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5)" @click.self="isOpen = false" x-show="isOpen">
    <div class="bg-white p-6 w-full max-w-md mx-auto rounded shadow-lg" @click.stop>
      <h2 class="text-xl font-semibold mb-4 text-center">Credentials<br/> <span class="font-bold"> {{$application->name }}</span> <span class="italic text-sm"> by {{$application->user->name}}</span></h2>
      <pre class="py-4 rounded">API Key:</pre>
      <div x-data="clipboardHandler()">
        <div class="flex items-center pb-4">
          <button @click="copyToClipboard('{{$this->getCredentials()}}')" class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded" title="Copy to Clipboard">
            Copy
          </button>
          <pre class="bg-gray-100 p-2 rounded inline">{{$this->getCredentials()}}</pre>
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
      <div class="flex justify-end">
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4" @click="isOpen = false">
          Close
        </button>
      </div>

    </div>
  </div>
</div>