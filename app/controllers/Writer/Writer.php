<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Writer;

use Database;
use User\User;

/**
 * Description of Writer
 *
 * @author rezy
 */
class Writer extends User
{

    private $user_type = 2;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create Writer
     */
    public function create()
    {
        parent::create($this->user_type);
    }

    /**
     *
     */
    public function update()
    {
        parent::update();
    }

    public function delete()
    {
        parent::delete();
    }

    /**
     *
     * @param int $offset
     * @return type
     */
    public function getList(int $offset)
    {
        $query = 'SELECT id, name, email FROM user WHERE type = :type' . SQLOffset($offset);
        $parameters = [
            'type' => 2
        ];

        return Database::SelectQuery($query, $parameters);
    }

    /**
     * 
     * @param int $id
     * @return type
     */
    public function getDetail(int $id)
    {
        $query = 'SELECT id, name, email FROM user WHERE id = :id AND type = :type';
        $parameters = [
            'id' => $id,
            'type' => 2
        ];

        return Database::SelectQuery($query, $parameters);
    }

}
