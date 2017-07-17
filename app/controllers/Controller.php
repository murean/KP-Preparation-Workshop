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

    protected $session, $request, $db;

    public function __construct()
    {
        $this->session = Session::GetSessionData();
        $this->request = Flight::request();
    }

    /**
     * Prevent Unknown or Invalid User Type to enter.
     * @param int $user_type
     * @return void
     */
    protected static function userFilter(int $user_type)
    {
        // if session not exist or user type is not match, then redirect to logout process
        $session = Session::GetSessionData();

        if (!isset($session) || !isset($session['type']) || $session['type'] !== $user_type) {
            Flight::redirect('/prc/logout');
            exit();
        }
    }

}
