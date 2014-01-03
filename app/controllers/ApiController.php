<?php

class ApiController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function getLookup($user = null)
    {
				if($user == null)
					return ("");
				
				echo"looking for {$user} <br>";
				$userAllData = User::where('username', 'LIKE', $user.'%') -> get(array('username'));
				$return = "";
				foreach($userAllData as $val){

					$return .= "<li>{$val['username']}</li>";
				}
				return $return;
    }
} 