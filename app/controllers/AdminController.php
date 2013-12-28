<?php

class AdminController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('admin');
    }

/*
getIndex()
    home page

getUsers()
    seznam uporabnikov
    ko kliknes te preusmeri na getUser($userid)
    izpis vasi klink na vasi getTerritory($villageid)

postUser($userid)
    za potrditev sprememb

postTerritory($territoryId)


*/
    public function getIndex()
    {
        return View::make('admin');
    }

    public function getUser()
    {
            $userList = User::orderBy('username', 'asc') -> get(array('id', 'username'));
            $data = array("userList" => $userList);
            return View::make('useradmin', $data);        
    }

    public function postUsersubmit()
    {
        $inputData = Input::all();
        User::where('id', '=', $inputData['userid'])
        ->update(array('username' => $inputData['username'], 'email' => $inputData['email']));
        
        return View::make('adminedituser');

    }

    public function postDeleteterritory()
    {
        $inputData = Input::all();
        $territoryID = $inputData['territoryid'];

        Territory::whereIn('id', $territoryID) -> delete();

        $data = array("deletedTerritories" => "successful");
        return View::make('adminedituser', $data);

    }

    public function postUser()
    {

            $inputData = Input::all();

            /* spremenjlivke */
            $userData = array();

            /* zbiranje podatkov o uporabniku */
            $userID = $inputData['userid'];
            $userAllData = User::where('id', '=', $userID) -> get(array('id', 'username', 'email'));
            $userAllData = $userAllData[0];

            /* shranjevanje podatkov v $userData array */
            $userData['id'] = $userAllData['id'];
            $userData['username'] = $userAllData['username'];
            $userData['email'] = $userAllData['email'];

            /* zbiranje podatkov o uporabnikovih teritorijih */
            $territoryAllData = Territory::where('id_owner', '=', $userID) -> orderBy('name', 'asc') -> get(array('id', 'name'));

            /* shranjevanje v array ki bo poslan v view */
            $data = array("userData" => $userData, "userTerritories" => $territoryAllData);

            /* unset vseh odrabljenih spremenljivk */
            unset($userData);
            unset($userAllData);
            unset($territoryAllData);

            return View::make('adminedituser', $data);

    }
}