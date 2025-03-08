<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\VisitorType;

class VisitorTypeFactory extends Factory
{
    protected $model = VisitorType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
