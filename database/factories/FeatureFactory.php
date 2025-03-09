<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Feature;

class FeatureFactory extends Factory
{
    protected $model = Feature::class;

    public function definition()
    {
        $nameEn = $this->faker->sentence(3);
        $nameAr = 'ترجمة ' . $nameEn;

        return [
            'name' => ['en' => $nameEn, 'ar' => $nameAr],
            'is_active' => true,
            'is_bold' => true,
        ];
    }
}