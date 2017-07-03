<?php

namespace View;
use Flight;

class LoginView
{
    public static function RenderLogin()
    {
        Flight::render('login');
    }

    public static function RenderLoginFailure()
    {
        Flight::render('login', []);
    }
}
