<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Models\Users;

class Dashboard{

    public function users()
    {
        $user = new Users();
        $users = $user->findAll();

        return $users;
    }

}