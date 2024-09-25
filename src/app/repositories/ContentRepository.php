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

    public function existsContent($content) {
        $type = $content["type"];
        if ($type == "track") {
            $content = $this->queryBuilder->selectByColumn($this->table, "CONTENT_ID", $content["track_id"]);
        } else {
            $content = $this->queryBuilder->selectByColumn($this->table, "CONTENT_ID", $content["album_id"]);
        }

        if (empty($content)) {
            return false;
        } else {
            return true;
        }
    }

    public function getContentPosts($userId, $contentId){
       $postRepository = new PostRepository();
       $postRepository->setQueryBuilder(QueryBuilder::getInstance());
       $mostRelevantPosts = $postRepository->getMostRelevantContentPosts($userId, $contentId);
       $mostRecentPosts = $postRepository->getMostRecentContentPosts($userId, $contentId);

       return ["recent" => $mostRecentPosts, "relevant" => $mostRelevantPosts];
    }

    public function getAverageRating($contentId) {
        $postRepository = new PostRepository();
        $postRepository->setQueryBuilder(QueryBuilder::getInstance());
        $posts = $postRepository->getPostsFromContent($contentId);
    
        $count = count($posts);
        $sum = 0;

        foreach($posts as $post) {
            $sum += $post["RATING"];
        }

        if($count > 0) {
            $average = round($sum / $count, 2);
        } else {
            $average = 0;
        }

        return ["average" => $average, "count" => $count ];
    }


    public function createContent($contentData) {
        try {
            $content = new Content();

            $type = $contentData["type"];

            $content->setContentId($contentData[$type."_id"]);
            $content->setReleaseDate($contentData["release_date"]);
            $content->setSpotifyId($contentData[$type."_id"]);
            $content->setSpotifyApiUrl($contentData[$type."_api_url"]);
            $content->setSpotifyUrl($contentData[$type."_spotify_url"]);
            if ($type == "track") {
                $content->setSpotifyPreviewUrl($contentData[$type."_preview_url"]);
                $content->setType('t');
            } else {
                $content->setType('a');
            }
            $content->setTitle($contentData[$type."_name"]);
            $content->setCoverId($contentData["images"][0]["url"]);
            $content->setArtistId($contentData["artist_id"]);
        
            $this->queryBuilder->insert($this->table, $content->fields);

            return [true, "Content registrado con éxito"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Ocurrió un error durante el registro del content"];
        }
    }


    public function getContentById($contentId) {
        try{
            $content = $this->queryBuilder->selectByColumn($this->table, "CONTENT_ID", $contentId);
            
            if (!$content) {
                return null;
            }

            $contentInstance = new Content();
            $contentInstance->set(current($content));

            $artistRepository = new ArtistRepository();
            $artistRepository->setQueryBuilder(QueryBuilder::getInstance());
            $artist = $artistRepository->getArtistById($contentInstance->fields["ARTIST_ID"]);

            $contentInstance->fields["ARTIST_NAME"] = $artist->fields["NAME"];

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


