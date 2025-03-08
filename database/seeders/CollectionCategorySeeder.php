<?php

namespace Database\Seeders;

use App\Models\CollectionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Antiquities', 'Cultural', 'Painting', 'Sculpture'];

        foreach ($categories as $category) {
            CollectionCategory::firstOrCreate(['name' => $category]);
        }
    }
}
