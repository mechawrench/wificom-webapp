<?php

namespace App\Filament\Resources\WifiDeviceResource\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class DiscordWidget extends Widget
{
    protected static string $view = 'filament.resources.dashboard-resource.widgets.discord-widget';

    public ?Model $record = null;
}
