<?php

namespace App\Forms;

use App\Core\Utils;
use App\Forms\Abstract\AForm;
use App\Models\Templates;

class CreatePage extends AForm
{

    protected $method = "POST";

    public function getConfig(): array
    {
        $pages = new Templates();
        $arrayTemplatePages = [];
        $templatesPages = $pages->getDataUrl();
        if (empty($templatesPages)) {
            Utils::redirect("choice_template_page");
        }
        foreach ($templatesPages as $templatesPage) {
            $descriptionTemplate = $templatesPage['description'];
            $dom = new \DOMDocument();
            $dom->loadHTML($descriptionTemplate);

            $inputs = $dom->getElementsByTagName('input');
            foreach ($inputs as $input) {
                $name = $input->getAttribute('name');
                $type = $input->getAttribute('type');
                $value = $input->getAttribute('value');
                $placeholder = $input->getAttribute('placeholder');
                $arrayTemplatePages[$name] = [
                    "type" => $type,
                    "value" => $value,
                    "placeholder" => $placeholder,
                    "error" => "Veuillez renseigner les champs manquant",
                    "name" => $name,
                ];
            }
        }
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "multipart/form-data",
                "submit" => "Confirmer",
                "cancel" => "Annuler"
            ],
            "inputs" => $arrayTemplatePages,
        ];
    }
}
