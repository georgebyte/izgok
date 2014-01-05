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
            $image=Config::get('auth.usersAvatarsLocation') . "/" . $user->image_path;
            $usersAndScores[$name." ".$image]=$user->score;

        }
        arsort($usersAndScores);
        $data=array("scores"=> $usersAndScores);
        return View::make('scoreboard', $data);
    }
}

?>