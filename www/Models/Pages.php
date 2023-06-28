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

    public function __construct()
    {
        $this->url_page = '';
        $this->controller_page = '';
        $this->action_page = '';
        $this->date_created = null;
        $this->date_modified = null;
    }

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

    public function getUriPages()
    {
        $db = $this::getInstance();
        Utils::var_dump($db);
        $query = $db->prepare("SELECT * FROM esgi_pages");
        $query->execute();
        $uri = $query->fetch();
        if (!$uri) {
            return false;
        }
        return $uri;
    }
}
