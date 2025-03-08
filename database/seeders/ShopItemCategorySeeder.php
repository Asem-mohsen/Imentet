<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShopItemCategory;

class ShopItemCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Hand Made', 'Furniture', 'Paintings', 'Antiquities', 'Sculpture'];

        foreach ($categories as $category) {
            ShopItemCategory::firstOrCreate(['name' => $category]);
        }
    }
}

