<?php

use Illuminate\Database\Migrations\Migration;

class CreateTerritoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('territories', function($table) {
            $table -> increments('id');
            $table -> string('name', 63);
            $table -> text('description');
            $table -> integer('pos_x');
            $table -> integer('pos_y');
			$table -> integer('id_owner') -> unsigned() -> nullable();
            //$table -> foreign('id_owner') -> references('id') -> on('users') -> onDelete('set null');
            $table -> boolean('is_main_village');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('territories');
	}

}