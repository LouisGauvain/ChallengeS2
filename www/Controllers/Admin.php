<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Models\Users;

class Admin{

    public function deleteUser()
    {
        $user = new Users();
        $user->delete($_GET['id']);
        Utils::redirect('/dashboard');
    }

    public function editUser()
    {
        echo "editUser";
    }

}