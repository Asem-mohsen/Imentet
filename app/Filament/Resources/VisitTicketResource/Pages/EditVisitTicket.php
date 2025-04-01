<?php

namespace App\Filament\Resources\VisitTicketResource\Pages;

use App\Filament\Resources\VisitTicketResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisitTicket extends EditRecord
{
    protected static string $resource = VisitTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
