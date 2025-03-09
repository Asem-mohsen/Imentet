<?php

namespace Database\Seeders;

use App\Models\CollectionCategory;
use Illuminate\Database\Seeder;

class CollectionCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Cultural' => 'ثقافي',
            'Paintings' => 'لوحات فنية',
            'Antiquities' => 'الآثار',
            'Sculpture' => 'النحت',
        ];

        foreach ($categories as $en => $ar) {
            CollectionCategory::create(['name' => ['en' => $en, 'ar' => $ar]]);
        }
    }
}
