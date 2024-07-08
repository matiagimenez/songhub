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

    private function getCurrentUserId() {
        return $this -> repository -> getCurrentUserId();
    }
    
    public function addCurrentUserFavoriteContent() {
        $userId = $this -> getCurrentUserId();
        $contentId = $this->sanitizeUserInput(Request::getInstance()->getParameter("id", "GET"));
        $contentType = $this->sanitizeUserInput(Request::getInstance()->getParameter("type", "GET"));

        $result = $this->repository->addCurrentUserFavoriteContent($userId, $contentId, $contentType);
    }

    public function removeCurrentUserFavoriteContent() {
        $userId = $this -> getCurrentUserId();
        $contentId = $this->sanitizeUserInput(Request::getInstance()->getParameter("id", "GET"));


        $result = $this->repository->removeCurrentUserFavoriteContent($userId, $contentId);
    }

    public function getCurrentUserFavoriteContent() {
        $userId = $this -> getCurrentUserId();


        $userFavoriteContent = $this->repository->getCurrentUserFavoriteContent($userId);

        header('Content-Type: application/json');
        echo json_encode($userFavoriteContent);
        exit;
    }

}