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
        $template = $this->templateLoader->load('login.twig');
        echo $template->render(['title' => 'Iniciar sesión', 'style' => 'login', "show_footer" => false, "show_header" => false, "error" => $error, "message" => $message, "email" => $email]);
    }

    public function register($message = "", $error = false, $currentUserData = null)
    {
        $template = $this->templateLoader->load('register.twig');
        echo $template->render(['title' => 'Registrarme', 'style' => 'register', "show_footer" => false, "show_header" => false, "error" => $error, "message" => $message, "currentUserData" => $currentUserData]);
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
            'show_footer' => true, 
            "show_header" => true
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
        echo $template->render(['message' => $message,'type' => $type, 'title' => 'Not found', 'style' => 'error', "show_footer" => true, "show_header" => false, "username" => $username]);
    }

    public function internalError()
    {
        http_response_code(500);
        $type = '500';
        $message = 'INTERNAL SERVER ERROR';
        $username = $this->getUsername();

        $template = $this->templateLoader->load('error.twig');
        echo $template->render(['message' => $message,'type' => $type, 'title' => 'Server error', 'style' => 'error', "show_footer" => true, "show_header" => false, "username" => $username]);
    }
    
    public function terms_conditions()
    {
        $username = $this->getUsername();

        $template = $this->templateLoader->load('terms-conditions.twig');
        echo $template->render(['title' => 'Términos y condiciones', 'style' => 'terms-conditions', "show_header" => true, "show_footer" => true, "username" => $username]);
    }
    

    public function profile($user, $country, $posts, $following, $followers, $favorites, $message)
    {
        $title = "Perfil";
        $style = "profile";
        $username = $this->getUsername();

        $template = $this->templateLoader->load('profile.twig');

        echo $template->render([
            'title' => $title,
            'style' => $style,
            'country' => $country,
            'posts' => $posts,
            'user' => $user,
            'username' => $username,
            'following' => $following,
            'followers' => $followers,
            'favorites' => $favorites,
            'message' => $message,
            'show_footer' => false, 
            "show_header" => false
        ]);

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