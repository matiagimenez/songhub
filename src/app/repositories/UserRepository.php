<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\User;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;
use Songhub\core\database\QueryBuilder;

class UserRepository extends Repository
{
    public $table = "USER";

    public function getUser(string $column, string $value)
    {

        $user = $this->queryBuilder->selectByColumn($this->table, $column, $value);

        if (!$user) {
            return null;
        }

        $userInstance = new User();
        $userInstance->set(current($user));
        return $userInstance;
    }

    public function emailIsUsed(string $email)
    {
        $user = $this->queryBuilder->selectByColumn($this->table, "EMAIL", $email);

        return count($user) > 0;
    }
    public function usernameIsUsed(string $username)
    {
        $user = $this->queryBuilder->selectByColumn($this->table, "USERNAME", $username);

        return count($user) > 0;
    }

    public function createUser($userData)
    {

        try {
            if ($this->emailIsUsed($userData["EMAIL"])) {
                return [false, "El correo electrónico ya se encuentra en uso."];
            }

            if ($this->usernameIsUsed($userData["USERNAME"])) {
                return [false, "El nombre de usuario ya se encuentra en uso."];
            }

            $user = new User();

            $user->setUsername($userData["USERNAME"]);
            $user->setName($userData["USERNAME"]);
            $user->setEmail($userData["EMAIL_CONFIRMATION"], $userData["EMAIL"]);
            $user->setPassword($userData["PASSWORD"], $userData["PASSWORD_CONFIRMATION"]);

            $this->queryBuilder->insert($this->table, $user->fields);

            return [true, "Usuario registrado con éxito"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Ocurrió un error durante el registro de usuario"];
        }
    }

    public function updateUser($field, $value, $userData)
    {
        $user = $this->getUser($field, $value);

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

    public function login($email, $password)
    {
        $user = $this->getUser("EMAIL", $email);

        if ($user === null) {
            return [false, "Correo electrónico o contraseña incorrectos"];
        }

        $isCorrect = $user->checkPassword($password);

        if (!$isCorrect) {
            return [false, "Correo electrónico o contraseña incorrectos"];
        }

        return [true, "Inicio de sesión exitoso"];
    }

    public function getUserPosts($userId) {
        $postRepository = new PostRepository();
        $postRepository->setQueryBuilder(QueryBuilder::getInstance());
        return $postRepository -> getPostsFromUser($userId);
    }

    public function getUserPostsCount($userId) {
        $postRepository = new PostRepository();
        $postRepository->setQueryBuilder(QueryBuilder::getInstance());
        return $postRepository -> getPostsCountFromUser($userId);
    }

    public function getUserAccountStats($userId) {
        $followRepository = new FollowRepository();
        $followRepository->setQueryBuilder(QueryBuilder::getInstance());

        $followers = $followRepository->getUserFollowersCount($userId);
        $following = $followRepository->getUserFollowingCount($userId);

        return ["followers" => $followers, "following" => $following];
    }

    public function getUserNationality($userId) {
        $nationalityRepository = new NationalityRepository();
        $nationalityRepository->setQueryBuilder(QueryBuilder::getInstance());

        $countryRepository = new CountryRepository();
        $countryRepository->setQueryBuilder(QueryBuilder::getInstance());

        $availableCountries = $countryRepository -> getAvailableCountries();
        $nationality = $nationalityRepository -> getUserNationality($userId);
 

        return ["NATIONALITY" => $nationality, "COUNTRIES" => $availableCountries];
    }
}
