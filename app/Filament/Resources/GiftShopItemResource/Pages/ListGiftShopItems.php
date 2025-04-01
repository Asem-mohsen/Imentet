<?php

namespace App\Filament\Resources\GiftShopItemResource\Pages;

use App\Filament\Resources\GiftShopItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGiftShopItems extends ListRecords
{
    protected static string $resource = GiftShopItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
