<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\FollowRepository;
use Songhub\app\repositories\UserRepository;
use Songhub\core\Controller;
use Songhub\core\Request;
use Songhub\core\Renderer;
use Songhub\core\Session;


class FollowController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = FollowRepository::class;
        parent::__construct();
    }

    public function followers()
    {
        Renderer::getInstance()->followers();
    }

    public function following()
    {
        Renderer::getInstance()->following();
    }

    public function follow()
    {
        $user = $this->sanitizeUserInput(Request::getInstance()->getParameter("user", "GET"));
        $userRepository = new UserRepository();
        // $userRepository->setQueryBuilder(QueryBuilder::getInstance());
        $currUser = $userRepository->getUser("USERNAME", Session::getInstance()->get("username"));
        $followData = ["FOLLOWER_ID" => $currUser->fields["USER_ID"], "FOLLOWED_ID" => $user];
        $this->repository->createFollow($followData);
        // $this->renderProfile("getUser", null, "Siguiendo");
    }
}