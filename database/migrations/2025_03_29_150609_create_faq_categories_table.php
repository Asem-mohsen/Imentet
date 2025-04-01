<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->id();
            $table->json('name')->unique();
            $table->timestamps();
        });

        DB::table('faq_categories')->insert([
            ['name' => json_encode(['en' => 'Management', 'ar' => 'الإدارة'])],
            ['name' => json_encode(['en' => 'Museum', 'ar' => 'المتحف'])],
            ['name' => json_encode(['en' => 'Membership', 'ar' => 'العضوية'])],
            ['name' => json_encode(['en' => 'Donation', 'ar' => 'التبرع'])],
            ['name' => json_encode(['en' => 'Exhibition', 'ar' => 'المعرض'])],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('faq_categories');
    }
};
