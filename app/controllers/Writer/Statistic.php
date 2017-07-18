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

    /**
     * Get Top 5 Writer
     * @return array
     */
    public static function getTopWriters(): array
    {
        $query = 'SELECT a.creator, SUM(a.hit) AS poin, u.name, u.created_at'
            . ' FROM article AS a'
            . ' LEFT JOIN user AS u ON u.id = a.creator '
            . ' GROUP BY a.creator ORDER BY poin DESC LIMIT 5';
        return $top_writer = Database::SelectQuery($query);
    }

    /**
     * Count Total Writers
     * @return type
     */
    public static function getTotalWriter()
    {
        $query = 'SELECT COUNT(id) AS total FROM user WHERE type = 2';
        return Database::SelectQuery($query, [], false);
    }

}
