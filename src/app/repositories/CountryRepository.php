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
        try {
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
        } catch (Exception $exception) {
            $this->logger->error(
                "Error al obtener los paises disponibles",
                [
                    "Error" => $exception->getMessage(),
                    "Operacion" => 'CountryRepository - getAvailableCountries',
                ]
            );
            return [];
        }
  
    }

    public function getCountryById($countryId)
    {
        try {
            if(!$countryId) return null;

            $country = $this->queryBuilder->selectByColumn($this->table, "COUNTRY_ID", $countryId);
    
            if(!$country) return null;
    
            $countryInstance = new Country();
            $countryInstance->set($country[0]);
    
            return $countryInstance;
        } catch(Exception $exception) {
            $this->logger->error(
                "Error al obtener los datos del country",
                [
                    "Error" => $exception->getMessage(),
                    "Operacion" => 'CountryRepository - getCountryById',
                ]
            );
            return null;
        }
     
    }
}