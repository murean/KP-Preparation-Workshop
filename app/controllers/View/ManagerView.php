<?php

namespace View;

use Controller;
use Flight;
use Writer\Writer;

class ManagerView extends Controller
{

    public static function RenderDashboard()
    {
        parent::userFilter(1);
        $statistic = new \Article\Statistic();
        $article = [
            'total_hit' => $statistic->getTotalHit()['hit'],
            'total_article' => $statistic->getTotalArticle()['count'],
            'total_writer' => \Writer\Statistic::getTotalWriter()['total'],
            'top_writers' => \Writer\Statistic::getTopWriters(),
            'tops' => $statistic->getTopArticle(),
            'lasts' => $statistic->getLastArticle(),
        ];
        Flight::render('user/manager/dashboard', $article);
    }

    public static function RenderCreateWriter()
    {
        parent::userFilter(1);
        Flight::render('user/manager/writer_creator');
    }

    public static function RenderWriterList(int $offset)
    {
        parent::userFilter(1);
        $writers = Writer::getList($offset);
        Flight::render('user/manager/writer_list', ['writers' => $writers]);
    }

}
