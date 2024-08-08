<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class Content
{
    public $fields = [
        "CONTENT_ID" => null, // Id from Spotify
        // "AVERAGE_RATING" => null,
        "RELEASE_DATE" => null,
        "SPOTIFY_ID" => null,
        "SPOTIFY_API_URL" => null,
        "SPOTIFY_URL" => null,
        "SPOTIFY_PREVIEW_URL" => null,
        "TITLE" => null,
        "TYPE" => null,
        "COVER_ID" => null,
        "ARTIST_ID" => null, // Id from Spotify
    ];

    public function setContentId($content_id)
    {
        $this->fields["CONTENT_ID"] = $content_id;
    }

    // public function setAverageRating($average_rating)
    // {
    //     $this->fields["AVERAGE_RATING"] = $average_rating;
    // }

    public function setReleaseDate($release_date)
    {
        $this->fields["RELEASE_DATE"] = $release_date;
    }

    public function setSpotifyId($spotify_id)
    {
        $this->fields["SPOTIFY_ID"] = $spotify_id;
    }

    public function setSpotifyApiUrl($spotify_api_url)
    {
        $this->fields["SPOTIFY_API_URL"] = $spotify_api_url;
    }

    public function setSpotifyUrl($spotify_url)
    {
        $this->fields["SPOTIFY_URL"] = $spotify_url;
    }

    public function setSpotifyPreviewUrl($spotify_preview_url)
    {
        $this->fields["SPOTIFY_PREVIEW_URL"] = $spotify_preview_url;
    }

    public function setTitle($title)
    {
        $this->fields["TITLE"] = $title;
    }

    public function setType($type)
    {
        $this->fields["TYPE"] = $type;
    }

    public function setCoverId($cover_id)
    {
        $this->fields["COVER_ID"] = $cover_id;
    }

    public function setArtistId($artist_id)
    {
        $this->fields["ARTIST_ID"] = $artist_id;
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
            
            // if (count($property) > 1) {
            //     $method = "set" . ucfirst(strtolower($property[0])) . ucfirst(strtolower($property[1]));

            // } else {
            //     $method = "set" . ucfirst(strtolower($property[0]));
            // }

            $this->$method($values[$field]);
        }

    }

}