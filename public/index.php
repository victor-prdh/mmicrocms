<?php

use App\Router\Router;

define('ROOT', dirname(__DIR__));
require_once ROOT."/vendor/autoload.php";

$routes = [
    ['/article/:slug', 'article'],
    ['/', 'index'],
    ['/account', 'compte'],
    
];

$router = new Router($routes);


var_dump($router->match());

echo '<hr>';

