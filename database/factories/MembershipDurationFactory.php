<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MembershipDuration;
use App\Models\Membership;
class MembershipDurationFactory extends Factory
{
    protected $model = MembershipDuration::class;

    public function definition()
    {
        return [
            'membership_id' => Membership::inRandomOrder()->first()->id,
            'duration' => $this->faker->randomElement(['Monthly', 'Yearly', 'Open']),
        ];
    }
}