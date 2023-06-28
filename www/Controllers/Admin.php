<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Models\Users;
use App\Core\View;
use App\Forms\EditUser;

class Admin{

    public function deleteUser()
    {
        $user = new Users();
        $user->delete($_GET['id']); 
        Utils::redirect('/dashboard');
    }

    public function editUser()
    {
        $user = new Users();
        $userInfos = $user->find($_GET['id']);
        $form = new EditUser($userInfos);
        $view = new View("Admin/edit_user", "front");

        $view->assign("form", $form->getConfig());
        $view->assign("fullname", $userInfos['firstname'] . " " . $userInfos['lastname']);
    }

}