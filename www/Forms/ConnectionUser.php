<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;

class ConnectionUser extends AForm
{

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Se Connecter",
                "cancel" => "Annuler"
            ],
            "inputs" => [
                "user_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "placeholder" => "Votre email",
                    "error" => "L'email ou le mot de passe est incorrect"
                ],
                "user_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "placeholder" => "Votre mot de passe",
                    "error" => "L'email ou le mot de passe est incorrect"
                ],
            ]
        ];
    }
}
