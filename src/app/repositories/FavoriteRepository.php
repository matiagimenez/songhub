<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Favorite;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;
use Songhub\core\Session;
use Songhub\core\database\QueryBuilder;

class FavoriteRepository extends Repository
{
    public $table = "FAVORITE";

    public function getCurrentUserId() {
        $username = Session::getInstance()->get("username");

        $userRepository = new UserRepository();
        $userRepository -> setQueryBuilder(QueryBuilder::getInstance()); 

        $user = $userRepository->getUser("USERNAME", $username);

        return $user -> fields["USER_ID"];
    }


    public function addCurrentUserFavoriteContent(int $userId, $contentId, $contentType) { 
        try {
            $favorite = new Favorite();
            $favorite->setUserId($userId);
            $favorite->setContentId($contentId);

            $userFavorites = $this -> getCurrentUserFavoriteContent($userId);

            if($contentType == "album" && count($userFavorites["FAVORITE_ALBUMS"]) >= 3) {
                return [false, "Se puede tener hasta 3 albumes favoritos"];
            }

            if($contentType == "track" && count($userFavorites["FAVORITE_TRACKS"]) >= 3) {
                return [false, "Se puede tener hasta 3 canciones favoritas"];
            }
            
            $this->queryBuilder->insert($this->table, ["CONTENT_ID" => $contentId, "USER_ID" => $userId]);
            return [true, "Se agrego el contenido como favorito"];
        } catch (Exception $exception) {
    
            $this->logger->error(
                "Error al agregar el favorito del usuario",
                [
                    "Error" => $exception->getMessage(),
                    "Operacion" => 'FavoriteRepository - addCurrentUserFavoriteContent',
                ]
            );
            return [false, "Ocurrió un error al agregar el favorito del usuario"];
        }
    }

    public function getCurrentUserFavoriteContent(int $userId)
    {
        try {
            $favorites = $this->queryBuilder->selectByColumn($this->table, "USER_ID", $userId);

            $contentRepository = new ContentRepository();
            $contentRepository->setQueryBuilder($this->queryBuilder);

            $tracks = [];
            $albums = [];

            
            
            foreach($favorites as $favorite) {
                $favoriteInstance = new Favorite();
                $favoriteInstance ->set($favorite);
                $content = $contentRepository->getContentById($favoriteInstance->fields["CONTENT_ID"]);
                
                if ($content->fields["TYPE"] == "a") {
                    $albums[] = $content;
                } else {
                    $tracks[] = $content;
                }
            }

            return [
                "FAVORITE_ALBUMS" => $albums,
                "FAVORITE_TRACKS" => $tracks,
            ];
        } catch (Exception $exception) {
            $this->logger->error(
                "Error al obtener favoritos del usuario",
                [
                    "Error" => $exception->getMessage(),
                    "Operacion" => 'FavoriteRepository - getUserFavorites',
                ]
            );
            return [
                "FAVORITE_ALBUMS" => [],
                "FAVORITE_TRACKS" => [],
            ];
        }
    }
}