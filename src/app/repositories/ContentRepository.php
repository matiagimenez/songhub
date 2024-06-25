<?php

namespace Songhub\app\repositories;

use Exception;
use Songhub\app\models\Content;
use Songhub\core\exceptions\InvalidValueException;
use Songhub\core\Repository;

class ContentRepository extends Repository
{
    public $table = "CONTENT";
}
