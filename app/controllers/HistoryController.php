<?php

class HistoryController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function getIndex()
    {

        /* deklaracija spremenljivk potrebna skozi controller */
        /* data je tabela podatkov poslanih v view */
        $myID = Auth::user() -> id;
        $quizIDsArray = array();
        $quizDates = array();
        $solvedQuizes = array();
        $data = array();
        $attackedTerritoryData = array();
        $attackedTerritories = array();
        $territoryName = array();
        $territoryPosX = array();
        $territoryPosY = array();

        /* branje kvizov v katerih je uporabnik sodeloval kot napadalec ali branitelj - sortirano po casu padajoce */
        /* array s podatki id kviza*/

        $quizHistory = Quiz::where('id_attacker', '=', $myID) -> orWhere('id_defender', '=', $myID) -> orderBy('created_at','desc') ->get(array('id', 'created_at','id_attacked_territory','attacked_territory_pos_x','attacked_territory_pos_y'));

        foreach($quizHistory as $value){
            /* branje podatkov */
            $quiz = Quiz::find($value['id']);
            $isAttacker = ($quiz -> id_attacker == Auth::user() -> id) ? true : false;
            $isDefender = ($quiz -> id_defender == Auth::user() -> id) ? true : false;

            if(($isAttacker && $quiz -> submit_time_attacker == null) || ($isDefender && $quiz -> submit_time_defender == null))
                $solved = false;
            else
                $solved = true;

            /* pridobivanje podatkov naselja */
            /* TODO :: fix empty attackedterritorydata*/
            $attackedTerritoryData = Territory::where('id','=', $value['id_attacked_territory']) -> get(array('name','pos_x','pos_y')); 

            /* napad na nenaseljeno ozemlje */
            if(count($attackedTerritoryData) == 0)
            {
                $attackedTerritoryData[0] = array('name' => 'Nenasljeno ozemlje', 'pos_x' => $value['attacked_territory_pos_x'], 'pos_y' => $value['attacked_territory_pos_y']);
            }

            /* polnenje tabel s podatki */
            array_push($quizIDsArray, $value['id']);
            array_push($quizDates, $value['created_at']);
            array_push($solvedQuizes, $solved);
            array_push($attackedTerritories, $attackedTerritoryData[0]);
        }

        /* podatki o teritorijih */
        foreach($attackedTerritories as $value)
            {
                array_push($territoryName, $value['name']); 
                array_push($territoryPosX, $value['pos_x']);
                array_push($territoryPosY, $value['pos_y']); 
            }
        /* sestavljanje tabele $data ki bo poslana v view */
        $data=array("quizIDs" => $quizIDsArray, "quizDates" => $quizDates, "solvedQuizes" => $solvedQuizes, 'attackedTerritoryData' => $attackedTerritories, 'territoryName' => $territoryName, 'territoryPosX' => $territoryPosX, 'territoryPosY' => $territoryPosY);

        /* brisanje tabel katerih se več ne potrebuje */
        unset($quizIDsArray);
        unset($quizDates);
        unset($solvedQuizes);
        unset($territoryName);
        unset($territoryPosX);
        unset($territoryPosY);

        /* vracanje view in posiljanje podatkov */
        return View::make('history', $data);
    }

    public function getUnsolved()
    {

        /* deklaracija spremenljivk potrebna skozi controller */
        /* data je tabela podatkov poslanih v view */
        $myID = Auth::user() -> id;
        $quizIDsArray = array();
        $quizDates = array();
        $solvedQuizes = array();
        $data = array();
        $attackedTerritoryData = array();
        $attackedTerritories = array();
        $territoryName = array();
        $territoryPosX = array();
        $territoryPosY = array();

        /* branje kvizov v katerih je uporabnik sodeloval kot napadalec ali branitelj - sortirano po casu padajoce */
        /* array s podatki id kviza*/
        $quizHistory = Quiz::where('id_attacker', '=', $myID) -> orWhere('id_defender', '=', $myID) -> orderBy('created_at','desc') ->get(array('id', 'created_at','id_attacked_territory','attacked_territory_pos_x','attacked_territory_pos_y'));

        foreach($quizHistory as $value){
            /* branje podatkov */
            $quiz = Quiz::find($value['id']);
            $isAttacker = ($quiz -> id_attacker == Auth::user() -> id) ? true : false;
            $isDefender = ($quiz -> id_defender == Auth::user() -> id) ? true : false;

            if(($isAttacker && $quiz -> submit_time_attacker == null) || ($isDefender && $quiz -> submit_time_defender == null)){
                $solved = false;

            /* pridobivanje podatkov naselja */
            /* TODO :: fix empty attackedterritorydata*/
            $attackedTerritoryData = Territory::where('id','=', $value['id_attacked_territory']) -> get(array('name','pos_x','pos_y')); 
            
            /* napad na nenaseljeno ozemlje */
            if(count($attackedTerritoryData) == 0)
            {
                $attackedTerritoryData[0] = array('name' => 'Nenasljeno ozemlje', 'pos_x' => $value['attacked_territory_pos_x'], 'pos_y' => $value['attacked_territory_pos_y']);
            }

            /* polnenje tabel s podatki */
            array_push($quizIDsArray, $value['id']);
            array_push($quizDates, $value['created_at']);
            array_push($solvedQuizes, $solved);
            array_push($attackedTerritories, $attackedTerritoryData[0]);
            }
        }

        /* podatki o teritorijih */
        foreach($attackedTerritories as $value)
            {
                array_push($territoryName, $value['name']); 
                array_push($territoryPosX, $value['pos_x']);
                array_push($territoryPosY, $value['pos_y']); 
            }
        /* sestavljanje tabele $data ki bo poslana v view */
        $data=array("quizIDs" => $quizIDsArray, "quizDates" => $quizDates, "solvedQuizes" => $solvedQuizes, 'attackedTerritoryData' => $attackedTerritories, 'territoryName' => $territoryName, 'territoryPosX' => $territoryPosX, 'territoryPosY' => $territoryPosY);

        /* brisanje tabel katerih se več ne potrebuje */
        unset($quizIDsArray);
        unset($quizDates);
        unset($solvedQuizes);
        unset($territoryName);
        unset($territoryPosX);
        unset($territoryPosY);

        /* vracanje view in posiljanje podatkov */
        return View::make('history', $data);
    }

    public function getDefense()
    {

        /* deklaracija spremenljivk potrebna skozi controller */
        /* data je tabela podatkov poslanih v view */
        $myID = Auth::user() -> id;
        $quizIDsArray = array();
        $quizDates = array();
        $solvedQuizes = array();
        $data = array();
        $attackedTerritoryData = array();
        $attackedTerritories = array();
        $territoryName = array();
        $territoryPosX = array();
        $territoryPosY = array();

        /* branje kvizov v katerih je uporabnik sodeloval kot napadalec ali branitelj - sortirano po casu padajoce */
        /* array s podatki id kviza*/
        $quizHistory = Quiz::Where('id_defender', '=', $myID) -> orderBy('created_at','desc') ->get(array('id', 'created_at','id_attacked_territory','attacked_territory_pos_x','attacked_territory_pos_y'));

        foreach($quizHistory as $value){
            /* branje podatkov */
            $quiz = Quiz::find($value['id']);
            $isAttacker = ($quiz -> id_attacker == Auth::user() -> id) ? true : false;
            $isDefender = ($quiz -> id_defender == Auth::user() -> id) ? true : false;

            if(($isAttacker && $quiz -> submit_time_attacker == null) || ($isDefender && $quiz -> submit_time_defender == null))
                $solved = false;
            else
                $solved = true;

            /* pridobivanje podatkov naselja */
            /* TODO :: fix empty attackedterritorydata*/
            $attackedTerritoryData = Territory::where('id','=', $value['id_attacked_territory']) -> get(array('name','pos_x','pos_y')); 

            /* napad na nenaseljeno ozemlje */
            if(count($attackedTerritoryData) == 0)
            {
                $attackedTerritoryData[0] = array('name' => 'Nenasljeno ozemlje', 'pos_x' => $value['attacked_territory_pos_x'], 'pos_y' => $value['attacked_territory_pos_y']);
            }

            /* polnenje tabel s podatki */
            array_push($quizIDsArray, $value['id']);
            array_push($quizDates, $value['created_at']);
            array_push($solvedQuizes, $solved);
            array_push($attackedTerritories, $attackedTerritoryData[0]);
        }

        /* podatki o teritorijih */
        foreach($attackedTerritories as $value)
            {
                array_push($territoryName, $value['name']); 
                array_push($territoryPosX, $value['pos_x']);
                array_push($territoryPosY, $value['pos_y']); 
            }
        /* sestavljanje tabele $data ki bo poslana v view */
        $data=array("quizIDs" => $quizIDsArray, "quizDates" => $quizDates, "solvedQuizes" => $solvedQuizes, 'attackedTerritoryData' => $attackedTerritories, 'territoryName' => $territoryName, 'territoryPosX' => $territoryPosX, 'territoryPosY' => $territoryPosY);

        /* brisanje tabel katerih se več ne potrebuje */
        unset($quizIDsArray);
        unset($quizDates);
        unset($solvedQuizes);
        unset($territoryName);
        unset($territoryPosX);
        unset($territoryPosY);

        /* vracanje view in posiljanje podatkov */
        return View::make('history', $data);
    }
    
    public function getOffense()
    {

        /* deklaracija spremenljivk potrebna skozi controller */
        /* data je tabela podatkov poslanih v view */
        $myID = Auth::user() -> id;
        $quizIDsArray = array();
        $quizDates = array();
        $solvedQuizes = array();
        $data = array();
        $attackedTerritoryData = array();
        $attackedTerritories = array();
        $territoryName = array();
        $territoryPosX = array();
        $territoryPosY = array();

        /* branje kvizov v katerih je uporabnik sodeloval kot napadalec ali branitelj - sortirano po casu padajoce */
        /* array s podatki id kviza*/
        $quizHistory = Quiz::where('id_attacker', '=', $myID) -> orderBy('created_at','desc') ->get(array('id', 'created_at','id_attacked_territory','attacked_territory_pos_x','attacked_territory_pos_y'));

        foreach($quizHistory as $value){
            /* branje podatkov */
            $quiz = Quiz::find($value['id']);
            $isAttacker = ($quiz -> id_attacker == Auth::user() -> id) ? true : false;
            $isDefender = ($quiz -> id_defender == Auth::user() -> id) ? true : false;

            if(($isAttacker && $quiz -> submit_time_attacker == null) || ($isDefender && $quiz -> submit_time_defender == null))
                $solved = false;
            else
                $solved = true;

            /* pridobivanje podatkov naselja */
            /* TODO :: fix empty attackedterritorydata*/
            $attackedTerritoryData = Territory::where('id','=', $value['id_attacked_territory']) -> get(array('name','pos_x','pos_y')); 

            /* napad na nenaseljeno ozemlje */
            if(count($attackedTerritoryData) == 0)
            {
                $attackedTerritoryData[0] = array('name' => 'Nenasljeno ozemlje', 'pos_x' => $value['attacked_territory_pos_x'], 'pos_y' => $value['attacked_territory_pos_y']);
            }

            /* polnenje tabel s podatki */
            array_push($quizIDsArray, $value['id']);
            array_push($quizDates, $value['created_at']);
            array_push($solvedQuizes, $solved);
            array_push($attackedTerritories, $attackedTerritoryData[0]);
        }

        /* podatki o teritorijih */
        foreach($attackedTerritories as $value)
            {
                array_push($territoryName, $value['name']); 
                array_push($territoryPosX, $value['pos_x']);
                array_push($territoryPosY, $value['pos_y']); 
            }
        /* sestavljanje tabele $data ki bo poslana v view */
        $data=array("quizIDs" => $quizIDsArray, "quizDates" => $quizDates, "solvedQuizes" => $solvedQuizes, 'attackedTerritoryData' => $attackedTerritories, 'territoryName' => $territoryName, 'territoryPosX' => $territoryPosX, 'territoryPosY' => $territoryPosY);

        /* brisanje tabel katerih se več ne potrebuje */
        unset($quizIDsArray);
        unset($quizDates);
        unset($solvedQuizes);
        unset($territoryName);
        unset($territoryPosX);
        unset($territoryPosY);

        /* vracanje view in posiljanje podatkov */
        return View::make('history', $data);
    }

}