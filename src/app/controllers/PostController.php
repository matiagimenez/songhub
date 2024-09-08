<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Request;
use Songhub\core\Renderer;
use Songhub\core\Session;
use Songhub\app\repositories\PostRepository;
use Songhub\app\repositories\CommentRepository;
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

        if(is_null(Session::getInstance()->get("access_token"))) {
            Renderer::getInstance()->login();
            exit;
        }

        $post_id = $this->sanitizeUserInput(Request::getInstance()->getParameter("id", "GET"));
        $userInstance = $this->getCurrentUser();
        
        $response = $this->repository->getPost($post_id, $userInstance->fields["USER_ID"]);
        
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
        
        $date = $this->formatDate($response["DATETIME"]);
        
        $tags = $this->getPostTags($post_id);
        
        $comments = $this->getPostComments($post_id);
        
        $post = [
            "id" => $response["POST_ID"],
            "date" => $date,
            "description" => $response["DESCRIPTION"],
            "tags" => $tags,
            "likes" => $response["LIKES"],
            "rating" => $response["RATING"],
            "content" => $content,
            "artist" => $artist,
            "cover" => $cover,
            "user" => $posterUser,
            "comments" => $comments,
            "liked" => $response["LIKED"] ?? false
        ];

        $currentUser = [
          "id" => $userInstance->fields["USER_ID"],
          "username" => $userInstance->fields["USERNAME"],
          "avatar" => $userInstance->fields["SPOTIFY_AVATAR"],
        ];

        Renderer::getInstance()->post($post, $currentUser);
    }

    private function getPostComments($post_id)
    {
        $commentRepository = new CommentRepository();
        $comments = $commentRepository->getComments($post_id);

        $userRepository = new UserRepository();
        $response = [];
        foreach ($comments as $comment)
        {
            $user = $userRepository->getUser("USER_ID", $comment["USER_ID"]);

            $commentUser = [
                "id" => $user->fields["USER_ID"],
                "username" => $user->fields["USERNAME"],
                "avatar" => $user->fields["SPOTIFY_AVATAR"]
            ];
            
            $time_ago = $this->timeAgo($comment["DATETIME"]);

            $commentData = [
                "id" => $comment["COMMENT_ID"],
                "text" => $comment["TEXT"],
                "datetime" => $time_ago,
                "likes" => $comment["LIKES"],
                "user" => $commentUser,
                "liked" => $comment["LIKED"]
            ];
            array_push($response, $commentData);
        }
        return $response;
    }

    public function getCurrentUser()
    {
        $userRepository = new UserRepository();
    
        // Obtener el usuario actual
        $currUser = $userRepository->getUser("USERNAME", Session::getInstance()->get("username"));

        return $currUser;
    }

    private function timeAgo($postDatetimeString) {
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

    private function formatDate($dateStr) {
        $date = new DateTime($dateStr);
        $meses = [
            1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];
        $dia = $date->format('d');
        $mes = $meses[(int)$date->format('m')];
        $anio = $date->format('Y');
        return $dia . ' de ' . $mes . ' de ' . $anio;
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

    public function feed()
    {
        if(is_null(Session::getInstance()->get("access_token"))) {
            Renderer::getInstance()->home(false);
            exit;
        }

        $user = $this->getCurrentUser();

        $posts = $this->repository->getUserFeedPosts($user->fields["USER_ID"]);

        Renderer::getInstance()->home(true, $posts);
    }

    public function getMoreUserFeedPosts() {
        $page = $this->sanitizeUserInput(Request::getInstance()->getParameter("page", "GET"));
        $page = (is_numeric($page) && $page > 0) ? (int)$page : 0;

        if(is_null(Session::getInstance()->get("access_token"))) {
            Renderer::getInstance()->login();
            exit;
        }

        $user = $this->getCurrentUser();

        $posts = $this->repository->getUserFeedPosts($user->fields["USER_ID"], $page);

        
        ob_clean();
        header('Content-Type: application/json');
        echo json_encode($posts);
        exit;
    }

    public function getMoreUserProfilePosts() {
        $page = $this->sanitizeUserInput(Request::getInstance()->getParameter("page", "GET"));
        $page = (is_numeric($page) && $page > 0) ? (int)$page : 0;

        if(is_null(Session::getInstance()->get("access_token"))) {
            Renderer::getInstance()->login();
            exit;
        }

        $user = $this->getCurrentUser();

        $posts = $this->repository->getPostsFromUser($user->fields["USER_ID"], $page);
        
        ob_clean();
        header('Content-Type: application/json');
        echo json_encode($posts);
        exit;
    }

    public function likePost()
    {
        $currentUser = $this->getCurrentUser();
        $postData = json_decode(file_get_contents("php://input"), true);
        $post_id = $this->sanitizeUserInput($postData['post_id'] ?? null);
        $this->repository->likePost($post_id, $currentUser->fields["USER_ID"]);
    }

}