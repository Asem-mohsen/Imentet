<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransportationResource\Pages;
use App\Filament\Resources\TransportationResource\RelationManagers;
use App\Models\Transportation;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransportationResource extends Resource
{
    protected static ?string $model = Transportation::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Transportations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('English')
                            ->schema([
                                TextInput::make('vehicle_type.en')
                                    ->label('Vehicle Type (English)')
                                    ->required()
                                    ->maxLength(255),

                            ]),
                        Tabs\Tab::make('Arabic')
                            ->schema([
                                TextInput::make('vehicle_type.ar')
                                    ->label('Vehicle Type (English)')
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        Tabs\Tab::make('More Information')
                            ->schema([
                            Select::make('start_station_id')
                                ->relationship('startStation', 'name')
                                ->required(),

                            Select::make('end_station_id')
                                ->relationship('endStation', 'name')
                                ->required(),
                            TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->default(0.00)
                                ->prefix('$'),
                            ]),
                    ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('startStation.name')
                    ->numeric()
                    ->label('Start Station')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('endStation.name')
                    ->numeric()
                    ->label('End Station')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTransportations::route('/'),
            'create' => Pages\CreateTransportation::route('/create'),
            'edit' => Pages\EditTransportation::route('/{record}/edit'),
        ];
    }
}
