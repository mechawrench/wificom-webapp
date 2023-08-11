<?php

namespace App\Filament\Resources\PublicApplicationsResource\Pages;

use App\Filament\Resources\PublicApplicationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPublicApplications extends EditRecord
{
    protected static string $resource = PublicApplicationsResource::class;

    // Add query scope
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('is_public', true)->where('api_version', 1);
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
