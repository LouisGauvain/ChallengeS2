<?php

namespace App\Models;

use App\Core\Sql;
use App\Core\Utils;

class Templates extends Sql
{
    protected Int $id = -1;
    protected String $name;
    protected String $description;
    protected int $color;
    protected string $police;
    protected string $image;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getdescription(): string
    {
        return $this->description;
    }

    public function setdescription(string $description): void
    {
        $this->description = $description;
    }

    public function getColor(): int
    {
        return $this->color;
    }

    public function setColor(int $color): void
    {
        $this->color = $color;
    }

    public function getPolice(): string
    {
        return $this->police;
    }

    public function setPolice(string $police): void
    {
        $this->police = $police;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function nameTemplatePage($name): bool
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT name FROM " . $this->table . " WHERE name = :template_name");
        $query->execute([
            'template_name' => $name
        ]);
        $result = $query->fetch();
        if (!$result) {
            return false;
        }
        return true;
    }

    public function createFolderTemplate(): bool
    {
        $pathUploads = 'Templates';

        if (!file_exists($pathUploads)) {
            mkdir($pathUploads, 0777);
            chmod($pathUploads, 0755);
        }

        return true;
    }

    public function createFolderUploadTemplate(): bool
    {
        $pathUploads = 'Templates/Uploads/';

        if (!file_exists($pathUploads)) {
            mkdir($pathUploads, 0777);
            chmod($pathUploads, 0755);
        }

        return true;
    }

    public function addFolderAndFileTemplate(): string
    {
        $annualFolder = date('Y');
        $monthFolder = date('m');
        $pathUploadsAnnual = 'Templates/Uploads/' . $annualFolder . '/';
        $pathUploadsMonth = 'Templates/Uploads/' . $annualFolder . '/' . $monthFolder . '/';

        if (!file_exists($pathUploadsAnnual)) {
            mkdir($pathUploadsAnnual, 0777);
            chmod($pathUploadsAnnual, 0755);
        }

        if (!file_exists($pathUploadsMonth)) {
            mkdir($pathUploadsMonth, 0777);
            chmod($pathUploadsMonth, 0755);
        }

        $filename = $_POST['template_name'] . '+' . $_FILES['template_image']['name'];

        $destination = $pathUploadsMonth . $filename;

        move_uploaded_file($_FILES['template_image']['tmp_name'], $destination);

        return $destination;
    }

    public function choiceTemplatePage(): array
    {
        $db = $this::getInstance();
        $query = $db->query("SELECT * FROM " . $this->table);
        $templatePages = $query->fetchAll();
        if (is_null($templatePages)) {
            return false;
        } else {
            return $templatePages;
        }
    }

    public function getDataUrl(): array | bool
    {
        $SelectOption = str_replace('_', ' ', $_GET['selected_option']);
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM esgi_templates WHERE name = :selectedOption");
        $query->execute([
            'selectedOption' => $SelectOption
        ]);
        $templatePages = $query->fetchAll();
        if (empty($templatePages)) {
            return false;
        } else {
            return $templatePages;
        }
    }

    public function getByName($name): array | bool
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT description FROM " . $this->table . " WHERE name = :name");
        $query->execute([
            'name' => $name
        ]);
        $templatePages = $query->fetch();
        if (empty($templatePages)) {
            return false;
        } else {
            return $templatePages;
        }
    }
}
