<?php
namespace Songhub\App\Controllers;

class PageController
{
    public string $viewsDirectory;

    public function __construct()
    {
        $this->viewsDirectory = __DIR__ . "/../views/";

    }

    public function home()
    {
        $title = "Inicio";
        $style = "home";
        require $this->viewsDirectory . "home.view.php";
    }
    public function login()
    {
        $title = "Iniciar sesión";
        $style = "login";
        require $this->viewsDirectory . "login.view.php";
    }
    public function register()
    {
        $title = "Registrarme";
        $style = "register";
        require $this->viewsDirectory . "register.view.php";
    }

}