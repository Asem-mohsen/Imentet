<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Membership;

class MembershipFactory extends Factory
{
    protected $model = Membership::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
