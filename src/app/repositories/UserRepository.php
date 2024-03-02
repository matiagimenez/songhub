<?php

namespace Songhub\app\repositories;

use Songhub\app\models\User;
use Songhub\core\Repository;

class UserRepository extends Repository
{
    public $table = "USER";

    public function getUser(string $username)
    {
        $user = $this->queryBuilder->selectByColumn($this->table, "username", $username);
        $userInstance = new User();
        $userInstance->set(current($user));
        return $userInstance;

    }
    public function createUser()
    {
        // TODO: Crear un usuario
    }
    public function updateUser()
    {
        // TODO: Actualizar un usuario
    }
}