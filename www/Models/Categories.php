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

    public function getByName(string $name): int
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM " . $this->table . " WHERE name = :name");
        $query->execute(['name' => $name]);
        $result = $query->fetch();
        Utils::var_dump($result);
        return $result['id'];
    }
}
