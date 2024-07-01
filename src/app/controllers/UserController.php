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

    public function profile($user = null)
    {
        if(!$user){
            $username = $this->sanitizeUserInput(Request::getInstance()->getParameter("username", "GET"));
            $user = $this->repository->getUser("USERNAME", $username);
        }

        $country = $this->repository->getUserNationality($user->fields["COUNTRY_ID"]);

        $posts = $this -> repository->getUserPosts($user->fields["USER_ID"]);
        $postsCount = $this -> repository->getUserPostsCount($user->fields["USER_ID"]);
        $stats = $this -> repository->getUserAccountStats($user->fields["USER_ID"]);

        Renderer::getInstance()->profile($user, $country, $posts, $stats["following"], $stats["followers"]);
    }

    public function edit()
    {
        $username = Session::getInstance()->get("username");
        $user = $this->repository->getUser("USERNAME", $username);

        $country = $this->repository->getUserNationality($user->fields["COUNTRY_ID"]);
        $availableCountries = $this->repository->getAvailableCountries();

        Renderer::getInstance()->edit($user, $country, $availableCountries);
    }
    
    public function updateUser()
    {
        $username = $this->sanitizeUserInput(Request::getInstance()->getParameter("username", "POST"));
        $name = $this->sanitizeUserInput(Request::getInstance()->getParameter("name", "POST"));
        $country = $this->sanitizeUserInput(Request::getInstance()->getParameter("country", "POST"));
        $biography = $this->sanitizeUserInput(Request::getInstance()->getParameter("biography", "POST"));

        $data = [
            "NAME" => $name,
            "BIOGRAPHY" => $biography,
            "COUNTRY_ID" => $country
        ];

        $result = $this -> repository -> updateUser("USERNAME", $username, $data);

        if(!$result[0]){
            Renderer::getInstance()->internalError();
        }

        $user = $this->repository->getUser("USERNAME", $username);

        $this->profile($user);
    }
}
