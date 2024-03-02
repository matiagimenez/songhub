<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;

class ErrorController extends Controller
{

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

}