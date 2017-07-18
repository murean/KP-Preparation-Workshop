<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Writer;

use Database;

/**
 * Description of Statistic
 *
 * @author rezy
 */
class Statistic
{

    public static function getTopWriters(): array
    {
        $query = 'SELECT a.creator, SUM(a.hit) AS poin, u.name, u.created_at'
            . ' FROM article AS a'
            . ' LEFT JOIN user AS u ON u.id = a.creator '
            . ' GROUP BY a.creator ORDER BY poin DESC LIMIT 5';
        return $top_writer = Database::SelectQuery($query);

//        $query = 'SELECT name, email FROM user WHERE id IN (:top_writer)';
//        $parameters = [
//            'top_writer' => implode(',', $top_writer)
//        ];
//        return Database::SelectQuery($query, $parameters);
    }

    public static function getTotalWriter()
    {
        $query = 'SELECT COUNT(id) AS total FROM user WHERE type = 2';
        return Database::SelectQuery($query, [], false);
    }

}
