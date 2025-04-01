<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GiftShopItemResource\Pages;
use App\Filament\Resources\GiftShopItemResource\RelationManagers;
use App\Models\GiftShopItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GiftShopItemResource extends Resource
{
    protected static ?string $model = GiftShopItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('gift_shop_id')
                    ->relationship('giftShop', 'name')
                    ->required(),
                Forms\Components\Select::make('shop_item_id')
                    ->relationship('shopItem', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('giftShop.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('shopItem.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListGiftShopItems::route('/'),
            'create' => Pages\CreateGiftShopItem::route('/create'),
            'edit' => Pages\EditGiftShopItem::route('/{record}/edit'),
        ];
    }
}
