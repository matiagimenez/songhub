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

        $this->configs['HOST'] = getenv('HOST') ?? 'localhost';
<<<<<<< HEAD
        // $this->configs['PORT'] = getenv('PORT') ?? '8888';
        $this->configs['PORT'] = '8888';
=======
        $this->configs['PORT'] = getenv('PORT') ?? '8888';
>>>>>>> 77677394b19aa7d9ba870e21d478c9a14b799c3f

        $this->configs['DB_ADAPTER'] = getenv('DB_ADAPTER') ?? 'mysql';
        $this->configs['DB_HOSTNAME'] = getenv('DB_HOSTNAME') ?? 'localhost';
        $this->configs['DB_NAME'] = getenv('DB_NAME') ?? 'songhub';
        $this->configs['DB_USERNAME'] = getenv('DB_USERNAME') ?? 'root';
        $this->configs['DB_PASSWORD'] = getenv('DB_PASSWORD') ?? '';
        $this->configs['DB_PORT'] = getenv('DB_PORT') ?? '3306';
        $this->configs['DB_CHARSET'] = getenv('DB_CHARSET') ?? 'utf8';

        $this->configs['SPOTIFY_CLIENT_ID'] = getenv('SPOTIFY_CLIENT_ID') ?? '';
        $this->configs['SPOTIFY_CLIENT_SECRET'] = getenv('SPOTIFY_CLIENT_SECRET') ?? '';
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