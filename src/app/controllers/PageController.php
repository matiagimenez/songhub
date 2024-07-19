<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Renderer;

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
        Renderer::getInstance()->edit_password();
    }

}