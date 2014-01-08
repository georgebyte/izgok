<?php

class ApiController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function getLookup($user = null)
    {
				$userAllData = User::where('username', 'LIKE', '%'.$user.'%') -> where('email', '!=', 'NPC') -> get(array('username'));
				$tmp = array();
				foreach($userAllData as $val){
					array_push($tmp, $val['username']);
				}
				return Response::json($tmp);
    }
} 