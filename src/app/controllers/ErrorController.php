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
        $error = '404: Page not found';
        require $this->viewsDirectory . "error.view.php";
    }
    public function internalError()
    {
        http_response_code(500);
        $error = '500: Internal server error';
        require $this->viewsDirectory . "error.view.php";
    }

}