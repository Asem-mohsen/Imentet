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
        Schema::table('user_memberships', function (Blueprint $table) {
            $table->foreignId('price_id')->nullable()->constrained('membership_prices')->onDelete('cascade')->after('membrship_id');
            $table->enum('status', ['active', 'pending', 'suspended','cancelled'])->default('active')->after('price_id');
            $table->timestamp('document_submission_deadline')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_memberships', function (Blueprint $table) {
            $table->dropForeign(['price_id']);
            $table->dropColumn(['price_id', 'status', 'document_submission_deadline']);
        });
    }
};
