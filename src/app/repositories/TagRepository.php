<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Tag;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class TagRepository extends Repository
{
    public $table = "TAG";

    public function getTags(int $post_id)
    {
        try {
            $tags = $this->queryBuilder->selectByColumn($this->table, "POST_ID", $post_id);

            return $tags;
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Error al obtener los tags del post " . $post_id];
        }
    }

    public function createTag($tagData)
    {
        $tag = new Tag();
        try {

            $tag->set($tagData);
            $this->queryBuilder->insert($this->table, $tag->fields);
            return [true, "Nuevo Tag registrado"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Error al registrar Tag"];
        }
    }
}