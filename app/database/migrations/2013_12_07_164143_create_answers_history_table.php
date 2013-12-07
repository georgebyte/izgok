<?php

use Illuminate\Database\Migrations\Migration;

class CreateAnswersHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers_history', function($table)
        {
            $table->increments('id');
            $table->integer('id_quiz')->unsigned();
            $table->foreign('id_quiz')->references('id')->on('quizzes');
            $table->integer('id_question')->unsigned();
            $table->foreign('id_question')->references('id')->on('questions');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('answer')->unsigned();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('answers_history');
	}

}