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
	}
}