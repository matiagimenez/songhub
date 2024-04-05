<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Renderer;
use Songhub\core\Request;

class PageController extends Controller
{

    public function home()
    {
        Renderer::getInstance()->home();
    }
    public function login()
    {
        $redirect = Request::getInstance()->getParameter("redirect");

        if (boolval($redirect)) {
            Renderer::getInstance()->login("Su cuenta fue creada con éxito");
        } else {
            Renderer::getInstance()->login();
        }

    }
    public function register()
    {
        $redirect = Request::getInstance()->getParameter("redirect");

        if (boolval($redirect)) {
            Renderer::getInstance()->register("Ocurrió un error durante el registro.", true);
        } else {
            Renderer::getInstance()->register();
        }

    }
}