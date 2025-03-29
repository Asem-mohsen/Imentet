<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GiftShopsResource\Pages;
use App\Filament\Resources\GiftShopsResource\RelationManagers;
use App\Models\GiftShop;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
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

class GiftShopsResource extends Resource
{
    protected static ?string $model = GiftShop::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationGroup = 'Gift Shops';

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
                                    ->unique(column: 'name->en' , ignoreRecord: true)
                                    ->label('Gift Shop Name (English)')
                                    ->maxLength(255),

                                Textarea::make('location.en')->label('Location (English)'),
                            ]),
                    Tabs\Tab::make('Arabic')
                        ->schema([
                                TextInput::make('name.ar')
                                    ->required()
                                    ->unique(column: 'name->ar', ignoreRecord: true)
                                    ->label('Gift Shop Name (Arabic)')
                                    ->maxLength(255),

                                Textarea::make('location.ar')->label('Location (Arabic)'),
                            ]),
                            
                    Tabs\Tab::make('Place')
                        ->schema([
                            Select::make('place_id')
                                ->label('Select Place')
                                ->relationship('place', 'name')
                                ->preload()
                                ->searchable()
                                ->required(),
                            ]),

                    Tabs\Tab::make('Media')
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('gift_shop_meida')
                                ->collection('gift_shop_meida')
                                ->multiple()
                                ->helperText('Upload gift shop media.'),
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
                TextColumn::make('place.name')->label('Place')->sortable()->searchable(),
                TextColumn::make('location')->label('Location')->sortable()->searchable()->words(8),
                TextColumn::make('items_count')->label('No. of Items')->counts('items')->sortable(),
                TextColumn::make('created_at')->date()->sortable(),
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
            'index' => Pages\ListGiftShops::route('/'),
            // 'create' => Pages\CreateGiftShops::route('/create'),
            // 'edit' => Pages\EditGiftShops::route('/{record}/edit'),
        ];
    }
}
