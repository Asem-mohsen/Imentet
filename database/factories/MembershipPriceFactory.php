<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MembershipPrice;
use App\Models\Membership;
use App\Models\VisitorType;

class MembershipPriceFactory extends Factory
{
    protected $model = MembershipPrice::class;

    public function definition()
    {
        return [
            'membership_id' => Membership::inRandomOrder()->first()->id,
            'visitor_type_id' => VisitorType::inRandomOrder()->first()->id,
            'price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
