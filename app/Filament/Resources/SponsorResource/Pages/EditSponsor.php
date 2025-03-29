<?php

namespace App\Filament\Resources\SponsorResource\Pages;

use App\Filament\Resources\SponsorResource;
use App\Models\Sponsor;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSponsor extends EditRecord
{
    protected static string $resource = SponsorResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['assign_membership'] && isset($data['membership_id'])) {
            $sponsor = Sponsor::find($data['id']);
            if ($sponsor) {
                $sponsor->memberships()->attach($data['membership_id']);
            }
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
