<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Request;
use Songhub\core\Renderer;
use Songhub\core\Session;
use Songhub\app\repositories\PostRepository;
use Songhub\app\repositories\UserRepository;
use Songhub\app\controllers\TagController;
use DateTime;

class PostController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = PostRepository::class;
        parent::__construct();
    }


    public function post()
    {
        $post_id = $this->sanitizeUserInput(Request::getInstance()->getParameter("id", "GET"));
        $response = $this->repository->getPost($post_id);

        $content = [
            "spotifyId" => $response["SPOTIFY_ID"],
            "averageRating" => $response["RATING"],
            "title" => $response["TITLE"],
            "releaseDate" => $response["RELEASE_DATE"],
            "spotifyPreviewUrl" => $response["SPOTIFY_PREVIEW_URL"],
            "type" => $response["TYPE"],
        ];

        $artist = [
            "id" => $response["ARTIST_ID"],
            "name" => $response["NAME"],
        ];

        $cover = [
            "id" => $response["COVER_ID"],  
        ];

        $posterUser = [
            "id" => $response["USER_ID"],
            "username" => $response["USERNAME"],
            "avatar" => $response["SPOTIFY_AVATAR"],
        ];

        $time_ago = $this->timeAgo($response["DATETIME"]);

        $tags = $this->getPostTags($post_id);

        $post = [
            "id" => $response["POST_ID"],
            "timeAgo" => $time_ago,
            "description" => $response["DESCRIPTION"],
            "tags" => $tags,
            "likes" => $response["LIKES"],
            "rating" => $response["RATING"],
            "content" => $content,
            "artist" => $artist,
            "cover" => $cover,
            "user" => $posterUser
        ];

        $userInstance = $this->getCurrentUser();

        $currentUser = [
          "id" => $userInstance->fields["USER_ID"],
          "username" => $userInstance->fields["USERNAME"],
          "avatar" => $userInstance->fields["SPOTIFY_AVATAR"],
        ];

        Renderer::getInstance()->post($post, $currentUser);
    }

    public function getCurrentUser()
    {
        $userRepository = new UserRepository();
    
        // Obtener el usuario actual
        $currUser = $userRepository->getUser("USERNAME", Session::getInstance()->get("username"));

        return $currUser;
    }

    function timeAgo($postDatetimeString) {
        $postDatetime = new DateTime($postDatetimeString);
        $currentDatetime = new DateTime();
        $interval = $postDatetime->diff($currentDatetime);
    
        if ($interval->y > 0) {
            return  "hace " . $interval->y . " año" . ($interval->y > 1 ? "s" : "");
        } elseif ($interval->m > 0) {
            return "hace " . $interval->m . " mes" . ($interval->m > 1 ? "es" : "");
        } elseif ($interval->d > 0) {
            return "hace " . $interval->d . " día" . ($interval->d > 1 ? "s" : "");
        } elseif ($interval->h > 0) {
            return "hace " . $interval->h . " hora" . ($interval->h > 1 ? "s" : "");
        } elseif ($interval->i > 0) {
            return "hace " . $interval->i . " minuto" . ($interval->i > 1 ? "s" : "");
        } else {
            return "hace " . $interval->s . " segundo" . ($interval->s > 1 ? "s" : "");
        }
    }

    private function getPostTags($post_id) {
        $tagController = new TagController();
        $tags = $tagController->getTags($post_id);
        return $tags;
    }

    public function createPost()
    {   
        $postData = json_decode(file_get_contents('php://input'), true);
        error_log('Received POST data: ' . print_r($postData, true));
        
        $postRepository = new PostRepository();
        $response = $postRepository->createPost($postData);

        $postID = $response["post_id"];

        $tagController = new TagController();
        $tagController->createTags($postData["TAGS"], $postID);

        header('Location: /');
        exit; 
    }

}