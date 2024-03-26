<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Follow;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class FollowRepository extends Repository
{
    public $table = "FOLLOW";

    public function getFollowers(int $followed_id)
    {
        // TODO:
        //   Armar un querie para pedir la lista de seguidores
    }
    
    public function getFollowed(int $follower_id)
    {
        // TODO:
        //   Armar un querie para pedir la lista de seguidos
    
    }

    public function createFollow($followData)
    {
        $follow = new Follow();
        try {

            $follow->set($followData);
            $this->queryBuilder->insert($this->table, $follow->fields);
            return [true, "Nuevo follow registrado"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Error al registrar follow"];
        }
    }
}