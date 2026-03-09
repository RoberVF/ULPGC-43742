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
        Schema::create('bills', function (Blueprint $table) {
            $table->string('bill_num', 20)->primary();
            $table->string('transmitter_dni', 15);
            $table->string('receiver_dni', 15);
            $table->timestamp('bill_date')->useCurrent();
            $table->decimal('total_amount', 15, 2);

            $table->foreign('transmitter_dni')->references('dni')->on('users');
            $table->foreign('receiver_dni')->references('dni')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
