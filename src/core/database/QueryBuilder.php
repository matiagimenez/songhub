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
            
            $query = "SELECT * FROM {$table}";


            //* Arma el where con los parametros que vienen en $params como clave => valor
            if (count($params) > 0) {
                foreach ($params as $key => $value) {

                    if ($where !== "") {
                        $where .= " AND "; // Solo agregamos "AND" si ya hay una condición anterior
                    }

                    $where .= $key . "= :" . $key;
                    $bindings[":" . $key] = $value;
                }

                $query = "SELECT * FROM {$table} WHERE {$where}";
            }


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
                    "Operacion" => 'select',
                    "Tabla" => $table,
                    "Columna" => $params,
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

    public function selectByColumnLike(string $table, $column, $value)
    {
        try {
            $query = "SELECT * FROM {$table} WHERE {$column} LIKE :value";
            $value = "%{$value}%";
            
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
                    "Operacion" => 'selectByColumnLike',
                    "Tabla" => $table,
                    "Columna" => $column,
                    "Valor" => $value,
                ]
            );
            return [];
        }
    }

    public function selectByColumnInDescOrder(string $table, $column, $value, $columnBy, $limit = 0)
    {
        try {
            if($limit > 0) {
                $query = "SELECT * FROM {$table} WHERE {$column} = :value ORDER BY {$columnBy} DESC LIMIT {$limit};";
            } else {
                $query = "SELECT * FROM {$table} WHERE {$column} = :value ORDER BY {$columnBy} DESC;";
            }

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
                    "Operacion" => 'selectByColumnInDescOrder',
                    "Tabla" => $table,
                    "Columna" => $column,
                    "Valor" => $value,
                ]
            );
            return [];
        }
    }

    public function selectByColumnInAscOrder(string $table, $column, $value, $columnBy, $limit = 0)
    {
        try {
            if($limit > 0) {
                $query = "SELECT * FROM {$table} WHERE {$column} = :value ORDER BY {$columnBy} ASC LIMIT {$limit};";
            } else {
                $query = "SELECT * FROM {$table} WHERE {$column} = :value ORDER BY {$columnBy} ASC;";
            }

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

    public function selectByColumns(string $table, $column1, $value1, $column2, $value2)
    {
        try {
            $query = "SELECT * FROM {$table} WHERE {$column1} = {$value1} AND {$column2} = {$value2}";
            // $value = "%{$value}%";
            
            $statement = $this->pdo->prepare($query);
            // $statement->bindParam(':value', $value);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            
            return $statement->fetchAll();
        } catch (PDOException $error) {
            $this->logger->error(
                "Error al ejecutar el query en la base de datos",
                [
                    "Error" => $error->getMessage(),
                    "Operacion" => 'selectByColumnLike',
                    "Tabla" => $table,
                    "Columna" => $column1,
                    "Valor" => $value1,
                ]
            );
            return [];
        }
    }


    public function selectWithMultipleJoinsInDescOrder(
        string $table,
        array $joins, // Array de tablas a unir y sus condiciones
        string $column,
        $value,
        string $orderByColumn,
        int $limit = 0
    ) {
        try {
            // Construir la parte del JOIN de la consulta
            $joinQuery = "";
            foreach ($joins as $join) {
                $joinQuery .= " JOIN {$join['table']} ON {$join['condition']}";
            }
    
            // Construir la consulta completa
            $query = "SELECT * FROM {$table}{$joinQuery} 
                      WHERE {$column} = :value 
                      ORDER BY {$orderByColumn} DESC";
            
            if ($limit > 0) {
                $query .= " LIMIT {$limit}";
            }
    
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
                    "Operacion" => 'selectWithMultipleJoinsInDescOrder',
                    "Tabla" => $table,
                    "Joins" => $joins,
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

            $lastInsertId = $this->pdo->lastInsertId();
            return $lastInsertId;

        } catch (PDOException $e) {
            $this->logger->info(
                "Error al ejecutar la consulta: " . $e->getMessage(),
                [
                    "Operation" => 'INSERT',
                    "Table" => $table,
                    "Data" => $data
                ]
            );
        }
    }

    public function update($table, $data, $primaryKey, $primaryKeyValue)
    {
        try {
            $setValues = [];
            foreach ($data as $column => $value) {
                $setValues[] = $column . ' = :' . $column;
            }
            $setClause = implode(", ", $setValues);
            $query = "UPDATE {$table} SET {$setClause} WHERE {$primaryKey} = :VALUE";
            $sentencia = $this->pdo->prepare($query);

            foreach ($data as $column => $value) {
                $sentencia->bindValue(':' . $column, $value);
            }
            $sentencia->bindValue(':VALUE', $primaryKeyValue);
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

    public function delete($table, $primaryKey, $primaryKeyValues)
    {
        try {
            // Construir la cláusula WHERE con las columnas de la clave primaria
            $whereClause = [];
            foreach ($primaryKey as $column) {
                $whereClause[] = $column . ' = :' . $column;
            }
            $whereClause = implode(' AND ', $whereClause);
    
            // Construir la consulta SQL
            $query = "DELETE FROM {$table} WHERE {$whereClause}";
            $sentencia = $this->pdo->prepare($query);
    
            // Vincular los valores de las columnas de la clave primaria
            foreach ($primaryKeyValues as $column => $value) {
                $sentencia->bindValue(':' . $column, $value);
            }
    
            // Ejecutar la consulta
            $result = $sentencia->execute();
            if ($result != true) {
                throw new PDOException($sentencia->errorInfo()[2]);
            }
        } catch (PDOException $e) {
            $this->logger->info(
                "Error al ejecutar la consulta: " . $e->getMessage(),
                [
                    "Operation" => 'DELETE',
                    "Table" => $table,
                ]
            );
        }
    }
}