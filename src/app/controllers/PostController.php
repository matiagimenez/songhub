<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\PostRepository;
use Songhub\core\Controller;
use Songhub\core\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = PostRepository::class;
        parent::__construct();
    }

    public function createPost()
    {   
        $postData = json_decode(file_get_contents('php://input'), true);
        error_log('Received POST data: ' . print_r($postData, true));
        $postRepository = new PostRepository();
        $postRepository->createPost($postData);
    }

}