<?php

namespace Songhub\Core\Database;

use PDO;
use PDOException;
use Songhub\core\Config;
use Songhub\core\traits\Loggable;

class ConnectionBuilder
{
    use Loggable;

    public function make(Config $config): PDO
    {
        try {
            $adapter = $config->get('DB_ADAPTER');
            $hostname = $config->get('DB_HOSTNAME');
            $dbName = $config->get('DB_NAME');
            $port = $config->get('DB_PORT');
            $charset = $config->get('DB_CHARSET');
            // echo "<pre>";
            // var_dump($adapter);
            // var_dump($dbName);
            // var_dump($hostname);
            // var_dump($charset);
            // var_dump($port);
            // die;

            return new PDO(
                "{$adapter}:host={$hostname};dbname={$dbName};
              port={$port};charset={$charset}",
                $config->get('DB_USERNAME'),
                $config->get('DB_PASSWORD'),
                [
                    'options' => [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    ],
                ]
            );
        } catch (PDOException $error) {
            $this->logger->error("Internal server error", ["Error" => $error]);
            die("Error interno del servidor - Consulte al administrador de sistemas.");
        }
    }
}