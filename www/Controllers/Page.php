<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\templates;
use App\Forms\CreatePage;
use App\Core\Verificator;
use App\Core\Utils;

class Page
{
    public function createPage(): void
    {
        $form = new CreatePage();
        $view = new View("page/createPage", "front");
        $templatePages = new Templates();
        $view->assign('form', $form->getConfig());
    }
}
