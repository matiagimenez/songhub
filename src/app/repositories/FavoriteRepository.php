<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Favorite;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class FavoriteRepository extends Repository
{
    public $table = "FAVORITE";

    public function getFavorites(int $user_id)
    {
        // TODO:
        //   Armar un querie para pedir la lista de favoritos de un usuario
    }

    public function createFavorite($favoriteData)
    {
        $favorite = new Favorite();
        try {

            $favorite->set($favoriteData);
            $this->queryBuilder->insert($this->table, $favorite->fields);
            return [true, "Nuevo Favorite registrado"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Error al registrar Favorite"];
        }
    }
}