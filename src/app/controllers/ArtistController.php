<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\ArtistRepository;
use Songhub\core\Controller;
use Songhub\core\Request;
use Songhub\core\Session;
use Songhub\core\HttpClient;

class ArtistController extends Controller
{

    private $access_token = "";

    public function __construct()
    {
        $this->repositoryName = ArtistRepository::class;
        parent::__construct();
    }

    public function createArtist($content) {

        
        
        $artist["ARTIST_ID"] = $content["artist_id"];
        $artist["NAME"] = $content["artist_name"];
        $artist["AVATAR_URL"] = $content["artist_avatar_url"];
        $artist["SPOTIFY_URL"] = $content["artist_spotify_url"];
        $artist["SPOTIFY_API_URL"] = $content["artist_api_url"];

        if(!$this->repository->existsArtist($artist["ARTIST_ID"])) {
            $this->repository->createArtist($artist);
        }
    }

}