<?php

namespace Database\Seeders;

use App\Enums\MembershipDuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipSeeder extends Seeder
{
    public function run()
    {
        $memberships = [
            'Individual' => [
                'ar' => 'فردي',
                'durations' => ['monthly', 'yearly'],
            ],
            'Families' => [
                'ar' => 'العائلات',
                'durations' => ['yearly'], // 'lifetime' should be added to enum if needed
            ],
            'Supporting' => [
                'ar' => 'دعم',
                'durations' => ['yearly'],
            ],
            'Patron' => [
                'ar' => 'الراعي',
                'durations' => ['open'],
            ],
            'Students' => [
                'ar' => 'طلاب',
                'durations' => ['monthly', 'semi-annual'],
            ],
            'Seniors' => [
                'ar' => 'كبار السن',
                'durations' => ['monthly', 'yearly'],
            ],
        ];

        foreach ($memberships as $en => $data) {
            $membership = Membership::create([
                'name' => ['en' => $en, 'ar' => $data['ar']],
            ]);

            foreach ($data['durations'] as $durationValue) {
                if (!MembershipDuration::tryFrom($durationValue)) {
                    continue;
                }

                $membership->durations()->create([
                    'duration' => [
                        'en' => $durationValue,
                        'ar' => MembershipDuration::labels()[$durationValue] ?? $durationValue, // fallback
                    ],
                ]);
            }
        }
    }
}
