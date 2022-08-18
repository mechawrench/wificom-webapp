<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscribedApplicationsResource\Pages;
use App\Models\SubscribedApplication;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class SubscribedApplicationsResource extends Resource
{
    protected static ?string $model = SubscribedApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rss';

    protected static ?string $navigationGroup = 'Apps';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
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
                Action::make('subscribe')
                    ->label('Subscribe')
                    ->icon('heroicon-o-check')
                    ->action(fn (SubscribedApplication $record): string => $record->delete())
                    ->visible(fn (SubscribedApplication $record): bool => ! $record->exists()),
                Action::make('unsubscribe')
                    ->label('Unsubscribe')
                    ->icon('heroicon-o-trash')
                    ->action(fn (SubscribedApplication $record): string => $record->delete())
                    ->visible(fn (SubscribedApplication $record): bool => $record->exists()),
                Action::make('make_exclusive')
                    ->label('Set Exclusivity')
                    ->icon('heroicon-o-star')
                    ->hidden(fn (SubscribedApplication $record): bool => $record->is_exclusive)
                    ->action(fn (SubscribedApplication $record): string => $record->makeExclusive()),
                Action::make('make_non_exclusive')
                    ->label('Remove Exclusivity')
                    ->icon('heroicon-o-star')
                    ->action(fn (SubscribedApplication $record): string => $record->makeNotExclusive())
                    ->hidden(fn (SubscribedApplication $record): bool => ! $record->is_exclusive),
            ])
            ->bulkActions([
                // TODO: Add bulk unsubscribe
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
            'index' => Pages\ListSubscribedApplications::route('/'),
            //            'create' => Pages\CreateSubscribedApplications::route('/create'),
            //            'edit' => Pages\EditSubscribedApplications::route('/{record}/edit'),
        ];
    }
}
