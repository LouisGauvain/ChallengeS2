<?php

namespace App\Models;

use App\Core\Sql;
use App\Core\Utils;

class Pages extends Sql
{
    protected Int $id = -1;
    protected String $title;
    protected String $content;
    protected int $user_id;
    protected String $url_page;
    protected String $controller_page;
    protected string $action_page;
    protected $date_created;
    protected $date_modified;
    protected $used_template;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getUrlPage(): string
    {
        return $this->url_page;
    }

    public function setUrlPage(string $url_page): void
    {
        $this->url_page = $url_page;
    }

    public function getControllerPage(): string
    {
        return $this->controller_page;
    }

    public function setControllerPage(string $controller_page): void
    {
        $this->controller_page = $controller_page;
    }

    public function getActionPage(): string
    {
        return $this->action_page;
    }

    public function setActionPage(string $action_page): void
    {
        $this->action_page = $action_page;
    }

    public function getDateCreated()
    {
        return $this->date_created;
    }

    public function setDateCreated($date_created): void
    {
        $this->date_created = $date_created;
    }

    public function getDateModified()
    {
        return $this->date_modified;
    }

    public function setDateModified($date_modified): void
    {
        $this->date_modified = $date_modified;
    }

    public function getUsedTemplate()
    {
        return $this->used_template;
    }

    public function setUsedTemplate($used_template): void
    {
        $this->used_template = $used_template;
    }

    public function getUriPages()
    {
        $db = $this::getInstance();
        $query = $db->query("SELECT url_page, controller_page, action_page FROM " . $this->table);
        $uriq = $query->fetchAll();
        if (is_null($uriq)) {
            return false;
        } else {
            return $uriq;
        }
    }

    public function getUriPagesByAction()
    {
        $db = $this::getInstance();
        $query = $db->query("SELECT title, url_page FROM " . $this->table . " WHERE action_page = 'index'");
        $uriq = $query->fetchAll();
        if (is_null($uriq)) {
            return false;
        } else {
            return $uriq;
        }
    }

    public function namePage($title): bool
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT title FROM " . $this->table . " WHERE title = :titleSite");
        $query->execute([
            'titleSite' => $title
        ]);
        $result = $query->fetch();
        if (!$result) {
            return false;
        }
        return true;
    }

    public function findByUri($url_page): array | bool
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM " . $this->table . " WHERE url_page = :url_page");
        $query->execute([
            'url_page' => $url_page
        ]);
        $result = $query->fetch();
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function createFolderImagePage(): bool
    {
        $pathUploads = 'ImagePage';

        if (!file_exists($pathUploads)) {
            mkdir($pathUploads, 0777);
        }

        return true;
    }

    public function createFolderUploadImagePage(): bool
    {
        $pathUploads = 'ImagePage/Uploads/';

        if (!file_exists($pathUploads)) {
            mkdir($pathUploads, 0777);
        }

        return true;
    }

    public function addFolderAndFileImagePage(): string
    {
        $pathImagePageName = 'ImagePage/Uploads/' . strip_tags($_POST['titleSite']) . '/';
        if (!file_exists($pathImagePageName)) {
            mkdir($pathImagePageName, 0777);
        }
        for ($j = 1; isset($_FILES['imageSite+' . $j]); $j++) {
            $filename = strip_tags($_POST['titleSite']) . '+' . $_FILES['imageSite+' . $j]['name'];
            $destination = $pathImagePageName . $filename;
            move_uploaded_file($_FILES['imageSite+' . $j]['tmp_name'], $destination);
        }
        return $destination;
    }

    public function getAllPages(): array | bool
    {
        $db = $this::getInstance();
        $query = $db->query("SELECT * FROM " . $this->table . " WHERE controller_page = 'Page' AND action_page = 'index'");
        $pages = $query->fetchAll();
        if (is_null($pages)) {
            return false;
        } else {
            return $pages;
        }
    }

    public function getBySlug($slug): array | bool
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM " . $this->table . " WHERE url_page = :url_page");
        $query->execute([
            'url_page' => $slug
        ]);
        $result = $query->fetch();
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function findByID($id): array | bool
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        $result = $query->fetch();
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function getPagesByCategory($category)
    {
        $Categories = new Categories();
        $category = $Categories->getByName($category);

        $PageCategories = new PageCategories();
        $pages = $PageCategories->getPagesByCategory($category);

        return $pages;
    }
    
}
