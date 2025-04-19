<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Sale;
use App\Repositories\ShopItemsRepository;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Filament\Forms\Set;
class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-percent-badge';

    protected static ?string $navigationGroup = 'Gift Shops';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('shop_item_id')
                    ->required()
                    ->label('Product')
                    ->options(app(ShopItemsRepository::class)->getAvailableForSale()->pluck('name', 'id'))
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $shopItem = app(ShopItemsRepository::class)->findById($state);
                        if ($shopItem) {
                            $set('price', $shopItem->price);
    
                            $discountPercent = $get('amount_of_dicount'); // use Get here
                            if ($discountPercent) {
                                $discount = $shopItem->price * $discountPercent / 100;
                                $set('discounted_price', $shopItem->price - $discount);
                            }
                        }
                    }),
                TextInput::make('price')
                    ->label('Original Price')
                    ->readOnly()
                    ->numeric(),
                TextInput::make('amount_of_dicount')
                    ->label('Discount Amount')
                    ->prefix('%')
                    ->required()
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $originalPrice = $get('price');
                
                        if ($originalPrice && is_numeric($state)) {
                            $discounted = $originalPrice - ($originalPrice * $state / 100);
                
                            // Prevent negative prices
                            if ($discounted < 0) {
                                $set('discounted_price', 0.00); // fallback value or null
                                // Optionally: You can also throw a validation error manually
                                session()->flash('error', 'New price cannot be negative.');
                            } else {
                                $set('discounted_price', number_format($discounted, 2, '.', ''));
                            }
                        }
                    }),
                
                TextInput::make('discounted_price')
                    ->label('New Price')
                    ->numeric()
                    ->readOnly()
                    ->default(0.00),
                DateTimePicker::make('start_date')
                    ->required()
                    ->after(today()),
                DateTimePicker::make('end_date')->after('start_date'),
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'pending' => 'Pending',
                        'inactive' => 'Inactive',
                    ])
                    ->required()
                    ->default('active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('shopItem.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('shopItem.price')
                    ->numeric()
                    ->color('danger')
                    ->label('Original Price')
                    ->sortable(),
                TextColumn::make('discounted_price')
                    ->numeric()
                    ->color('success')
                    ->label('New Price')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'pending' => 'warning',
                    }),
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
