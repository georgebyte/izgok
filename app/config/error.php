<?php

/* lambda funkcija za vracanje funkcije za opis napake */
return array(

    'errorInfo' => function($errorText, $details = array()){
    	/* tukaj je mogoce dodati dodatne funkcionalnosti za napake kot je na primer logiranje */
    	$URI="";
    	$code="";
    	foreach($details as $key => $value){
    		if($key == "code"){
    			$code=$value;
    		}
    		elseif($key == "uri"){
    			$URI = $value ? $_SERVER['REQUEST_URI'] : " ";
    		}
    	}
    	$data = array("error" => "$errorText", "code" => $code, "uri" => $URI);
		return View::make('error', $data);
    }


);
