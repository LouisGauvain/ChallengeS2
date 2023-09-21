<?php

namespace App\Models;

use App\Core\Sql;
use App\Core\Utils;

class Comments extends Sql
{
    protected Int $id = -1;
    protected String $content;
    protected String $user_name;
    protected Int $page_id;
    protected Int $parent_id;
    protected $date_created;
    protected Bool $statut_moderation;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    
    public function getUserName(): int
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): void
    {
        $this->user_name = $user_name;
    }

    public function getPageId(): int
    {
        return $this->page_id;
    }

    public function setPageId(int $page_id): void
    {
        $this->page_id = $page_id;
    }

    public function getParentId(): int
    {
        return $this->parent_id;
    }

    public function setParentId(int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    public function getDateCreated()
    {
        return $this->date_created;
    }

    public function setDateCreated($date_created): void
    {
        $this->date_created = $date_created;
    }

    public function getStatutModeration()
    {
        return $this->statut_moderation;
    }

    public function setStatutModeration($statut_moderation): void
    {
        $this->statut_moderation = $statut_moderation;
    }


    public function getCommentsTreeByPageID($id): array
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM " . $this->table . " WHERE page_id = :id AND statut_moderation = true");
        $query->execute(['id' => $id]);
        $result = $query->fetchAll();
        //Utils::var_dump_die($result);
        $commentsTree = $this->buildCommentTree($result);

        return $commentsTree;
    }


    private function buildCommentTree($comments, $parentId = 0) {
        $tree = [];
    
        foreach ($comments as $comment) {
            if ($comment['parent_id'] == $parentId) {
                $children = $this->buildCommentTree($comments, $comment['id']);
                if ($children) {
                    $comment['children'] = $children;
                }
                $tree[] = $comment;
            }
        }
    
        return $tree;
    }

    
    public function getCommentNonValidated(): array | bool
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM " . $this->table . " WHERE statut_moderation = false");
        $query->execute();
        $nonValidatedComments = $query->fetchAll();

        if (!$nonValidatedComments) {
            return false;
        }

        return $nonValidatedComments;
    }


    /*public function getChildrenByParentId($id)
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM " . $this->table . " WHERE parent_id = :id AND statut_moderation = true");
        $query->execute(['id' => $id]);
        $result = $query->fetchAll();
        //Utils::var_dump_die($result);
        return $result;
    }*/
}
