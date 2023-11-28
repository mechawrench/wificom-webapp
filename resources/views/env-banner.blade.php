<div class="bg-orange-500 text-center p-3 ml-300 sm:pl-50" style="height: 160px; max-height: 160px;">
    <div class="mx-auto sm:w-full" style="resize: both; overflow: auto;">
    </div>
    <div class="mx-auto sm:w-full" style="resize: both; overflow: auto;">
        <h2 class="hidden sm:hidden md:block text-white text-3xl">Warning: You are not in the production environment</h2>
        <h3 class="text-red-200 text-xl font-bold">Environment: {{ env('APP_ENV') }}</h3>
        <p class="text-white text-base sm:text-base md:text-base"><i>Please note that the database resets periodically, and the wificom secrets.py file must be updated for the new MQTT server</i></p>
        <p class="hidden sm:hidden md:block text-white text-base"><i>Any changes on this site will not be reflected on the production site</i></p>
        <p class="hidden sm:hidden md:block text-white text-base"><i>Apps on this site will not work unless the app is also connected to this site</i></p>
    </div>
</div>

