<?php

use Illuminate\Database\Migrations\Migration;

class AnswerHistoryAddCorrectanswerUseranswerRenameAnswer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('answers_history', function($table)
		{
			$table -> renameColumn('answer', 'shuffle');
			$table -> integer('user_answer') -> nullable() -> unsigned();
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
		$table -> renameColumn('shuffle', 'answer');
		$table -> dropColumn('user_answer');
		$table -> dropColumn('correct_answer');
	}

}