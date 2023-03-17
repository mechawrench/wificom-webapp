<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use Filament\Resources\Pages\Page;

class AppCredentials extends Page
{
    protected static string $resource = ApplicationResource::class;

    protected static ?string $title = 'App Credentials';
    protected static ?string $navigationGroup = 'Apps';
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationLabel = 'Credentials';

    protected static ?int $navigationSort = -1;
    protected static string $view = 'filament.resources.application-resource.pages.app-credentials';

    public $applications;
    
    public function mount(): void
    {
        $this->applications = \App\Models\Application::where('is_public', true)->get();
    }
}
