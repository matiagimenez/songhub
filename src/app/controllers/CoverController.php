<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\CoverRepository;
use Songhub\core\Controller;
use Songhub\core\Request;
use Songhub\core\Session;
use Songhub\core\HttpClient;

class CoverController extends Controller
{

    private $access_token = "";

    public function __construct()
    {
        $this->repositoryName = CoverRepository::class;
        parent::__construct();
    }

    public function createCover($content) {

        
        $cover["SMALL_COVER_URL"] = $content["images"][0]["url"];
        $cover["MEDIUM_COVER_URL"] = $content["images"][1]["url"];
        $cover["LARGE_COVER_URL"] = $content["images"][2]["url"];
        
        // ob_clean();
        // header('Content-Type: application/json');
        // echo json_encode($cover);
        // die;

        if(!$this->repository->existsCover($cover["SMALL_COVER_URL"])) {
            $this->repository->createCover($cover);
        }
    }

}