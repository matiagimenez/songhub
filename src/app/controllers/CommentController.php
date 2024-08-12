<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Request;
use Songhub\core\Session;
use Songhub\app\repositories\CommentRepository;
use Songhub\app\repositories\UserRepository;
use DateTime;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = CommentRepository::class;
        parent::__construct();
    }

    public function createComment()
    {
        $post_id = $this->sanitizeUserInput(Request::getInstance()->getParameter("post_id", "POST"));
        $text = $this->sanitizeUserInput(Request::getInstance()->getParameter("text", "POST"));

        $currentDatetime = new DateTime();
        $currentUser = $this->getCurrentUser();

        $comment = [
            "TEXT" => $text,
            "DATETIME" => $currentDatetime->format("Y-m-d H:i:s"),
            "LIKES" => 0,
            "POST_ID" => $post_id,
            "USER_ID" => $currentUser->fields["USER_ID"]
        ];

        $this->repository->createComment($comment);

        header("Location: /post?id=" . urlencode($post_id));
        exit;
    }

    public function getCurrentUser()
    {
        $userRepository = new UserRepository();
        $currUser = $userRepository->getUser("USERNAME", Session::getInstance()->get("username"));
        return $currUser;
    }
    
    // public function getComments($post_id)
    // {
    //     $comments = $this->repository->getComments($post_id);
    //     $userRepository = new UserRepository();
    //     $response = [];
    //     foreach ($comments as $comment)
    //     {
    //         $user = $userRepository->getUser("USER_ID", $comment["USER_ID"]);

    //         $commentUser = [
    //             "id" => $user->fields["USER_ID"],
    //             "username" => $user->fields["USERNAME"],
    //             "avatar" => $user->fields["SPOTIFY_AVATAR"]
    //         ];

    //         $commentData = [
    //             "id" => $comment["COMMENT_ID"],
    //             "text" => $comment["TEXT"],
    //             "datetime" => $comment["DATETIME"],
    //             "likes" => $comment["LIKES"],
    //             "user" => $commentUser,
    //         ];
    //         array_push($response, $commentData);
    //     }
    //     return $response;
    // }
}