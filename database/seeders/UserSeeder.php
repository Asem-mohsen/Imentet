<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $regularUserRole   = Role::where('name', 'Regular User')->first();
        $masterAdminRole   = Role::where('name', 'Master Admin')->first();
        $strategyAdminRole = Role::where('name', 'Strategic Admin')->first();

        // Seed 20 regular users
        User::factory()->count(20)->create([
            'role_id' => $regularUserRole?->id,
            'is_admin' => false,
        ]);

        // Seed 3 Master Admins
        User::factory()->count(3)->create([
            'role_id' => $masterAdminRole?->id,
            'is_admin' => true,
        ]);

        // Seed 3 Strategy Admins
        User::factory()->count(3)->create([
            'role_id' => $strategyAdminRole?->id,
            'is_admin' => true,
        ]);

        User::factory()->count(1)->create([
            'first_name' =>'Assem',
            'last_name' => 'Mohsen',
            'email' => 'Imentet@gmail.com',
            'email_verified_at' => now(),
            'status' => 'active',
            'password' => Hash::make('Imentet@gmail.com'),
            'role_id' => $masterAdminRole?->id,
            'is_admin' => true,
        ]);

    }
}
