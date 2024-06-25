<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Cover;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class CoverRepository extends Repository
{
    public $table = "COVER";
}
