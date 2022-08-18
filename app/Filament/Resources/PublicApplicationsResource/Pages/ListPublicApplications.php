<?php

namespace App\Filament\Resources\PublicApplicationsResource\Pages;

use App\Filament\Resources\PublicApplicationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPublicApplications extends ListRecords
{
    protected static string $resource = PublicApplicationsResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('is_public', true);
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PublicApplicationsResource\Widgets\PublicAppsOverview::class,
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            \Filament\Tables\Columns\ImageColumn::make('logo')
                ->label('Logo')
                ->default(public_path('images/default-logo.png')),
            \Filament\Tables\Columns\TextColumn::make('name')
                ->label('Name'),
            \Filament\Tables\Columns\TextColumn::make('user.name')
                ->label('Creator'),
            \Filament\Tables\Columns\BooleanColumn::make('subscribed')
                ->default(false)
                ->exists('subscribed')
                ->name('Subscribed'),
        ];
    }
}
