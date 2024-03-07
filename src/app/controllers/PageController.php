<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;

class PageController extends Controller
{

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