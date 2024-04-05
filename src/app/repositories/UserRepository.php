<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\User;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class UserRepository extends Repository
{
    public $table = "USER";

    public function getUser(string $username)
    {

        $user = $this->queryBuilder->selectByColumn($this->table, "USERNAME", $username);

        if (!$user) {
            return null;
        }

        $userInstance = new User();
        $userInstance->set(current($user));
        return $userInstance;
    }

    public function userExists(string $username, string $email = "")
    {
        if (strlen($email) > 0) {
            $user = $this->queryBuilder->select($this->table, ["USERNAME" => $username, "EMAIL" => $email]);
        } else {
            $user = $this->queryBuilder->selectByColumn($this->table, "USERNAME", $username);
        }

        return count($user) > 0;
    }

    public function createUser($userData)
    {
        $user = new User();
        try {
            $user->set($userData);
            $this->queryBuilder->insert($this->table, $user->fields);
            return [true, "Usuario registrado con éxito"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Ocurrió un error durante el registro de usuario"];
        }
    }

    public function updateUser($userData)
    {
        $user = $this->getUser($userData["USERNAME"]);

        try {
            $user->set($userData);
            $this->queryBuilder->update($this->table, $user->fields);
            return [true, "Usuario actualizado con éxito"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Ocurrió un error al actualizar datos del usuario"];
        }
    }
}