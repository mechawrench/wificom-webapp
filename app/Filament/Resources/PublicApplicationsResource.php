<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicApplicationsResource\Pages;
use App\Models\Application;
use App\Models\SubscribedApplication;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class PublicApplicationsResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $modelLabel = 'Public Applications';

    protected static ?string $title = 'Custom Page Title';

    protected static ?string $slug = 'public-applications';

    protected static ?string $navigationLabel = 'Public Applications';

    protected static ?string $navigationTitle = 'Public Applications';

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationGroup = 'Apps';

    protected static ?string $label = 'Public Application';

    protected static ?string $labelPlural = 'Public Applications';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_public', true);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                //                Tables\Actions\EditAction::make(),
                Action::make('subscribe')
                    ->label('Subscribe')
                    ->icon('heroicon-o-check-circle')
                    ->action(fn (Application $record): string => SubscribedApplication::create([
                        'application_uuid' => $record->uuid,
                        'user_id' => auth()->id(),
                    ]))
                    ->visible(fn (Application $record): bool => !$record->subscribed),
                Action::make('unsubscribe')
                    ->label('Unsubsribe')
                    ->icon('heroicon-o-trash')
                    ->action(fn (Application $record): string => SubscribedApplication::where([
                        'application_uuid' => $record->uuid,
                        'user_id' => auth()->id(),
                    ])->delete())
                    ->hidden(fn (Application $record): bool => !$record->subscribed),

            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPublicApplications::route('/'),
            //            'create' => Pages\CreatePublicApplications::route('/create'),
            //            'edit' => Pages\EditPublicApplications::route('/{record}/edit'),
        ];
    }
}
