<?php

class AdminController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('admin');
    }

    public function Userform()
    {
        exit("TODO :: user control form view");
    }

    public function Territoryform()
    {
        exit("TODO :: territory control form view");
    }  

    public function getForm($form = null)
    {
        $data = array("error" => "Zahtevana funkcija ne obstaja.");

        if($form == null)
          return View::make('admin');  

        if($form == "user")
            AdminController::UserForm();
        elseif($form == "territory")
            AdminController::TerritoryForm();
        else
            return View::make('admin', $data);
    }  
}