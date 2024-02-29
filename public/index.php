<?php

require __DIR__ . '/../src/bootstrap.php';

use Songhub\app\controllers\ErrorController;
use Songhub\app\controllers\PageController;
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