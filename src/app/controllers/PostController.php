<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\PostRepository;
use Songhub\core\Controller;
use Songhub\core\Request;
use Songhub\core\Renderer;
use Songhub\app\controllers\TagController;

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

        $post = [
            "id" => $response["POST_ID"],
            "datetime" => $response["DATETIME"],
            "description" => $response["DESCRIPTION"],
            "likes" => $response["LIKES"],
            "rating" => $response["RATING"],
            "content" => $content,
            "artist" => $artist,
            "cover" => $cover,
            "user" => $posterUser
        ];

        Renderer::getInstance()->post($post);
    }

    public function createPost()
    {   
        $postData = json_decode(file_get_contents('php://input'), true);
        error_log('Received POST data: ' . print_r($postData, true));
        
        $postRepository = new PostRepository();
        $response = $postRepository->createPost($postData);

        $postID = $response["post_id"];

        $tagController = new TagController();
        // TODO:
        //   Recuperar El ID del Post
        $tagController->createTags($postData["TAGS"], $postID);
    }

}