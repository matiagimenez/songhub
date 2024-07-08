<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Renderer;

class ErrorController extends Controller
{

    public function notFound()
    {
        Renderer::getInstance()->notFound();
    }
    
    public function internalError()
    {
        Renderer::getInstance()->internalError();

    }

}