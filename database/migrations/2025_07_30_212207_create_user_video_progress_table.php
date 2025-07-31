<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_video_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('video_id')->constrained()->onDelete('cascade');
            $table->integer('watched_duration')->default(0); // in seconds
            $table->boolean('is_completed')->default(false);
            $table->timestamp('last_watched_at')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'video_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_video_progress');
    }
};