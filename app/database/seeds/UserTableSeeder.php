<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();

        User::create(
            array(
                'email'      => 'jure.bajt@gmail.com',
                'username'   => 'jure',
                'password'   => Hash::make('jure'),
                'image_path' => md5('1').".jpg",
                'score'      => '15',
                'is_admin'   => '1'
            )
        );

        User::create(
            array(
                'email'      => 'sandi.mikus@gmail.com',
                'username'   => 'sandi',
                'password'   => Hash::make('sandi'),
                'image_path' => md5('2').".jpg",
                'score'      => '15',
                'is_admin'   => '1'
            )
        );

        User::create(
            array(
                'email'      => 'ziga.zumer@gmail.com',
                'username'   => 'ziga',
                'password'   => Hash::make('ziga'),
                'image_path' => md5('3').".jpg",
                'score'      => '15',
                'is_admin'   => '1'
            )
        );

        User::create(
            array(
                'email'      => 'matejmart@gmail.com',
                'username'   => 'matej',
                'password'   => Hash::make('matej'),
                'image_path' => md5('4').".jpg",
                'score'      => '15',
                'is_admin'   => '1'
            )
        );


        // for ($i=5; $i < 100; $i++) { 
        //     User::create(
        //         array(
        //             'email'      => 'npc@izgok.si',
        //             'username'   => 'npc'.$i,
        //             'password'   => Hash::make('cpn'.$i),
        //             'image_path' => 'default.jpg',
        //             'score'      => '15',
        //             'is_admin'   => '0'
        //         )
        //     );
        // }
    }

}