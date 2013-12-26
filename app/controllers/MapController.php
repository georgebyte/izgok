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
        foreach ($visibleTerritories as $territory) {
            array_push($visibleTerritoriesData, $territory);
        }
        $data['visibleTerritories'] = $visibleTerritoriesData;

        return View::make('map', $data);
    }

}