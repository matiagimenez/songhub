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
            // $comments = $this->queryBuilder->selectByColumn($this->table, "POST_ID", $post_id);
            $comments = $this->queryBuilder->selectByColumnInDescOrder($this->table, "POST_ID", $post_id, "DATETIME");
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
    
    public function likeComment($user_id,$comment_id, $post_id)
    {
        $isLiked = $this->isLikedComment($user_id);
        try {
            $data = [
                "USER_ID" => $user_id,
                "COMMENT_ID" => $comment_id,
                "POST_ID" => $post_id,
            ];
            !$isLiked ? $this->queryBuilder->insert("COMMENT_LIKE", $data) : $this->deleteComment($user_id, $comment_id, $post_id);
            $conditions = [
                "COMMENT_ID" => $comment_id,
                "POST_ID" => $post_id,
            ];
            $operation = !$isLiked ? "LIKES + 1" : "LIKES - 1";
            $this->queryBuilder->updateWithConditions($this->table, ["LIKES" => $operation], $conditions);
            return [true, "Comentario actualizado"];
        } catch (Exception $exception) {
            return [false, "Error al registrar Comment"];
        }
    }
    
    public function isLikedComment($user_id) {
        return $this->queryBuilder->count("COMMENT_LIKE", "USER_ID", $user_id) > 0;
    }

    public function deleteComment($user_id, $comment_id, $post_id)
    {
        try {
            $data = [
                "USER_ID" => $user_id,
                "COMMENT_ID" => $comment_id,
                "POST_ID" => $post_id,
            ];
            $this->queryBuilder->deleteWithManyPK("COMMENT_LIKE",["USER_ID", "COMMENT_ID", "POST_ID"], $data);
            return [true, "Comentario actualizado"];
        } catch (Exception $exception) {
            return [false, "Error al registrar Comment"];
        }
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