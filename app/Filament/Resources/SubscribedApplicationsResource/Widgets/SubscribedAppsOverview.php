<?php

namespace App\Filament\Resources\SubscribedApplicationsResource\Widgets;

use Filament\Widgets\Widget;

class SubscribedAppsOverview extends Widget
{
    protected static string $view = 'filament.resources.subscribed-appliations-resource.widgets.subscribed-apps-overview';

    protected int|string|array $columnSpan = 'full';

    protected $casts = [
        'is_exclusive' => 'boolean',
    ];
}
