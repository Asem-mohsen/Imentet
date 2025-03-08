<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VisitorType;

class VisitorTypeSeeder extends Seeder
{
    public function run()
    {
        $types = ['Student', 'Senior', 'Foreigner Senior'];

        foreach ($types as $type) {
            VisitorType::firstOrCreate(['name' => $type]);
        }
    }
}