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
        return $this->queryBuilder->count($this->table, "FOLLOWED_ID", $followed_id);
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

            // Respuesta exitosa
            header('Content-Type: application/json');
            http_response_code(201);
            echo json_encode([
                "success" => true,
                "message" => "Follow registrado",
                "data" => [
                    "user_id" => $followData["FOLLOWED_ID"]
                ]
            ]);
        } catch (PDOException $exception) {
            // Respuesta de error
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                "success" => false,
                "message" => "Ocurrió un error al seguir el usuario",
                "error" => $exception->getMessage()
            ]);
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
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode([
                "success" => true,
                "message" => "Follow eliminado",
                "data" => [
                    "user_id" => $unfollowData["FOLLOWED_ID"]
                ]
            ]);
        } catch (PDOException $exception) {
            $this->logger->error(
                "Error al eliminar el seguidor: " . $exception->getMessage(),
                [
                    "Operation" => 'DELETE',
                    "Data" => $unfollowData,
                ]
            );
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                "success" => false,
                "message" => "Ocurrió un error al eliminar el seguidor"
            ]);
        }
    }

    public function isFollowing($follower_id, $followed_id) {
        $a = $this->queryBuilder->selectByColumns($this->table, "FOLLOWER_ID", $follower_id, "FOLLOWED_ID", $followed_id);
        return count($a) > 0;
        
    }
}