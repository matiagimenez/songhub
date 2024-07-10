<?php
namespace Songhub\core;

class Renderer
{
    private static $instance;
    public string $viewsDirectory;

    private function __construct()
    {
        $this->viewsDirectory = __DIR__ . "/../app/views/";
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function home()
    {

        $title = "Inicio";
        $style = "home";
        require $this->viewsDirectory . "home.view.php";
    }

    public function login($message = "", $error = false, $email="")
    {
        $title = "Iniciar sesión";
        $style = "login";

        require $this->viewsDirectory . "login.view.php";
    }

    public function register($message = "", $error = false, $currentUserData = null)
    {
        $title = "Registrarme";
        $style = "register";
        require $this->viewsDirectory . "register.view.php";
    }
    
    public function explore($recentActivity, $newReleases, $recommendations, $userTopTracks, $username)
    {
        $title = "Explorar";
        $style = "explore";
        require $this->viewsDirectory . "explore.view.php";
    }

    public function content($content, $mostRelevantPosts)
    {
        $title = $content["type"] ?? "Contenido";
        $style = "content";
        require $this->viewsDirectory . "content.view.php";
    }

    public function notFound()
    {
        http_response_code(404);
        $errorType = '404';
        $errorMessage = "PAGE NOT FOUND";
        $style = "error";
        $title = "404";
        require $this->viewsDirectory . "error.view.php";
    }

    public function internalError()
    {
        http_response_code(500);
        $errorType = '500';
        $errorMessage = 'INTERNAL SERVER ERROR';
        $style = "error";
        $title = "500";
        require $this->viewsDirectory . "error.view.php";
    }

    public function profile($user, $country, $posts, $following, $followers, $favorites)
    {
        $title = "Perfil";
        $style = "profile";
        require $this->viewsDirectory . "profile.view.php";
    }
    
    public function edit($user, $userNationality, $countries, $favorites)
    {
        $title = "Editar perfil";
        $style = "edit-profile";
        require $this->viewsDirectory . "edit-profile.view.php";
    }
    
    public function search()
    {
        $title = "Search";
        $style = "search";
        require $this->viewsDirectory . "search.view.php";
    }
}