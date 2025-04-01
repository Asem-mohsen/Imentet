<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShopItemCategory;

class ShopItemCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Hand Made' => 'صناعة يدوية',
            'Furniture' => 'أثاث',
            'Paintings' => 'لوحات فنية',
            'Antiquities' => 'الآثار',
            'Sculpture' => 'النحت',
        ];

        foreach ($categories as $en => $ar) {
            ShopItemCategory::create(['name' => ['en' => $en, 'ar' => $ar]]);
        }
    }
}

