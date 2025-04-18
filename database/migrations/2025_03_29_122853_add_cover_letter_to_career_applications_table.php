<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('career_applications', function (Blueprint $table) {
            $table->longText('cover_letter')->after('career_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_applications', function (Blueprint $table) {
            $table->dropColumn('cover_letter');
        });
    }
};
