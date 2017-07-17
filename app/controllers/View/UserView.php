<?php

namespace View;

use Flight;
use User\User;

class UserView
{

    public static function RenderAccount()
    {
        $data = (new User())->getData();
        Flight::render('user/account', ['data' => $data]);
    }

}
