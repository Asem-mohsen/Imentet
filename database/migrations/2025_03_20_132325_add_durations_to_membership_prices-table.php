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
        Schema::table('membership_prices', function (Blueprint $table) {
            $table->enum('duration', \App\Enums\MembershipDuration::values())->after('visitor_type_id');
        });

        Schema::dropIfExists('membership_durations');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membership_prices', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
};
