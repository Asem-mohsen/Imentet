<?php

namespace App\Filament\Resources\SponsorResource\Pages;

use App\Filament\Resources\SponsorResource;
use App\Models\Role;
use App\Models\User;
use App\Models\UserMembership;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateSponsor extends CreateRecord
{
    protected static string $resource = SponsorResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['is_user']) {
            $nameParts = explode(' ', trim($data['contact_person']), 2);
            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';
        
            $sponsorRole = Role::where('name', 'sponsor')->first();

            $user = User::create([
                'first_name' => $firstName,
                'role_id' => $sponsorRole->id,
                'last_name' => $lastName,
                'email' => $data['email'],
                'address' => $data['address'] ?? null,
                'password' => Hash::make('password'),
            ]);
        
            $user->save();
        }

        if (!empty($data['membership_id']) && !empty($data['membership_id'])) {
            UserMembership::create([
                'user_id' => $user->id,
                'membership_id' => $data['membership_id'],
                'start_date' => now(),
                'end_date' => now()->addYear(),
            ]);
        }

        return $data;
    }
}
