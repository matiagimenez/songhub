<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Post;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class PostRepository extends Repository
{
    public $table = "POST";

    public function getPosts(int $post_id)
    {
        // TODO:
        //   Armar un querie para pedir la lista de posts de un usuario
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
}