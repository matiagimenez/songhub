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
        // Inicia el buffer de salida
        ob_start();
        $post = new Post();
        try {
            $post->set($postData);
            $this->queryBuilder->insert($this->table, $post->fields);
            http_response_code(201); // Código 201: Created
            $response = ["success" => true, "message" => "Nuevo Post registrado"];
        } catch (InvalidValueException $exception) {
            http_response_code(400); // Código 400: Bad Request
            $response = ["success" => false, "message" => $exception->getMessage()];
        } catch (Exception $exception) {
            http_response_code(500); // Código 500: Internal Server Error
            $response = ["success" => false, "message" => "Error al registrar Post"];
        }

        // Limpia el buffer de salida y desactívalo
        ob_end_clean();

        // Envía la respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}