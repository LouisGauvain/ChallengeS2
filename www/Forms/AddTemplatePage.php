<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;

class AddTemplatePage extends AForm
{

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "multipart/form-data",
                "submit" => "Confirmer",
                "cancel" => "Annuler"
            ],
            "inputs" => [
                "template_name" => [
                    "type" => "text",
                    "placeholder" => "Le nom du template",
                    "min" => 2,
                    "max" => 45,
                    "label" => "",
                    "error" => "Le nom du template doit faire entre 2 et 45 caractères",
                    "class" => ""
                ],
                "template_description" => [
                    "type" => "texte",
                    "placeholder" => "Code du template",
                    "min" => "",
                    "max" => "",
                    "label" => "",
                    "error" => "La description n'as pas pu être ajouté",
                    "class" => "code-editor"
                ],
                "template_image" => [
                    "type" => "file",
                    "placeholder" => "L'image du template",
                    "min" => "",
                    "max" => "",
                    "label" => "",
                    "error" => "L'image n'as pas pu être ajouté",
                    "class" => ""
                ],
            ],
        ];
    }
}
