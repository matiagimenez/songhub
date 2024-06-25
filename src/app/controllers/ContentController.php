<?php

namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Renderer;
use Songhub\core\Request;
use Songhub\core\Session;
use Songhub\core\HttpClient;

class ContentController extends Controller
{

    private $access_token = "";
    private $seeds = null;
    private $recommendations = null;

    public function __construct()
    {
        $this->access_token = Session::getInstance()->get("access_token");

        //? Este array contiene información que sirve a modo de seed para solicitar las recomendaciones a Spotify API. Límite de contenido de seed = 5
        $this->seeds = [
            "tracks" => [],
            "artists" => [],
            "genres" => []
        ];
    }

    public function content()
    {
        $id = Request::getInstance() -> getParameter("id");
        $type = Request::getInstance() -> getParameter("type");
        $content = $this->fetchContentData($id, $type);

        Renderer::getInstance()->content($content);
    }


    private function fetchContentData($id, $type)
    {
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me/top/artists", ["time_range" => "short_term", "limit" => 10], ["Authorization" => "Bearer " . $this->access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];

        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }


        if (count($body["items"]) > 0) {
            foreach ($body["items"] as $artist) {
                $topArtistId = $artist["id"];
                array_push($this->seeds["artists"], $topArtistId);
        
                foreach ($artist["genres"] as $genre) {
                    array_push($this->seeds["genres"], $genre);
                }
            }
        }

        //? Obtiene TOP de tracks escuchados por el usuario
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me/top/tracks", ["time_range" => "short_term", "limit" => 10], ["Authorization" => "Bearer " . $this->access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];

        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }

        $userTopTracks = [];

        $ids = "";

        if (count($body["items"]) > 0) {
            foreach ($body["items"] as $track) {
                $topTrackId = $track["id"];
                array_push($this->seeds["tracks"], $topTrackId);
                $track = [
                    "album_id" => $track["album"]["id"],
                    "type" => $track["album"]["album_type"],
                    "artist_name" => $track["album"]["artists"][0]["name"],
                    "artist_id" => $track["album"]["artists"][0]["id"],
                    "artist_spotify_url" => $track["album"]["artists"][0]["external_urls"]["spotify"],
                    "artist_api_url" => $track["album"]["artists"][0]["href"],
                    "album_spotify_url" => $track["album"]["external_urls"]["spotify"],
                    "album_api_url" => $track["album"]["href"],
                    "images" => $track["album"]["images"],
                    "album_name" => $track["album"]["name"],
                    "release_date" => $track["album"]["release_date"],
                    "track_spotify_url" => $track["external_urls"]["spotify"],
                    "track_api_url" => $track["href"],
                    "track_id" => $track["id"],
                    "track_name" => $track["name"],
                    "track_preview_url" => $track["preview_url"],
                ];

                if(strlen($ids) > 0 ){
                    $ids .= "," . $track["artist_id"];
                } else {
                    $ids .= $track["artist_id"];
                }

                array_push($userTopTracks, $track);
                
            }
        }
        
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/artists", ["ids" => $ids], ["Authorization" => "Bearer " . $this->access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];
        
        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }
        
        for($i = 0; $i < count($body["artists"]); $i++){
            $userTopTracks[$i]["artist_avatar_url"] = $body["artists"][$i]["images"][1];
        }
        
        return $userTopTracks;
    }
    
}
