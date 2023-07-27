<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Utils;
use App\Controllers\Dashboard;
use App\Models\Pages;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Main
{
    public function index(): void
    {
        $view = new View("Main/page", "front");

        $pages = new Pages();
        $view->assign("pages", $pages->getAllPages());
    }

    public function contact(): void
    {
        $view = new View("Main/contact", "front");
    }

    public function dashboard(): void
    {
        $view = new View("Main/dashboard", "back");

        if (!isset($_SESSION['user']['id'])) {
            Utils::redirect("login");
        }

        if ($_SESSION['user']['role_id'] == 1) {
            $dashboard = new Dashboard();

            $view->assign("users", $dashboard->users());
        }
    }

    public function components(): void
    {
        $view = new View("Main/components", "back");
    }
}
