<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(
            array(
                'email'     => 'jure.bajt@gmail.com',
                'username'  => 'jure',
                'password'  => Hash::make('jure')
            )
        );

        User::create(
            array(
                'email'     => 'sandi.mikus@gmail.com',
                'username'  => 'sandi',
                'password'  => Hash::make('sandi')
            )
        );

        User::create(
            array(
                'email'     => 'ziga.zumer@gmail.com',
                'username'  => 'ziga',
                'password'  => Hash::make('ziga')
            )
        );

        User::create(
            array(
                'email'     => 'matejmart@gmail.com',
                'username'  => 'matej',
                'password'  => Hash::make('matej')
            )
        );
    }

}