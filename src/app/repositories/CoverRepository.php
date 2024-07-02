<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Cover;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class CoverRepository extends Repository
{
    public $table = "COVER";

    public function existsCover($small_url) {
        
        $content = $this->queryBuilder->selectByColumn($this->table, "SMALL_COVER_URL", $small_url);

        if (empty($content)) {
            return false;
        } else {
            return true;
        }
    }

    public function createCover($coverData) {

        try {
            $cover = new Cover();
            $cover->setSmallCoverUrl($coverData["SMALL_COVER_URL"]);
            $cover->setMediumCoverUrl($coverData["MEDIUM_COVER_URL"]);
            $cover->setLargeCoverUrl($coverData["LARGE_COVER_URL"]);
            
            $this->queryBuilder->insert($this->table, $cover->fields);

            return [true, "covera registrado con éxito"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Ocurrió un error durante el registro del covera"];
        }

    }
}
