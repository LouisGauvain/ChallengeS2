<?php

namespace App\Models;

use App\Core\Sql;
use App\Core\Utils;

class Comments extends Sql
{
    protected Int $id = -1;
    protected String $content;
    protected Int $user_id;
    protected Int $page_id;
    protected Int $parent_id;
    protected $date_created;

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
    
    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
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


    public function getCommentsTreeByPageID($id)
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




    public function getChildrenByParentId($id)
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM " . $this->table . " WHERE parent_id = :id AND statut_moderation = true");
        $query->execute(['id' => $id]);
        $result = $query->fetchAll();
        //Utils::var_dump_die($result);
        return $result;
    }
}
