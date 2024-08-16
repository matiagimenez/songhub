<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Follow;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class FollowRepository extends Repository
{
    public $table = "FOLLOW";

    public function getUserFollowing($follower_id)
    {
        $following = $this->queryBuilder->selectWithMultipleJoins(
            $this->table,
            [
                [
                    'table' => 'USER',
                    'condition' => 'USER.USER_ID = FOLLOW.FOLLOWED_ID'
                ],
            ],
            "FOLLOWER_ID",
            $follower_id,
        );

        return $following;
    }

    public function getUserFollowers(int $followed_id)
    {
        $followers = $this->queryBuilder->selectWithMultipleJoins(
            $this->table,
            [
                [
                    'table' => 'USER',
                    'condition' => 'USER.USER_ID = FOLLOW.FOLLOWER_ID'
                ],
            ],
            "FOLLOWED_ID",
            $followed_id,
        );

        return $followers;
    }

    public function getUserFollowersCount(int $followed_id)
    {
        $count = $this->queryBuilder->count($this->table, "FOLLOWED_ID", $followed_id) - 1;
        return $count;
    }

    public function getUserFollowingCount(int $follower_id)
    {
        $count = $this->queryBuilder->count($this->table, "FOLLOWER_ID", $follower_id) - 1;
        return $count;
    }

    public function createFollow($followData)
    {
        $follow = new Follow();
        try {
            $follow->set($followData);
            $this->queryBuilder->insert($this->table, $follow->fields);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function deleteFollow($unfollowData)
    {
        try {
            $this->queryBuilder->delete(
                $this->table,
                ['FOLLOWER_ID', 'FOLLOWED_ID'],
                [
                    'FOLLOWER_ID' => $unfollowData["FOLLOWER_ID"],
                    'FOLLOWED_ID' => $unfollowData["FOLLOWED_ID"]
                ]
            );
            return true;
        } catch (PDOException $exception) {
            $this->logger->error(
                "Error al eliminar el seguidor: " . $exception->getMessage(),
                [
                    "Operation" => 'DELETE',
                    "Data" => $unfollowData,
                ]
            );
            return false;
        }
    }

    public function isFollowing($follower_id, $followed_id) {
        $a = $this->queryBuilder->selectByColumns($this->table, "FOLLOWER_ID", $follower_id, "FOLLOWED_ID", $followed_id);
        return count($a) > 0;
        
    }
}