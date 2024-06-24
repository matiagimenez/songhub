<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Artist;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class ArtistRepository extends Repository
{
    public $table = "ARTIST";
}
