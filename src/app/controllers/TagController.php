<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\TagRepository;
use Songhub\core\Controller;
use Songhub\core\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = TagRepository::class;
        parent::__construct();
    }

    

}