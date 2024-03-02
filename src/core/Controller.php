<?php

namespace Songhub\core;

use Songhub\core\database\QueryBuilder;
use Songhub\core\Repository;

class Controller
{
    public string $viewsDirectory;
    public ?string $repositoryName = null;
    public ?Repository $repository = null;
    public function __construct()
    {
        $this->viewsDirectory = __DIR__ . "/../app/views/";

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