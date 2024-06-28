<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\FavoriteRepository;
use Songhub\core\Controller;
use Songhub\core\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = FavoriteRepository::class;
        parent::__construct();
    }    

}