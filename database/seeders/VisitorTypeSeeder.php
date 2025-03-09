<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorType;

class VisitorTypeSeeder extends Seeder
{
    public function run()
    {
        $types = [
            'Egyptian Student' => 'طالب مصري',
            'Foreigner Adult' => 'بالغ أجنبي',
            'Foreigner Student' => 'طالب أجنبي',
            'Egyptian Senior' => 'مسن مصري',
            'Egyptian Adult' => 'بالغ مصري',
            'Foreigner Senior' => 'مسن أجنبي',
        ];

        foreach ($types as $en => $ar) {
            VisitorType::create([
                'name' => ['en' => $en, 'ar' => $ar]
            ]);
        }
    }
}