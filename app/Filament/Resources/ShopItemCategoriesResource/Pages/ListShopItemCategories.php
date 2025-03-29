<?php

namespace App\Filament\Resources\ShopItemCategoriesResource\Pages;

use App\Filament\Resources\ShopItemCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShopItemCategories extends ListRecords
{
    protected static string $resource = ShopItemCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
