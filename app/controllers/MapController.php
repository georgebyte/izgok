<?php

class MapController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function getIndex()
    {
        return Redirect::to("/map/show/");
    }

    public function getShow($x = 0, $y = 0)
    {
        $visibleMapSize = Config::get('map.visibleMapSize', 4);
        $data = array('x' => $x, 'y' => $y, 'visibleTerritories' => null, 'visibleMapSize' => $visibleMapSize);
        $rules = array(
            'x' => 'integer',
            'y'    => 'integer'
        );
        $validator = Validator::make($data, $rules);
        if (!$validator->passes()) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Navedene koordinate niso veljavne.");
        }

        /* Iz baze dobi vsa naselja ki se nahajajo v kvadratu 9x9 okoli izbrane tocke z x, y koordinatama */
        $visibleTerritories = Territory::whereBetween('pos_x', array($x-$visibleMapSize, $x+$visibleMapSize)) -> whereBetween('pos_y', array($y-$visibleMapSize, $y+$visibleMapSize)) -> get();

        $visibleTerritoriesData = array();
        $territoryOwners = array();
        foreach ($visibleTerritories as $territory) {
            /* Iskanje lastnika ozemlja */
            $territoryOwner = User::find($territory['id_owner'])['username'];
            $tempTerritoryID = $territory['id'];
            $territoryOwners[$tempTerritoryID] = $territoryOwner;
            array_push($visibleTerritoriesData, $territory);
        }
        $data['visibleTerritories'] = $visibleTerritoriesData;
        $data['leaders'] = $territoryOwners;

        return View::make('map', $data);
    }

    public function getTerritory($territoryID = null, $x = null, $y = null)
    {
        $data = array('territoryID' => $territoryID, 'x' => $x, 'y' => $y);
        $rules = array(
            'territoryID' => 'required|integer',
            'x'           => 'required|integer',
            'y'           => 'required|integer'
        );
        $validator = Validator::make($data, $rules);
        if (!$validator->passes()) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Navedene koordinate niso veljavne.");
        }

        $data = array('territoryID' => $territoryID, 'name' => null, 'description' => null, 'player' => null, 'playerID' => null, 'x' => $x, 'y' => $y);
        if (!$territoryID) {
            $data['name'] = "Divjina";
            $data['description'] = "Nenaseljeno ozemlje";
            $data['player'] = "---";
            $data['playerID'] = 0;
            return View::make('territory', $data);
        } else {
            $dbTerritory = Territory::where('id', '=', $territoryID)->first();
            $dbPlayer = User::where('id', '=', $dbTerritory['id_owner'])->first();
            $data['name'] = $dbTerritory['name'];
            $data['description'] = $dbTerritory['description'];
            $data['player'] = $dbPlayer['username'];
            $data['playerID'] = $dbPlayer['id'];
            $data['is_main_village'] = $dbTerritory['is_main_village'];
            $data['is_npc_village'] = $dbTerritory['is_npc_village'];
            return View::make('territory', $data);
        }
    }

}