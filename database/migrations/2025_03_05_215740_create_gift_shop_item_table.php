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
        // the items available on the gift shopes to be shown 
        Schema::create('gift_shop_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gift_shop_id')->constrained()->onDelete('cascade');
            $table->foreignId('shop_item_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_shop_items');
    }
};
