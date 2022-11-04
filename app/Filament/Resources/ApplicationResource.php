<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Filament\Resources\ApplicationResource\RelationManagers\SubscribedApplicationsRelationManager;
use App\Models\Application;
use App\Models\SubscribedApplication;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $modelLabel = 'My Application';

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $slug = 'my-applications';

    protected static ?string $navigationLabel = 'My Applications';

    protected static ?string $navigationTitle = 'My Applications';

    protected static ?string $navigationGroup = 'Apps';

    protected static ?string $label = 'My Application';

    protected static ?string $labelPlural = 'My Applications';

    protected static ?string $recordTitleAttribute = 'name';

    // Change sidebar order
    protected static int $order = 0;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignorable: fn (?Application $record): ?Application => $record),
                Forms\Components\Textarea::make('description')
                    ->required(),
                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->maxSize(2048)
                    ->required(),
                Forms\Components\TextInput::make('website'),
                Forms\Components\Toggle::make('is_public')
                    ->label('Is Publicly Available'),
                Forms\Components\Toggle::make('is_output_hidden')
                    ->label('Hide Serial Output'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('subscribe')
                    ->label('Subscribe')
                    ->icon('heroicon-o-check-circle')
                    ->action(fn (Application $record): string => SubscribedApplication::create([
                        'application_uuid' => $record->uuid,
                        'user_id' => auth()->id(),
                    ]))
                    ->visible(fn (Application $record): bool => ! $record->subscribed),
                Action::make('unsubscribe')
                    ->label('Unsubsribe')
                    ->icon('heroicon-o-trash')
                    ->action(fn (Application $record): string => SubscribedApplication::where([
                        'application_uuid' => $record->uuid,
                        'user_id' => auth()->id(),
                    ])->delete())
                    ->hidden(fn (Application $record): bool => ! $record->subscribed),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
            'view' => Pages\ViewApplication::route('/{record}'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            SubscribedApplicationsRelationManager::class,
        ];
    }
}
