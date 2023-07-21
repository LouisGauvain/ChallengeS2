<?php

namespace App\Core;

class Verificator
{

    public static function formRegister(array $config, array $data): array
    {
        $listOfErrors = [];
        if (count($config["inputs"]) != count($data) - 1) {
            die("Tentative de Hack");
        }
        foreach ($config["inputs"] as $name => $input) {
            if (empty($data[$name])) {
                die("Tentative de Hack 2");
            }

            if ($input["type"] == "email" && !self::checkEmail($data[$name]) && $name != "user_confirm_email") {
                $listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "password" && !self::checkPassword($data[$name]) && $name != "user_confirm_password") {
                $listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "text" && !self::checkFirstName($data[$name])) {
                $listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "text" && !self::checkLastName($data[$name])) {
                $listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "email" && !self::checkConfirmEmail($data["user_email"], $data[$name])) {
                $listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "password" && !self::checkConfirmPassword($data["user_password"], $data[$name])) {
                $listOfErrors[] = $input["error"];
            }
        }
        return $listOfErrors;
    }

    public static function formConnection(array $config, array $data): array
    {
        $listOfErrors = [];
        if (count($config["inputs"]) != count($data) - 1) {
            die("Tentative de Hack");
        }
        foreach ($config["inputs"] as $name => $input) {
            if (empty($data[$name])) {
                die("Tentative de Hack");
            }

            if ($input["type"] == "email" && !self::checkEmail($data[$name])) {
                $listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "password" && !self::checkPassword($data[$name])) {
                $listOfErrors[] = $input["error"];
            }
        }
        return $listOfErrors;
    }

    public static function checkEmail($email): bool
    {
        $filterMail = filter_var($email, FILTER_VALIDATE_EMAIL);
        $pregMail = preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email);
        return $filterMail && $pregMail;
    }

    public static function checkPassword($password): bool
    {
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()])[a-zA-Z\d!@#$%^&*()]{8,45}$/", $password);
    }

    public static function checkFirstName($firstName): bool
    {
        return preg_match("/^[a-zA-Z]{2,45}$/", $firstName);
    }

    public static function checkLastName($lastName): bool
    {
        return preg_match("/^[a-zA-Z]{2,45}$/", $lastName);
    }

    public static function checkConfirmEmail($email, $confirmEmail): bool
    {
        return $email == $confirmEmail;
    }

    public static function checkConfirmPassword($password, $confirmPassword): bool
    {
        return $password == $confirmPassword;
    }


    static public function formEditUser(array $config, array $data): array
    {
        $listOfErrors = [];

        foreach ($config["inputs"] as $name => $input) {
            if (empty($data[$name]) && $name != "user_new_password") {
                die("Tentative de Hack 3");
            }
            if ($input["type"] == "password" && !empty($data[$name]) && !self::checkPassword($data[$name])) {
                $listOfErrors[] = $input["error"];
            }

            if ($input["type"] == "email" && !self::checkEmail($data[$name])) {
                $listOfErrors[] = $input["error"];
            }
        }

        return $listOfErrors;
    }

    public static function addImageTemplate(array $config, array $data): array
    {
        $listOfErrors = [];
        if (count($config["inputs"]) != count($data) - 1 + count($_FILES)) {
            die("Tentative de Hack");
        }

        $data["template_image"] = $_FILES;
        foreach ($config["inputs"] as $name => $input) {
            if (empty($data[$name])) {
                die("Tentative de Hack 2");
            }
            if (!isset($_POST["template_name"]) || !isset($_POST["template_description"]) || !isset($_FILES) || empty($_FILES)) {
                $listOfErrors[] = $input["error"];
            }

            if ($_FILES["template_image"]["type"]) {
                $type = $_FILES["template_image"]["type"];
                if ($type != "image/png" && $type != "image/jpeg" && $type != "image/jpg") {
                    $listOfErrors[] = $input["error"];
                }
            }
        }
        return $listOfErrors;
    }

    public static function choiceTemplatePage(): array
    {
        $listOfErrors = [];
        $on = reset($_POST);
        if ($on != "on") {
            $listOfErrors[] = "Vous devez choisir un template";
        }
        return $listOfErrors;
    }

    public static function addPages(array $config, array $data): array
    {
        $listOfErrors = [];

        if (count($config["inputs"]) != count($data) - 1 + count($_FILES)) {
            $texteError = "Veuillez remplir tous les champs 1";
            if (!in_array($texteError, $listOfErrors)) {
                $listOfErrors[] = $texteError;
            }
        }

        if (!empty($_FILES)) {
            for ($i = 1; isset($_FILES['imageSite+' . $i]); $i++) {
                $file[] = 'imageSite+' . $i;
            }
            foreach ($file as $key => $value) {
                if (empty($_FILES[$value]['name'])) {
                    $texteError = "Veuillez insérer une image";
                    if (!in_array($texteError, $listOfErrors)) {
                        $listOfErrors[] = $texteError;
                    }
                }
            }
        }

        for ($j = 1; isset($_FILES['imageSite+' . $j]); $j++) {
            $data["imageSite+" . $j] = $_FILES['imageSite+' . $j];
        }
        foreach ($config["inputs"] as $name => $input) {
            if (empty($data[$name])) {
                $texteError = "Veuillez remplir tous les champs 2";
                if (!in_array($texteError, $listOfErrors)) {
                    $listOfErrors[] = $texteError;
                }
            }
            // Repérer s'il y a le mot "script" dans le contenu
            if (preg_match("/<script>/i", $_POST['titleSite'] || $_POST['texteSite'])) {
                $texteError = "Il est interdit d'insérer du script 1";
                if (!in_array($texteError, $listOfErrors)) {
                    $listOfErrors[] = $texteError;
                }
            }
            if (preg_match("/<\/script>/i", $_POST['titleSite'] || $_POST['texteSite'])) {
                $texteError = "Il est interdit d'insérer du script 2";
                if (!in_array($texteError, $listOfErrors)) {
                    $listOfErrors[] = $texteError;
                }
            }
        }
        return $listOfErrors;
    }
}
