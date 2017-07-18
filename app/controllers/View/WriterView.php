<?php

namespace View;

use Article\Article;
use Article\Statistic;
use Controller;
use Flight;

class WriterView extends Controller
{

    /**
     * Render Dashboard View for Writer
     */
    public static function RenderDashboard()
    {
        parent::userFilter(2);
        $statistic = new Statistic();
        $article = [
            'total_hit' => $statistic->getTotalOwnedHit()['hit'],
            'total_owned' => $statistic->getTotalOwnedArticle()['count'],
            'tops' => $statistic->getTopOwnedArticle(),
            'lasts' => $statistic->getLastOwnedArticle(),
        ];
        Flight::render('user/writer/dashboard', $article);
    }

    /**
     * Render Creator for Article
     */
    public static function RenderCreateArticle($status = null)
    {
        parent::userFilter(2);
        Flight::render('user/writer/creator', ['message' => $status]);
    }

    /**
     * Render Editor for Article
     */
    public static function RenderEditArticle(int $id, $status = null)
    {
        parent::userFilter(2);
        $article = Article::getDataForUpdate($id);
        Flight::render('user/writer/editor', [
            'data' => $article,
            'message' => $status
        ]);
    }

    /**
     * Render Owned Article List
     */
    public static function RenderArticleList(int $offset = null)
    {
        parent::userFilter(2);
        $articles = Article::getList($offset, true);

        Flight::render('user/writer/article_list', ['articles' => $articles]);
    }

}
