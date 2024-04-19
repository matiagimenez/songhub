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

    public function sanitizeUserInput($input, $filter = FILTER_SANITIZE_STRING)
    {
        // Aplicar htmlentities para convertir caracteres especiales en entidades HTML
        $sanitized_input = htmlentities($input, ENT_QUOTES, 'UTF-8');

        // Eliminar cualquier etiqueta HTML restante
        $sanitized_input = strip_tags($sanitized_input);

        // Eliminar espacios en blanco al inicio y al final
        $sanitized_input = trim($sanitized_input);

        // Utilizar filter_var para aplicar un filtro específico
        $sanitized_input = filter_var($sanitized_input, $filter);

        return $sanitized_input;
    }
}
