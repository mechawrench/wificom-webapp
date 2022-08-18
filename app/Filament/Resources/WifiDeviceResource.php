<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Widgets\ApplicationsOverview;
use App\Filament\Resources\WifiDeviceResource\Pages;
use App\Filament\Resources\WifiDeviceResource\Widgets\ConfigExportWidget;
use App\Filament\Resources\WifiDeviceResource\Widgets\SendDigirom;
use App\Filament\Resources\WifiDeviceResource\Widgets\WifiDeviceStatus;
use App\Models\WifiDevice;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class WifiDeviceResource extends Resource
{
    protected static ?string $model = WifiDevice::class;

    protected static ?string $navigationGroup = 'Devices';

    protected static ?string $navigationIcon = 'heroicon-o-wifi';

    protected static ?string $navigationTitle = 'Manage your WiFi-Com devices';

    protected static ?string $navigationDescription = 'Manage your WiFi-Com\'s';

    protected static ?string $recordTitleAttribute = 'device_name';

    // Update name of the resource on sidebar
    protected static ?string $label = 'Wifi-Com';

    // Add plural name of the resource on sidebar
//    protected static ?string $labelPlural = 'WiFi-Com Devices';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereBelongsTo(auth()->user())
            ->orderBy('sort');
    }

    // Add widgets
    protected static ?array $widgets = [
        ApplicationsOverview::class,
        SendDigirom::class,
        WifiDeviceStatus::class,
        ConfigExportWidget::class,
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('device_name')
                    ->unique(ignorable: fn (?WifiDevice $record): ?WifiDevice => $record)
                    ->required(),

                Forms\Components\Textarea::make('device_comments'),

                Forms\Components\TextInput::make('uuid')
                    ->disabled()
                    ->placeholder('UUID will be generated on creation of the WiFiCom'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('device_name')
                    ->label('Name'),
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID'),
                Tables\Columns\TextColumn::make('device_type')
                    ->label('Type'),
                Tables\Columns\TextColumn::make('sort')
                    ->label('Sort')
                    ->sortable(),
            ])
            ->defaultSort('sort', 'asc')
            ->filters([
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->reorderable();
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
            'index' => Pages\ListWifiDevices::route('/'),
            'create' => Pages\CreateWifiDevice::route('/create'),
            'view' => Pages\ViewWifiDevice::route('/{record}'),
            'edit' => Pages\EditWifiDevice::route('/{record}/edit'),
        ];
    }
}
