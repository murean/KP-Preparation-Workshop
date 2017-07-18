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
    public static function RenderArticleList(int $offset = 1)
    {
        $lists = Article::getList($offset);

        Flight::render('article/list', ['lists' => $lists]);
    }

    public static function RenderArticleDetail(int $id)
    {
        $article = Article::read($id);

        if (!$article || empty($article)) {
            redirect('/error/404');
        }
        Flight::render('article/read', ['article' => $article]);
    }

}
