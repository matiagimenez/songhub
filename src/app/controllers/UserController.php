<?php

namespace Songhub\App\Controllers;

use Songhub\app\repositories\FollowRepository;
use Songhub\app\repositories\PostRepository;
use Songhub\app\repositories\UserRepository;
use Songhub\core\Controller;
use Songhub\core\database\QueryBuilder;
use Songhub\core\Renderer;
use Songhub\core\Request;
use Songhub\core\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = UserRepository::class;
        parent::__construct();
    }

    public function profile()
    {

        $username = $this->sanitizeUserInput(Request::getInstance()->getParameter("username", "GET"), FILTER_SANITIZE_EMAIL);

        $user = $this->repository->getUser("USERNAME", $username);

        $posts = $this -> repository->getUserPosts($user->fields["USER_ID"]);
        $stats = $this -> repository->getUserAccountStats($user->fields["USER_ID"]);

        Renderer::getInstance()->profile($user, $posts, $stats["following"], $stats["followers"]);
    }

    public function edit()
    {

        $username = Session::getInstance()->get("username");
        $user = $this->repository->getUser("USERNAME", $username);

        Renderer::getInstance()->edit($user);
    }
    
    public function updateUser()
    {
    }
}
