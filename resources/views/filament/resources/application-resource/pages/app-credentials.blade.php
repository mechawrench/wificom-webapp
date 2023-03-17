<x-filament::page>
    <div class="container mx-auto px-4 py-8" x-data="{ open: false }">
        <div class="grid grid-cols-2 gap-4">
            @foreach($applications as $application)
            <div class="card rounded shadow-lg p-4 bg-white">
                <h3 class="text-xl font-semibold mb-4 text-center">{{$application->name}} <br /><span class="text-xs italic">By {{$application->user->name}}</h3>
                <div class="flex items-center space-x-2">
                        @livewire('credentials-modal-get', ['applicationId' => $application->id])
                        @livewire('credentials-modal-regen', ['applicationId' => $application->id])
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-filament::page>