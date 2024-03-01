<?php
namespace Songhub\App\Controllers;

class ErrorController
{
    public string $viewsDirectory;

    public function __construct()
    {
        $this->viewsDirectory = __DIR__ . "/../views/";

    }

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