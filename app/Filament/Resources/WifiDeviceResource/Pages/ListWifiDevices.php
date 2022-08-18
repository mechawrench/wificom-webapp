<?php

namespace App\Filament\Resources\WifiDeviceResource\Pages;

use App\Filament\Resources\WifiDeviceResource;
use App\Models\WifiDevice;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListWifiDevices extends ListRecords
{
    protected static string $resource = WifiDeviceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make('Application'),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return WifiDevice::query()
            ->whereBelongsTo(auth()->user())
            ->orderBy('sort')
            ->limit(10);
    }

    protected function getTableColumns(): array
    {
        return [
            \Filament\Tables\Columns\TextColumn::make('device_name')
                ->label('Name'),
            \Filament\Tables\Columns\TextColumn::make('uuid')
                ->label('UUID'),
            \Filament\Tables\Columns\BooleanColumn::make('online_status')
                ->label('Online'),
            \Filament\Tables\Columns\TextColumn::make('sort')
                ->sortable()
                ->hidden(),
        ];
    }
}
