<?php

use Illuminate\Database\Migrations\Migration;

class AddSubmitTimesToQuizzes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quizzes', function($table) {
			$table -> dateTime('submit_time_attacker') -> nullable();
			$table -> dateTime('submit_time_defender') -> nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quizzes', function($table) {
			$table -> dropColumn('submit_time_attacker');
			$table -> dropColumn('submit_time_defender');
		});
	}

}