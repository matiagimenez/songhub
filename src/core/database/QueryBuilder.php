<?php

namespace Songhub\core\Database;

use PDO;
use Songhub\core\traits\Loggable;

class QueryBuilder
{
    use Loggable;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function select()
    {
        // $this->pdo->prepare("SELECT * FROM {$table}");
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