<?php

namespace App\Filament\Resources\GiftShopItemResource\Pages;

use App\Filament\Resources\GiftShopItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGiftShopItem extends EditRecord
{
    protected static string $resource = GiftShopItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
