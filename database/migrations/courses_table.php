public function up()
{
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('level');
        $table->string('image');
        $table->timestamps();
    });
}

