<div class="bg-orange-500 text-center p-10">
    <h2 class="text-white text-4xl">Warning: You are not in the production environment.</h2>
    <h3 class="text-red-200 text-2xl font-bold">Environment: {{ env('APP_ENV') }}</h3>
    <p class="text-white text-lg"><i>Please note that the database resets periodically, and the wificom secrets.py file must be updated for the new MQTT server.</i></p>
    <p class="text-white text-lg"><i>Also, remember that apps created or edited here won't be reflected on the production website.</i></p>
</div>
