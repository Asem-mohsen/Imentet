<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipSeeder extends Seeder
{
    public function run()
    {
        $memberships = [
            'Individual' => 'فردي',
            'Families' => 'العائلات',
            'Supporting' => 'دعم',
            'Patron' => 'الراعي',
            'Students' => 'طلاب',
            'Seniors' => 'كبار السن',
        ];

        foreach ($memberships as $en => $ar) {
            Membership::create(['name' => ['en' => $en, 'ar' => $ar]]);
        }
    }
}
