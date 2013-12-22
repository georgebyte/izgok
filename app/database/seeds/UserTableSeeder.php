<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(
            array(
                'email'     => 'jure.bajt@gmail.com',
                'username'  => 'jure',
                'password'  => Hash::make('jure'),
                'image_path'=> 'uploads/1.jpg'
            )
        );

        User::create(
            array(
                'email'     => 'sandi.mikus@gmail.com',
                'username'  => 'sandi',
                'password'  => Hash::make('sandi'),
                'image_path'=> 'uploads/2.jpg'
            )
        );

        User::create(
            array(
                'email'     => 'ziga.zumer@gmail.com',
                'username'  => 'ziga',
                'password'  => Hash::make('ziga'),
                'image_path'=> 'uploads/3.jpg'
            )
        );

        User::create(
            array(
                'email'     => 'matejmart@gmail.com',
                'username'  => 'matej',
                'password'  => Hash::make('matej'),
                'image_path'=> 'uploads/4.jpg'
            )
        );
    }

}