<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class User
{
    public $fields = [
        "USER_ID" => null,
        "USERNAME" => null,
        "NAME" => null,
        "EMAIL" => null,
        "PASSWORD" => null,
        "SPOTIFY_ID" => null,
        "REFRESH_TOKEN" => null,
        "SPOTIFY_AVATAR" => null,
        "BIOGRAPHY" => "",
        "SPOTIFY_URL" => null,
    ];
    public function setUserId($user_id)
    {
        $user_id = trim($user_id);
        $this->fields["USER_ID"] = $user_id;
    }

    public function setName(string $name = "")
    {
        $name = trim($name);
        $name = strtolower(trim($name));

        if (strlen($name) > 60) {
            throw new InvalidValueException("El nombre debe tener un maximo de 60 caracteres");
        }

        if (!preg_match('/^[a-zA-Z ]*$/', $name)) {
            throw new InvalidValueException("El nombre solo puede contener letras y espacios en blanco");
        }

        $this->fields["NAME"] = $name;
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

        $this->fields["USERNAME"] = $username;
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

        $this->fields["EMAIL"] = $email;
    }

    public function setPassword($password, $password_confirmation = "")
    {
        if (strlen($password) < 8) {
            throw new InvalidValueException("La contraseña debe tener un minimo de 8 caracteres");
        }

        if (strlen($password) > 255) {
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
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $this->fields["PASSWORD"] = $hashed_password;
        } else {
            $this->fields["PASSWORD"] = $password;
        }
    }

    public function setSpotifyId(string $spotify_id)
    {
        $spotify_id = trim($spotify_id);
        $this->fields["SPOTIFY_ID"] = $spotify_id;
    }
    public function setSpotifyUrl(string $spotify_url)
    {
        $spotify_url = trim($spotify_url);
        $this->fields["SPOTIFY_URL"] = $spotify_url;
    }

    public function setRefreshToken(string $refresh_token)
    {
        $refresh_token = trim($refresh_token);
        $this->fields["REFRESH_TOKEN"] = $refresh_token;
    }

    public function setSpotifyAvatar(string $spotify_avatar)
    {
        if (!filter_var($spotify_avatar, FILTER_VALIDATE_URL)) {
            throw new InvalidValueException("La URL del avatar de spotify no es valida");
        }

        $spotify_avatar = trim($spotify_avatar);
        $this->fields["SPOTIFY_AVATAR"] = $spotify_avatar;
    }
    public function setBiography(string $biography = "")
    {

        if (strlen($biography) > 160) {
            throw new InvalidValueException("La biografia debe tener un maximo de 160 caracteres");
        }

        $biography = trim($biography);
        $this->fields["BIOGRAPHY"] = $biography;
    }

    public function checkPassword($password)
    {
        if (!password_verify($password, $this->fields["PASSWORD"])) {
            return false;
        }

        return true;
    }

    public function set(array $values)
    {

        foreach (array_keys($this->fields) as $field) {
            $field = trim($field);
            if (!isset($values[$field])) {
                continue;
            }

            $property = explode("_", $field);
            if (count($property) > 1) {
                $method = "set" . ucfirst(strtolower($property[0])) . ucfirst(strtolower($property[1]));
            } else {
                $method = "set" . ucfirst(strtolower($property[0]));
            }

            $this->$method($values[$field]);
        }
    }
}
