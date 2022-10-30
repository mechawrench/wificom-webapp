<x-filament::page>
    <x-filament::card>
        <h1 class="text-2xl">Generate Realtime Battle Code</h1>
        <!-- Create a form with one text item and a submit button -->
        <!-- Show validation errors -->
        <div>
            <div class="mb-3">
                Create a realtime battle instance with another player, send them the invite code to sync up your WiFiCom devices.
            </div>
            <span class="text-lg text-green-400">{{$successMessageInitiate}}</span>
            <div>
                <div class="mb-3">
                    <label for="battle_type" class="block text-sm font-bold mb-2">Device Type</label>
                    <select wire:model="battle_type" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="none" selected>Select a Device Type (Digimon/Legendz)</option>
                        <option value="digimon-penx-battle">Digimon (PenX) Battle</option>
                        <option value="legendz">Legendz</option>
                    </select>
                    @error('battle_type') <span class="error text-red-300"><br/>{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="user_selected_com_host" class="block text-sm font-bold mb-2">WiFiCom Device to Use</label>
                    <select wire:model="user_selected_com_host" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="none" selected>Select a Com Device</option>
                        @foreach($user_coms as $com)
                            <option value="{{$com->uuid}}">{{$com->device_name}}</option>
                        @endforeach
                        <option value="DUMMY">DUMMY DEVICE (DEBUG)</option>
                    </select>
                    @error('user_selected_com_host') <span class="error text-red-300"><br/>{{ $message }}</span> @enderror
                </div>

                <div class="pt-5 text-right">

                    <x-filament::button class="w-1/4" wire:click.prevent="genRtbInvite">
                        Start Realtime Battle
                    </x-filament::button>
                    <br/>
                    <x-filament::button class="w-1/4 mt-5" wire:click.prevent="retryHost">
                        Retry
                    </x-filament::button>
                </div>
            </div>
            <div wire:poll>
                Invite Code (Pass this to your partner)
                <div class="bg-gray-300 border-2 border-gray-500 p-4">
                    {{ $current_rtb_model->invite_code ?? 'No Invite Code Yet' }}
                </div>
            </div>
        </div>
    </x-filament::card>
    <x-filament::card>
        <h1 class="text-2xl">Accept Realtime Battle</h1>
        <!-- Create a form with one text item and a submit button -->
        <!-- Show validation errors -->
        <div>
            <div class="mb-3">
                Enter your partner's invite code
            </div>
            <span class="text-lg text-green-400">{{$successMessageAccept}}</span>
            <span class="text-lg text-red-400">{{$errorMessage}}</span>
            <div>
                    <div class="mb-3">
                        <input type="text" wire:model="invite_code" class="w-full">
                        @error('invite_code') <span class="error text-red-300"><br/>{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_selected_com_guest" class="block text-sm font-bold mb-2">WiFiCom Device to Use</label>
                        <select wire:model="user_selected_com_guest" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="none" selected>Select a Com Device</option>
                            @foreach($user_coms as $com)
                                <option value="{{$com->uuid}}">{{$com->device_name}}</option>
                            @endforeach
                        </select>
                        @error('user_selected_com_guest') <span class="error text-red-300"><br/>{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-5 text-right">

                        <x-filament::button type="submit" class="w-1/4" wire:click.prevent="accept_rtb">
                            Start Realtime Battle
                        </x-filament::button>
                        <br/>
                        <x-filament::button class="w-1/4 mt-5" wire:click.prevent="retryGuest">
                            Retry
                        </x-filament::button>
                    </div>
                </div>
        </div>
    </x-filament::card>

</x-filament::page>
