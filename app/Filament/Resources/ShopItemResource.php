<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopItemResource\Pages;
use App\Filament\Resources\ShopItemResource\RelationManagers;
use App\Models\ShopItem;
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

class ShopItemResource extends Resource
{
    protected static ?string $model = ShopItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

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
                                    ->label('Name (English)')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('description.en')->label('Description (English)')->required(),
                            ]),
                        Tabs\Tab::make('Arabic')
                            ->schema([
                                TextInput::make('name.ar')
                                    ->label('Name (English)')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('description.ar')->label('Description (Arabic)')->required(),
                            ]),

                        Tabs\Tab::make('More Information')
                            ->schema([
                                Select::make('category_id')
                                    ->relationship('category' , 'name')
                                    ->required()
                                    ->preload()
                                    ->searchable(),
                                TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$'),
                                TextInput::make('stock_quantity')
                                    ->required()
                                    ->numeric(),
                                SpatieMediaLibraryFileUpload::make('shop_item')
                                    ->collection('shop_item')
                                    ->multiple()
                                    ->helperText('Upload shop items media.'),
                            ]),
                    ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('category.name')
                    ->sortable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('stock_quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ListShopItems::route('/'),
            'create' => Pages\CreateShopItem::route('/create'),
            'edit' => Pages\EditShopItem::route('/{record}/edit'),
        ];
    }
}
