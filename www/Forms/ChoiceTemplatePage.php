<?php

namespace App\Forms;

use App\Core\Utils;
use App\Forms\Abstract\AForm;
use App\Models\templates;

class ChoiceTemplatePage extends AForm
{

    protected $method = "POST";

    public function getConfig(): array
    {
        $pages = new templates();
        $arrayTemplatePages = [];
        $templatesPages = $pages->choiceTemplatePage();
        foreach ($templatesPages as $templatesPage) {
            $nameTemplate = $templatesPage['name'];
            $imagePage = $templatesPage['image'];
            $arrayTemplatePages[] = [
                "type" => "radio",
                "placeholder" => "Choisissez votre template",
                "for" => "$nameTemplate",
                "label" => $nameTemplate . "<br><img src='" . $imagePage . "' alt='image du template'>" . "<br>",
                "name" => "$nameTemplate",
                "value" => $nameTemplate,
                "id" => "$nameTemplate",
                "checked" => false,
                "error" => "Veuillez choisir un template"
            ];
        }
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Confirmer votre choix",
                "cancel" => "Annuler"
            ],
            "inputs" => $arrayTemplatePages,
        ];
    }
}
