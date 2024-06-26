<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\PostRepository;
use Songhub\core\Controller;
use Songhub\core\Request;
use Songhub\core\Session;
use Songhub\app\repositories\UserRepository;
use Songhub\core\database\QueryBuilder;

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
        $queryBuilder = QueryBuilder::getInstance();
        $userRepository = new UserRepository();
        $userRepository->setQueryBuilder($queryBuilder);
        $username = Session::getInstance()->get("username");
        $user = $userRepository->getUser("USERNAME", $username);
        $postData["USER_ID"] = $user->fields["USER_ID"];
        $postData["DATETIME"] = date("Y-m-d");

        

        $postRepository = new PostRepository();
        $postRepository->createPost($postData);
    }

}