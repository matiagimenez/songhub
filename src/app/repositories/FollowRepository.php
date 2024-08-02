<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Follow;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class FollowRepository extends Repository
{
    public $table = "FOLLOW";

    public function getUserFollowers($followed_id)
    {
        $followers = $this->queryBuilder->selectByColumn($this->table, "FOLLOWED_ID", $followed_id);

        $userFollowers = [];

        if (count($followers) > 0) {
            foreach ($followers as $follower) {
                $followInstance = new Follow();
                $followInstance->set($follower);
                $userFollowers->push($followInstance);
            }
        }

        return $userFollowers;
    }

    public function getUserFollowing(int $follower_id)
    {
        $following = $this->queryBuilder->selectByColumn($this->table, "FOLLOWER_ID", $follower_id);

        $userFollowing = [];

        if (count($following) > 0) {
            foreach ($following as $follower) {
                $followInstance = new Follow();
                $followInstance->set($follower);
                $userFollowing->push($followInstance);
            }
        }

        return $userFollowing;
    }

    public function getUserFollowersCount(int $followed_id)
    {
        return $this->queryBuilder->count($this->table, "FOLLOWER_ID", $followed_id);
    }

    public function getUserFollowingCount(int $follower_id)
    {
        return $this->queryBuilder->count($this->table, "FOLLOWER_ID", $follower_id);
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

    // public function deleteFollow($follower_id, $followed_id)
    // {
    //     try {
    //         $this->queryBuilder->deleteByColumn($this->table, "FOLLOWER_ID", $follower_id, "FOLLOWED_ID", $followed_id);
    //         return [true, "Seguidor eliminado"];
    //     } catch (Exception $exception) {
    //         return [false, "Ocurrio un error al eliminar el seguidor"];
    //     }
    // }

    public function isFollowing($follower_id, $followed_id) {
        $a = $this->queryBuilder->selectByColumns($this->table, "FOLLOWER_ID", $follower_id, "FOLLOWED_ID", $followed_id);
        return count($a) > 0;
        
    }
}