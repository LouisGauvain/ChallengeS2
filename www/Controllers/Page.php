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
        $pages = new Pages();
        $page = $pages->findByUri($_SERVER["REQUEST_URI"]);

        //if method is post
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            echo $page["content"];
            return;
        }

        $view = new View("Page/index", "front");

        $allUsersPages = $pages->getUriPagesByAction();
        //remove all html tags
        $allUsersPages = array_map(function ($page) {
            $page['title'] = strip_tags($page['title']);
            return $page;
        }, $allUsersPages);

        $view->assign("url", $_ENV['API_URL']);
        $view->assign("page", $page);
        $view->assign("allUsersPages", $allUsersPages);
        $PageCategories = new PageCategories();
        $view->assign("categories", $PageCategories->getCategoriesByPageId($page['id']));
    


        $comments = new Comments();
        $commentsTree = $comments->getCommentsTreeByPageID($page['id']);

        $view->assign("commentsTree", $commentsTree);


        $form = new AddComment();
        $view->assign('form', $form -> getConfig());

        

        if($form->isSubmit())
        {
            $errors = Verificator::formAddComment($form->getConfig(), $_POST);
            if(empty($errors))
            {
                $comment = new Comments();
                
                $comment->setContent($_POST['content']);
                $comment->setPageId($page['id']);
                $comment->setStatutModeration(false);
                $comment->setUserName($_POST['name']);

                Utils::var_dump_die($comment);

                $comment->save();

            }else {
                $view->assign('errors', $errors);
            }
        }
    }

    public static function pageCreate(): void
    {
    }

}
