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
        // echo "<pre>";
        // var_dump($followers);
        // die;

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
        // echo "<pre>";
        // var_dump($following);
        // die;

        return $userFollowing;

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