<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use App\Models\Application;
use Filament\Resources\Pages\Page;

class AppCredentials extends Page
{
    protected static string $resource = ApplicationResource::class;

    protected static ?string $title = 'App Credentials';
    protected static ?string $navigationGroup = 'Apps';
    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationLabel = 'API Keys';

    protected static ?int $navigationSort = -1;
    protected static string $view = 'filament.resources.application-resource.pages.app-credentials';

    public $applications;

    protected $listeners = ['refreshAppCredentials' => 'refreshData'];

    public function mount(): void
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->applications = \App\Models\Application::where(function ($query) {
            $query->where('is_public', true)
                  ->orWhere('user_id', auth()->user()->id);
        })
        ->where('api_version', 2)
        ->with('subscribedV2')
        ->get();
    }
}
