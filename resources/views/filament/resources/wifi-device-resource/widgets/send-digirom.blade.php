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
                    @error('digirom') <span class="error text-red-300"><br />{{ $message }}</span> @enderror
                </div>

                <div class="pt-5 text-right">
                    <x-filament::button type="submit" class="w-1/4">
                        Send Digirom
                    </x-filament::button>
                </div>

                <div wire:poll.1s="checkAckReceived">
                    <div class="text-center p-5">
                        <span class="text-lg text-green-400">{{ $successMessage }}</span>
                    </div>
                </div>
            </form>
            <div wire:poll>
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-bold">Recent Output</h2>
                    <p class="text-sm text-gray-500">{{ $record->last_output_web_updated_at ? $record->last_output_web_updated_at->diffForHumans() : '' }}</p>
                </div>
                <!-- (Results stay for 10 minutes) -->
                <div class="bg-gray-300 border-2 border-gray-500 p-4">
                    {!! nl2br(e($record->last_output_web)) !!}
                </div>
            </div>

        </div>
    </x-filament::card>
</x-filament::widget>