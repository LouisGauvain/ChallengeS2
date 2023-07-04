<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Utils;
use App\Controllers\Dashboard;

class Main
{
    public function index()
    {

        $pseudo = "Prof";
        $view = new View("Main/index", "front");
        $view->assign("pseudo", $pseudo);
    }

    public function contact()
    {
        $view = new View("Main/contact", "front");
    }

    public function dashboard()
    {
        $view = new View("Main/dashboard", "back");

        if (!isset($_SESSION['user']['id'])) {
            Utils::redirect("login");
        }

        if($_SESSION['user']['role_id'] == 1){
            $dashboard = new Dashboard();

            $view->assign("users", $dashboard->users());
        }
    }

    public function components()
    {
        $view = new View("Main/components", "back");
    }
}
