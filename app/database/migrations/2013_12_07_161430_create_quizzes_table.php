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
            $table -> timestamps();
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
        Schema::dropIfExists('quizzes');   
    }

}