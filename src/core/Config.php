<?php

namespace Songhub\core;

use Dotenv\Dotenv;

class Config
{
    private array $configs;
    private static Config $instance;

    private function __construct()
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__ . "/../../");
        $dotenv->load();
        $this->configs["LOG_LEVEL"] = getenv("LOG_LEVEL") ?? "INFO";
        $path = getenv("LOG_PATH") ?? "/logs/app.log";
        $this->configs["LOG_PATH"] = $this->joinPaths(__DIR__, "../..", $path);
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($name)
    {
        return $this->configs[$name] ?? null;
    }

    public function joinPaths()
    {
        $paths = [];
        foreach (func_get_args() as $arg) {
            if ($arg !== '') {
                $paths[] = $arg;
            }
        }

        return preg_replace('#/+#', '/', join('/', $paths));
    }
}