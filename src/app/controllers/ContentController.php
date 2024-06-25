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
        if($type == "album") {
            $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/albums/".$id, [], ["Authorization" => "Bearer " . $this->access_token]);
            $body = json_decode($response["body"], true);
            $status = $response["status"];
            
            if ($status >= 300) {
                Renderer::getInstance()->internalError();
                die;
            }

            $album = [
                "album_id" => $body["id"],
                "type" => $body["album_type"],
                "artist_name" => $body["artists"][0]["name"],
                "artist_id" => $body["artists"][0]["id"],
                "artist_spotify_url" =>$body["artists"][0]["external_urls"]["spotify"],
                "artist_api_url" => $body["artists"][0]["href"],
                "album_spotify_url" => $body["external_urls"]["spotify"],
                "album_api_url" => $body["href"],
                "images" => $body["images"],
                "album_name" => $body["name"],
                "release_date" => $body["release_date"],
            ];

            $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/artists/".$album["artist_id"], [], ["Authorization" => "Bearer " . $this->access_token]);
            $body = json_decode($response["body"], true);
            $status = $response["status"];

            if ($status >= 300) {
                Renderer::getInstance()->internalError();
                die;
            }

            $album["artist_avatar_url"] = $body["images"][1];

            echo "<pre>";
            var_dump($album);
            die;
    

            return $album;
        }
        
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/tracks/".$id, [], ["Authorization" => "Bearer " . $this->access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];

        $track = [
            "album_id" => $body["album"]["id"],
            "type" => $body["album"]["album_type"],
            "artist_name" => $body["album"]["artists"][0]["name"],
            "artist_id" => $body["album"]["artists"][0]["id"],
            "artist_spotify_url" => $body["album"]["artists"][0]["external_urls"]["spotify"],
            "artist_api_url" => $body["album"]["artists"][0]["href"],
            "album_spotify_url" => $body["album"]["external_urls"]["spotify"],
            "album_api_url" => $body["album"]["href"],
            "images" => $body["album"]["images"],
            "album_name" => $body["album"]["name"],
            "release_date" => $body["album"]["release_date"],
            "track_spotify_url" => $body["external_urls"]["spotify"],
            "track_api_url" => $body["href"],
            "track_id" => $body["id"],
            "track_name" => $body["name"],
            "track_preview_url" => $body["preview_url"],
        ];

        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/artists/" . $track["artist_id"], [], ["Authorization" => "Bearer " . $this->access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];

        
        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }

        $track["artist_avatar_url"] = $body["images"][1];
        
        echo "<pre>";
        var_dump($track);
        die;

        return $track;
    }
    
}
