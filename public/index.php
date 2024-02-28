<?php

require __DIR__ . "/../vendor/autoload.php";

use Songhub\app\controllers\ErrorController;
use Songhub\app\controllers\PageController;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$controller = new PageController();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path == "/") {
    $controller->home();
} else if ($path == "/login") {
    $controller->login();
} else if ($path == "/register") {
    $controller->register();
} else {
    $controller = new ErrorController();
    $controller->not_found();
}