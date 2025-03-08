<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CollectionCategory;

class CollectionCategoryFactory extends Factory
{
    protected $model = CollectionCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
