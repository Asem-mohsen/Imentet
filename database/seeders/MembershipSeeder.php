<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipSeeder extends Seeder
{
    public function run()
    {
        $memberships = ['Individual', 'Families', 'Supporting', 'Patron', 'Students', 'Seniors'];

        foreach ($memberships as $membership) {
            Membership::firstOrCreate(['name' => $membership]);
        }
    }
}
