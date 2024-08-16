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
        if(is_null(Session::getInstance()->get("access_token"))) {
            Renderer::getInstance()->login();
            exit;
        }

        $username = $this->sanitizeUserInput(Request::getInstance()->getParameter("username", "GET"));
        
        $userRepository = new UserRepository();
        $user = $userRepository->getUser("USERNAME", $username);

        $followers = $this->repository->getUserFollowers($user -> fields["USER_ID"]);

        Renderer::getInstance()->followers($followers, $username);
    }

    public function following()
    {
        if(is_null(Session::getInstance()->get("access_token"))) {
            Renderer::getInstance()->login();
            exit;
        }

        $username = $this->sanitizeUserInput(Request::getInstance()->getParameter("username", "GET"));
        
        $userRepository = new UserRepository();
        $user = $userRepository->getUser("USERNAME", $username);

        $following = $this->repository->getUserFollowing($user -> fields["USER_ID"]);

        Renderer::getInstance()->following($following, $username);
    }

    public function follow()
    {
        $followedUserID = $this->sanitizeUserInput(Request::getInstance()->getParameter("user", "GET"));
        $userRepository = new UserRepository();
        
        // Obtener el usuario seguido
        $followedUser = $userRepository->getUser("USER_ID", $followedUserID);
        
        // Verificar si el usuario seguido existe
        if (!$followedUser) {
            Request::sendResponse(404, "Usuario seguido no encontrado");
            return;
        }
    
        // Obtener el usuario actual
        $currUser = $userRepository->getUser("USERNAME", Session::getInstance()->get("username"));
        
        // Preparar los datos para el seguimiento
        $followData = [
            "FOLLOWER_ID" => $currUser->fields["USER_ID"],
            "FOLLOWED_ID" => $followedUser->fields["USER_ID"] // Usar el ID del usuario seguido
        ];
        
        // Crear el seguimiento
        $success = $this->repository->createFollow($followData);
    
        if ($success) {
            Request::sendResponse(200, "Follow registrado", [
                "user_id" => $followData["FOLLOWED_ID"]
            ]);
        } else {
            Request::sendResponse(500, "Error al registrar el follow");
        }
    }    
    
    public function unfollow()
    {
        $unfollowedUserID = $this->sanitizeUserInput(Request::getInstance()->getParameter("user", "GET"));
        $userRepository = new UserRepository();

        // Obtener el usuario
        $unfollowedUser = $userRepository->getUser("USER_ID", $unfollowedUserID);
        
        // Verificar si el usuario existe
        if (!$unfollowedUser) {
            Request::sendResponse(404, "Usuario no encontrado");
            return;
        }

        $currUser = $userRepository->getUser("USERNAME", Session::getInstance()->get("username"));
        $unfollowData = ["FOLLOWER_ID" => $currUser->fields["USER_ID"], "FOLLOWED_ID" => $unfollowedUserID];
        $success = $this->repository->deleteFollow($unfollowData);

        if ($success) {
            Request::sendResponse(200, "Se eliminó el follow correctamente", [
                "user_id" => $unfollowData["FOLLOWED_ID"]
            ]);
        } else {
            Request::sendResponse(500, "Error al dejar de seguir al usuario");
        }
    }
}