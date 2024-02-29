<?php
namespace Songhub\App\Controllers;

class AuthController
{

    public function login()
    {
        $formData = $_POST;
        echo "<pre>";
        var_dump($formData);
        die;
    }

}