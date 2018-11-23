<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('question_id');
            $table->string('question_text');
            $table->string('question_correct_text');
            $table->string('question_incorrect_text');
            $table->integer('form_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('questions', function (Blueprint $table){
            $table->foreign('form_id')->references('form_id')->on('forms')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
