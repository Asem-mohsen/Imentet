<?php

namespace Database\Seeders;

use App\Models\EventCategory;
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

        foreach ($categories as $en => $ar) {
            EventCategory::create([
                'name' => ['en' => $en, 'ar' => $ar]
            ]);
        }
    }
}
