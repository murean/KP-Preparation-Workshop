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

    public function getTopWriters(): array
    {
        $query = 'SELECT SUM(hit) AS poin FROM article GROUP BY creator ORDER BY poin DESC' . SQLOffset(0);
        $top_writer = Database::SelectQuery($query);

        $query = 'SELECT name, email FROM user WHERE id IN (:top_writer)';
        $parameters = [
            'top_writer' => implode(',', $top_writer)
        ];

        return Database::SelectQuery($query, $parameters);
    }

}
