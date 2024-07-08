<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class Favorite
{
    public $fields = [
        "USER_ID" => null,
        "CONTENT_ID" => null,
    ];

    public function setUserId($user_id)
    {
        $this->fields["USER_ID"] = $user_id;
    }
    
    public function setContentId($content_id)
    {
        $this->fields["CONTENT_ID"] = $content_id;
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