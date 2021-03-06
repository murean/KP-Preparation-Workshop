<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Article;

use Controller;
use Database;

class Statistic extends Controller
{

    /**
     * Count Total Hit Regardless Article
     * @return type
     */
    public function getTotalHit()
    {
        $query = 'SELECT COALESCE(SUM(hit), 0) AS hit FROM article';
        return Database::SelectQuery($query, [], false);
    }

    /**
     * Count Total of Owned Articles Hit
     * @param int $user_id
     * @return type
     */
    public function getTotalOwnedHit(int $user_id = null)
    {
        /*
         * 1. get user id
         * 2. sum all hit from article that owned
         */
        $user = ($user_id !== null) ? $user_id : $this->session['id'];
        $query = 'SELECT COALESCE(SUM(hit), 0) AS hit FROM article WHERE creator = :creator';
        $parameters = ['creator' => $user];
        return Database::SelectQuery($query, $parameters, false);
    }

    /**
     * Get Total Article Regardless Writer
     * @return mixed array|object
     */
    public function getTotalArticle()
    {
        $query = 'SELECT COUNT(id) AS count FROM article';
        return Database::SelectQuery($query, [], false);
    }

    /**
     * Count Total of Owned Articles
     * @param int $user_id
     * @return type
     */
    public function getTotalOwnedArticle(int $user_id = null)
    {
        /*
         * 1. get user id
         * 2. count all article where creator matches the user_id
         */
        $user = ($user_id !== null) ? $user_id : $this->session['id'];
        $query = 'SELECT COUNT(id) AS count FROM article WHERE creator = :creator';
        $parameters = ['creator' => $user];
        return Database::SelectQuery($query, $parameters, false);
    }

    /**
     * Get Top 5 Articles
     * @return type
     */
    public function getTopArticle()
    {
        $query = 'SELECT a.id, a.title, u.name, a.created_at, a.updated_at, a.hit'
            . ' FROM article AS a'
            . ' LEFT JOIN user AS u ON u.id = a.creator'
            . ' ORDER BY hit DESC'
            . ' LIMIT 5';

        return Database::SelectQuery($query);
    }

    /**
     * Get 5 Top Hit Owned Articles
     * @param int $user_id
     * @return type
     */
    public function getTopOwnedArticle(int $user_id = null)
    {
        $user = ($user_id !== null) ? $user_id : $this->session['id'];

        $query = 'SELECT a.id, a.title, a.created_at, a.updated_at, a.hit'
            . ' FROM article AS a'
            . ' LEFT JOIN user AS u ON u.id = a.creator'
            . ' WHERE a.creator = :creator'
            . ' ORDER BY hit DESC'
            . ' LIMIT 5';

        $parameters = ['creator' => $user];

        return Database::SelectQuery($query, $parameters);
    }

    /**
     *
     * @return type
     */
    public function getLastArticle()
    {
        $query = 'SELECT a.id, a.title, u.name, a.created_at, a.updated_at, a.hit'
            . ' FROM article AS a'
            . ' LEFT JOIN user AS u ON u.id = a.creator'
            . ' ORDER BY a.created_at DESC, a.updated_at DESC'
            . ' LIMIT 5';

        return Database::SelectQuery($query, []);
    }

    /**
     * Get Last 5 Article
     * @param int $user_id
     * @return type
     */
    public function getLastOwnedArticle(int $user_id = null)
    {
        $user = ($user_id !== null) ? $user_id : $this->session['id'];

        $query = 'SELECT a.id, a.title, a.created_at, a.updated_at, a.hit'
            . ' FROM article AS a'
            . ' LEFT JOIN user AS u ON u.id = a.creator'
            . ' WHERE a.creator = :creator'
            . ' ORDER BY a.created_at DESC, a.updated_at DESC'
            . ' LIMIT 5';

        $parameters = ['creator' => $user];

        return Database::SelectQuery($query, $parameters);
    }

}
