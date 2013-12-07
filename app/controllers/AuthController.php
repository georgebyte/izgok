<?php

class AuthController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('guest', array('except' => 'getLogout'));
        $this->beforeFilter('auth', array('only' => 'getLogout'));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getIndex()
    {
        return Redirect::to('auth/login');
    }

    public function getLogin()
    {
        return View::make('auth.login');
    }

    public function postLogin()
    {
        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        $remember = (Input::get('remember_me') == 'on') ? true : false;

        if (Auth::attempt($userdata, $remember)) {        	
            return Redirect::intended('/');
        }

        return Redirect::to('auth/login')
            ->with('error', 'Your username and password combination was incorrect.')
            ->withInput();
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    public function getRegister()
    {
        return View::make('auth.register');
    }

    public function postRegister()
    {
        $data = Input::all();

        $rules = array(
            'username' => 'required|alpha_num|min:3|max:32|unique:users,username',
            'email'    => 'required|email|max:320|unique:users,email',
            'password' => 'required|confirmed'
        );

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            $userdata = array(
                'username' => $data['username'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password'])
            );
            $user = new User($userdata);
            $user->save();
            return Redirect::to('/');
        }

        return Redirect::to('auth/register')->withInput()->withErrors($validator);
    }

}