<?php

namespace Songhub\Core\Database;

use PDO;
use PDOException;
use Songhub\core\Config;
use Songhub\core\LoggerBuilder;
use Songhub\core\traits\Loggable;

class ConnectionBuilder
{
    private static $instance;
    private PDO $connection;
    use Loggable;

    private function __construct()
    {
        $logger = LoggerBuilder::getInstance()->getLogger();
        $this->setLogger($logger);
        $this->connection = $this->make(Config::getInstance());
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function make(Config $config): PDO
    {
        try {
            $adapter = $config->get('DB_ADAPTER');
            $hostname = $config->get('DB_HOSTNAME');
            $dbName = $config->get('DB_NAME');
            $port = $config->get('DB_PORT');
            $charset = $config->get('DB_CHARSET');
            $username = $config->get('DB_USERNAME');
            $password = $config->get('DB_PASSWORD');

            $connection = new PDO(
                "{$adapter}:host={$hostname};dbname={$dbName};
              port={$port};charset={$charset}",
                $username,
                $password,
                [
                    'options' => [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    ],
                ]
            );

            $this->logger->info("Conexión a la base de datos establecida", ["Database" => $dbName]);

            return $connection;
        } catch (PDOException $error) {
            $this->logger->error("Internal server error", ["Error" => $error]);
            die("Error interno del servidor - Consulte al administrador de sistemas.");
        }
    }

    public function getConnection(): PDO
    {

        return $this->connection;
    }
}