<?php
require __DIR__ . '/../vendor/autoload.php';

use Framework\Router;
use Framework\Session;

Session::start();

require '../helpers.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router();
$routes = require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route($uri);