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
    public function create(int $type = null)
    {
        parent::create($this->user_type);
    }

    /**
     *
     * @param int $offset
     * @return type
     */
    public static function getList(int $offset)
    {
        $query = 'SELECT id, name, email, created_at FROM user WHERE type = :type '
            . ' AND deleted_at IS NULL' . SQLOffset($offset);
        $parameters = [
            'type' => 2
        ];

        $query_counter = 'SELECT count(id) AS total FROM user WHERE type = :type';

        $result['dataset'] = Database::SelectQuery($query, $parameters);
        $result['offsets'] = paginationCounter(Database::SelectQuery($query_counter, $parameters, false)['total']);

        return $result;
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
