<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wall_posts', function (Blueprint $table) {
            $table->boolean('pinned')->default(false)->after('message');
        });

        Schema::create('wall_post_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('wall_post_id')->constrained('wall_posts')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id', 'wall_post_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wall_post_likes');
        Schema::table('wall_posts', function (Blueprint $table) {
            $table->dropColumn('pinned');
        });
    }
};
