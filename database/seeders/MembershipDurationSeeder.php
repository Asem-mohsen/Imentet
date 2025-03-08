<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;
use App\Models\MembershipDuration;

class MembershipDurationSeeder extends Seeder
{
    public function run()
    {
        $durations = ['Monthly', 'Yearly', 'Open'];

        foreach (Membership::all() as $membership) {
            MembershipDuration::firstOrCreate([
                'membership_id' => $membership->id,
                'duration' => $durations[array_rand($durations)],
            ]);
        }
    }
}

