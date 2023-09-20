<?php

namespace App\Models;

use App\Core\Sql;
use App\Core\Utils;

class Categories extends Sql
{
    protected Int $id = -1;
    protected String $name;

    public function getId(): int
    {
        return $this->id;
    }
}
