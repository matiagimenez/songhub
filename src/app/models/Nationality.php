<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class Nationality
{
    public $fields = [
        "COUNTRY_ID" => null,
        "USER_ID" => null,
    ];

    public function setUserId($userId)
    {
        $this->fields["USER_ID"] = $userId;
    }
    
    public function setCountryId($countyId)
    {
        $this->fields["COUNTRY_ID"] = $countyId;
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