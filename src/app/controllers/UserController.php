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

    public function profile($user = null, $message = "")
    {
        if(is_null(Session::getInstance()->get("access_token"))) {
            Renderer::getInstance()->login();
            exit;
        }

        if(!$user){
            $username = $this->sanitizeUserInput(Request::getInstance()->getParameter("username", "GET"));
            $user = $this->repository->getUser("USERNAME", $username);
        }

        $country = $this->repository->getUserNationality($user->fields["COUNTRY_ID"]);

        $posts = $this -> repository->getUserPosts($user->fields["USER_ID"]);
        $postsCount = $this -> repository->getUserPostsCount($user->fields["USER_ID"]);
        $stats = $this -> repository->getUserAccountStats($user->fields["USER_ID"]);

        $favorites = $this -> repository->getUserFavorites($user->fields["USER_ID"]);

        Renderer::getInstance()->profile($user, $country, $posts, $stats["following"], $stats["followers"], $favorites, $message);
    }

    public function visit($user = null, $message = "")
    {
        if(is_null(Session::getInstance()->get("access_token"))) {
            Renderer::getInstance()->login();
            exit;
        }

        if(!$user){
            $username = $this->sanitizeUserInput(Request::getInstance()->getParameter("username", "GET"));

            $user = $this->repository->getUserVisit("USERNAME", $username);
        }

        $country = $this->repository->getUserNationality($user->fields["COUNTRY_ID"]);

        $posts = $this -> repository->getUserPosts($user->fields["USER_ID"]);
        $postsCount = $this -> repository->getUserPostsCount($user->fields["USER_ID"]);
        $stats = $this -> repository->getUserAccountStats($user->fields["USER_ID"]);

        $favorites = $this -> repository->getUserFavorites($user->fields["USER_ID"]);

        Renderer::getInstance()->profile($user, $country, $posts, $stats["following"], $stats["followers"], $favorites, $message);
    }

    public function edit($message = "")
    {
        if(is_null(Session::getInstance()->get("access_token"))) {
            Renderer::getInstance()->login();
            exit;
        }
        
        $username = Session::getInstance()->get("username");
        $user = $this->repository->getUser("USERNAME", $username);

        $country = $this->repository->getUserNationality($user->fields["COUNTRY_ID"]);
        $availableCountries = $this->repository->getAvailableCountries();

        $favorites = $this -> repository->getUserFavorites($user->fields["USER_ID"]);

        Renderer::getInstance()->edit($user, $country, $availableCountries, $favorites, $message);
    }

    public function edit_password() {
        $username = Session::getInstance()->get("username");
        $oldPassword = $this->sanitizeUserInput(Request::getInstance()->getParameter("old-password", "POST"));
        $newPassword = $this->sanitizeUserInput(Request::getInstance()->getParameter("new-password", "POST"));
        $newPasswordConfirmation = $this->sanitizeUserInput(Request::getInstance()->getParameter("new-password-confirmation", "POST"));

        $data = [
            "OLD_PASSWORD" => $oldPassword,
            "NEW_PASSWORD" => $newPassword,
            "NEW_PASSWORD_CONFIRMATION" =>  $newPasswordConfirmation,
        ];

        list($status, $message) = $this -> repository -> updateUserPassword("USERNAME", $username, $data);

        if(!$status){
            Renderer::getInstance()->edit_password($message);
            exit;
        }
        

        $user = $this->repository->getUser("USERNAME", $username);

        $this->profile($user, $message);
    }   
    
    
    public function updateUser()
    {
        $username = Session::getInstance()->get("username");
        $name = $this->sanitizeUserInput(Request::getInstance()->getParameter("name", "POST"));
        $country = $this->sanitizeUserInput(Request::getInstance()->getParameter("country", "POST"));
        $biography = $this->sanitizeUserInput(Request::getInstance()->getParameter("biography", "POST"));

        $data = [
            "NAME" => $name,
            "BIOGRAPHY" => $biography,
            "COUNTRY_ID" => $country
        ];

        list($status, $message) = $this -> repository -> updateUser("USERNAME", $username, $data);

        if(!$status){
            $this->edit($message);
            exit;
        }

        $user = $this->repository->getUser("USERNAME", $username);

        $this->profile($user, "Tu perfil fue actualizado con éxito");
    }

    public function searchProfiles()
    {
        $username = $this->sanitizeUserInput(Request::getInstance()->getParameter("username", "GET"));
        $offset = $this->sanitizeUserInput(Request::getInstance()->getParameter("offset", "GET"));
        
        $users = $this->repository->searchProfiles($username, $offset);
        
        ob_clean();
        header('Content-Type: application/json');
        echo json_encode($users);
        exit;
    }
}
