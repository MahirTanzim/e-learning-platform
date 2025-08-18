
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('course_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('title');
            $table->tinyInteger('rating');
            $table->text('body');
            $table->string('pros')->nullable();
            $table->string('cons')->nullable();
            $table->boolean('recommend')->default(false);
            $table->string('proof')->nullable();
            $table->enum('status', ['pending', 'approved'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
