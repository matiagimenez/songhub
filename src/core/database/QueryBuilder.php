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
            $where = "";
            $bindings = [];

            //* Arma el where con los parametros que vienen en $params como clave => valor
            if (count($params) > 0) {
                foreach ($params as $key => $value) {

                    if ($where !== "") {
                        $where .= " AND "; // Solo agregamos "AND" si ya hay una condición anterior
                    }

                    $where .= $key . "= :" . $key;
                    $bindings[":" . $key] = $value;
                }
            }

            $query = "SELECT * FROM {$table} WHERE {$where}";

            $statement = $this->pdo->prepare($query);

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $statement->execute($bindings);

            return $statement->fetchAll();

        } catch (PDOException $error) {
            // Retorna un array vacío en caso de error
            $this->logger->error(
                "Error al ejecutar el query en la base de datos",
                [
                    "Error" => $error->getMessage(),
                    "Operacion" => 'selectByColumn',
                    "Tabla" => $table,
                    "Columna" => $params,
                    "Valor" => $value,
                ]
            );
            return [];
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
            return [];
        }
    }

    public function selectByColumnInDescOrder(string $table, $column, $value, $columnBy, $limit)
    {
        try {
            $query = "SELECT * FROM {$table} WHERE {$column} = :value ORDER BY {$columnBy} ASC LIMIT {$limit};";
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
                    "Operacion" => 'selectByColumnInAscOrder',
                    "Tabla" => $table,
                    "Columna" => $column,
                    "Valor" => $value,
                ]
            );
            return [];
        }
    }

    public function count($table, $column, $value) {
        try {
            $query = "SELECT COUNT(*) as count FROM {$table} WHERE {$column} = :value";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':value', $value);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $error) {
            $this->logger->error(
                "Error al ejecutar el query en la base de datos",
                [
                    "Error" => $error->getMessage(),
                    "Operacion" => 'count',
                    "Tabla" => $table,
                    "Columna" => $column,
                    "Valor" => $value,
                ]
            );
            return 0;
        }
    }

    public function insert($table, $data)
    {

        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));

            $query = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
            $sentencia = $this->pdo->prepare($query);
            foreach ($data as $column => $value) {
                $sentencia->bindValue(':' . $column, $value);
            }
            $result = $sentencia->execute();

            if ($result != true) {
                throw new PDOException($sentencia->errorInfo()[2]);
            }

        } catch (PDOException $e) {
            $this->logger->info(
                "Error al ejecutar la consulta: " . $e->getMessage(),
                [
                    "Operation" => 'INSERT',
                    "Table" => $table,
                ]
            );

        }

    }

    public function update($table, $data)
    {
        try {
            $setValues = [];
            foreach ($data as $column => $value) {
                $setValues[] = $column . ' = :' . $column;
            }
            $setClause = implode(", ", $setValues);
            $query = "UPDATE {$table} SET {$setClause} WHERE USERNAME = :USERNAME";
            $sentencia = $this->pdo->prepare($query);

            foreach ($data as $column => $value) {
                $sentencia->bindValue(':' . $column, $value);
            }
            $sentencia->bindValue(':USERNAME', $data["USERNAME"]);
            $result = $sentencia->execute();
            if ($result != true) {
                throw new PDOException($sentencia->errorInfo()[2]);
            }
        } catch (PDOException $e) {
            $this->logger->info(
                "Error al ejecutar la consulta: " . $e->getMessage(),
                [
                    "Operation" => 'UPDATE',
                    "Table" => $table,
                ]
            );
        }
    }

    public function delete()
    {
        // $this->pdo->prepare("SELECT * FROM {$table}");
    }
}