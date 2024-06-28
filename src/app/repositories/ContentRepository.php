<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Content;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;
use Songhub\core\database\QueryBuilder;

class ContentRepository extends Repository
{
    public $table = "CONTENT";

    public function getContentPosts($contentId){
       $postRepository = new PostRepository();
       $postRepository->setQueryBuilder(QueryBuilder::getInstance());
       $mostRelevantPosts = $postRepository->getMostRelevantContentPosts($contentId);
       $mostRecentPosts = $postRepository->getMostRelevantContentPosts($contentId);

       return ["recent" => $mostRecentPosts, "relevant" => $mostRelevantPosts];
    }

    public function getContentById($contentId) {
        try{
            $content = $this->queryBuilder->selectByColumn($this->table, $column, $value);
            
            if (!$content) {
                return null;
            }

            $contentInstance = new Content();
            $contentInstance->set(current($content));

            return $contentInstance;

        } catch (Exception $exception) {
            $this->logger->error(
                "Error al obtener los datos del content",
                [
                    "Error" => $exception->getMessage(),
                    "Operacion" => 'ContentRepository - getContentById',
                ]
            );

            return null;
        }
    }
}


