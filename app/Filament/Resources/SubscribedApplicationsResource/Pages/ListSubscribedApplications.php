<?php

namespace App\Filament\Resources\SubscribedApplicationsResource\Pages;

use App\Filament\Resources\SubscribedApplicationsResource;
use App\Filament\Resources\SubscribedApplicationsResource\Widgets\SubscribedAppsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubscribedApplications extends ListRecords
{
    protected static string $resource = SubscribedApplicationsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SubscribedAppsOverview::class,
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            \Filament\Tables\Columns\ImageColumn::make('app.logo')
                ->label('Logo')
                ->default(public_path('images/default-logo.png')),
            \Filament\Tables\Columns\TextColumn::make('app.name')
                ->label('Name'),
            \Filament\Tables\Columns\TextColumn::make('user.name')
                ->label('Creator'),
            \Filament\Tables\Columns\TextColumn::make('app.uuid')
                ->label('UUID'),
            \Filament\Tables\Columns\BooleanColumn::make('is_exclusive')
                ->label('Exclusive Access'),
        ];
    }
}
