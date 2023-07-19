<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Verificator;
use App\Core\Utils;

use App\Forms\AddUser;
use App\Forms\ConnectionUser;
use App\Forms\ChoiceTemplatePage;
use App\Forms\AddTemplatePage;
use App\Forms\CreatePage;

use App\Models\Users;
use App\Models\Tokens;
use App\Models\templates;
use App\Models\PhpMailor;
use App\Models\Pages;

class Security
{

    public function login(): void
    {
        $form = new ConnectionUser();
        $view = new View("Auth/connection", "back");
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
            $errors = Verificator::formConnection($form->getConfig(), $_POST);
            if (empty($errors)) {
                $user = new Users();
                $user->setEmail($_POST['user_email']);
                $user->setPassword($_POST['user_password']);
                if ($user->login()) {
                    $userInfos = $user->login();
                    $token = new Tokens();
                    $token->setUserId($userInfos['id']);
                    $token->createToken();
                    Utils::setSession($userInfos, $token->getToken());
                    if ($userInfos['email_verified']) {
                        Utils::redirect("dashboard");
                    } else {
                        $view->assign('errors', ['user_email' => 'Email non vérifié']);
                    }
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
                if ($user->emailExist($_POST['user_email'])) {
                    $errors['user_email'] = "Cet email existe déjà";
                    $view->assign('errors', $errors);
                } else {
                    $token = bin2hex(random_bytes(32));
                    $user->setVericationToken($token);
                    $user->setFirstname($_POST['user_firstname']);
                    $user->setLastname($_POST['user_lastname']);
                    $user->setEmail($_POST['user_email']);
                    $user->setPassword($_POST['user_password']);
                    $user->save();
                    $phpMailer = new PhpMailor();
                    $phpMailer->setMail($_POST['user_email']);
                    $phpMailer->setFirstname($_POST['user_firstname']);
                    $phpMailer->setLastname($_POST['user_lastname']);
                    $phpMailer->setToken($token);
                    $phpMailer->sendMail();
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

    public function verify(): void
    {
        $users = new Users();
        $verify = $users->verifyToken($_GET['token']);
        if ($verify) {
            foreach ($verify as $key => $value) {
                $methodName = "set" . ucfirst($key);
                if (method_exists($users, $methodName)) {
                    $users->$methodName($value);
                }
            }
            $users->setEmailVerified(1);
            $users->save();
            Utils::redirect("login");
        } else {
            Utils::redirect("register");
        }
    }

    public function choiceTemplatePage(): void
    {
        $form = new ChoiceTemplatePage();
        $view = new View("page/choiceTemplatePage", "back");
        $view->assign('form', $form->getConfig());
        $errors = Verificator::choiceTemplatePage($form->getConfig(), $_POST);
        if (empty($errors)) {
            $keys = array_keys($_POST);
            $pageAcceuilKey = $keys[0];
            $redirectURL = "create_page?selected_option=" . urlencode($pageAcceuilKey);
            Utils::redirect($redirectURL);
        } else {
            $view->assign('errors', $errors);
        }
    }

    public function addTemplatePage(): void
    {
        $form = new AddTemplatePage();
        $view = new View("page/addTemplatePage", "back");
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
            $errors = Verificator::addImageTemplate($form->getConfig(), $_POST);
            if (empty($errors)) {
                $templatePages = new Templates();
                if ($templatePages->nameTemplatePage($_POST['template_name'])) {
                    $errors['template_name'] = "Ce template existe déjà";
                    $view->assign('errors', $errors);
                } else {
                    $templatePages->setName($_POST['template_name']);
                    $templatePages->setdescription($_POST['template_description']);
                    $templatePages->createFolderTemplate();
                    $templatePages->createFolderUploadTemplate();
                    $destination = $templatePages->addFolderAndFileTemplate();
                    $templatePages->setImage($destination);
                    $templatePages->save();
                    echo "Insertion en BDD";
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function createPage(): void
    {
        $form = new CreatePage();
        $view = new View("page/createPage", "back");
        $templatePages = new Templates();
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
            $errors = Verificator::addPages($form->getConfig(), $_POST);
            if (empty($errors)) {
                $Pages = new Pages();
                if ($Pages->namePage($_POST['titleSite'])) {
                    $errors['titleSite'] = "Ce nom de site existe déjà";
                    $view->assign('errors', $errors);
                } else {
                    $titleSite = $_POST['titleSite'];
                    $texteSite = $_POST['texteSite'];
                    $imageSite = $_POST['imageSite'];
                    $donnees = array(
                        'titleSite' => $titleSite,
                        'texteSite' => $texteSite,
                        'imageSite' => $imageSite,
                    );
                    $jsonPage = json_encode($donnees);
                    $Pages->setTitle($titleSite);
                    $Pages->setContent($jsonPage);
                    $Pages->setUserId($_SESSION['user']['id']);
                    $Pages->setDateCreated(date('Y-m-d H:i:s'));
                    $text = strtolower(trim(strip_tags($titleSite)));
                    $Pages->setUrlPage('/' . $text);
                    $Pages->setControllerPage('Page');
                    $Pages->setActionPage('pageCreate');
                    $Pages->save();
                    echo "Insertion en BDD";
                    Utils::redirect('/' . $text);
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
}
