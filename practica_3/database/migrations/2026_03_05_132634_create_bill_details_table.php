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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->string('bill_num', 20);
            $table->unsignedBigInteger('harvest_id');
            $table->decimal('quantity', 10, 2);
            $table->decimal('price', 10, 2);

            $table->primary(['bill_num', 'harvest_id']);
            $table->foreign('bill_num')->references('bill_num')->on('bills')->onDelete('cascade');
            $table->foreign('harvest_id')->references('id')->on('harvests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
