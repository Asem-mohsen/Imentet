<?php

namespace App\Filament\Resources\VisitorTypesResource\Pages;

use App\Filament\Resources\VisitorTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisitorTypes extends ListRecords
{
    protected static string $resource = VisitorTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
