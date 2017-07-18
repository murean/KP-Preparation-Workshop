<?php

use Article\Article;
use User\User;
use Writer\Writer;

/* ---------------------VIEWS------------------------- */
// Login
Flight::route('GET /login', ['View\LoginView', 'RenderLogin']);
Flight::route('GET /login/retry', ['View\LoginView', 'RenderLoginFailure']);

// Home page
Flight::route('GET /', function() {
    Flight::redirect('/1/');
});
// article list
Flight::route('GET /@offset:[0-9]+', ['View\ArticleView', 'RenderArticleList']);

// read article
Flight::route('GET /article/@id', ['View\ArticleView', 'RenderArticleDetail']);

// Writer dashboard
Flight::route('GET /writer/dashboard', ['View\WriterView', 'RenderDashboard']);
// article creation
Flight::route('GET /writer/article/creator', ['View\WriterView', 'RenderCreateArticle']);
// article editor
Flight::route('GET /writer/article/editor/@id:[0-9]+', ['View\WriterView', 'RenderEditArticle']);
// owned article list
Flight::route('GET /writer/articles/@offset:[0-9]+', ['View\WriterView', 'RenderArticleList']);

// Account
Flight::route('GET /@type:manager|writer/account', ['View\UserView', 'RenderAccount']);

// Manager dashboard
Flight::route('GET /manager/dashboard', ['View\ManagerView', 'RenderDashboard']);
// writer list
Flight::route('GET /manager/writers/@offset:[0-9]+', ['View\ManagerView', 'RenderWriterList']);
// register a writer
Flight::route('GET /manager/writer/creator', ['View\ManagerView', 'RenderCreateWriter']);

// error view
Flight::route('GET /error', function() {
    Flight::render('error');
});

Flight::map('notFound', function() {
    Flight::render('404');
});

Flight::route('GET /error/404', function() {
    Flight::render('404');
});

/* --------------------Processes---------------------- */
// create article
Flight::route('POST /prc/article/create', [(new Article()), 'create']);

// update article
Flight::route('POST /prc/article/update', [(new Article()), 'update']);

//delete article
Flight::route('GET /prc/article/delete/@id:[0-9]+', [(new Article()), 'delete']);

// create writer
Flight::route('POST /prc/writer/create', [(new Writer()), 'create']);

// delete writer
Flight::route('GET /prc/writer/delete/@id:[0-9]+', [(new Writer()), 'delete']);

// login
Flight::route('POST /prc/login', [(new User()), 'login']);

// logout
Flight::route('GET /prc/logout', [(new User()), 'logout']);

// update account
Flight::route('POST /prc/account/update', [(new User()), 'update']);

Flight::route('GET /test', function() {

    var_dump((new DateTime(null)));
});
