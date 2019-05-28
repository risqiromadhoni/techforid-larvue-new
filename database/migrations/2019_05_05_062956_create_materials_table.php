<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('title');
            $table->enum('type', ['video', 'presentation'])->default('video');
            $table->bigInteger('line')->default(1);
            $table->string('wistya_hashed_link');
            $table->string('wistya_hashed_id');
            $table->string('duration')->nullable();
            $table->boolean('status')->default(true);
            $table->bigInteger('section_id')->foreign('section_id')->reference('id')->on('sections');
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
        Schema::dropIfExists('materials');
    }
}
