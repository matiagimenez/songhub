<?php

require __DIR__ . "/../vendor/autoload.php";

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Songhub\core\Config;
use Songhub\core\Router;

$config = new Config();

$logger = new Logger("songhub");
$logHandler = new StreamHandler($config->get("LOG_PATH"));
$logHandler->setLevel($config->get("LOG_LEVEL"));
$logger->pushHandler($logHandler);

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