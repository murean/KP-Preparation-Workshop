<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Writer;

use User\User;

/**
 * Description of Writer
 *
 * @author rezy
 */
class Writer extends User
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        parent::create();
    }

    public function update()
    {
        parent::update();
    }

    public function delete()
    {
        parent::delete();
    }

    public function getList();

    public function detail();
}
