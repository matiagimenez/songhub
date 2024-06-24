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
        $postData = Request::getInstance();
        $postRepository = new PostRepository();
        $postRepository->createPost($postData);
    }

}