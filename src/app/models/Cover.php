<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class Cover
{
    public $fields = [
        "COVER_ID" => null,
        "SMALL_COVER_URL" => null,
        "MEDIUM_COVER_URL" => null,
        "LARGE_COVER_URL" => null,
    ];

    public function setCoverId($cover_id)
    {
        $this->fields["COVER_ID"] = $cover_id;
    }

    public function setSmallCoverUrl($small_cover_url)
    {  
      $this->fields["SMALL_COVER_URL"] = $small_cover_url;
    }

    public function setMediumCoverUrl($medium_cover_url)
    {  
      $this->fields["MEDIUM_COVER_URL"] = $medium_cover_url;
    }

    public function setLargeCoverUrl($large_cover_url)
    {  
      $this->fields["LARGE_COVER_URL"] = $large_cover_url;
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