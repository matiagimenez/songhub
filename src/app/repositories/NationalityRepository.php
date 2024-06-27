<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Nationality;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class NationalityRepository extends Repository
{
    public $table = "NATIONALITY";

    public function updateUserNationality(int $userId, int $countryId)
    {
        $nationality = $this->queryBuilder->update($this->table, ["COUNTRY_ID" => $countryId], "USER_ID", $userId);
    }

    public function getUserNationality(int $userId)
    {
        $nationality = $this->queryBuilder->selectByColumn($this->table, "USER_ID", $userId);
 

        if(!$nationality || count($nationality) == 0) return null;

        $nationalityInstance = new Nationality();
        $nationalityInstance->set($nationality[0]);

        return $nationalityInstance;
    }
}