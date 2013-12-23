<?php

class ControlPanelController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', array('on' => 'get'));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    

    public function getChange()
    {
        $error=array("up"=>"");
        return View::make('control',$error);
    }
    

    public function postChange()
    {
        
        $data=Input::all();

        
        if (Auth::validate(array('username' => $data['oldUsername'], 'password' => $data['oldPassword'])))       
        {    
            $rules = array(
                
                'username'    => 'alpha_num|min:3|max:32|unique:users,username',
                'password'    => 'confirmed',
                'slika'       => 'image|between:0,500'
            );

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $userID = Auth::user() -> id;
                if(Input::has('username')){
                    User::where('id', '=', $userID)
                        ->update(array('username'=>Input::get('username')));
                }       
                
                if(Input::has('password')){
                    User::where('id', '=', $userID)
                        ->update(array('password'=>Hash::make(Input::get('password'))));
                }  
                /* shranjevanje slik v direktorij uploads */
                if(Input::hasFile('slika')){
                    $file = Input::file('slika');
                    $destinationPath="uploads";
                    $fileName=$userID;
                    $file->move($destinationPath, $fileName.".".$file->getClientOriginalExtension());
                    User::where('id', '=', $userID)
                        ->update(array('image_path'=>$destinationPath."/".$fileName.".".$file->getClientOriginalExtension()));
                }
                
                return Redirect::to('profile');
            }
            
            return Redirect::to('control')->withInput()->withErrors($validator);
        }
        
        $error=array("up"=>"Username and password combination is not correct.");
        return View::make('control',$error);
            
    }

}
