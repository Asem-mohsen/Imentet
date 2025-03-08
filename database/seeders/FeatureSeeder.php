<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    public function run()
    {
        $features = [
            'Discount on Gift Shop', 'Discount Parking', 'Childern Museum', 'Vouchers Museum',
            'Members News letter', 'Special Exhibtions', 'Access Museum Lib', 'Invatations To Activites',
            'Access To Events', 'Access Tutankhamun', 'Access Hologram', 'Access To Monuments',
            'Priority Access To Events', 'Students Events'
        ];

        foreach ($features as $feature) {
            Feature::firstOrCreate(['name' => $feature]);
        }
    }
}
