<?php

namespace App\Filament\Resources\WifiDeviceResource\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class ConfigExportWidget extends Widget
{
    protected static string $view = 'filament.resources.wifi-device-resource.widgets.config-export-widget';

    public ?Model $record = null;

    public function downloadConfig()
    {
        $this->record->downloadConfig();
    }
}
