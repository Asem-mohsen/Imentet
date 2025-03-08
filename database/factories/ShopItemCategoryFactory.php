<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ShopItemCategory;

class ShopItemCategoryFactory extends Factory
{
    protected $model = ShopItemCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
