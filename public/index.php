<?php

require __DIR__ . "/../vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$menu = [
    ["href" => "/", "text" => "Home"],
    ["href" => "/about", "text" => "Sobre nosotros"],
    ["href" => "/services", "text" => "Servicios"],
    ["href" => "/contact", "text" => "Contacto"],
];

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path == "/") {
    $title = htmlspecialchars($_GET["name"] ?? "Nombre");
    require __DIR__ . '/../src/index.view.php';
} else if ($path == "/services") {
    $title = "Servicios";
    require __DIR__ . '/../src/services.view.php';
} else {
    echo "404: Page Not Found";
}