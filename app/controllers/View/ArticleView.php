<?php

namespace View;

use Article\Article;
use Flight;

// use Articles\Article;

class ArticleView
{

    /**
     * [RenderArticleList description]
     * @param int    $offset  [description]
     * @param string $keyword [description]
     */
    public static function RenderArticleList(int $offset = 1,
        string $keyword = null)
    {
        $search_key = ($keyword) ?: '';
        $lists = Article::getList($offset, $search_key);

        Flight::render('article/list', ['lists' => $lists]);
    }

    public static function RenderArticleDetail(int $id)
    {
        $article = Article::read($id);

        Flight::render('article/read', ['article' => $article]);
    }

}
