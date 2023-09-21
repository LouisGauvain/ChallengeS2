<?php

namespace App\Forms;

use App\Core\Utils;
use App\Forms\Abstract\AForm;

class AddComment extends AForm
{

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Ajouter un commentaire",
                "cancel" => "Annuler"
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "placeholder" => "Votre nom",
                    "min" => 2,
                    "max" => 45,
                    "label" => "Votre nom",
                    "error" => "Votre nom doit faire entre 2 et 45 caractères, il peut contenir des chiffres et des lettres, des espaces et des tirets",
                    "class" => ""
                ],
                "content" => [
                    "type" => "textarea",
                    "placeholder" => "Votre commentaire",
                    "min" => 2,
                    "max" => 255,
                    "label" => "Votre commentaire",
                    "error" => "Le commentaire doit faire entre 2 et 255 caractères",
                    "class" => "" 
                ],
            ],
        ];
    }
}