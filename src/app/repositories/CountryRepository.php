<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Country;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class CountryRepository extends Repository
{
    public $table = "COUNTRY";

    public function getAvailableCountries()
    {
        $countries = $this->queryBuilder->select($this->table);
    
        $availableCountries = [];

        if (count($countries) > 0) {
            foreach ($countries as $country) {
                $countryInstance = new Country();
                $countryInstance->set($country);
     
                $availableCountries[] = $countryInstance;
            }
        }

        return $availableCountries;
    }

    // public function getCountryById(int $countryId)
    // {
    //     $country = $this->queryBuilder->selectByColumn($this->table, "COUNTRY_ID", $countryId);

    //     if(!$country) return null;

    //     $countryInstance = new Country();
    //     $countryInstance->set($country);

    //     return $countryInstance;
    // }
}