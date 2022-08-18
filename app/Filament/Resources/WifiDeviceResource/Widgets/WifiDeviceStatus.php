<?php

namespace App\Filament\Resources\WifiDeviceResource\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class WifiDeviceStatus extends Widget
{
    protected static string $view = 'filament.resources.wifi-device-resource.widgets.wifi-device-status';

    public ?Model $record = null;

    // Polling interval in seconds
    public int $pollingInterval = 5;
}
