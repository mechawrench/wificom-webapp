<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Devices',
                'Apps',
                'Docs',
            ]);
        });

        Filament::registerNavigationGroups([
            'Devices',
            'Online Battles',
            'Applicatons',
        ]);
    }
}
