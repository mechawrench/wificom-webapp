<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;

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
                'Online Battles',
                'Applications',
                ]);
        });

        if (env('APP_ENV') != 'production') {
            Filament::registerRenderHook(
                'body.start',
                fn (): View => view('env-banner'),
            );
        }
    }
}
