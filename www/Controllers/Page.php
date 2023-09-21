<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Templates;
use App\Forms\CreatePage;
use App\Core\Verificator;
use App\Core\Utils;
use App\Forms\AddComment;
use App\Models\Comments;
use App\Models\PageCategories;
use App\Models\Pages;

//dotenv
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Page
{
    public static function index(): void
    {
        $form = new AddComment();

        $pages = new Pages();
        $page = $pages->findByUri($_SERVER["REQUEST_URI"]);

        $comments = new Comments();
        $commentsTree = $comments->getCommentsTreeByPageID($page['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = [];
            $content['content'] = $page['content'];
            $content['comments'] = $commentsTree;
            echo json_encode($content);
            return;
        }

        $PageCategories = new PageCategories();

        if ($form->isSubmit()) {
            $errors = Verificator::formAddComment($form->getConfig(), $_POST);
            if (empty($errors)) {
                $comment = new Comments();

                $comment->setContent($_POST['content']);
                $comment->setPageId($page['id']);
                $comment->setStatutModeration(false);
                $comment->setUserName($_POST['name']);

                $comment->save();
                Utils::redirect($_SERVER["REQUEST_URI"]);
            } else {
                $view = new View("Page/index", "front");

                $view->assign('errors', $errors);
            }
        } else {
            $view = new View("Page/index", "front");

            $view->assign('form', $form->getConfig());

            $view->assign("categories", $PageCategories->getCategoriesByPageId($page['id']));

            $allUsersPages = $pages->getUriPagesByAction();
            //remove all html tags
            $allUsersPages = array_map(function ($page) {
                $page['title'] = strip_tags($page['title']);
                return $page;
            }, $allUsersPages);

            $view->assign("url", $_ENV['API_URL']);
            $view->assign("page", $page);
            $view->assign("commentsTree", $commentsTree);
            $view->assign("allUsersPages", $allUsersPages);

        }
    }
}
