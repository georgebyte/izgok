<?php

use Illuminate\Database\Migrations\Migration;

class AddNumberOfCorrectAnswersToQuizzesAndVillageid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quizzes', function($table)
		{
		    $table -> integer('id_attacked_territory') -> unsigned() -> nullable();

		    /* zakomentirano zaradi problema z kljuci pri posodabljanju tabele pri napadanju */
            //$table -> foreign('id_attacked_territory') -> references('id') -> on('territories') -> onDelete('set null');
            $table -> integer('attacker_num_correct_ans') -> unsigned();
            $table -> integer('defender_num_correct_ans');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quizzes', function($table)
		{
		    //$table -> dropForeign('id_attacked_territory');
		    $table -> dropColumn('id_attacked_territory');
		    $table -> dropColumn('attacker_num_correct_ans');
		    $table -> dropColumn('defender_num_correct_ans');
		});
	}

}