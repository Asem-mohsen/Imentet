<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use App\Models\Place;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Concerts' => 'الحفلات الموسيقية',
            'Festivals' => 'المهرجانات',
            'Exhibitions' => 'المعارض',
            'Education' => 'تعليم',
        ];

        $places = Place::all();

        foreach ($places as $place) {
            foreach ($categories as $en => $ar) {
                EventCategory::create([
                    'place_id' => $place->id,
                    'name' => [
                        'en' => $en,
                        'ar' => $ar,
                    ],
                ]);
            }
        }
    }
}
