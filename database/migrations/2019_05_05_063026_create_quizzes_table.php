<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('material_id')->foreign('material_id')->reference('id')->on('materials');
            $table->bigInteger('choice_option_id')->foreign('choice_option_id')->reference('id')->on('choice_options');
            $table->text('question')->nullable();
            $table->string('true');
            $table->bigInteger('line')->default(1);
            $table->bigInteger('minute')->default(0);
            $table->bigInteger('second')->default(0);
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
        Schema::dropIfExists('quizzes');
    }
}
