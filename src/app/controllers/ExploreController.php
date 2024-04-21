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
        //? Obtiene TOP de artistas escuchados por el usuario
        $this->getUserTops();


        //? Valida si se pudo personalizar la recomendación en base a artistas/tracks TOP del usuario, sino recomienda en base a canciones guardadas.
        if (!$this->validSeeds()) {
            $this->getUserSavedTracks();
        }

        //? Valida si se pudo personalizar la recomendación, sino recomienda ultimos lanzamientos (info. más genérica).
        if ($this->validSeeds()) {
            //? Obtiene recomendaciones personalizadas para el usuario
            $recommendations = $this->getRecommendations();

            //TODO: Renderizar explore.view.php
        } else {
            //? Recomendamos nuevos lanzamientos al usuario
            $recommendations = $this->getNewReleases();
            //TODO: Renderizar explore.view.php

        }
        Renderer::getInstance()->explore();
    }


    private function getUserTops()
    {
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me/top/artists", ["time_range" => "short_term", "limit" => 2], ["Authorization" => "Bearer " . $this->access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];

        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }

        if (count($body["items"]) > 0) {
            foreach ($body["items"] as $artist) {
                $topArtistId = $artist["id"];
                $topArtistGenre = $artist["genres"][0];
                array_push($this->seeds["artists"], $topArtistId);
                array_push($this->seeds["genres"], $topArtistGenre);
            }
        }

        //? Obtiene TOP de tracks escuchados por el usuario
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me/top/tracks", ["time_range" => "short_term", "limit" => 1], ["Authorization" => "Bearer " . $this->access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];

        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }

        if (count($body["items"]) > 0) {
            foreach ($body["items"] as $track) {
                $topTrackId = $track["id"];
                array_push($this->seeds["tracks"], $topTrackId);
            }
        }
    }

    private function getUserSavedTracks()
    {
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me/tracks?limit=5", [], ["Authorization" => "Bearer " . $this->access_token]);
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
        $artists = "";
        $genres = "";
        $tracks = count($this->seeds["tracks"]) > 0 ? $this->seeds["tracks"][0] : "";

        foreach ($this->seeds["artists"] as $artistId) {
            if (strlen($artists) > 0) {
                $artists .= "%2C" . $artistId;
            } else {
                $artists .= $artistId;
            }
        }

        foreach ($this->seeds["genres"] as $genre) {
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

        //TODO: Retornar solo info necesaria de los tracks
        return $body["tracks"];
    }

    private function getNewReleases()
    {
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/browse/new-releases", ["limit", 10], ["Authorization" => "Bearer " . $this->access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];

        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }

        //TODO: Retornar solo info necesaria de los albums
        return $body["albums"];
    }
}
