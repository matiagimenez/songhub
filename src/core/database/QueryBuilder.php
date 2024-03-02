<?php

namespace Songhub\core\Database;

use PDO;
use PDOException;
use Songhub\core\LoggerBuilder;
use Songhub\core\traits\Loggable;

class QueryBuilder
{
    private static $instance;
    use Loggable;
    private PDO $pdo;

    private function __construct(PDO $pdo)
    {
        $logger = LoggerBuilder::getInstance()->getLogger();
        $this->setLogger($logger);
        $this->pdo = $pdo;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self(ConnectionBuilder::getInstance()->getConnection());
        }

        return self::$instance;
    }

    public function select(string $table, $params = [])
    {
        try {
            $where = "1 = 1";

            if (count($params) > 0) {
                //* Armar el where con los parametros que vienen en $params como clave => valor
                //! Recordar utilizar bindParam() para evitar inyecciones de SQL
                $where = "";
            }

            $query = "SELECT * FROM {$table} WHERE {$where}";
        } catch (PDOException $error) {

        }
    }

    public function selectByColumn(string $table, $column, $value)
    {

        try {
            $query = "SELECT * FROM {$table} WHERE {$column} = :value";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':value', $value);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $error) {
            $this->logger->error(
                "Error al ejecutar el query en la base de datos",
                [
                    "Error" => $error->getMessage(),
                    "Operacion" => 'selectByColumn',
                    "Tabla" => $table,
                    "Columna" => $column,
                    "Valor" => $value,
                ]
            );
        }
    }
    public function insert()
    {
        // $this->pdo->prepare("SELECT * FROM {$table}");
    }
    public function delete()
    {
        // $this->pdo->prepare("SELECT * FROM {$table}");
    }
    public function update()
    {
        // $this->pdo->prepare("SELECT * FROM {$table}");
    }
}