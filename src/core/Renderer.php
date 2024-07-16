<?php
namespace Songhub\core;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;


class Renderer
{
    private static $instance;
    public string $viewsDirectory;
    private Environment $templateLoader;

    private function __construct()
    {
        $this->viewsDirectory = __DIR__ . "/../app/views/";
        $loader = new FilesystemLoader(__DIR__."/../app/views/");
        $this -> templateLoader = new Environment($loader, [
            'cache' => __DIR__."/../../cache/twig",
        ]);
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

        $template = $this->templateLoader->load('explore.twig');

        echo $template->render([
            'title' => $title,
            'style' => $style,
            'username' => $username,
            'recentActivity' => $recentActivity,
            'recommendations' => $recommendations,
            'userTopTracks' => $userTopTracks,
            'newReleases' => $newReleases,
            'show_footer' => false
        ]);
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
        $type = '404';
        $message = "RESOURCE NOT FOUND";
        $username = $this->getUsername();

        $template = $this->templateLoader->load('error.twig');
        echo $template->render(['message' => $message,'type' => $type, 'title' => 'Not found', 'style' => 'error', "show_footer" => true, "username" => $username]);
    }

    public function internalError()
    {
        http_response_code(500);
        $type = '500';
        $message = 'INTERNAL SERVER ERROR';
        $username = $this->getUsername();

        $template = $this->templateLoader->load('error.twig');
        echo $template->render(['message' => $message,'type' => $type, 'title' => 'Server error', 'style' => 'error', "show_footer" => true, "username" => $username]);
    }
    

    public function profile($user, $country, $posts, $following, $followers, $favorites, $message)
    {
        $title = "Perfil";
        $style = "profile";
        require $this->viewsDirectory . "profile.view.php";
    }
    
    public function edit($user, $userNationality, $countries, $favorites, $message)
    {
        $title = "Editar perfil";
        $style = "edit-profile";
        require $this->viewsDirectory . "edit-profile.view.php";
    }

    private function isAuthenticated () {
        return Session::getInstance()->exists("username");
    } 

    private function getUsername () {        
        $is_authenticated = $this->isAuthenticated();
        $username = null;

        if($is_authenticated) {
            $username = Session::getInstance()->get("username");
        }
        
        return $username;
    } 
}