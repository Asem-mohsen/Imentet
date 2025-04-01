<?php

namespace App\Filament\Resources\CollectionsCategoriesResource\Pages;

use App\Filament\Resources\CollectionsCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCollectionsCategories extends ListRecords
{
    protected static string $resource = CollectionsCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
