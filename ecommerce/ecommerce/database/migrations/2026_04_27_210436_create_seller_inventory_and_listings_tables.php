<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');
            $table->foreignId('harvest_id')->constrained('harvests')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('lunar_orders')->onDelete('cascade');
            $table->unsignedInteger('quantity_purchased');
            $table->unsignedInteger('quantity_remaining');
            $table->timestamps();
        });

        Schema::create('seller_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');
            $table->foreignId('seller_inventory_id')->constrained('seller_inventory')->onDelete('cascade');
            $table->unsignedBigInteger('lunar_variant_id')->nullable();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('stock');
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_listings');
        Schema::dropIfExists('seller_inventory');
    }
};
