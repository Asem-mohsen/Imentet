<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StationsResource\Pages;
use App\Filament\Resources\StationsResource\RelationManagers;
use App\Models\Station;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StationsResource extends Resource
{
    protected static ?string $model = Station::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static ?string $navigationGroup = 'Transportations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('English')
                            ->schema([

                                    TextInput::make('name.en')
                                        ->required()
                                        ->unique(column: 'name->en')
                                        ->label('Station Name (English)')
                                        ->maxLength(255),

                                    Textarea::make('description.en')->label('Description (English)')->columnSpanFull(),
                                ]),
                        Tabs\Tab::make('Arabic')
                            ->schema([

                                    TextInput::make('name.ar')
                                        ->required()
                                        ->unique(column: 'name->ar')
                                        ->label('Station Name (Arabic)')
                                        ->maxLength(255),
                                        

                                    Textarea::make('description.ar')->label('Description (Arabic)')->columnSpanFull(),
                                ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable()->words(4),
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
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStations::route('/'),
            // 'create' => Pages\CreateStations::route('/create'),
            // 'edit' => Pages\EditStations::route('/{record}/edit'),
        ];
    }
}
