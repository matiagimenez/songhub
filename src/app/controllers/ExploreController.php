<?php

namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Renderer;
use Songhub\core\Session;
use Songhub\core\HttpClient;

class ExploreController extends Controller
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

    public function explore()
    {
        $recommendations = null;
        $userTopTracks = $this->getUserTops();
        $newReleases = $this->getNewReleases();

        //? Valida si se pudo personalizar la recomendación en base a artistas/tracks TOP del usuario, sino recomienda en base a canciones guardadas.
        if (!$this->validSeeds()) {
            $this->getUserSavedTracks();
        }

        //? Valida si se pudo personalizar la recomendación, sino recomienda ultimos lanzamientos (info. más genérica).
        if ($this->validSeeds()) {
            //? Obtiene recomendaciones personalizadas para el usuario
            $recommendations = $this->getRecommendations();

        }
        

        echo "<pre>";
        var_dump($userTopTracks);
        var_dump($newReleases);
        var_dump($recommendations);
        die;

        //TODO: Renderizar explore.view.php
        Renderer::getInstance()->explore();
    }


    private function getUserTops()
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
        
        // TODO: Save data to DB
        return $userTopTracks;
    }

    private function getUserSavedTracks()
    {
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me/tracks?limit=10", [], ["Authorization" => "Bearer " . $this->access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];

        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }

        if (count($body["items"]) > 0) {
            foreach ($body["items"] as $item) {
                $savedTrackId = $item["track"]["id"];
                array_push($this->seeds["tracks"], $savedTrackId);
            }
        }
    }


    private function validSeeds()
    {
        return count($this->seeds["artists"]) > 0 || count($this->seeds["tracks"]) > 0 || count($this->seeds["genres"]) > 0;
    }

    private function getRecommendations()
    {
        /* 
            En primer lugar, debemos armar el seed que usará Spotify para generar las recomendaciones personalizadas de contenido al usuario 
            El tamaño límite del seed es de 5. Por lo tanto, elegí 2 artistas, 2 generos y 1 canción dentro del contenido más escuchado por el usuario.
        */
        $artists = "";
        $genres = "";
        $tracks = count($this->seeds["tracks"]) > 0 ? $this->seeds["tracks"][array_rand($this->seeds["tracks"])] : ""; // Agrega 1 track al seed de recomendaciones

        // Agrega 2 artistas al seed de recomendaciones
        for ($i = 1; $i <= 2; $i++) {
            $randomIndex = array_rand($this->seeds["artists"]);
            $artistId = $this->seeds["artists"][$randomIndex];
            if (strlen($artists) > 0) {
                $artists .= "%2C" . $artistId;
            } else {
                $artists .= $artistId;
            }
        }

        // Agrega 2 géneros al seed de recomendaciones
        for ($i = 1; $i <= 2; $i++) {
            $randomIndex = array_rand($this->seeds["genres"]);
            $genre = $this->seeds["genres"][$randomIndex];
            $words = explode(" ", $genre);
            $genre = "";

            foreach ($words as $word) {
                if (strlen($genre) > 0) {
                    $genre .= "+" . $word;
                } else {
                    $genre .= $word;
                }
            }

            if (strlen($genres) > 0) {
                $genres .= "%2C" . $genre;
            } else {
                $genres .= $genre;
            }
        }

        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/recommendations?seed_artists=$artists&seed_tracks=$tracks&seed_genres=$genres&limit=10", [], ["Authorization" => "Bearer " . $this->access_token]);

        $body = json_decode($response["body"], true);
        $status = $response["status"];

        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }

        $recommendations = [];
        $ids = "";

        if (count($body["tracks"]) > 0) {
            foreach ($body["tracks"] as $track) {
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

                array_push($recommendations, $track);
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
            $recommendations[$i]["artist_avatar_url"] = $body["artists"][$i]["images"][1];
        }
        
        // TODO: Save data to DB
        return $recommendations;
    }

    private function getNewReleases()
    {
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/browse/new-releases", ["limit" => 10], ["Authorization" => "Bearer " . $this->access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];

        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }

        $newReleases = [];
        $ids = "";

        if (count($body["albums"]["items"]) > 0) {
            foreach ($body["albums"]["items"] as $item) {
                $album = [
                    "album_id" => $item["id"],
                    "type" => $item["album_type"],
                    "artist_name" => $item["artists"][0]["name"],
                    "artist_id" => $item["artists"][0]["id"],
                    "artist_spotify_url" => $item["external_urls"]["spotify"],
                    "artist_api_url" => $item["href"],
                    "album_spotify_url" => $item["external_urls"]["spotify"],
                    "album_api_url" => $item["href"],
                    "images" => $item["images"],
                    "album_name" => $item["name"],
                    "release_date" => $item["release_date"],
                ];

                if(strlen($ids) > 0 ){
                    $ids .= "," . $album["artist_id"];
                } else {
                    $ids .= $album["artist_id"];
                }

                array_push($newReleases, $album);
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
            $newReleases[$i]["artist_avatar_url"] = $body["artists"][$i]["images"][1];
        }

        // TODO: Save data to DB
        return $newReleases;
    }
}
