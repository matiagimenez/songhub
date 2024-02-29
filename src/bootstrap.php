<?php

require __DIR__ . "/../vendor/autoload.php";

use Monolog\Handler\StreamHandler;
use Monolog\Logger;


$logger = new Logger("songhub");
$logger->pushHandler(new StreamHandler(__DIR__ . "/../logs/app.log", Logger::DEBUG));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();