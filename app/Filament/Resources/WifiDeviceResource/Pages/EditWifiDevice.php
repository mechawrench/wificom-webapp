<?php

namespace App\Filament\Resources\WifiDeviceResource\Pages;

use App\Filament\Resources\WifiDeviceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWifiDevice extends EditRecord
{
    protected static string $resource = WifiDeviceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
