<?php

namespace App\Controllers;

use App\Models\Comments;
use App\Core\View;
use App\Core\Verificator;
use App\Core\Utils;
use App\Forms\AddComment;


class Comment
{
    public function addComment(): void
    {
        $comment = new Comments();
        $commentInfos = $comment->find($_GET['id']);
        $commentForm = new AddComment($commentInfos);
        $view = new View()

        if($commentForm->isSubmit())
        {
            $errors = Verificator::formAddComment($form->getConfig(), $_POST);
            if(empty($errors))
            {
                $comment = new Comments();

            }
        }
    }
}