<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class Favorite
{
    public $fields = [
        "CONTENT_ID" => null,
        "USER_ID" => null,
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
            if (count($property) > 1) {
                $method = "set" . ucfirst(strtolower($property[0])) . ucfirst(strtolower($property[1]));

            } else {
                $method = "set" . ucfirst(strtolower($property[0]));
            }

            $this->$method($values[$field]);
        }

    }

}