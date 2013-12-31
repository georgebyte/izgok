<?php

class ScoreboardController extends BaseController {
    
    public function __construct()
    {
        $this->beforeFilter('auth');
        
    }

    public function getIndex()
    {

        return Redirect::to("/scoreboard/show/");
    }


    public function getShow()
    {

    	/* data je tabela podatkov poslanih v view */
    	
        $data=Array();
        $usersAndScores = array();
        $users = User::all();    
        foreach ($users as $user) {
            $id=$user->id;
            $name=$user->username;
            $image=$user->image_path;
            $territoryCount = Territory::where('id_owner', '=', $id) 
                -> count();
            $usersAndScores[$name." ".$image]=$territoryCount*15;

        }
        arsort($usersAndScores);
        $data=array("scores"=> $usersAndScores);
        return View::make('scoreboard', $data);
    }
}

?>