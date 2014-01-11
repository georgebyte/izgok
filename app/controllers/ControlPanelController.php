<?php

class ControlPanelController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', array('on' => 'get'));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getChange()
    {
        $error = array("up" => "");
        return View::make('control',$error);
    }
    
    public function postChange()
    {
        $data = Input::all();

        if(!(Auth::validate(array('username' => Auth::user() -> username, 'password' => $data['oldPassword'])))){ 
            $error=array("up" => "Username and password combination is not correct.");
            return View::make('control',$error);
        }

        $rules = array(
            'password' => 'confirmed',
            'slika'    => 'image|between:0,500'
        );

        $validator = Validator::make($data, $rules);

        if (!($validator->passes())) {
            return Redirect::to('control') -> withInput() -> withErrors($validator);
        }

        $userID = Auth::user() -> id;   
        
        if(Input::has('password')){
            User::where('id', '=', $userID)
                ->update(array('password'=>Hash::make(Input::get('password'))));
        }  

        if(Input::hasFile('slika')){
            $file = Input::file('slika');
            $fileName = md5($userID).".".$file -> getClientOriginalExtension();
            $destinationPath = Config::get('auth.usersAvatarsLocation');
            $file -> move($destinationPath, $fileName);
            User::where('id', '=', $userID) -> update(array('image_path' => $fileName));
        }
        
        return Redirect::to('profile');
    }
}
