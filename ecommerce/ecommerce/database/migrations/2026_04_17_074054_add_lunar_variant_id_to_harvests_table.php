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
        Schema::table('harvests', function (Blueprint $table) {
            $table->unsignedBigInteger('lunar_variant_id')->nullable()->after('id');
            // $table->foreign('lunar_variant_id')->references('id')->on('lunar_variants')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('harvests', function (Blueprint $table) {
            // $table->dropForeign(['lunar_variant_id']);
            $table->dropColumn('lunar_variant_id');
        });
    }
};
