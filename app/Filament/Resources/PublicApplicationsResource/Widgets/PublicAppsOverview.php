<?php

namespace App\Filament\Resources\PublicApplicationsResource\Widgets;

use Filament\Widgets\Widget;

class PublicAppsOverview extends Widget
{
    protected static string $view = 'filament.resources.public-applications-resource.widgets.public-apps-overview';

    protected int | string | array $columnSpan = 'full';
}
