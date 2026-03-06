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
        Schema::create('harvests', function (Blueprint $table) {
            $table->id();
            $table->string('producer_dni', 15);
            $table->unsignedBigInteger('product_type_id');
            $table->date('collect_date');
            $table->decimal('quantity', 10, 2);
            $table->decimal('stock', 10, 2);
            $table->decimal('price', 10, 2);
            $table->string('unit_measure', 10);
            $table->decimal('temperature', 5, 2)->nullable();
            $table->decimal('humidity', 5, 2)->nullable();
            $table->foreign('producer_dni')->references('dni')->on('producers');
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harvests');
    }
};
