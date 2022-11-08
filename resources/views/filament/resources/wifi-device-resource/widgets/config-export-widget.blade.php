<x-filament::widget>
    <script>
        new ClipboardJS('.btn');
    </script>
    <x-filament::card>
        <h2 class="text-2xl font-bold text-center">View your secrets.py config contents</h2>

        <div>
            Copy the following config to secrets.py on your WiFiCom device, do not share this file with anyone!
        </div>
        <div>
            Replace the uppercase values with your own information to complete the configuration.
        </div>
        <!-- Codeblock -->
        <div x-data="{ open: false }">
            <div class="flex justify-center">
                <x-filament::button type="submit" x-on:click="open = ! open"   class="w-1/4">
                    Show/Hide secrets.py
                </x-filament::button>
            </div>

            <div x-show="open">
                <div  id="secrets" class="secrets">
                    <code>
                        secrets = { <br/>
                        <div class="pl-5">
                            # Wifi network variables <br/>
                            'ssid' : 'YOUR_WIFI_NETWORK',<br/>
                            'password' : 'YOUR_WIFI_PASSWORD',<br/>
                            # Hosted service variables<br/>
                            'broker': '{{ config('mqtt-client.connections.default.host')}}',<br/>
                            'mqtt_username' : '{{ $record->user->name }}',<br/>
                            'mqtt_password' : '{{ $record->user->mqtt_token }}',<br/>
                            'user_uuid': '{{ $record->user->uuid }}',<br/>
                            'device_uuid': '{{ $record->uuid }}',<br/>
                        </div>
                        }
                    </code>
                </div>
                <div class="flex justify-center pt-3 btn">
                    <x-filament::button data-clipboard-target="#secrets"   class="w-1/4 btn">
                        Copy to Clipboard
                    </x-filament::button>
                </div>
            </div>


        </div>

    </x-filament::card>
</x-filament::widget>
