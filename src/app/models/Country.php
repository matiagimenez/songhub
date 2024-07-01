<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class Country
{
    public $fields = [
        "COUNTRY_ID" => null,
        "NAME" => null,
    ];

    public function setCountryId($countryId)
    {
        $this->fields["COUNTRY_ID"] = $countryId;
    }

    public function setName($countryName)
    {  
      $this->fields["NAME"] = $countryName;
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