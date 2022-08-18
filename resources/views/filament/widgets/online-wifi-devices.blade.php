<x-filament::widget>
    <x-filament::card>
        <div>
            <h2 class="text-gray-500 text-sm font-medium">WiFiCom Status</h2>
            <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4" wire:poll>
                @foreach($devices as $device)
                    <li class="col-span-1 flex shadow-sm rounded-md">
                        @if($device->online_status)
                            <div class="flex-shrink-0 flex items-center justify-center w-16 bg-green-600 text-white text-sm font-medium rounded-l-md">ON</div>
                        @else
                            <div class="flex-shrink-0 flex items-center justify-center w-16 bg-red-600 text-white text-sm font-medium rounded-l-md">OFF</div>
                        @endif
                        <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                            <div class="flex-1 px-4 py-2 text-sm truncate">
                                <a href="wifi-devices/{{$device->id}}" class="text-gray-900 font-medium hover:text-gray-600">{{ $device->device_name }}</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </x-filament::card>
</x-filament::widget>
