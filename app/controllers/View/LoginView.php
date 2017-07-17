<?php

namespace View;

use Flight;
use Session;

class LoginView
{

    public static function RenderLogin()
    {
        (new self())->checkSessionExistence();
        Flight::render('login');
    }

    public static function RenderLoginFailure()
    {
        Flight::render('login', ['failure_warning' => 'Kombinasi Email dan Password Tidak Sesuai']);
    }

    private function checkSessionExistence()
    {
        $session_data = Session::GetSessionData();

        // redirect to right dashboard
        if ($session_data) {
            ($session_data['type'] === 1) ? Flight::redirect('/manager/dashboard')
                        : Flight::redirect('/writer/dashboard');
            exit();
        }
    }

}
