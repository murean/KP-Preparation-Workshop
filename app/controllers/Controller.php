<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author rezy
 */
class Controller
{

    protected $session, $request;

    public function __construct()
    {
        $this->session = Session::GetSessionData();
        $this->request = Flight::request();
    }

}
