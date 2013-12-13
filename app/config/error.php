<?php

/* lambda funkcija za vracanje funkcije za opis napake */
return array(

    'errorInfo' => function($errorText){
    	/* tukaj je mogoce dodati dodatne funkcionalnosti za napake kot je na primer logiranje */
    	$data = array("error" => "$errorText");
		return View::make('error', $data);
    }


);
