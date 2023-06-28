<?php

namespace App\Forms;

use App\Core\Utils;
use App\Forms\Abstract\AForm;

class EditUser extends AForm
{

    protected $method = "POST";

    private $email;
    private $firstname;
    private $lastname;
    private $role_id;
    private $email_verified;
    
    public function __construct($user)
    {
        $this->email = $user['email'];
        $this->firstname = $user['firstname'];
        $this->lastname = $user['lastname'];
        $this->role_id = $user['role_id'];
        $this->email_verified = $user['email_verified'];
        Utils::var_dump($this->email_verified);
    }

    public function getConfig(): array
{
    return [
        "config" => [
            "method" => $this->getMethod(),
            "action" => "",
            "enctype" => "",
            "submit" => "Confirmer les changements",
            "cancel" => "Annuler"
        ],
        "inputs" => [
            "user_email" => [
                "type" => "email",
                "min" => 5,
                "max" => 255,
                "placeholder" => "Votre email",
                "error" => "L'email ou le mot de passe est incorrect",
                "value" => $this->email
            ],
            "user_firstname" => [
                "type" => "text",
                "min" => 2,
                "max" => 50,
                "placeholder" => "Votre prénom",
                "error" => "Le prénom est invalide",
                "value" => $this->firstname
            ],
            "user_lastname" => [
                "type" => "text",
                "min" => 2,
                "max" => 50,
                "placeholder" => "Votre nom",
                "error" => "Le nom est invalide",
                "value" => $this->lastname
            ],
            "user_role_id" => [
                "type" => "select",
                "options" => [
                    "1" => "Admin",
                    "2" => "Editor",
                    "3" => "Author",
                    "4" => "Contributor",
                    "5" => "Subscriber",
                    "6" => "User"
                ],
                "placeholder" => "Sélectionner un rôle",
                "error" => "Le rôle est invalide",
                "value" => $this->role_id
            ],
            "user_email_verified" => [
                "type" => "checkbox",
                "label" => "Email vérifié",
                "checked" => $this->email_verified
            ],
            "user_new_password" => [
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
