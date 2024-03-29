<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Models\Users;
use App\Models\Pages;
use App\Models\Comments;
use App\Core\View;
use App\Forms\EditUser;
use App\Core\Verificator;

class Admin
{
    public function install(){
        Utils::redirect("/install.php");
    }

    public function verifRole(): void
    {
        if(session_status() == PHP_SESSION_NONE) {
            Utils::redirect("/login");
        }
        if (!empty($_SESSION['user'])) {
            if ($_SESSION['user']['role_id'] != 1) {
                Utils::redirect("/");
            }
        } else {
            Utils::redirect("/login");
        }
    }

    public function deleteUser(): void
    {
        $this->verifRole();

        if (!isset($_GET['id'])) {
            Utils::redirect('/dashboard');
        }

        $user = new Users();
        $user->delete($_GET['id']);
        Utils::redirect('/dashboard');
    }
    
    public function deletePage(): void
    {
        $this->verifRole();

        if (!isset($_GET['id'])) {
            Utils::redirect('/page');
        }
        
        $page = new Pages();
        $page->delete($_GET['id']);
        Utils::redirect('/page');
    }

    public function deleteComment(): void
    {
        $this->verifRole();

        if (!isset($_GET['id'])) {
            Utils::redirect('/list_comment');
        }
        
        $page = new Comments();
        $page->delete($_GET['id']);
        Utils::redirect('/list_comment');
    }

    public function verifyComment(): void
    {
        $this->verifRole();
        if (!isset($_GET['id'])) {
            Utils::redirect('/list_comment');
        }

        $page = new Comments();
        $page->setStatutModeration(true);
        $page->setDateCreated(NULL);
        $page->setId($_GET['id']);
        $page->save();

        Utils::redirect('/list_comment');
    }

    public function editUser(): void
    {
        $this->verifRole();
        
        if (!isset($_GET['id'])) {
            Utils::redirect('/dashboard');
        }

        $user = new Users();
        $userInfos = $user->find($_GET['id']);
        $form = new EditUser($userInfos);
        $view = new View("Admin/edit_user", "front");

        $view->assign("form", $form->getConfig());
        $view->assign("fullname", $userInfos['firstname'] . " " . $userInfos['lastname']);
        if ($form->isSubmit()) {
            $errors = Verificator::formEditUser($form->getConfig(), $_POST);
            if (empty($errors)) {
                $user = new Users();
                if ($user->emailExist($_POST['user_email']) && $_POST['user_email'] != $userInfos['email']) {
                    $errors['user_email'] = "Cet email existe déjà";
                    $view->assign('errors', $errors);
                } else {
                    $user->setId($userInfos['id']);
                    $user->setEmail($_POST['user_email']);
                    $user->setFirstname($_POST['user_firstname']);
                    $user->setLastname($_POST['user_lastname']);
                    switch ($_POST['user_role_id']) {
                        case 'Admin':
                            $user->setRoleId(1);
                            break;
                        case 'Editor':
                            $user->setRoleId(2);
                            break;
                        case 'Author':
                            $user->setRoleId(3);
                            break;
                        case 'Contributor':
                            $user->setRoleId(4);
                            break;
                        case 'Subscriber':
                            $user->setRoleId(5);
                            break;
                        default:
                            $user->setRoleId(6);
                            break;
                    }
                    if (isset($_POST['user_email_verified']) && $_POST['user_email_verified'] == "on") {
                        $user->setEmailVerified(1);
                    } else {
                        $user->setEmailVerified(0);
                    }
                    $user->setDateUpdated(date("Y-m-d H:i:s"));
                    $user->setPassword($userInfos['password']);
                    $user->save($_GET['id']);
                    Utils::redirect('/dashboard');
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
}
