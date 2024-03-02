<?php
namespace Songhub\core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Songhub\core\Config;

class LoggerBuilder
{
    private static $instance;
    private Logger $logger;

    private function __construct()
    {
        $config = Config::getInstance();
        $this->logger = new Logger("app-logger");
        $logHandler = new StreamHandler($config->get("LOG_PATH"));
        $logHandler->setLevel($config->get("LOG_LEVEL"));
        $this->logger->pushHandler($logHandler);
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getLogger(): Logger
    {
        return $this->logger;
    }
}