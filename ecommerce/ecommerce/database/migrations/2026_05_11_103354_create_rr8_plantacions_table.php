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
        Schema::create('rr8_plantacions', function (Blueprint $table) {
            $table->id();
            $table->date('fechaInicio');
            $table->decimal('costeProduccion', 8, 2);
            $table->foreignId('rr8Producto_id')->constrained('rr8_productos')->onDelete('cascade');
            $table->date('fechaFin')->nullable();
            $table->decimal('valorVenta', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rr8_plantacions');
    }
};
