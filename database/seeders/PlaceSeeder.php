<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    public function run()
    {
        $places = [
            ['en' => 'Pyramids', 'ar' => 'الأهرامات'],
            ['en' => 'Grand Egyptian Museum', 'ar' => 'المتحف المصري الكبير'],
        ];

        foreach ($places as $place) {
            Place::create([
                'name' => $place,
            ]);
        }
    }
}
