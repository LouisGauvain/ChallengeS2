<?php
namespace App\Controllers;
use App\Core\View;
use App\Forms\AddUser;
use App\Models\Users;
use App\Core\Verificator;

class Security{

    public function login(): void
    {
        echo "Login";
    }

    public function register(): void
    {
        $form = new AddUser();
        $view = new View("Auth/register", "front");
        $view->assign('form', $form->getConfig());
        if($form->isSubmit()){
            $errors = Verificator::form($form->getConfig(), $_POST);
            if(empty($errors)){
                var_dump($_POST);
                $user = new Users();
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['pwd']);
                $user->save();
                echo "Insertion en BDD";
            }else{
                $view->assign('errors', $errors);
            }
        }
        
        /*$user = new Users();
        $user->setEmail("test@gmail.com");
        $user->save();*/
        
    }

    public function logout(): void
    {
        echo "Logout";
    }

}