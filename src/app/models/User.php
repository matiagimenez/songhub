<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class User
{
    public $fields = [
        "user_id" => null,
        "username" => null,
        "name" => null,
        "email" => null,
        "password" => null,
        "spotify_id" => null,
        "spotify_avatar" => null,
        "biography" => null,
        "is_verified" => null,
    ];

    public function setUserId($user_id)
    {
        $user_id = trim($user_id);
        $this->fields["user_id"] = $user_id;
    }

    public function setName(string $name)
    {
        $name = trim($name);
        $name = strtolower(trim($name));

        if (strlen($name) > 60) {
            throw new InvalidValueException("El nombre debe tener un maximo de 60 caracteres");
        }

        if (!preg_match('/^[a-zA-Záéíóú\s]+$/', $name)) {
            throw new InvalidValueException("El nombre solo puede contener letras");
        }

        $name = array_map('trim', explode(' ', $name));

        $name = array_map(function ($word) {
            return ucfirst(strtolower($word));
        }, $name);

        $name = implode(' ', $name);
        $this->fields["name"] = $name;
    }

    public function setUsername(string $username)
    {
        $username = trim($username);

        if (strlen($username) > 30) {
            throw new InvalidValueException("El nombre de usuario debe tener un maximo de 30 caracteres");
        }

        if (strlen($username) === 0) {
            throw new InvalidValueException("El nombre de usuario debe tener al menos un caracter");
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            throw new InvalidValueException("El nombre de usuario solo puede contener letras y números");
        }

        $this->fields["username"] = $username;
    }
    public function setEmail(string $email, string $email_confirmation = null)
    {

        $email = strtolower(trim($email));
        if (strlen($email) > 128) {
            throw new InvalidValueException("El email debe tener un maximo de 128 caracteres");
        }

        if (strlen($email) === 0) {
            throw new InvalidValueException("El email no es valido");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidValueException("El email no es valido");
        }

        if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
            throw new InvalidValueException("El email no es valido");
        }

        // El email de confirmacion solo se pasa al momento de registrarse. En el resto de usos del metodo setEmail, no se tiene en cuenta este segundo parametro.
        if ($email_confirmation !== null) {
            $email_confirmation = strtolower(trim($email_confirmation));
            if ($email !== $email_confirmation) {
                throw new InvalidValueException("Los emails no coinciden");
            }
        }

        $this->fields["email"] = $email;
    }

    public function setPassword($password, $password_confirmation = "")
    {
        if (strlen($password) < 8) {
            throw new InvalidValueException("La contraseña debe tener un minimo de 8 caracteres");
        }

        if (strlen($password) < 255) {
            throw new InvalidValueException("La contraseña debe tener un maximo de 255 caracteres");
        }

        if (!preg_match("#[0-9]+#", $password)) {
            // Verifica que la contraseña tenga al menos un numero
            throw new InvalidValueException("La contraseña debe tener al menos un numero");
        }

        if (!preg_match("#[a-zA-Z]+#", $password)) {
            // Verifica que el password tenga al menos una letra
            throw new InvalidValueException("La contraseña debe tener al menos una letra");
        }

        // El password de confirmacion solo se pasa al momento de registrarse. En el resto de usos del metodo setPassword, no se tiene en cuenta este segundo parametro.
        if (strlen($password_confirmation) > 0) {
            if ($password !== $password_confirmation) {
                throw new InvalidValueException("Las contraseñas no coinciden");
            }}

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $this->fields["password"] = $hashed_password;
    }

    public function setSpotifyId(string $spotify_id)
    {
        $spotify_id = trim($spotify_id);
        $this->fields["spotify_id"] = $spotify_id;
    }
    public function setSpotifyAvatar(string $spotify_avatar)
    {
        if (!filter_var($spotify_avatar, FILTER_VALIDATE_URL)) {
            throw new InvalidValueException("La URL del avatar de spotify no es valida");
        }

        $spotify_avatar = trim($spotify_avatar);
        $this->fields["spotify_avatar"] = $spotify_avatar;
    }
    public function setBiography(string $biography)
    {

        if (strlen($biography) > 160) {
            throw new InvalidValueException("La biografia debe tener un maximo de 160 caracteres");
        }

        $biography = trim($biography);
        $this->fields["biography"] = $biography;
    }
    public function setIsVerified(string $is_verified)
    {
        $isBoolean = filter_var($is_verified, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($isBoolean === null) {
            throw new InvalidValueException("El valor de la verificacion debe ser un booleano");
        }

        $is_verified = $isBoolean ? true : false;

        if (!filter_var($is_verified, FILTER_VALIDATE_BOOLEAN)) {
            $this->fields["is_verified"] = $is_verified;
        }

    }

    public function set(array $values)
    {
        foreach (array_keys($this->fields) as $field) {
            if (!isset($values[$field])) {
                continue;
            }

            $property = explode("_", $field);
            if (count($property) > 1) {
                $method = "set" . ucfirst($property[0]) . ucfirst($property[1]);

            } else {
                $method = "set" . ucfirst($property[0]);
            }
            $status = $this->$method($values[$field]);
        }
    }

}