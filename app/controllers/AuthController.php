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
            'password' => 'required|confirmed',
            'slika'    => 'image|between:0,500'
        );

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            $userdata = array(
                'username' => $data['username'],
                'email'    => $data['email'],
                'location' => $data['location'], 
                'password' => Hash::make($data['password'])

            );

            /* dodajanje uporabnika */
            $user = new User($userdata);
            $user -> score = 15;
            $user->save();
            $userID = $user -> id;
            $userName = $user -> username;
            

            /* shranjevanje slik v direktorij uploads */
            
            $file = Input::file('slika');
            if ($file) {
                $fileName = md5($userID).".".$file->getClientOriginalExtension();
                $destinationPath = Config::get('auth.usersAvatarsLocation');
                $file->move($destinationPath, $fileName);
            } else {
                $fileName = 'default.jpg';
            }
            
            /* shranjevanje poti do slike v bazo */
            User::where('id', '=', $userID)
                 ->update(array('image_path' => $fileName));

            /* iskanje polozaja na mapi */
            $positionOnMap = $userdata['location'];
            $allTerritoriesCount = Territory::all() -> count();

            /* razdelitev limit za sirjenje od znotraj navzven */
            $min = (int)($allTerritoriesCount / 10);
            $min = (int)(($min + 1) * 2);
            $max = (int)($min * 2.5);
            $minNeg = -1 * $min;
            $maxNeg = -1 * $max;
            $posx=0;
            $posy=0;
            do{
                if($allTerritoriesCount <= $min){

                    switch($positionOnMap){
                        case 'NE': 
                            $posx=rand(0,$min);
                            $posy=rand(0,$min);
                        break;
                        case 'SE': 
                            $posx=rand(0,$min);
                            $posy=rand($minNeg,0);
                        break;
                        case 'SW':
                            $posx=rand($minNeg,0);
                            $posy=rand($minNeg,0);
                        break;
                        case 'NW': 
                            $posx=rand($minNeg,0);
                            $posy=rand(0,$min);
                        break;
                    }
                }
                else{

                    switch($positionOnMap){
                        case 'NE': 
                            $posx=rand($min,$max);
                            $posy=rand($min,$max);
                        break;
                        case 'SE': 
                            $posx=rand($min,$max);
                            $posy=rand($maxNeg,$minNeg);
                        break;
                        case 'SW':
                            $posx=rand($maxNeg,$minNeg);
                            $posy=rand($maxNeg,$minNeg);
                        break;
                        case 'NW': 
                            $posx=rand($maxNeg,$minNeg);
                            $posy=rand($min,$max);
                        break;
                    }
                }

                $territoryCount = Territory::where('pos_x', '=', $posx)
                                    -> where('pos_y', '=', $posy)
                                    -> count();
            }while($territoryCounty > 1);

            /* dodajanje teritorija uporabniku */
            $userName = $userdata['username'];
            $territoryName = $userName."'s village";
            $territory = new Territory;
            $territory -> name = $territoryName;
            $territory -> pos_x = $posx;
            $territory -> pos_y = $posy;
            $territory -> id_owner = $userID;
            $territory -> is_main_village = 1;
            $territory -> save();

            return Redirect::to('/');
        }

        return Redirect::to('auth/register')->withInput()->withErrors($validator);
    }

}
