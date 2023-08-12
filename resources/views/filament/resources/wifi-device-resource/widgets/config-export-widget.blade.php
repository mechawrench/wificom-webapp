<x-filament::widget>
    <x-filament::card x-data="popupComponent()" class="mb-10">
        <h2 class="text-2xl font-bold text-center">Credentials Download</h2>
        <div>
            Copy the following config to secrets.py on your WiFiCom device (CIRCUITPY drive). Do not share this file with anyone!
        </div>
        <div>
            First put your WiFiCom into Drive Mode.
        </div>
        <div>
            Use the Local Only Configurator (recommended) to enter your WiFi network information before saving the file. Alternatively, use one of the other two options, then replace the uppercase values in the file with your own information to complete the configuration.
        </div>

        <div x-show="showConfigurator" class="fixed  top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-8 bg-white border border-gray-300 rounded shadow-lg z-50">
            <h3 class="text-xl font-bold text-center">Local Only Configurator</h3>
            <form @submit.prevent="submitForm" class="space-y-4">
                <div @click="showConfigurator = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 cursor-pointer">
                    &times;
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        WiFi SSID:
                        <input type="text" name="wifi_custom_ssid" id="wifi_custom_ssid" x-model="wifi_custom_ssid" class="mt-1 p-2 w-full border rounded-md" autocomplete="off">
                    </label>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        WiFi Password:
                        <input type="text" name="wifi_custom_password" id="wifi_custom_password" x-model="wifi_custom_password" class="mt-1 p-2 w-full border rounded-md" autocomplete="off">
                    </label>
                </div>
                <div class="block text-sm font-medim text-gray-500 italic">
                    This information is not shared with wificom.dev
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Download</button>
                </div>
            </form>
        </div>

        <div x-data="{ open: false }">
            <div class="flex justify-center">
                <x-filament::button type="submit" @click="showConfigurator = !showConfigurator"  class="pr-5 mr-5 w-1/4">
                    Local Only
                    Configurator
                </x-filament::button>
                <x-filament::button type="submit" x-on:click="open = ! open" class="ml-5 pr-5 w-1/4">
                    Show/Hide secrets.py
                </x-filament::button>
                <span class="px-5"></span>
                <x-filament::button type="submit" onclick="downloadFile(`
'''
This file is where you keep secret settings, keep it safe and keep a backup.
Please note, you can get an automatically generated version of this on the webapp
'''

secrets = {
    # Wifi network variables
    'wireless_networks':[
        {'ssid': 'FIRST_SSID', 'password': 'YOURSECUREPASSWORD'},
        # {'ssid': 'SECOND_SSID', 'password': 'YOURSECUREPASSWORD'}, # Example of an additional network
        # {'ssid': 'THIRD_SSID', 'password': 'YOURSECUREPASSWORD'}, # Example of an additional network
    ],
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
                            'wireless_networks':[<br />
                            {'ssid': 'FIRST_SSID', 'password': 'YOURSECUREPASSWORD'},<br />
                            # {'ssid': 'SECOND_SSID', 'password': 'YOURSECUREPASSWORD'}, <br />
                            # {'ssid': 'THIRD_SSID', 'password': 'YOURSECUREPASSWORD'}, <br />
                            ],
                            # Hosted service variables<br />
                            'broker': '{{ config('mqtt-client.connections.default.host')}}',<br />
                            'mqtt_username' : '{{ $record->user->name }}',<br />
                            'mqtt_password' : '{{ $record->user->mqtt_token }}',<br />
                            'user_uuid': '{{ $record->user->uuid }}',<br />
                            'device_uuid': '{{ $record->uuid }}',<br />
                            <br/>
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

            <script>
                function popupComponent() {
                    return {
                        showConfigurator: false,
                        wifi_custom_ssid: '',
                        wifi_custom_password: '',

                        submitForm() {
let secrets =`'''
This file is where you keep secret settings, keep it safe and keep a backup.
Please note, you can get an automatically generated version of this on the webapp
'''

secrets = {
	# WiFi network variables
	'wireless_networks':[
		{'ssid': 'FIRST_SSID', 'password': 'YOURSECUREPASSWORD'},
		# {'ssid': 'SECOND_SSID', 'password': 'YOURSECUREPASSWORD'}, # Example of an additional network
		# {'ssid': 'THIRD_SSID', 'password': 'YOURSECUREPASSWORD'}, # Example of an additional network
	],
	# Hosted service variables
	'broker': '{{ config('mqtt-client.connections.default.host')}}',
    'mqtt_username' : '{{ $record->user->name }}',
    'mqtt_password' : '{{ $record->user->mqtt_token }}',
    'user_uuid': '{{ $record->user->uuid }}',
    'device_uuid': '{{ $record->uuid }}'
}
`;
                            secrets = secrets.replace("{'ssid': 'FIRST_SSID', 'password': 'YOURSECUREPASSWORD'}", `{'ssid': '${this.wifi_custom_ssid}', 'password': '${this.wifi_custom_password}'}`);

                            const blob = new Blob([secrets], { type: 'text/plain' });
                            const url = URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = 'secrets.py';
                            a.click();
                            URL.revokeObjectURL(url);

                            this.showConfigurator = false;
                        }
                    }
                }

                new ClipboardJS('.btn');

                function downloadFile(text) {const blob = new Blob([text], {
                        type: 'text/plain'
                    });

                    const anchor = document.createElement('a');
                    anchor.download = 'secrets.py';
                    anchor.href = URL.createObjectURL(blob);
                    anchor.style.display = 'none';

                    document.body.appendChild(anchor);

                    anchor.click();

                    document.body.removeChild(anchor);
                }
            </script>
        </div>
    </x-filament::card>
</x-filament::widget>
