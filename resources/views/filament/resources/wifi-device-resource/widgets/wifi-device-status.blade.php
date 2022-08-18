<x-filament::widget>
    <x-filament::card>
        <h1 class="text-2xl">Device Status</h1>
        <!-- Create a form with one text item and a submit button -->
        <!-- Show validation errors -->
        <div wire:poll.{{$pollingInterval}}s>
            <div class="text-center p-5">
                <span class="text-lg text-xl p-3  border-2 rounded-2xl italic  {{$record->last_ping_at < \Carbon\Carbon::now()->subSeconds(30) ? "text-red-300 bg-danger-500 border-red-600" : "text-green-300 bg-green-500 border-green-600"}}">{{$record->last_ping_at && $record->last_ping_at > \Carbon\Carbon::now()->subSeconds(30) ? "ONLINE" : "OFFLINE"}}</span>
            </div>
            <div>
                <span class="text-lg">Last Device Heartbeat: {{$record->last_ping_at ? $record->last_ping_at->diffForHumans() : "Never Connected"}}</span>
            </div>
            <div>
                <span class="text-lg">Time Since Last Digirom: {{$record->last_code_sent_at ? $record->last_code_sent_at->diffForHumans() : "No Digiroms Sent Yet"}}</span>
            </div>
            <div class="italic flex justify-center">
                Updates every 5 seconds
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
