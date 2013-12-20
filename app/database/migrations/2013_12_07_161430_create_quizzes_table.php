<?php

use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function($table) {
            $table -> increments('id');

            $table -> integer('id_attacker')-> unsigned() -> nullable();
            //$table -> foreign('id_attacker') -> references('id') -> on('users') -> onDelete('set null');
            $table -> integer('id_defender')-> unsigned() -> nullable();
            //$table -> foreign('id_defender') -> references('id') -> on('users') -> onDelete('set null');

            $table -> dateTime('submit_time_attacker') -> nullable();
            $table -> dateTime('submit_time_defender') -> nullable();

            $table -> timestamps();
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