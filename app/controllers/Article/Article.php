<?php

namespace Article;

use Flight;
use Session;
use Database;

class Article
{

    private $db, $request, $session;

    public function __construct()
    {
        $this->db = new Database();
        $this->request = Flight::request();
        $this->session = Session::GetSessionData();
    }

    /**
     * Writer Create Article
     * @return void
     */
    public function createArticle()
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
    public function updateArticle()
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
    public function deleteArticle()
    {
        $query = 'UPDATE `article` SET deleted_at = NOW()
            WHERE id = :id';

        $parameters = [
            'id' => $this->request->id
        ];

        $result = Database::TransactionQuery($query, $parameters);
    }

    /**
     *
     * @param int $offset
     * @param string $keyword
     * @return mixed
     */
    public function getArticles(int $offset = 1, string $keyword = null)
    {
        $parameters = [];

        $query = 'SELECT a.id, a.title, a.content, a.creator, a.created_at, '
            . ' a.updated_at,'
            . ' w.name'
            . ' FROM article AS a'
            . ' LEFT JOIN writer AS w ON w.id = a.creator';

        if ($keyword) {
            $query .= ' WHERE MATCH(`a`.`title`) AGAINST (:keyword)';
            $parameters['keyword'] = $keyword;
        }

        $query .= ' LIMIT 15 OFFSET ' . (($offset - 1) * 15);

        return Database::SelectQuery($query, $parameters);
    }

    public function readArticle(int $id)
    {
        // Update Hit
        $query_update_hit = 'UPDATE article SET hit = hit + 1 WHERE id = :id';
        $parameter_update_hit = ['id' => $id];

        $result = Database::TransactionQuery($query_update_hit, $parameter_update_hit);

        $query = 'SELECT a.id, a.title, a.content, a.creator, a.created_at, '
            . ' a.updated_at,'
            . ' w.name'
            . ' FROM article AS a'
            . ' LEFT JOIN writer AS w ON w.id = a.creator';

        return Database::SelectQuery($query, []);
    }

}
