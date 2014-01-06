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


        /* NPCs */
        User::create(array('email'=> 'NPC','username'=> 'Antonin Pij','password'=> Hash::make('cpn4'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Dioklecijan','password'=> Hash::make('cpn5'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Kaligula','password'=> Hash::make('cpn6'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Mark Avrelij','password'=> Hash::make('cpn7'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Genghis Khan','password'=> Hash::make('cpn8'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Ludvik XIV','password'=> Hash::make('cpn9'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Benjamin Franklin','password'=> Hash::make('cpn10'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Joseph Stalin','password'=> Hash::make('cpn11'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Kleopatra','password'=> Hash::make('cpn12'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Adolf Hitler','password'=> Hash::make('cpn13'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Henrik VIII','password'=> Hash::make('cpn14'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Josef Mengele','password'=> Hash::make('cpn15'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Josip Broz Tito','password'=> Hash::make('cpn16'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'John Fitzgerald Kennedy','password'=> Hash::make('cpn17'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));
        User::create(array('email'=> 'NPC','username'=> 'Aleksandar Veliki','password'=> Hash::make('cpn18'),'image_path' => 'default.jpg','score'=> '15','is_admin'=> '0'));

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