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


    public function getShow($pagination = 0)
    {

    	/* data je tabela podatkov poslanih v view */
    	$pageLength=10;
        $data=Array();
        $usersAndScores = array();
        $users = User::where('email', '!=', 'NPC') -> get();    
        foreach ($users as $user) {
            $id=$user->id;
            $name=$user->username;
            $image=Config::get('auth.usersAvatarsLocation') . "/" . $user->image_path;
            $usersAndScores[$name." ".$image]=$user->score;

        }
        arsort($usersAndScores);
        
        $start=true;
        $end=true;
        $length=count($usersAndScores);
        if($pagination==0)
            $start=false;
        if($pagination+$pageLength>=$length){
            $pageLength=$length-$pagination;
            $end=false;
        }
        $usersAndScores = array_slice($usersAndScores, $pagination, $pageLength);
        $data=array("scores"=> $usersAndScores,"start"=>$start,"end"=>$end,"page"=>$pagination,"pageLength"=>$pageLength);
        return View::make('scoreboard', $data);
    }
}