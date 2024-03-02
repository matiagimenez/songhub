<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;

class AuthController extends Controller
{

    public function login()
    {
        $formData = $_POST;
        echo "<pre>";
        var_dump($formData);
        die;
    }

}