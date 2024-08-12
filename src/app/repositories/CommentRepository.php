<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Comment;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class CommentRepository extends Repository
{
    public $table = "COMMENT";

    public function getComments(int $post_id)
    {
        try {
            $comments = $this->queryBuilder->selectByColumn($this->table, "POST_ID", $post_id);
            return $comments;
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Error al registrar Comment"];
        }
    }
    
    public function getComment(int $comment_id)
    {
        // TODO:
        //   Armar un querie para pedir un comentario
    
    }

    public function likeComment(int $comment_id)
    {
        // TODO:
        //   Armar un querie para aumentar en uno la cantidad de likes de un post/comentario
    
    }

    public function createComment($commentData)
    {
        $comment = new Comment();
        try {

            $comment->set($commentData);
            $this->queryBuilder->insert($this->table, $comment->fields);
            return [true, "Nuevo Comment registrado"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Error al registrar Comment"];
        }
    }
}