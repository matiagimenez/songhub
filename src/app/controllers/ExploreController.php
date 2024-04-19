<?php

namespace Songhub\App\Controllers;

use Songhub\core\Controller;
use Songhub\core\Renderer;
use Songhub\core\Session;
use Songhub\core\HttpClient;

class ExploreController extends Controller
{

    public function explore()
    {
        $access_token = Session::getInstance()->get("access_token");

        //? Este array contiene información que sirve a modo de seed para solicitar las recomendaciones a Spotify API. Límite de contenido de seed = 5
        $seeds = [
            "tracks" => [],
            "artists" => [],
            "genres" => []
        ];

        //? Obtiene TOP de artistas escuchados por el usuario
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me/top/artists", ["time_range" => "short_term", "limit" => 2], ["Authorization" => "Bearer " . $access_token]);
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
                array_push($seeds["artists"], $topArtistId);
                array_push($seeds["genres"], $topArtistGenre);
            }
        }

        //? Obtiene TOP de tracks escuchados por el usuario
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me/top/tracks", ["time_range" => "short_term", "limit" => 1], ["Authorization" => "Bearer " . $access_token]);
        $body = json_decode($response["body"], true);
        $status = $response["status"];

        if ($status >= 300) {
            Renderer::getInstance()->internalError();
            die;
        }

        if (count($body["items"]) > 0) {
            foreach ($body["items"] as $track) {
                $topTrackId = $track["id"];
                array_push($seeds["tracks"], $topTrackId);
            }
        }

        $seeds = [
            "tracks" => [],
            "artists" => [],
            "genres" => []
        ];
        //? Valida si se pudo personalizar la recomendación, sino recomienda ultimos lanzamientos (info. más genérica).
        if (count($seeds["artists"]) > 0 || count($seeds["tracks"]) > 0) {
            //? Obtiene recomendaciones personalizadas para el usuario
            $artists = "";
            $genres = "";
            $tracks = count($seeds["tracks"]) > 0 ? $seeds["tracks"][0] : "";

            foreach ($seeds["artists"] as $artistId) {
                if (strlen($artists) > 0) {
                    $artists .= "%2C" . $artistId;
                } else {
                    $artists .= $artistId;
                }
            }

            foreach ($seeds["genres"] as $genre) {
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

            $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/recommendations?seed_artists=$artists&seed_tracks=$tracks&seed_genres=$genres&limit=10", [], ["Authorization" => "Bearer " . $access_token]);
            $body = json_decode($response["body"], true);
            $status = $response["status"];

            if ($status >= 300) {
                Renderer::getInstance()->internalError();
                die;
            }

            // echo "<pre>";
            // var_dump($body["tracks"]);
            // die;
        } else {
            //? Recomendamos nuevos lanzamientos al usuario
            $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/browse/new-releases", ["limit", 10], ["Authorization" => "Bearer " . $access_token]);
            $body = json_decode($response["body"], true);
            $status = $response["status"];
            // echo "<pre>";
            // var_dump($body["albums"]);
            // die;
        }
        Renderer::getInstance()->explore();
    }
}
