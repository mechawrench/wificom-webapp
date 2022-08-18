<?php

namespace App\Filament\Resources\SubscribedApplicationsResource\Pages;

use App\Filament\Resources\SubscribedApplicationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubscribedApplications extends EditRecord
{
    protected static string $resource = SubscribedApplicationsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
