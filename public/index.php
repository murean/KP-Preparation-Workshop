<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// constant for different component directory
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('CORE', $_SERVER['DOCUMENT_ROOT'] . '/../app/core');
define('CONTROLLER', $_SERVER['DOCUMENT_ROOT'] . '/../app/controllers');
define('VIEW', $_SERVER['DOCUMENT_ROOT'] . '/views');
define('VENDOR', $_SERVER['DOCUMENT_ROOT'] . '/../vendor');

// autoload
include CORE . '/bootstrap.php';

// require CORE . '/session.php';
// Session::ValidateUser();
