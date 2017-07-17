<?php

namespace View;

use Flight;

class ManagerView
{

    public static function RenderDashboard()
    {
        Flight::render('user/manager/dashboard');
    }

    public static function RenderCreateWriter()
    {
        Flight::render('user/manager/write_creator');
    }

    public static function RenderWriterList()
    {
        Flight::render('user/manager/writer_list');
    }

}
