<?php

namespace Songhub\core;

use Songhub\core\database\QueryBuilder;
use Songhub\core\Repository;

class Controller
{
    public ?string $repositoryName = null;
    public ?Repository $repository = null;
    public function __construct()
    {

        if (!is_null($this->repositoryName)) {
            $repository = new $this->repositoryName;
            $queryBuilder = QueryBuilder::getInstance();
            $repository->setQueryBuilder($queryBuilder);
            $this->setRepository($repository);
        }

    }

    public function setRepository(Repository $repository)
    {
        $this->repository = $repository;
    }
}