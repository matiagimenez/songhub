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
}


