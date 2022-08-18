<x-filament::widget>
    <x-filament::card>
        <h1 class="text-2xl">Queue Digirom</h1>
        <!-- Create a form with one text item and a submit button -->
        <!-- Show validation errors -->
        <div>
            <div class="mb-3">
                Send a Digirom to your device (if it's online)
            </div>
            <form wire:submit.prevent="saveDigirom">
                <div>
                    <input type="text" wire:model="digirom" class="w-full">
                    @error('digirom') <span class="error text-red-300"><br/>{{ $message }}</span> @enderror
                </div>

                <div class="pt-5 text-right">
                    <x-filament::button type="submit" class="w-1/4">
                        Send Digirom
                    </x-filament::button>
                </div>

                <span class="text-lg text-green-400">{{$successMessage}}</span>
            </form>
            <div wire:poll>
                Recent Output (Results stay for 10 minutes)
                <div class="bg-gray-300 border-2 border-gray-500 p-4">
                    {{ \Illuminate\Support\Facades\Cache::get($record->user->uuid . '-' . $record->uuid . '-' . '0' . '_last_output') ?? 'No output yet' }}
                </div>
            </div>

        </div>
    </x-filament::card>
</x-filament::widget>
