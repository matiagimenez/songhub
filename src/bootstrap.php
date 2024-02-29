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
$router->loadRoutes('/', 'PageController@home');
$router->loadRoutes('/login', 'PageController@login');
$router->loadRoutes('/register', 'PageController@register');
$router->loadRoutes('/not_found', 'ErrorController@notFound');
$router->loadRoutes('/internal_error', 'ErrorController@internalError');