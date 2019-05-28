<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoiceOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choice_options', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->enum('type', ['quiz', 'latihan', 'ujian', 'survei', 'pretest', 'postest'])->default('quiz');
            $table->bigInteger('number')->default(1);
            $table->bigInteger('line')->default(1);
            $table->bigInteger('sort')->default(1);
            $table->text('field');
            $table->text('value');
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
        Schema::dropIfExists('choice_options');
    }
}
