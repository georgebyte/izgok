<?php

class QuizzesTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('quizzes')->delete();
		Quiz::create(array('id_attacker' => '4', 'id_defender' => '1', 'id_attacked_territory' => '1', 'attacker_num_correct_ans' => '2', 'defender_num_correct_ans' => '5' ));
		Quiz::create(array('id_attacker' => '1', 'id_defender' => '4', 'id_attacked_territory' => '1', 'attacker_num_correct_ans' => '1', 'defender_num_correct_ans' => '6' ));
		Quiz::create(array('id_attacker' => '2', 'id_defender' => '3', 'id_attacked_territory' => '1', 'attacker_num_correct_ans' => '2', 'defender_num_correct_ans' => '5' ));
		Quiz::create(array('id_attacker' => '3', 'id_defender' => '2', 'id_attacked_territory' => '1', 'attacker_num_correct_ans' => '1', 'defender_num_correct_ans' => '6' ));
    	Quiz::create(array('id_attacker' => '4', 'id_defender' => '1', 'id_attacked_territory' => '1', 'attacker_num_correct_ans' => '2', 'defender_num_correct_ans' => '5' ));
		Quiz::create(array('id_attacker' => '1', 'id_defender' => '4', 'id_attacked_territory' => '1', 'attacker_num_correct_ans' => '1', 'defender_num_correct_ans' => '6' ));
		Quiz::create(array('id_attacker' => '2', 'id_defender' => '3', 'id_attacked_territory' => '1', 'attacker_num_correct_ans' => '2', 'defender_num_correct_ans' => '5' ));
		Quiz::create(array('id_attacker' => '3', 'id_defender' => '2', 'id_attacked_territory' => '1', 'attacker_num_correct_ans' => '1', 'defender_num_correct_ans' => '6' ));
   
    }

}