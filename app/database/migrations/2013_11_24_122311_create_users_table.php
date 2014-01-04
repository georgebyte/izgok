<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table) {
            $table -> increments('id');
            $table -> string('username', 32);
            $table -> string('email', 128);
            $table -> string('password', 60);
            $table -> string('image_path', 72);
            $table -> boolean('is_admin');
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
        Schema::dropIfExists('users');
    }

}