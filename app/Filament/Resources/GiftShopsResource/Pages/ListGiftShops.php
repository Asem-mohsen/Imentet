<?php

namespace App\Filament\Resources\GiftShopsResource\Pages;

use App\Filament\Resources\GiftShopsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGiftShops extends ListRecords
{
    protected static string $resource = GiftShopsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
