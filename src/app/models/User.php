<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class User
{
    public $fields = [
        "username" => null,
        "password" => null,
        "email" => null,
    ];

    public function setUsername(string $username)
    {
        $username = trim($username);

        if (strlen($username) > 20) {
            throw new InvalidValueException("El nombre de usuario no debe ser mayor a 20 caracteres");
        }

        if (strlen($username) === 0) {
            throw new InvalidValueException("El nombre de usuario debe tener al menos un caracter");
        }

        $this->fields["username"] = $username;
    }
    public function setEmail(string $email)
    {
        $username = trim($email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidValueException("El email no es valido");
        }

        $this->fields["email"] = $email;
    }
    public function setPassword(string $password)
    {
        $username = trim($password);

        if (strlen(trim($password)) < 8) {
            throw new InvalidValueException("La contraseña debe tener un mínimo de 8 caracteres");
        }

        $this->fields["password"] = $password;
    }

    public function set(array $values)
    {
        foreach (array_keys($this->fields) as $field) {
            if (!isset($values[$field])) {
                continue;
            }

            $method = "set" . ucfirst($field);
            $this->$method($values[$field]);
        }
    }

}