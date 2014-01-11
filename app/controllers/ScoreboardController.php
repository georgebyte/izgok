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
    	$pageLength = 10;
        $data = array();
        $usersAndScores = array();

        $start = true;
        $end = true;
        $length = User::where('email', '!=', 'NPC') -> count();

        if($pagination < 0)
            $pagination = 0;

        if($pagination == 0)
            $start = false;

        if($pagination + $pageLength >= $length){
            $pageLength = $length - $pagination;
            $end = false;
        }

        $users = User::where('email', '!=', 'NPC') -> orderBy("score", "desc") -> orderBy("username", "asc") -> skip($pagination) -> take($pageLength) -> get();    

        foreach ($users as $user) {
            $id=$user->id;
            $name=$user->username;
            $image=Config::get('auth.usersAvatarsLocation') . "/" . $user -> image_path;
            $usersAndScores[$name." ".$image] = $user -> score;
        }

        $data = array("scores" => $usersAndScores, "start" => $start, "end" => $end, "page" => $pagination, "pageLength" => $pageLength);
        return View::make('scoreboard', $data);
    }
}