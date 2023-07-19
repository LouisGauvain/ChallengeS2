<?php

namespace App\Models;

use App\Core\Sql;
use App\Core\Utils;

class Configurations extends Sql
{
    protected Int $id = -1;
    protected String $siteName;

    public function getId(): int
    {
        return $this->id;
    }

    public function siteName(): string
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM " . $this->table . " WHERE configuration_key = 'site_name'");
        $query->execute();
        $result = $query->fetch();
        return $result['configuration_value'];
    }
}   