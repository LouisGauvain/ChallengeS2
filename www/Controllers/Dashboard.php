<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Models\Users;
use App\Models\Pages;

class Dashboard
{

    public function users(): array | bool
    {
        $user = new Users();

        if (isset($_GET['sort']) && isset($_GET['order'])) {
            $sort = $_GET['sort'];
            $order = $_GET['order'];
            $users = $user->findAll($sort, $order);
        } else {
            $users = $user->findAll();
        }

        return $users;
    }
}
