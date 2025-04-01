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
        Schema::table('user_tickets', function (Blueprint $table) {
            $table->enum('status', ['pending', 'completed'])->default('pending')->after('purchase_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_tickets', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
