<?php

use Article\Article;
use User\User;

///////////
// Views //
///////////
// Login
Flight::route('GET /login', ['View\LoginView', 'RenderLogin']);
Flight::route('GET /login/retry', ['View\LoginView', 'RenderLoginFailure']);

// Articles List
Flight::route('GET /', function() {
    Flight::redirect('/1/');
});
Flight::route('GET (/@offset:[0-9]+(/@keyword:[a-zA-Z]+))', ['View\ArticleView', 'RenderArticleList']);

// Article Detail / Read
Flight::route('GET /article/@id', ['View\ArticleView', 'RenderArticleDetail']);

// Writer
Flight::route('GET /writer/dashboard', ['View\WriterView', 'RenderDashboard']);
// article creation
Flight::route('GET /writer/article/creator(/@status)', ['View\WriterView', 'RenderCreateArticle']);
// article edit
Flight::route('GET /writer/article/editor/@id:[0-9]+(/@status)', ['View\WriterView', 'RenderEditArticle']);

Flight::route('GET /writer/articles(/@offset:[0-9]+(/@keyword:[a-zA-Z]+))', ['View\WriterView', 'RenderArticleList']);

// Account
Flight::route('GET /user/account', ['View\UserView', 'RenderAccount']);

// Manager
Flight::route('GET /manager/dashboard', ['View\ManagerView', 'RenderDashboard']);
Flight::route('GET /manager/writers(/@offset:[0-9]+)', ['View\ManagerView', 'RenderWriterList']);
Flight::route('GET /manager/writer/creator', ['View\ManagerView', 'RenderCreateWriter']);

Flight::route('GET /error', function() {
    Flight::render('error');
});

// Processes
//ARTICLES
Flight::route('POST /prc/article/create', [(new Article()), 'create']);
Flight::route('POST /prc/article/update', [(new Article()), 'update']);
Flight::route('GET /prc/article/delete/@id:[0-9]+', [(new Article()), 'delete']);
//USERS
Flight::route('POST /prc/login', [(new User()), 'login']);
Flight::route('GET /prc/logout', [(new User()), 'logout']);
Flight::route('POST /prc/account/update', [(new User()), 'update']);

Flight::route('/test(/@say:pew|wow)(/@talk)', function($say, $talk) {
    echo ($say === 'pew') ? 'pew' : 'wow';
    echo $talk;
});
