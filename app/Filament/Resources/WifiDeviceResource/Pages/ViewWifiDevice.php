<?php

namespace App\Filament\Resources\WifiDeviceResource\Pages;

use App\Filament\Resources\WifiDeviceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWifiDevice extends ViewRecord
{
    protected static string $resource = WifiDeviceResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            WifiDeviceResource\Widgets\SendDigirom::class,
            WifiDeviceResource\Widgets\WifiDeviceStatus::class,
            WifiDeviceResource\Widgets\ConfigExportWidget::class,
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
