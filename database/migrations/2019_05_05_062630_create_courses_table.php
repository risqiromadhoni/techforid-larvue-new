<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('title_certificate')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('suitable')->nullable();
            $table->text('requirment')->nullable();
            $table->integer('duration')->default(0);
            $table->string('course_duration')->nullable();
            $table->boolean('is_publish')->default(true); // true = active
            $table->boolean('status')->default(true); // true = pay
            $table->double('price')->default(0);
            $table->double('price_disc')->default(0);
            $table->integer('credit')->default(0);
            $table->string('video_detail')->nullable();
            $table->string('wistya_hashed_id')->nullable();
            $table->enum('tags', ['best', 'hot', 'new'])->default('hot');
            $table->string('meta_title')->nullable();
            $table->string('meta_tag')->nullable();
            $table->text('meta_desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
