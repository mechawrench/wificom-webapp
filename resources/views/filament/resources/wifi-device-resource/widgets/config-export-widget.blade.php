<x-filament::widget>
    <script>
        new ClipboardJS('.btn');

        function downloadFile(text) {
            // create a new Blob object with the text as its content
            const blob = new Blob([text], {
                type: 'text/plain'
            });

            // create a temporary anchor element
            const anchor = document.createElement('a');
            anchor.download = 'secrets.py';
            anchor.href = URL.createObjectURL(blob);
            anchor.style.display = 'none';

            // append the anchor to the document and click it
            document.body.appendChild(anchor);
            anchor.click();

            // remove the anchor from the document
            document.body.removeChild(anchor);
        }
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
                <x-filament::button type="submit" x-on:click="open = ! open" class="pl-5 w-1/4">
                    Show/Hide secrets.py
                </x-filament::button>
                <span class="px-5"></span>
                <x-filament::button type="submit" onclick="downloadFile(
                `secrets = {
                    # Wifi network variables
                    'ssid' : 'YOUR_WIFI_NETWORK',
                    'password' : 'YOUR_WIFI_PASSWORD',
                    # Hosted service variables
                    'broker': '{{ config('mqtt-client.connections.default.host')}}',
                    'mqtt_username' : '{{ $record->user->name }}',
                    'mqtt_password' : '{{ $record->user->mqtt_token }}',
                    'user_uuid': '{{ $record->user->uuid }}',
                    'device_uuid': '{{ $record->uuid }}',
                }
                    `)" class="w-1/4">
                    Download secrets.py
                </x-filament::button>
            </div>
            <div x-show="open">
                <div id="secrets" class="secrets">
                    <code>
                        secrets = { <br />
                        <div class="pl-5">
                            # Wifi network variables <br />
                            'ssid' : 'YOUR_WIFI_NETWORK',<br />
                            'password' : 'YOUR_WIFI_PASSWORD',<br />
                            # Hosted service variables<br />
                            'broker': '{{ config('mqtt-client.connections.default.host')}}',<br />
                            'mqtt_username' : '{{ $record->user->name }}',<br />
                            'mqtt_password' : '{{ $record->user->mqtt_token }}',<br />
                            'user_uuid': '{{ $record->user->uuid }}',<br />
                            'device_uuid': '{{ $record->uuid }}',<br />
                        </div>
                        }
                    </code>
                </div>
                <div class="flex justify-center pt-3 btn">
                    <x-filament::button data-clipboard-target="#secrets" class="w-1/4 btn">
                        Copy to Clipboard
                    </x-filament::button>
                </div>
            </div>


        </div>

    </x-filament::card>
</x-filament::widget>