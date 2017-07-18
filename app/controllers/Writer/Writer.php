<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Writer;

use Database;
use Flight;
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
        $keyword = Flight::request()->query->name;
        // list query
        $query = 'SELECT id, name, email, created_at FROM user WHERE type = 2 ';
        // counter query
        $query_counter = 'SELECT count(id) AS total FROM user WHERE type = 2';
        $parameters = [];

        // search by name too
        if ($keyword) {
            $filter = ' AND MATCH(name) AGAINST (:name IN BOOLEAN MODE)';
            $query .= $filter;
            $query_counter .= $filter;
            $parameters['name'] = preg_replace('/(\w+)/', '$1*', $keyword); // add * after each words
        }

        // add offset and limit
        $query .= ' AND deleted_at IS NULL' . snippetOffsetSQL($offset);
        // neither limit nor offset
        $query_counter .= ' AND deleted_at IS NULL';

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
