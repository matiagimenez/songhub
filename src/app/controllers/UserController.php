<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\FollowRepository;
use Songhub\app\repositories\PostRepository;
use Songhub\app\repositories\UserRepository;
use Songhub\core\Controller;
use Songhub\core\database\QueryBuilder;
use Songhub\core\Renderer;
use Songhub\core\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = UserRepository::class;
        parent::__construct();
    }

    public function profile()
    {

        $username = Request::getInstance()->getParameter("username", "GET");
        $username = trim($username);
        $user = $this->repository->getUser("USERNAME", $username);

        $queryBuilder = QueryBuilder::getInstance();

        $postRepository = new PostRepository();
        $postRepository->setQueryBuilder($queryBuilder);
        $posts = $postRepository->getPostsFromUser($user->fields["USER_ID"]);

        $followRepository = new FollowRepository();
        $followRepository->setQueryBuilder($queryBuilder);
        $followers = $followRepository->getUserFollowers($user->fields["USER_ID"]);
        $following = $followRepository->getUserFollowing($user->fields["USER_ID"]);

        Renderer::getInstance()->profile($user, $posts, $following, $followers);
    }

    public function edit()
    {
        $title = "Editar perfil";
        $style = "edit-profile";
        require $this->viewsDirectory . "edit-profile.view.php";
    }

    public function createUser()
    {
    }
    public function updateUser()
    {
    }

}