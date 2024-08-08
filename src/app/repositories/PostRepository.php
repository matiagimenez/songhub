<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Post;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;
use Songhub\core\Session;
use Songhub\app\repositories\UserRepository;
use Songhub\core\database\QueryBuilder;
use DateTime;

class PostRepository extends Repository
{
    public $table = "POST";

    public function getPostsFromUser($userId)
    {
        try {
            $posts = $this->queryBuilder->selectWithMultipleJoinsInDescOrder(
                $this->table,
                [
                    [
                        'table' => 'CONTENT',
                        'condition' => 'POST.CONTENT_ID = CONTENT.CONTENT_ID'
                    ],
                    [
                        'table' => 'ARTIST',
                        'condition' => 'CONTENT.ARTIST_ID = ARTIST.ARTIST_ID'
                    ],
                ],
                "USER_ID",
                $userId,
                "DATETIME",
                10
            );

            $tagRepository = new TagRepository();
            $tagRepository->setQueryBuilder($this->queryBuilder);

            foreach ($posts as &$post) {
                $tags = $tagRepository->getTags($post["POST_ID"]);
                $post["TAGS"] = $tags;
                $post['TIME_AGO'] = $this->timeAgo($post['DATETIME']);
            }

            return $posts;
        } catch (Exception $exception) {
            $this->logger->error(
                "Error al obtener los posts del usuario",
                [
                    "Error" => $exception->getMessage(),
                    "Operacion" => 'PostRepository - getPostsFromUser',
                ]
            );

            return [];
        }
    }

    public function getPostsFromContent($contentId){
        try {
            $posts = $this->queryBuilder->selectByColumn($this->table, "CONTENT_ID", $contentId);
            $contentPosts = [];
    
            if (count($posts) > 0) {
                foreach ($posts as $post) {
                    $postInstance = new Post();
                    $postInstance->set($post);
                    $contentPosts[] = $postInstance;
                }
            }
            return $posts;
        } catch (Exception $exception) {
            $this->logger->error(
                "Error al obtener los posts del content",
                [
                    "Error" => $exception->getMessage(),
                    "Operacion" => 'PostRepository - getMostRelevantContentPosts',
                ]
            );

            return [];
        }
    }

    public function getPostsCountFromUser($userId)
    {
        try {
            return $this->queryBuilder->count($this->table, "USER_ID", $userId);
        } catch(Exception $exception) {
            $this->logger->error(
                "Error al obtener los posts del usuario",
                [
                    "Error" => $exception->getMessage(),
                    "Operacion" => 'PostRepository - getPostsCountFromUser',
                ]
            );
            
            return 0;
        }
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
            $queryBuilder = QueryBuilder::getInstance();
            $userRepository = new UserRepository();
            $userRepository->setQueryBuilder($queryBuilder);
            $username = Session::getInstance()->get("username");
            $user = $userRepository->getUser("USERNAME", $username);
            $postData["USER_ID"] = $user->fields["USER_ID"];
            $postData["DATETIME"] = date("Y-m-d H:i:s");
            $post->set($postData);
            $postID = $this->queryBuilder->insert($this->table, $post->fields);
            http_response_code(201); // Código 201: Created
            $response = ["success" => true, "message" => "Nuevo Post registrado", "post_id" => $postID];
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

        return $response;
    }

    public function getMostRelevantContentPosts($contentId) {
        try {
            $posts = $this->queryBuilder->selectWithMultipleJoinsInDescOrder(
                $this->table,
                [
                    [
                        'table' => 'CONTENT',
                        'condition' => 'POST.CONTENT_ID = CONTENT.CONTENT_ID'
                    ],
                    [
                        'table' => 'ARTIST',
                        'condition' => 'CONTENT.ARTIST_ID = ARTIST.ARTIST_ID'
                    ],
                    [
                        'table' => 'USER',
                        'condition' => 'POST.USER_ID = USER.USER_ID'
                    ],
                ],
                'POST.CONTENT_ID', // Especifica la tabla aquí
                $contentId,
                'LIKES',
                3
            );
    
    
            $tagRepository = new TagRepository();
            $tagRepository->setQueryBuilder($this->queryBuilder);
    
            foreach ($posts as &$post) {
                $tags = $tagRepository->getTags($post["POST_ID"]);
                $post["TAGS"] = $tags;
                $post['TIME_AGO'] = $this->timeAgo($post['DATETIME']);
            }
    
            return $posts;
        } catch (Exception $exception) {
            $this->logger->error(
                "Error al obtener los posts del content",
                [
                    "Error" => $exception->getMessage(),
                    "Operacion" => 'PostRepository - getMostRelevantContentPosts',
                ]
            );
    
            return [];
        }
    }

    public function getMostRecentContentPosts($contentId) {
        try {
            $posts = $this->queryBuilder->selectWithMultipleJoinsInDescOrder(
                $this->table,
                [
                    [
                        'table' => 'CONTENT',
                        'condition' => 'POST.CONTENT_ID = CONTENT.CONTENT_ID'
                    ],
                    [
                        'table' => 'ARTIST',
                        'condition' => 'CONTENT.ARTIST_ID = ARTIST.ARTIST_ID'
                    ],
                    [
                        'table' => 'USER',
                        'condition' => 'POST.USER_ID = USER.USER_ID'
                    ],
                ],
                'POST.CONTENT_ID', // Especifica la tabla aquí
                $contentId,
                'POST.DATETIME', // Asegúrate de que está especificado con su tabla
                3
            );
    
            $tagRepository = new TagRepository();
            $tagRepository->setQueryBuilder($this->queryBuilder);
    
            foreach ($posts as &$post) {
                $tags = $tagRepository->getTags($post["POST_ID"]);
                $post["TAGS"] = $tags;
                $post['TIME_AGO'] = $this->timeAgo($post['DATETIME']);
            }
    
            return $posts;
        } catch (Exception $exception) {
            $this->logger->error(
                "Error al obtener los posts del content",
                [
                    "Error" => $exception->getMessage(),
                    "Operacion" => 'PostRepository - getMostRecentContentPosts',
                ]
            );
    
            return [];
        }
    }
    
    private function timeAgo($datetime, $full = false) {
        $timestamp = strtotime($datetime);
        $difference = time() - $timestamp;
        $periods = array('segundo', 'minuto', 'hora', 'día', 'semana', 'mes', 'año');
        $lengths = array('60', '60', '24', '7', '4.35', '30', '365');
        
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }
        
        $difference = round($difference);
        $period = $periods[$j];
        $result = ($difference > 1 ? $difference . ' ' . $period . 's' : '1 ' . $period);
        
        return 'hace ' . $result;
    }
}