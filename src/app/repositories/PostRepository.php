<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Post;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class PostRepository extends Repository
{
    public $table = "POST";

    public function getPostsFromUser($user_id)
    {
        $posts = $this->queryBuilder->selectByColumn($this->table, "USER_ID", $user_id);

        $userPosts = [];

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $postInstance = new Post();
                $postInstance->set($post);
                $userPosts->push($postInstance);
            }
        }
        // echo "<pre>";
        // var_dump($posts);
        // die;

        return $userPosts;
    }

    public function getPost(int $post_id)
    {
        // TODO:
        //   Armar un querie para pedir un post

    }

    public function likePost(int $post_id)
    {
        // TODO:
        //   Armar un querie para aumentar en uno la cantidad de likes de un post/comentario

    }

    public function createPost($postData)
    {
        $post = new Post();
        try {
            $post->set($postData);
            $this->queryBuilder->insert($this->table, $post->fields);
            return [true, "Nuevo Post registrado"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Error al registrar Post"];
        }
    }

    public function getMostRelevantContentPosts($contentId){
        try {
            $posts = $this->queryBuilder->selectByColumnInDescOrder($this->table, "CONTENT_ID", $contentId, "LIKES", 3);
            $contentPosts = [];
    
            if (count($posts) > 0) {
                foreach ($posts as $post) {
                    $postInstance = new Post();
                    $postInstance->set($posts);
                    $userPosts->push($postInstance);
                }
            }
            return $contentPosts;
        } catch (InvalidValueException $exception) {
            return $exception->getMessage();
        } catch (Exception $exception) {
            return "Error al obtener los posts recientes";
        }
    }

    public function getMostRecentContentPosts($contentId){
        try {
            $posts = $this->queryBuilder->selectByColumnInDescOrder($this->table, "CONTENT_ID", $contentId, "DATETIME", 3);
            $contentPosts = [];
    
            if (count($posts) > 0) {
                foreach ($posts as $post) {
                    $postInstance = new Post();
                    $postInstance->set($post);
                    $userPosts->push($postInstance);
                }
            }
            return $contentPosts;
        } catch (InvalidValueException $exception) {
            return $exception->getMessage();
        } catch (Exception $exception) {
            return "Error al obtener los posts recientes";
        }
    }
}