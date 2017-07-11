<?php

use Article\Article;

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
Flight::route('GET /writer/article/creator', ['View\WriterView', 'RenderCreateArticle']);
Flight::route('GET /writer/article/editor/@id:[0-9]+', ['View\WriterView', 'RenderEditArticle']);
Flight::route('GET /writer/articles(/@offset:[0-9]+(/@keyword:[a-zA-Z]+))', ['View\WriterView', 'RenderArticleList']);

// Account
Flight::route('GET /user/account', ['View\UserView', 'RenderAccount']);

// Manager
Flight::route('GET /manager/dashboard', ['View\ManagerView', 'RenderDashboard']);
Flight::route('GET /manager/writers(/@offset:[0-9]+)', ['View\ManagerView', 'RenderWriterList']);
Flight::route('GET /manager/writer/creator', ['View\ManagerView', 'RenderCreateWriter']);


// Processes
// Flight::route('POST /prc/user/logout', [(new User\User), 'Logout']);
Flight::route('POST /prc/article/create', [(new Article()), 'createArticle']);
Flight::route('POST /prc/article/update', [(new Article()), 'updateArticle']);
Flight::route('POST /prc/article/delete', [(new Article()), 'deleteArticle']);
