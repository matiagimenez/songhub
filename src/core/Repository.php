<?php

namespace Songhub\core;

use Songhub\core\database\QueryBuilder;
use Songhub\core\traits\Loggable;

class Repository
{
    use Loggable;
    public QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->queryBuilder = QueryBuilder::getInstance();
    }

    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }
}