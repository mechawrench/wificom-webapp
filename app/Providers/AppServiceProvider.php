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
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
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
