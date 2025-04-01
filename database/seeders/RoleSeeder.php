<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'Master Admin',
            'Strategic Admin',
            'Operations',
            'Customer Service',
            'Regular User',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
