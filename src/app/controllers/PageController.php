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
        require $this->viewsDirectory . "index.view.php";
    }
    public function login()
    {
        require $this->viewsDirectory . "login.view.php";
    }
    public function register()
    {
        require $this->viewsDirectory . "register.view.php";
    }

}