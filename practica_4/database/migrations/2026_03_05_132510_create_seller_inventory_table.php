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
        Schema::create('seller_inventory', function (Blueprint $table) {
            $table->string('seller_dni', 15);
            $table->unsignedBigInteger('harvest_id');
            $table->decimal('stock', 10, 2)->default(0.00);
            $table->decimal('sale_price', 10, 2)->default(0.00);

            $table->primary(['seller_dni', 'harvest_id']);
            $table->foreign('seller_dni')->references('dni')->on('sellers')->onDelete('cascade');
            $table->foreign('harvest_id')->references('id')->on('harvests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_inventory');
    }
};
