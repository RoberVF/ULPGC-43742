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
            $table->id();
            $table->string('bill_num', 20)->unique();
            $table->unsignedBigInteger('transmitter_id');
            $table->unsignedBigInteger('receiver_id');
            $table->timestamp('bill_date')->useCurrent();
            $table->decimal('total_amount', 15, 2);

            $table->foreign('transmitter_id')->references('id')->on('users');
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->timestamps();
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
