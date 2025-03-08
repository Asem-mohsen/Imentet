<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Concerts', 'Festivals', 'Exhibitions', 'Education'];

        foreach ($categories as $category) {
            EventCategory::firstOrCreate(['name' => $category]);
        }
    }
}
