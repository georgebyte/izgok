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
		Schema::create('answers_history', function($table) {
            $table -> increments('id');

            $table -> integer('id_quiz') -> unsigned();
            //$table -> foreign('id_quiz') -> references('id') -> on('quizzes') -> onDelete('cascade');

            $table -> integer('id_question') -> unsigned() -> nullable();
            //$table -> foreign('id_question') -> references('id') -> on('questions') -> onDelete('set null');

            $table -> integer('attacker_answer') -> unsigned() -> nullable();
            $table -> integer('defender_answer') -> unsigned() -> nullable();

            $table -> integer('shuffle') -> unsigned();
            $table -> integer('correct_answer') -> unsigned();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('answers_history');
	}

}