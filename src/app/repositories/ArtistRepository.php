<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Artist;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class ArtistRepository extends Repository
{
    public $table = "ARTIST";

    public function existsArtist($artist_id) {
        
        $content = $this->queryBuilder->selectByColumn($this->table, "ARTIST_ID", $artist_id);

        if (empty($content)) {
            return false;
        } else {
            return true;
        }
    }

    public function createArtist($artistData) {

        try {
            $artist = new Artist();
            $artist->setArtistId($artistData["ARTIST_ID"]);
            $artist->setName($artistData["NAME"]);
            $artist->setAvatarUrl($artistData["AVATAR_URL"]);
            $artist->setSpotifyUrl($artistData["SPOTIFY_URL"]);
            $artist->setSpotifyApiUrl($artistData["SPOTIFY_API_URL"]);
            
            $this->queryBuilder->insert($this->table, $artist->fields);

            return [true, "Artista registrado con éxito"];
        } catch (InvalidValueException $exception) {
            return [false, $exception->getMessage()];
        } catch (Exception $exception) {
            return [false, "Ocurrió un error durante el registro del artista"];
        }

    }

}
