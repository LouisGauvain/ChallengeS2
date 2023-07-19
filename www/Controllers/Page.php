<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Templates;
use App\Forms\CreatePage;
use App\Core\Verificator;
use App\Core\Utils;
use App\Models\Pages;

//dotenv
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Page
{
    public static function index(): void
    {
        $view = new View("Page/index", "front");

        $pages = new Pages();
        $page = $pages->findByUri($_SERVER["REQUEST_URI"]);

        $view->assign("url", $_ENV['API_URL']);
        $view->assign("page", $page);
    }

    public static function pageCreate(): void
    {
    }

}
