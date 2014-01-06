<?php

class TerritoriesTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('territories')->truncate();

		Territory::create(
            array(
                'name' => 'Village TAM',
                'description' => 'Tja ali Tam',
                'pos_x' => '1',
                'pos_y' => '1',
                'id_owner' => '1',
                'is_main_village' => '1'
            )
        );

        Territory::create(
            array(
                'name' => 'Village TJA',
                'description' => 'Tja xor Tam',
                'pos_x' => '-1',
                'pos_y' => '1',
                'id_owner' => '2',
                'is_main_village' => '1'
            )
        );

        Territory::create(
            array(
                'name' => 'Ziga Nation',
                'description' => 'Ziga Zaga poje zaga rom pom pom kladivo',
                'pos_x' => '-1',
                'pos_y' => '-1',
                'id_owner' => '3',
                'is_main_village' => '1'
            )
        );

        Territory::create(
            array(
                'name' => 'Marlboro',
                'description' => 'Ej jst grem sam na cik',
                'pos_x' => '1',
                'pos_y' => '-1',
                'id_owner' => '4',
                'is_main_village' => '1'
            )
        );

        /* NPC territories */
        Territory::create(array('name' => 'Naselje Antonin Pij','description' => '15. cesar Rimskega cesarstva, ki je vladal od leta 138 do 168.','pos_x' => '2','pos_y' => '2','id_owner' => '5','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Dioklecijan','description' => 'Rimski cesar med letoma 284 in 305.','pos_x' => '3','pos_y' => '3','id_owner' => '6','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Kaligula','description' => 'Tretji rimski cesar julijansko-klavdijske dinastije.','pos_x' => '4','pos_y' => '4','id_owner' => '7','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Mark Avrelij','description' => 'Mark Avrelij, rimski vojskovodja, cesar in filozof 26. april 121 Rim - 17. marec 180 Sirmij','pos_x' => '5','pos_y' => '5','id_owner' => '8','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Genghis Khan','description' => 'Rojen Temujin - Ustanovitelj in veliki vodja mongolskega imperija.','pos_x' => '-2','pos_y' => '-2','id_owner' => '9','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Ludvik XIV','description' => 'Ludvik XIV., imenovan tudi Soncni kralj, je vladal kot kralj Francije in kralj Navare od 14. maja 1643 do svoje smrti.','pos_x' => '-3','pos_y' => '-3','id_owner' => '10','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Benjamin Franklin','description' => 'Eden izmed ustanoviteljev zdruzenih drzav Amerike (ZDA).','pos_x' => '-4','pos_y' => '-4','id_owner' => '11','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Joseph Stalin','description' => 'Joseph Stalin ali Iosif Vissarionovich Stalin. Vodil Sovjetsko zvezo od cca 1920 do svoje smrti leta 1953','pos_x' => '-5','pos_y' => '-5','id_owner' => '12','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Kleopatra','description' => 'Vladala egiptu od leta 69 pr.n.st do 30 pr.n.st','pos_x' => '-2','pos_y' => '2','id_owner' => '13','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Adolf Hitler','description' => '20 April 1889 â€“ 30 April 1945 - politik, ter vodja nacisticne stranke.','pos_x' => '-3','pos_y' => '3','id_owner' => '14','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Henrik VIII','description' => 'Kralj angleskega kraljestva od 21 April 1509 do svoje smrti (28 January 1547).','pos_x' => '-4','pos_y' => '4','id_owner' => '15','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Josef Mengele','description' => 'SS oficir pod vodstvom Adolfa Hitlerja, ter zdravnik v delovnem taboriscu Auschwitz.','pos_x' => '-5','pos_y' => '5','id_owner' => '16','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Josip Broz Tito','description' => 'Vladal Jugoslaviji od leta 1948 pa do svoje smrti leta 1980.','pos_x' => '2','pos_y' => '-2','id_owner' => '17','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje John Fitzgerald Kennedy','description' => 'Maj 29, 1917 â€“ November 22, 1963. Ubit v atentatu (Dallas, Texas).','pos_x' => '3','pos_y' => '-3','id_owner' => '18','is_npc_village' => '1'));
        Territory::create(array('name' => 'Naselje Aleksandar Veliki','description' => 'Aleksandar III (poznan kot Aleksander Veliki ali Aleksander Makedonski). Aleksander Veliki je najbolj poznan kot eden najboljĹˇih antiÄŤnih vojskovodij in eden najbolj zasluĹľnih za razvoj grĹˇke kulture po tedaj znanem svetu.','pos_x' => '4','pos_y' => '-4','id_owner' => '19','is_npc_village' => '1'));

        // for ($i=5; $i < 100; $i++) { 
        //     Territory::create(
        //         array(
        //             'name' => "NPC".$i."'s Village",
        //             'description' => 'Bla bla blaaaaaaa.',
        //             'pos_x' => $i,
        //             'pos_y' => $i,
        //             'id_owner' => $i,
        //             'is_main_village' => '0',
        //             'is_npc_village' => '1'
        //         )
        //     );
        // }
	}
}