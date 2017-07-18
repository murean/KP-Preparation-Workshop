<?php

// autoload
require_once 'autoloader.php';
spl_autoload_register('Autoloader::ControllerLoader');
spl_autoload_register('Autoloader::CoreLoader');

// routing
require VENDOR . '/flight/flight/Flight.php';
require CORE . '/routes.php';
require CORE . '/helper.php';
require CORE . '/view.php';

// turn on the routing system
Flight::start();
