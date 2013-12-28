<?php

class AdminController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('admin');
    }

    public function Territoryform()
    {
        exit("TODO :: territory control form view");
    }

    public function postEdit()
    {
       $inputData = Input::all();
       User::where('id', '=', $inputData['userid'])
                        ->update(array('username' => $inputData['username'], 'email' => $inputData['email']));
        return View::make('adminedituser');
    }
    public function postForm($form = null)
    {

        $data = array("error" => "Zahtevana funkcija ne obstaja.");

        if($form == null){
            return View::make('admin');
        }
            
        elseif($form == "user"){

            $inputData = Input::all();

            $userID = $inputData['userid'];
            $userAllData = User::where('id', '=', $userID) -> get(array('id', 'username', 'email'));
            $userAllData = $userAllData[0];

            $userData = array();

            $userData['id'] = $userAllData['id'];
            $userData['username'] = $userAllData['username'];
            $userData['email'] = $userAllData['email'];
            $data = array("userData" => $userData);
            unset($userData);
            unset($userAllData);
            return View::make('adminedituser', $data);
        }

        elseif($form == "territory"){
            AdminController::TerritoryForm();
        }
            
        else
            return View::make('admin', $data);  
    }


    public function getForm($form = null)
    {
        $data = array("error" => "Zahtevana funkcija ne obstaja.");

        if($form == null){
            return View::make('admin');
        }
            

        elseif($form == "user"){
            $userList = User::orderBy('username', 'asc') -> get(array('id', 'username'));
            $data = array("userList" => $userList);
            return View::make('useradmin', $data);
        }

        elseif($form == "territory"){
            AdminController::TerritoryForm();
        }
            
        else
            return View::make('admin', $data);  
            
    }  
}