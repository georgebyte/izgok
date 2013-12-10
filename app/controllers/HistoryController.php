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
    	$data = array(); 


    	/* branje kvizov v katerih je uporabnik sodeloval kot napadalec ali branitelj - sortirano po casu padajoce */
    	/* array s podatki id kviza*/
    	$quizHistory = Quiz::where('id_attacker', '=', $myID) -> orWhere('id_defender', '=', $myID) -> orderBy('created_at','desc') ->get(array('id', 'created_at')); 

    	foreach($quizHistory as $value){
    		array_push($quizIDsArray, $value['id']);
    		array_push($quizDates, $value['created_at']);
    	}



    	/* sestavljanje tabele $data ki bo poslana v view */
    	$data=array("quizIDs" => $quizIDsArray, "quizDates" => $quizDates);

    	/* brisanje tabel katerih se več ne potrebuje */
    	unset($quizIDsArray);
    	unset($quizDates);

    	/* vracanje view in posiljanje podatkov */
    	return View::make('history', $data);
    }
}

?>