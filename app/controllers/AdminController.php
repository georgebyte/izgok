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

    public function getNpc()
    {
        return View::make('adminaddnpc');
    }

    public function postNpc()
    {
        $inputData = Input::all();
        $npcName = $inputData['name'];
        $npcDesc = $inputData['description'];
        $varName = rand(1,2) == 1 ? "vas" : "ozemlje";
        //territoryName = $npcName."'s ".$varName;
        $territoryName = $varName." ".$npcName;

        /* dodajanje NPC-ja */
        $userdata = array(
            'username' => $npcName,
            'email'    => "NPC",
            'password' => Hash::make($npcName.rand(123,321))
            );
        $user = new User($userdata);
        $user -> score = 10;
        $user->save();
        $userID = $user -> id;

        /* iskanje pozicije na mapi */
        $allTerritoriesCount = Territory::all() -> count();


        /* izbiranje smeri neba ( $positionOnMap ) za postavitev NPCja glede na tjo kje jih je najmanj */
        
        /* vec nacinov razvrscanja za NPCje*/

        $positionSelection = rand(1,100);

        if($positionSelection <= 15){
            switch(rand(1,4)){
            case 1: $positionOnMap = "S"; break;
            case 2: $positionOnMap = "E"; break;
            case 3: $positionOnMap = "W"; break;
            case 4: $positionOnMap = "N"; break;
            }
        }

        if($positionSelection > 15){
            $countNE = Territory::where('pos_x', '>', '0') -> where('pos_y', '>', '0') -> where('is_npc_village' ,'=', '1') -> count();
            $countSW = Territory::where('pos_x', '<', '0') -> where('pos_y', '<', '0') -> where('is_npc_village' ,'=', '1') -> count();
            $countNW = Territory::where('pos_x', '<', '0') -> where('pos_y', '>', '0') -> where('is_npc_village' ,'=', '1') -> count();
            $countSE = Territory::where('pos_x', '>', '0') -> where('pos_y', '<', '0') -> where('is_npc_village' ,'=', '1') -> count();

            if(($countNE + $countSW + $countNW) >= $countSE*3)
                $positionOnMap = "SE";

            elseif(($countSW + $countNW + $countSE) >= $countNE*3)
                $positionOnMap = "NE";

            elseif(($countSW + $countNE + $countSE) >= $countNW*3)
                $positionOnMap = "NW";

            elseif(($countNE + $countNW + $countSE) >= $countSW*3)
                $positionOnMap = "SW";
        }

        /* razdelitev limit za sirjenje od znotraj navzven */
        $min = (int)($allTerritoriesCount / 10);
        $min = (int)(($min + 1) * 1.33);
        $max = (int)($min * 1.67);
        $minNeg = -1 * $min;
        $maxNeg = -1 * $max;
        $posx=0;
        $posy=0;
        $territoryCount = 1;
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
                    case 'S':
                        $posx=rand($minNeg,$max);
                        $posy=rand($minNeg,0);
                    break;
                    case 'E':
                        $posx=rand(0,$max);
                        $posy=rand($minNeg,$max);
                    break;
                    case 'N':
                        $posx=rand($minNeg,$max);
                        $posy=rand(0,$max);
                    break;
                    case 'W':
                        $posx=rand($minNeg, 0);
                        $posy=rand($minNeg,$max);
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
                    case 'S':
                        $posx=rand($minNeg,$max);
                        $posy=rand($minNeg,0);
                    break;
                    case 'E':
                        $posx=rand(0,$max);
                        $posy=rand($minNeg,$max);
                    break;
                    case 'N':
                        $posx=rand($minNeg,$max);
                        $posy=rand(0,$max);
                    break;
                    case 'W':
                        $posx=rand($minNeg, 0);
                        $posy=rand($minNeg,$max);
                    break;                    
                }
            }

            $territoryCount = Territory::where('pos_x', '=', $posx)
                                -> where('pos_y', '=', $posy)
                                -> count();
        }while($territoryCount > 1);

        /* dodajanje teritorija */
        $territory = new Territory;
        $territory -> name = $territoryName;
        $territory -> description = $npcDesc;
        $territory -> pos_x = $posx;
        $territory -> pos_y = $posy;
        $territory -> id_owner = $userID;
        $territory -> is_main_village = 0;
        $territory -> is_npc_village = 1;
        $territory -> save();

        $data = array("added" => true, "npcName" => $npcName, "position" => $positionOnMap, "posx" => $posx, "posy" => $posy);
        return View::make('adminaddnpc', $data);
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
            if(isset($_POST['searchbox'])){
                $userName = $inputData['username'];
                $userAllData = User::where('username', '=', $userName) -> get(array('id', 'username', 'email'));
            }
            if(isset($_POST['dropdown'])){
                $userID = $inputData['userid'];
                $userAllData = User::where('id', '=', $userID) -> get(array('id', 'username', 'email'));
            }
            $userAllData = $userAllData[0];
            $userID = $userAllData['id'];
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