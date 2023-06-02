<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;

class AddUser extends AForm
{

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "S'inscrire",
                "cancel" => "Annuler"
            ],
            "inputs" => [
                "user_firstname" => [
                    "type" => "text",
                    "placeholder" => "Votre prénom",
                    "min" => 2,
                    "max" => 45,
                    "error" => "Votre prénom doit faire entre 2 et 45 caractères"
                ],
                "user_lastname" => [
                    "type" => "text",
                    "placeholder" => "Votre nom de famille",
                    "min" => 2,
                    "max" => 45,
                    "error" => "Votre nom de famille doit faire entre 2 et 45 caractères"
                ],
                "user_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "placeholder" => "Votre email",
                    "error" => "Le format de votre email est incorrect"
                ],
                "user_confirm_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "placeholder" => "Confirmation de votre email",
                    "confirm" => "user_email",
                    "error" => "Vous avez insérer deux emails différents"
                ],
                "user_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "placeholder" => "Votre mot de passe",
                    "error" => "Mot de passe incorrect"
                ],
                "user_confirm_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "placeholder" => "Confirmation de votre mot de passe",
                    "confirm" => "user_password",
                    "error" => "Vous avez insérer deux mots de passe différents"
                ],
            ]
        ];
    }
}
