<?php

namespace View;

use Flight;
use User\User;

class UserView
{

    public static function RenderAccount(string $type)
    {
        $data = (new User())->getData();
        Flight::render('user/account', ['data' => $data, 'banner' => 'banner_' . $type]);
    }

}
