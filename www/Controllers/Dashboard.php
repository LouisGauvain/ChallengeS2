<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Models\Users;

class Dashboard
{

    public function users()
    {
        $user = new Users();
        
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            $users = $user->findAll($sort);
        } else {
            $users = $user->findAll();
        }

        return $users;
    }
}
