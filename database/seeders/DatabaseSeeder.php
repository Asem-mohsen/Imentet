<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            VisitorTypeSeeder::class,
            MembershipSeeder::class,
            FeatureSeeder::class,
            EventCategorySeeder::class,
            MembershipDurationSeeder::class,
            MembershipFeatureSeeder::class,
            ShopItemCategorySeeder::class,
            CollectionCategorySeeder::class,
            UserSeeder::class,
        ]);

    }
}
