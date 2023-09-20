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
use App\Models\Templates;
use App\Models\PhpMailor;
use App\Models\Pages;

function extractStructure($element): array
{
    $structure = array(
        "type" => strtolower($element->tagName),
    );

    // Extract attributes
    if ($element->hasAttributes()) {
        $structure["attributes"] = array();
        foreach ($element->attributes as $attr) {
            $attrName = strtolower($attr->name);

            if (strpos($attrName, "data-") === 0) {
                if (!isset($structure["attributes"]["data"])) {
                    $structure["attributes"]["data"] = array();
                }
                $dataAttrName = str_replace("data-", "", $attrName);
                $structure["attributes"]["data"][$dataAttrName] = $attr->value;
            } elseif ($attrName === "style") {
                $style = array();
                $styleParts = explode(";", $attr->value);
                foreach ($styleParts as $stylePart) {
                    $styleAttr = explode(":", $stylePart);
                    if (count($styleAttr) === 2) {
                        $style[trim($styleAttr[0])] = trim($styleAttr[1]);
                    }
                }
                $structure["attributes"]["style"] = $style;
            } else {
                $structure["attributes"][$attrName] = $attr->value;
            }
        }
    }

    // Extract children
    if ($element->hasChildNodes()) {
        $structure["children"] = array();
        foreach ($element->childNodes as $child) {
            if ($child->nodeType === XML_TEXT_NODE) {
                $structure["children"][] = $child->nodeValue;
            } elseif ($child->nodeType === XML_ELEMENT_NODE) {
                $structure["children"][] = extractStructure($child);
            }
        }
    }

    return $structure;
}

class Security
{

    public function login(): void
    {
        $form = new ConnectionUser();
        $view = new View("Auth/connection", "front");
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
                    if ($userInfos['email_verified']) {
                        Utils::redirect("dashboard");
                        Utils::setSession($userInfos, $token->getToken());
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
                    Utils::redirect("login");
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
        $view = new View("Page/choiceTemplatePage", "back");
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
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
    }

    public function addTemplatePage(): void
    {
        $form = new AddTemplatePage();
        $view = new View("Page/addTemplatePage", "back");
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
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function createPage(): void
    {
        $form = new CreatePage();
        $view = new View("Page/createPage", "back");
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
                    $imageSite = array();
                    for ($j = 1; isset($_FILES['imageSite+' . $j]); $j++) {
                        $imageSite[] = $_FILES['imageSite+' . $j];
                    }

                    $donnees = array(
                        'titleSite' => $titleSite,
                        'texteSite' => $texteSite
                    );

                    foreach ($imageSite as $key => $file) {
                        $donnees['imageSite+' . ($key + 1)] = $file;
                    }
                    $template = new Templates();
                    $description = $template->getByName($_GET['selected_option']);
                    $order = array();
                    $dom = new \DOMDocument();
                    $dom->loadHTML($description['description']);
                    $inputs = $dom->getElementsByTagName('input');
                    foreach ($inputs as $input) {
                        $name = $input->getAttribute('name');
                        $order[] = $name;
                    }
                    $order = array_flip($order);
                    $text = trim(strip_tags($titleSite));

                    $html = "<body>";
                    foreach ($order as $key => $value) {
                        if (gettype($donnees[$key]) == 'array') {
                            $html .= '<img src="ImagePage/Uploads/' . $text . '/' . $text . "+" . $donnees[$key]['name'] . '">';
                        }
                        if (gettype($donnees[$key]) == 'string') {
                            $html .= $donnees[$key];
                        }
                    }
                    $html .= "</body>";
                    $dom->loadHTML($html);
                    $body = $dom->getElementsByTagName('body');

                    $structure = extractStructure($body[0]);
                    $json = var_export(json_encode($structure), true);
                    $json = substr($json, 1, -1);


                    $Pages->setTitle($titleSite);
                    $Pages->setContent($json);
                    $Pages->setUserId($_SESSION['user']['id']);
                    $Pages->setDateCreated(date('Y-m-d H:i:s'));
                    $Pages->setUrlPage('/' . $text);
                    $Pages->setControllerPage('Page');
                    $Pages->setActionPage('index');
                    $Pages->createFolderImagePage();
                    $Pages->createFolderUploadImagePage();
                    $Pages->addFolderAndFileImagePage();
                    $Pages->setUsedTemplate($_GET['selected_option']);
                    $Pages->save();
                    Utils::redirect('/' . $text);
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function Page(): void
    {

        $view = new View("Main/index", "back");

        $pages = new Pages();
        $view->assign("pages", $pages->getAllPages());
    }
}
