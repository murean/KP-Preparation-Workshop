<?php

namespace Article;

use Controller;
use Database;

class Article extends Controller
{

    /**
     * Writer Create Article
     * @return void
     */
    public function create()
    {
        $query = 'INSERT INTO article (`title`, `content`, `creator`,
            `created_at`) VALUES (:title, :content, :creator, NOW())';

        $parameters = [
            'title' => $this->request->title,
            'content' => $this->request->content,
            'creator' => $this->session->id,
        ];

        $result = Database::TransactionQuery($query, $parameters);

        // return to view
    }

    /**
     * Update An Article
     * @return [type] [description]
     */
    public function update()
    {
        $query = 'UPDATE article SET title = :title,
            content = :content, updated_at = NOW()
            WHERE id = :id AND creator = :creator';

        $parameters = [
            'title' => $this->request->title,
            'content' => $this->request->content,
            'id' => $this->request->id,
            'creator' => $this->session->id
        ];

        $result = Database::TransactionQuery($query, $parameters);

        // reutrn to view
    }

    /**
     * Writer Delete An Article
     * @return void
     */
    public function delete()
    {
        $query = 'UPDATE `article` SET deleted_at = NOW()
            WHERE id = :id';

        $parameters = [
            'id' => $this->request->id
        ];

        $result = Database::TransactionQuery($query, $parameters);
    }

    /**
     * Get Article data limited to id, title, and summary
     * @param int $offset
     * @param string $keyword
     * @return mixed
     */
    public static function getList(int $offset, string $keyword)
    {
        $parameters = [];

        $query = 'SELECT a.id, a.title, a.summary '
            . ' FROM article AS a';

        if ($keyword) {
            $query .= ' WHERE MATCH(`a`.`title`) AGAINST (:keyword) AND a.deleted_at IS NULL';
            $parameters['keyword'] = $keyword;
        } else {
            $query .= ' WHERE a.deleted_at IS NULL';
        }

        $query .= SQLOffset($offset);

        return Database::SelectQuery($query, $parameters);
    }

    /**
     * Read an Article
     * @param int $id
     * @return type
     */
    public static function read(int $id)
    {
        // Update Hit
        $query_update_hit = 'UPDATE article SET hit = hit + 1 WHERE id = :id';
        $parameter_update_hit = ['id' => $id];

        $result = Database::TransactionQuery($query_update_hit, $parameter_update_hit);

        if ($result) {
            $query = 'SELECT a.id, a.title, a.content, a.creator, a.created_at, '
                . ' a.updated_at, '
                . ' u.name'
                . ' FROM article AS a'
                . ' LEFT JOIN user AS u ON u.id = a . creator'
                . ' WHERE a.id = :id';

            return Database::SelectQuery($query, ['id' => $id], false);
        }
        return false;
    }

}
