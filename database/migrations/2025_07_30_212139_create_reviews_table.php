<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating'); // 1-5
            $table->text('review')->nullable();
            $table->timestamps();
            
            $table->unique(['course_id', 'student_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};