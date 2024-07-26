<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Renderer;
use Songhub\core\Session;

class PageController extends Controller
{

    public function home()
    {
        Renderer::getInstance()->home();
    }

    public function login()
    {
        Renderer::getInstance()->login();
    }

    public function register()
    {
        Renderer::getInstance()->register();
    }

    public function terms_conditions()
    {
        Renderer::getInstance()->terms_conditions();
    }

    public function edit_password()
    {
        if(is_null(Session::getInstance()->get("access_token"))) {
            $this->login();
            exit;
        }

        Renderer::getInstance()->edit_password();
    }

    
    public function passwordRecovery()
    {
        Renderer::getInstance()->password_recovery("", false);
    }

}