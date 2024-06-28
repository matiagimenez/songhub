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
            $content = $this->queryBuilder->selectByColumn($this->table, "SPOTIFY_ID", $content["track_id"]);
        } else {
            $content = $this->queryBuilder->selectByColumn($this->table, "SPOTIFY_ID", $content["album_id"]);
        }

        if (empty($content)) {
            return false;
        } else {
            return true;
        }
    }

    public function getContentPosts($contentId){
       $postRepository = new PostRepository();
       $postRepository->setQueryBuilder(QueryBuilder::getInstance());
       $mostRelevantPosts = $postRepository->getMostRelevantContentPosts($contentId);
       $mostRecentPosts = $postRepository->getMostRelevantContentPosts($contentId);

       return ["recent" => $mostRecentPosts, "relevant" => $mostRelevantPosts];
    }


    public function createContent($contentData) {
        try {
            $content = new Content();

            $type = $contentData["type"];

            // $content->setAverageRating($contentData["average_rating"]);
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
            $content->setArtistId($contentData["artist_spotify_id"]);
        
            $this->queryBuilder->insert($this->table, $content->fields);

            return [true, "Content registrado con éxito"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Ocurrió un error durante el registro del content"];
        }
    }


}


