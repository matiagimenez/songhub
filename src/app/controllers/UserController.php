<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\UserRepository;
use Songhub\core\Controller;

class UserController extends Controller
{
    public ?string $repositoryName = UserRepository::class;

    public function profile()
    {
        $title = "Perfil";
        $style = "profile";
        require $this->viewsDirectory . "profile.view.php";
    }
    public function edit()
    {
        $title = "Editar perfil";
        $style = "edit-profile";
        require $this->viewsDirectory . "edit-profile.view.php";
    }

    public function createUser()
    {
    }
    public function updateUser()
    {
    }

}