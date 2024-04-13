<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Renderer;
use Songhub\core\Session;

class ExploreController extends Controller
{

    public function explore()
    {
        $access_token = Session::getInstance()->get("access_token");
        echo "User access token: " . $access_token;
        die;

        Renderer::getInstance()->explore();
    }

}