<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    public function run()
    {
        $features = [
            'Discount on Gift Shop' => 'خصم في متجر الهدايا',
            'Discount Parking' => 'خصم على مواقف السيارات',
            'Children Museum' => 'متحف الأطفال',
            'Vouchers Museum' => 'قسائم المتحف',
            'Members Newsletter' => 'نشرة الأعضاء',
            'Special Exhibitions' => 'معارض خاصة',
            'Access Museum Library' => 'الوصول إلى مكتبة المتحف',
            'Invitations To Activities' => 'دعوات للأنشطة',
            'Access To Events' => 'الوصول إلى الفعاليات',
            'Access Tutankhamun' => 'الوصول إلى توت عنخ آمون',
            'Access Hologram' => 'الوصول إلى الهولوجرام',
            'Access To Monuments' => 'الوصول إلى المعالم',
            'Priority Access To Events' => 'الوصول الأولوي للفعاليات',
            'Students Events' => 'فعاليات الطلاب',
        ];

        foreach ($features as $en => $ar) {
            Feature::create([
                'name' => ['en' => $en, 'ar' => $ar],
                'is_active' => true,
                'is_bold' => true,
            ]);
        }
    }
}

