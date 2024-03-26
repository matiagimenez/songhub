<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\CommentRepository;
use Songhub\core\Controller;
use Songhub\core\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = CommentRepository::class;
        parent::__construct();
    }

    

}