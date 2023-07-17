<?php

namespace App\Forms;

use App\Core\Utils;
use App\Forms\Abstract\AForm;
use App\Models\templates;

class CreatePage extends AForm
{

    protected $method = "POST";

    public function getConfig(): array
    {
        $pages = new templates();
        $arrayTemplatePages = [];
        $templatesPages = $pages->getDataUrl();
        if (empty($templatesPages)) {
            Utils::redirect("choice_template_page");
        }
        foreach ($templatesPages as $templatesPage) {
            $descriptionTemplate = $templatesPage['description'];
            $arrayTemplatePages[] = [
                "type" => "texte",
                "placeholder" => "Choisissez votre template",
                "value" => $descriptionTemplate,
                "error" => "Veuillez choisir un template"
            ];
        }
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Validé",
                "cancel" => "Annuler"
            ],
            "inputs" => $arrayTemplatePages,
        ];
    }
}
