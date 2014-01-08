<?php

class ProfileController extends BaseController {
    
    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('csrf', array('on' => 'post'));
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

    public function postEdit()
    {
        $input = Input::all();
        $myID = Auth::user() -> id;
        $territoryID = $input['id'];

        $territory= Territory::where('id_owner', '=', $myID)
                                -> where('id', '=', $territoryID)
                                -> take(1);

        if(count($territory) == 0){
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Nisi vladar tega ozemlja oz. to ozemlje ne obstaja.");
        }

        $territory = Territory::find($territoryID);
        $territory -> name = $input['name'];
        $territory -> description = $input['description'];
        $posX = $territory -> pos_x;
        $posY = $territory -> pos_y;
        $territory -> save();
        return Redirect::to("map/territory/$territoryID/$posX/$posY");
    }

    public function getEdit($territoryID = 0)
    {
        $myID = Auth::user() -> id;
        $territory= Territory::where('id_owner', '=', $myID)
                                -> where('id', '=', $territoryID)
                                -> get(array('id', 'id_owner','name','description'))
                                -> take(1);
        if(count($territory) == 0){
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Nisi vladar tega ozemlja oz. to ozemlje ne obstaja.");
        }

        $territoryInfo = array();
        foreach($territory as $value){
            $territoryInfo['id'] = $value['id'];
            $territoryInfo['id_owner'] = $value['id_owner'];
            $territoryInfo['name'] = $value['name'];
            $territoryInfo['description'] = $value['description'];
        }
        $data = array("territoryInfo" => $territoryInfo);
        return View::make('editterritory', $data);
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
            -> orderBy('name', 'asc')
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