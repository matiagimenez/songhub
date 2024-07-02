<?php
namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Renderer;
use Songhub\core\Session;
use Songhub\core\HttpClient;
use Songhub\core\Request;

class SearchController extends Controller
{

    private $access_token = "";

    public function search()
    {
        Renderer::getInstance()->search();
    }
  
    public function searchContent() {

      $query = $this->sanitizeUserInput(Request::getInstance()->getParameter("search", "GET"));
      $offset = $this->sanitizeUserInput(Request::getInstance()->getParameter("offset", "GET"));

      $this->access_token = Session::getInstance()->get("access_token");

      $response = HttpClient::getInstance()->get(
          "https://api.spotify.com/v1/search?q=".$query."&type=album%2Ctrack&limit=10&offset=".$offset, 
          [], 
          ["Authorization" => "Bearer " . $this->access_token]
      );
      $body = json_decode($response["body"], true);
      $status = $response["status"];

      $result = [
        'tracks' => $body["tracks"]["items"],
        'albums' => $body["albums"]["items"]
      ];
      
      ob_clean();
      header('Content-Type: application/json');
      echo json_encode($result);
      die;
    }

}