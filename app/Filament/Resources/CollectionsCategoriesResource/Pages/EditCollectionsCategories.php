<?php

namespace App\Filament\Resources\CollectionsCategoriesResource\Pages;

use App\Filament\Resources\CollectionsCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCollectionsCategories extends EditRecord
{
    protected static string $resource = CollectionsCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
