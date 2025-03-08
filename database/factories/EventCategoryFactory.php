<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EventCategory;

class EventCategoryFactory extends Factory
{
    protected $model = EventCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
