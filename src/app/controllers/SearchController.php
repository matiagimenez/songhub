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

      $this->access_token = Session::getInstance()->get("access_token");

      $response = HttpClient::getInstance()->get(
          "https://api.spotify.com/v1/search?q=".$query."&type=album%2Cplaylist%2Ctrack%2Cshow%2Cepisode%2Cartist%2Caudiobook&limit=5", 
          [], 
          ["Authorization" => "Bearer " . $this->access_token]
      );
      $body = json_decode($response["body"], true);
      $status = $response["status"];

      $result = [
        'tracks' => $body["tracks"]["items"],
        'albums' => $body["albums"]["items"],
        'artists' => $body["artists"]["items"],
        'playlists' => $body["playlists"]["items"],
        'episodes' => $body["episodes"]["items"],
        'audiobooks' => $body["audiobooks"]["items"]
      ];
      
      ob_clean();
      header('Content-Type: application/json');
      echo json_encode($result);
      die;
    }

}