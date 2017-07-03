<?php
namespace View;
use Flight;
// use Articles\Article;

class ArticleView
{
    /**
     * [RenderArticleList description]
     * @param int    $offset  [description]
     * @param string $keyword [description]
     */
    public static function RenderArticleList(int $offset = null, string $keyword = null)
    {        
        Flight::render('article/list', []);
    }

    public static function RenderArticleDetail(int $id)
    {
        Flight::render('article/read', []);
    }
}
