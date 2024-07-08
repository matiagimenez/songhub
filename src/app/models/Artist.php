<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class Artist
{
    public $fields = [
        "ARTIST_ID" => null, // ID from spotify
        "NAME" => null,
        "AVATAR_URL" => null,
        "SPOTIFY_URL" => null,
        "SPOTIFY_API_URL" => null
    ];

    public function setArtistId($artist_id)
    {
        $this->fields["ARTIST_ID"] = $artist_id;
    }

    public function setName(string $name)
    {
        $this->fields["NAME"] = $name;
    }
    
    public function setAvatarUrl(string $avatar_url)
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

    public function set(array $values)
    {

        foreach (array_keys($this->fields) as $field) {
            $field = trim($field);
            if (!isset($values[$field])) {
                continue;
            }

            $property = explode("_", $field);
            $method = "set";

            foreach ($property as $part) {
                $method .= ucfirst(strtolower($part));
            }

            $this->$method($values[$field]);
        }

    }

}