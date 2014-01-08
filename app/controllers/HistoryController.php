<?php

class HistoryController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function getAll($limit = 0)
    {

        $max = ($limit+1)*5;
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
        $insideTimeLimit = array();
        $territoryIDs = array();

        /* branje kvizov v katerih je uporabnik sodeloval kot napadalec ali branitelj - sortirano po casu padajoce */
        /* array s podatki id kviza*/

        $quizHistory = Quiz::where('id_attacker', '=', $myID) -> orWhere('id_defender', '=', $myID) -> orderBy('created_at','desc') -> get(array('id', 'created_at','id_attacked_territory','attacked_territory_pos_x','attacked_territory_pos_y')) -> take($max);
        $all = Quiz::where('id_attacker', '=', $myID) -> orWhere('id_defender', '=', $myID) -> orderBy('created_at','desc') -> count();
        
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
            $attackedTerritoryData = Territory::where('id','=', $value['id_attacked_territory']) -> get(array('id', 'name','pos_x','pos_y')); 

            /* napad na nenaseljeno ozemlje */
            if(count($attackedTerritoryData) == 0)
            {
                $attackedTerritoryData[0] = array('id' => 0, 'name' => 'Nenasljeno ozemlje', 'pos_x' => $value['attacked_territory_pos_x'], 'pos_y' => $value['attacked_territory_pos_y']);
            }

            $timeLimitOK = false;
            if(($isAttacker && $value['quiz_opened_attacker'] > time()) || ($isDefender && $value['quiz_opened_defender'] > time())){
                    $timeLimitOK = true;
            }
            /* polnenje tabel s podatki */
            array_push($quizIDsArray, $value['id']);
            array_push($quizDates, $value['created_at']);
            array_push($solvedQuizes, $solved);
            array_push($insideTimeLimit, $timeLimitOK);
            array_push($attackedTerritories, $attackedTerritoryData[0]);
        }

        /* podatki o teritorijih */
        //dd($attackedTerritoryData[0]);
        foreach($attackedTerritories as $value)
            {
                array_push($territoryIDs, $value['id']); 
                array_push($territoryName, $value['name']); 
                array_push($territoryPosX, $value['pos_x']);
                array_push($territoryPosY, $value['pos_y']);
            }
        /* sestavljanje tabele $data ki bo poslana v view */
        $i = $limit + 1;
        $url="/history/all/".$i;
        $data=array("territoryIDs" => $territoryIDs, "quizIDs" => $quizIDsArray, "quizDates" => $quizDates, "solvedQuizes" => $solvedQuizes, 'attackedTerritoryData' => $attackedTerritories, 'territoryName' => $territoryName, 'territoryPosX' => $territoryPosX, 'territoryPosY' => $territoryPosY, "insideTimeLimit" => $insideTimeLimit,  "all" => $all, "url" => $url, "url" => $url);

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

    public function getUnsolved($limit = 0)
    {

        $max = ($limit+1)*5;
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
        $insideTimeLimit = array();
        $territoryIDs = array();

        /* branje kvizov katerih uporabnik se ni resil - sortirano po casu padajoce */
        /* array s podatki id kviza*/
        $quizHistory = Quiz::where('id_attacker', '=', $myID) -> orWhere('id_defender', '=', $myID) -> orderBy('created_at','desc') -> get(array('id', 'created_at','id_attacked_territory','attacked_territory_pos_x','attacked_territory_pos_y')) -> take($max);
        $all = checkUnsolved();
        
        foreach($quizHistory as $value){
            /* branje podatkov */
            $quiz = Quiz::find($value['id']);
            $isAttacker = ($quiz -> id_attacker == Auth::user() -> id) ? true : false;
            $isDefender = ($quiz -> id_defender == Auth::user() -> id) ? true : false;

            if(($isAttacker && $quiz -> submit_time_attacker == null) || ($isDefender && $quiz -> submit_time_defender == null)){
                $solved = false;

            $timeLimitOK = false;
            if(($isAttacker && $value['quiz_opened_attacker'] > time()) || ($isDefender && $value['quiz_opened_defender'] > time()) || ($isDefender && $value['quiz_opened_defender'] != NULL)){
                $timeLimitOK = true;
            }
            /* pridobivanje podatkov naselja */
            /* TODO :: fix empty attackedterritorydata*/
            $attackedTerritoryData = Territory::where('id','=', $value['id_attacked_territory']) -> get(array('id', 'name','pos_x','pos_y')); 
            
            /* napad na nenaseljeno ozemlje */
            if(count($attackedTerritoryData) == 0)
            {
                $attackedTerritoryData[0] = array('id' => 0, 'name' => 'Nenasljeno ozemlje', 'pos_x' => $value['attacked_territory_pos_x'], 'pos_y' => $value['attacked_territory_pos_y']);
            }

            /* polnenje tabel s podatki */
            array_push($quizIDsArray, $value['id']);
            array_push($quizDates, $value['created_at']);
            array_push($solvedQuizes, $solved);
            array_push($insideTimeLimit, $timeLimitOK);
            array_push($attackedTerritories, $attackedTerritoryData[0]);
            }
        }

        /* podatki o teritorijih */
        foreach($attackedTerritories as $value)
            {
                array_push($territoryIDs, $value['id']); 
                array_push($territoryName, $value['name']); 
                array_push($territoryPosX, $value['pos_x']);
                array_push($territoryPosY, $value['pos_y']); 
            }
        /* sestavljanje tabele $data ki bo poslana v view */
        $i = $limit + 1;
        $url="/history/unsolved/".$i;
        $data=array("territoryIDs" => $territoryIDs, "quizIDs" => $quizIDsArray, "quizDates" => $quizDates, "solvedQuizes" => $solvedQuizes, 'attackedTerritoryData' => $attackedTerritories, 'territoryName' => $territoryName, 'territoryPosX' => $territoryPosX, 'territoryPosY' => $territoryPosY, "insideTimeLimit" => $insideTimeLimit, "all" => $all, "url" => $url);

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

    public function getDefense($limit = 0)
    {

        $max = ($limit+1)*5;
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
        $territoryIDs = array();

        /* branje kvizov v katerih je uporabnik sodeloval kot branitelec - sortirano po casu padajoce */
        /* array s podatki id kviza*/
        $quizHistory = Quiz::Where('id_defender', '=', $myID) -> orderBy('created_at','desc') -> get(array('id', 'created_at','id_attacked_territory','attacked_territory_pos_x','attacked_territory_pos_y')) -> take($max);
        $all = Quiz::Where('id_defender', '=', $myID) -> orderBy('created_at','desc') -> count();
        
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
            $attackedTerritoryData = Territory::where('id','=', $value['id_attacked_territory']) -> get(array('id', 'name','pos_x','pos_y')); 

            /* napad na nenaseljeno ozemlje */
            if(count($attackedTerritoryData) == 0)
            {
                $attackedTerritoryData[0] = array('id' => 0, 'name' => 'Nenasljeno ozemlje', 'pos_x' => $value['attacked_territory_pos_x'], 'pos_y' => $value['attacked_territory_pos_y']);
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
                array_push($territoryIDs, $value['id']);                 
                array_push($territoryName, $value['name']); 
                array_push($territoryPosX, $value['pos_x']);
                array_push($territoryPosY, $value['pos_y']); 
            }
        /* sestavljanje tabele $data ki bo poslana v view */
        $i = $limit + 1;
        $url="/history/defense/".$i;
        $data=array("territoryIDs" => $territoryIDs, "quizIDs" => $quizIDsArray, "quizDates" => $quizDates, "solvedQuizes" => $solvedQuizes, 'attackedTerritoryData' => $attackedTerritories, 'territoryName' => $territoryName, 'territoryPosX' => $territoryPosX, 'territoryPosY' => $territoryPosY, "all" => $all, "url" => $url);

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
    
    public function getOffense($limit = 0)
    {

        $max = ($limit+1)*5;
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
        $territoryIDs = array();

        /* branje kvizov v katerih je uporabnik sodeloval kot napadalec - sortirano po casu padajoce */
        /* array s podatki id kviza*/
        $quizHistory = Quiz::where('id_attacker', '=', $myID) -> orderBy('created_at','desc') ->get(array('id', 'created_at','id_attacked_territory','attacked_territory_pos_x','attacked_territory_pos_y')) -> take($max);
        $all = Quiz::where('id_attacker', '=', $myID) -> orderBy('created_at','desc') -> count();

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
            $attackedTerritoryData = Territory::where('id','=', $value['id_attacked_territory']) -> get(array('id', 'name','pos_x','pos_y')); 

            /* napad na nenaseljeno ozemlje */
            if(count($attackedTerritoryData) == 0)
            {
                $attackedTerritoryData[0] = array('id' => 0, 'name' => 'Nenasljeno ozemlje', 'pos_x' => $value['attacked_territory_pos_x'], 'pos_y' => $value['attacked_territory_pos_y']);
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
                array_push($territoryIDs, $value['id']);                 
                array_push($territoryName, $value['name']); 
                array_push($territoryPosX, $value['pos_x']);
                array_push($territoryPosY, $value['pos_y']); 
            }
        /* sestavljanje tabele $data ki bo poslana v view */
        $i = $limit + 1;
        $url="/history/offense/".$i;
        $data=array("territoryIDs" => $territoryIDs, "quizIDs" => $quizIDsArray, "quizDates" => $quizDates, "solvedQuizes" => $solvedQuizes, 'attackedTerritoryData' => $attackedTerritories, 'territoryName' => $territoryName, 'territoryPosX' => $territoryPosX, 'territoryPosY' => $territoryPosY, "all" => $all, "url" => $url);

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