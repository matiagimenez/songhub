<?php
namespace Songhub\App\Controllers;

class ErrorController
{
    public string $viewsDirectory;

    public function __construct()
    {
        $this->viewsDirectory = __DIR__ . "/../views/";

    }

    public function not_found()
    {
        http_response_code(404);
        $error = '404: Page Not Found';
        require $this->viewsDirectory . "error.view.php";
    }

}