<?php

namespace App\Filament\Resources\GiftShopsResource\Pages;

use App\Filament\Resources\GiftShopsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGiftShops extends EditRecord
{
    protected static string $resource = GiftShopsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
