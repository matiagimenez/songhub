<?php

require __DIR__ . "/../vendor/autoload.php";

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Songhub\core\Router;

$logger = new Logger("songhub");
$logger->pushHandler(new StreamHandler(__DIR__ . "/../logs/app.log", Logger::DEBUG));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router();
$router->get('/', 'PageController@home');
$router->get('/login', 'PageController@login');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'PageController@register');
$router->get('/not_found', 'ErrorController@notFound');
$router->get('/internal_error', 'ErrorController@internalError');