<x-filament::widget>
    <x-filament::card>
        <div class="rounded-md bg-yellow-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: solid/exclamation -->
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Attention needed</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p class="pb-5">
                            Any apps here that you are subscribed to can read and write to your WiFiCom, potentially at any time.  Please review your subscribed Apps reguarly to ensure you are still using them.
                        </p>

                        <hr />
                        <p class="py-5">
                            Visit your applications and the public applications page to find more Apps to subscribe to.
                        </p>
                        <ul class="list-none pl-5">
                            <li>
                                <a href="{{ route('filament.resources.my-applications.index') }}" class="text-red-700 hover:text-red-800">
                                   Visit My Apps
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('filament.resources.public-applications.index') }}" class="text-red-700 hover:text-red-800">
                                    Visit Public Apps
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
