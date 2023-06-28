<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Models\Users;
use App\Core\View;
use App\Forms\EditUser;
use App\Core\Verificator;

class Admin
{

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
                        case 'admin':
                            $user->setRoleId(1);
                            break;
                        case 'editor':
                            $user->setRoleId(2);
                            break;
                        case 'author':
                            $user->setRoleId(3);
                            break;
                        case 'contributor':
                            $user->setRoleId(4);
                            break;
                        case 'subscriber':
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
