<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

// constant for different component directory
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('CORE', $_SERVER['DOCUMENT_ROOT'] . '/../app/core');
define('CONTROLLER', $_SERVER['DOCUMENT_ROOT'] . '/../app/controller');
define('VIEW', $_SERVER['DOCUMENT_ROOT'] . '/views');

// start session
session_start();
require CORE . '/session.php';
Session::ValidateUser();

// auto include view
require CORE . '/view.php';
View::CreateView();
