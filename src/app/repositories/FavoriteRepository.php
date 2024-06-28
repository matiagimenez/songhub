<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Favorite;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class FavoriteRepository extends Repository
{
    public $table = "FAVORITE";

    public function getUserFavorites(int $userId)
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
                
                // Ver el valor de TYPE que se usa al cargar un registro en la tabla CONTENT
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