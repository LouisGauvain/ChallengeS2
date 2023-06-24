<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\AddUser;
use App\Forms\ConnectionUser;
use App\Models\Users;
use App\Core\Verificator;
use App\Core\Utils;

class Security
{

    public function login(): void
    {
        $form = new ConnectionUser();
        $view = new View("Auth/connection", "front");
        if (isset($_SESSION['user']['id'])) {
            Utils::redirect("dashboard");
        }
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
            $errors = Verificator::formConnection($form->getConfig(), $_POST);
            if (empty($errors)) {
                $user = new Users();
                $user->setEmail($_POST['user_email']);
                $user->setPassword($_POST['user_password']);
                if($user->login())
                {
                    $userInfos = $user->login();
                    Utils::setSession($userInfos);
                    Utils::redirect("dashboard");
                } else {
                    $view->assign('errors', ['user_email' => 'Email ou mot de passe incorrect']);
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
    
    public function register(): void
    {
        $form = new AddUser();
        $view = new View("Auth/register", "front");
        if (isset($_SESSION['user']['id'])) {
            Utils::redirect("dashboard");
        }
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
            $errors = Verificator::formRegister($form->getConfig(), $_POST);
            if (empty($errors)) {
                $user = new Users();
                if($user->emailExist($_POST['user_email']))
                {
                    $errors['user_email'] = "Cet email existe déjà";
                    $view->assign('errors', $errors);
                }
                else{
                    $user->setFirstname($_POST['user_firstname']);
                    $user->setLastname($_POST['user_lastname']);
                    $user->setEmail($_POST['user_email']);
                    $user->setPassword($_POST['user_password']);
                    $user->save();
                    echo "Insertion en BDD";
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function logout(): void
    {
        echo "Logout";
    }

    public function disconnect(): void
    {
        session_start();
        session_destroy();
        Utils::redirect("login");
    }
}
