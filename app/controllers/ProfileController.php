<?php

class ProfileController extends BaseController {
    
    public function __construct()
    {
        $this->beforeFilter('auth');
        
    }

    public function getIndex()
    {

        return Redirect::to("/profile/show/");
    }


    public function postIndex()
    {
        $data=Input::all();
        return Redirect::to("/profile/show/".$data['find']);
    }


    public function getShow($name="myName")
    {

    	/* data je tabela podatkov poslanih v view */
    	
        
        if($name=="myName"){
            $myID = Auth::user() -> id;
            $name = User::find($myID)->username;
        }
        else{
            $temp = User::where('username', '=', $name)->count();
            if($temp==0){
                return View::make('playernotfound');
            }
            $myID = User::where('username', '=', $name)->get(array('id'));
            foreach($myID as $myID){
                $myID=$myID['id'];
            }
        }
        $data = array();

        
       

    	/* branje podatkov iz tabel territories in quizzes in njihovo shranjevanje v spremenljivke*/
    	
        


        $image = Config::get('auth.usersAvatarsLocation') . "/" . User::find($myID)->image_path;

    	$quizCount = Quiz::where('id_attacker', '=', $myID) 
            -> orWhere('id_defender', '=', $myID) 
            -> count();

        $territoryCount = Territory::where('id_owner', '=', $myID) 
            -> count(); 

        $territories= Territory::where('id_owner', '=', $myID) 
            -> get(array('id', 'name','description','pos_x','pos_y'));

        $highScoreAttack= Quiz::where('id_attacker', '=', $myID) 
            -> max('attacker_num_correct_ans');

        $highScoreDefense= Quiz::where('id_defender', '=', $myID) 
            -> max('defender_num_correct_ans');
        
        
        $averageAttackScore= Quiz::where('id_attacker', '=', $myID) 
            -> avg('attacker_num_correct_ans'); 
        
        $averageDefenseScore= Quiz::where('id_defender', '=', $myID) 
            -> avg('defender_num_correct_ans');    
    	
        
        /* sestavljanje tabele $data ki bo poslana v view */

    	$data=array("na"=>$name, "im" => $image, "id"=>$myID, "qc" => $quizCount,"tc" => $territoryCount, "t" => $territories, "hsa" => $highScoreAttack, "hsd" => $highScoreDefense, "aas" => $averageAttackScore, "ads" => $averageDefenseScore);

    	/* vracanje view in posiljanje podatkov */
    	return View::make('profile', $data);
    }
}

?>