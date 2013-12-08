<?php

use Illuminate\Database\Migrations\Migration;

class AnswerHistoryAnswerNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('answers_history', function($table)
		{
			$table -> integer('answer') -> nullable() -> unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('answers_history', function($table)
		{
			//$table -> dropColumn('answer');
			//$table -> integer('answer') -> unsigned();
		});
	}

}