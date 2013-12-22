<?php

class ProfileController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function showIndex()
    {

    	
    	



        /* data je tabela podatkov poslanih v view */
    	$myID = Auth::user() -> id;
    	$data = array();
       

    	/* branje podatkov iz tabel territories in quizzes in njihovo shranjevanje v spremenljivke*/
    	$name = User::find($myID)->username;

        $image = User::find($myID)->image_path;

    	$quizCount = Quiz::where('id_attacker', '=', $myID) 
            -> orWhere('id_defender', '=', $myID) 
            -> count();

        $territoryCount = Territory::where('id_owner', '=', $myID) 
            -> count(); 

        $territories= Territory::where('id_owner', '=', $myID) 
            -> get(array('name','description','pos_x','pos_y'));

        $highScoreAttack= Quiz::where('id_attacker', '=', $myID) 
            -> max('attacker_num_correct_ans');

        $highScoreDefense= Quiz::where('id_defender', '=', $myID) 
            -> max('defender_num_correct_ans');
        
        
        $averageAttackScore= Quiz::where('id_attacker', '=', $myID) 
            -> avg('attacker_num_correct_ans'); 
        
        $averageDefenseScore= Quiz::where('id_defender', '=', $myID) 
            -> avg('defender_num_correct_ans');    
    	
        
        /* sestavljanje tabele $data ki bo poslana v view */

    	$data=array("na"=>$name, "im" =>$image, "id"=>$myID, "qc" => $quizCount,"tc" => $territoryCount, "t" => $territories, "hsa" => $highScoreAttack, "hsd" => $highScoreDefense, "aas" => $averageAttackScore, "ads" => $averageDefenseScore);

    	/* vracanje view in posiljanje podatkov */
    	return View::make('profile', $data);
    }
}

?>