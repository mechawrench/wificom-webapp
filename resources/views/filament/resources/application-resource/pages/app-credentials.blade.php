<div class="container py-8" x-data="{ open: false }" wire:poll.2s>
    <div class="grid grid-cols-2 gap-4">
        @foreach($applications as $application)
        <div class="card relative flex flex-col rounded shadow-lg p-4 bg-white h-full">
            <div wire:key="application.id" class="absolute top-0 left-0 bg-yellow-500 text-white text-sm font-bold py-1 px-2 rounded-br">
                @if(!is_null($application->subscribedV2) && $application->subscribedV2->is_paused == 1)
                <div class="absolute top-0 left-0 bg-yellow-500 text-white text-sm font-bold py-1 px-2 rounded-br">PAUSED</div>
                @elseif(!is_null($application->subscribedV2) && $application->subscribedV2->is_paused == 0)
                <div class="absolute top-0 left-0 bg-green-500 text-white text-sm font-bold py-1 px-2 rounded-br">ACTIVE</div>
                @else
                <div class="absolute top-0 left-0 bg-red-500 text-white text-sm font-bold py-1 px-2 rounded-br">UNSUBBED</div>
                @endif
            </div>
            <div class="p-4">
                <h3 class="text-xl font-semibold mb-4 text-center">{{$application->name}} <br /><span class="text-xs italic">By {{$application->user->name}}</h3>
                <p class="text-center">{{$application->description}}</p>
            </div>
            <div class="justify-center mb-4" >
                <div class="flex justify-center space-x-2 mb-4">
                    <div class="w-1/2">
                        @livewire('credentials-modal-get', ['applicationId' => $application->id], key($application->id . 'get'))
                    </div>
                    @if(!is_null($application->subscribedV2))
                    <div class="w-1/2">
                        @livewire('credentials-modal-regen', ['applicationId' => $application->id], key($application->id . 'regen'))
                    </div>
                    @endif
                </div>
                @if(!is_null($application->subscribedV2))
                <div class="flex justify-center space-x-2 mb-4">
                    <div class="w-1/2">
                        @livewire('credentials-modal-pause', ['application' => $application], key($application->id . 'pause'))
                    </div>
                    <div class="w-1/2">
                        @livewire('credentials-modal-delete', ['applicationId' => $application->id], key($application->id . 'delete'))
                    </div>
                </div>
                @endif
            </div>

        </div>
        @endforeach
    </div>
</div>