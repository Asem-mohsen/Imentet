<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;
use App\Models\Feature;

class MembershipFeatureSeeder extends Seeder
{
    public function run()
    {
        $memberships = Membership::all();
        $features = Feature::all();

        foreach ($memberships as $membership) {
            $membership->features()->sync($features->random(rand(3, 6))->pluck('id'));
        }
    }
}
