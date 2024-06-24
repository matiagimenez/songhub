<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class Artist
{
    public $fields = [
        "ARTIST_ID" => null,
        "NAME" => null,
        "AVATAR_URL" => null,
        "SPOTIFY_URL" => null,
        "SPOTIFY_API_URL" => null,
        "SPOTIFY_ID" => null,
    ];

    public function setArtistId($artist_id)
    {
        $this->fields["ARTIST_ID"] = $artist_id;
    }

    public function setName(string $avatar_url)
    {
        $this->fields["AVATAR_URL"] = $avatar_url;
    }

    public function setSpotifyUrl(string $spotify_url)
    {
        $this->fields["SPOTIFY_URL"] = $spotify_url;
    }

    public function setSpotifyApiUrl(string $spotify_api_url)
    {
        $this->fields["SPOTIFY_API_URL"] = $spotify_api_url;
    }

    public function setSpotifyId(string $spotify_id)
    {
        $this->fields["SPOTIFY_ID"] = $spotify_id;
    }

    public function set(array $values)
    {

        foreach (array_keys($this->fields) as $field) {
            $field = trim($field);
            if (!isset($values[$field])) {
                continue;
            }

            $property = explode("_", $field);
            if (count($property) > 1) {
                $method = "set" . ucfirst(strtolower($property[0])) . ucfirst(strtolower($property[1]));

            } else {
                $method = "set" . ucfirst(strtolower($property[0]));
            }

            $this->$method($values[$field]);
        }

    }

}