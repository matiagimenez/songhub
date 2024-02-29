<?php

require __DIR__ . "/../vendor/autoload.php";

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Songhub\app\controllers\ErrorController;
use Songhub\app\controllers\PageController;

$logger = new Logger("songhub");
$logger->pushHandler(new StreamHandler(__DIR__ . "/../logs/app.log", Logger::DEBUG));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$controller = new PageController();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$logger->info("Path: " . $path);

if ($path == "/") {
    $controller->home();
    $logger->info("Respuesta exitosa: 200");

} else if ($path == "/login") {
    $controller->login();
    $logger->info("Respuesta exitosa: 200");

} else if ($path == "/register") {
    $controller->register();
    $logger->info("Respuesta exitosa: 200");

} else {
    $controller = new ErrorController();
    $controller->not_found();
    $logger->info("Path no encontrado: 404");

}