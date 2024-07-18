<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\FollowRepository;
use Songhub\core\Controller;
use Songhub\core\Request;
use Songhub\core\Renderer;


class FollowController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = FollowRepository::class;
        parent::__construct();
    }

    public function followers()
    {
        Renderer::getInstance()->followers();
    }

    public function following()
    {
        Renderer::getInstance()->following();
    }
}