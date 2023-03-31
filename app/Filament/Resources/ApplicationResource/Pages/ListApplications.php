<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use App\Filament\Resources\ApplicationResource\Widgets\ApplicationsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            ApplicationsOverview::class,
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make('Create application'),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            // \Filament\Tables\Columns\ImageColumn::make('logo')
            //     ->label('Logo'),
            \Filament\Tables\Columns\TextColumn::make('name')
                ->label('Name'),
            \Filament\Tables\Columns\TextColumn::make('uuid'),
            \Filament\Tables\Columns\TextColumn::make('api_version')
                ->label('API Version')
        ];
    }
}
