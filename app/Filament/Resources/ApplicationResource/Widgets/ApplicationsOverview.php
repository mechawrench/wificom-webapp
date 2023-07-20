<?php

namespace App\Filament\Resources\ApplicationResource\Widgets;

use Filament\Widgets\Widget;

class ApplicationsOverview extends Widget
{
    protected static string $view = 'filament.resources.application-resource.widgets.applications-overview';

    protected int|string|array $columnSpan = 'full';
}
