<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_tickets', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->default(0)->after('quantity');
            $table->timestamp('visit_date')->nullable()->after('total');
        });
    }

    public function down(): void
    {
        Schema::table('user_tickets', function (Blueprint $table) {
            $table->dropColumn(['visit_date', 'total']);
        });
    }
};
