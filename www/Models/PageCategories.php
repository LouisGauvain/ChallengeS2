<?php

namespace App\Models;

use App\Core\Sql;
use App\Core\Utils;

use App\Models\Categories;

class PageCategories extends Sql
{
    protected Int $id = -1;
    protected Int $page_id;
    protected Int $category_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setCategories($categoriesName, int $idPage)
    {
        $category = new Categories();
        Utils::var_dump($category->findAll());
        foreach ($categoriesName as $categoryName) {
            $categoryName = substr($categoryName, 4);
            $categoryName = str_replace("_", " ", $categoryName);
            $categoryId = $category->getByName($categoryName);
            $db = $this::getInstance();
            $query = $db->prepare("INSERT INTO " . $this->table . " (page_id, category_id) VALUES (:page_id, :category_id)");
            $query->execute(['page_id' => $idPage, 'category_id' => $categoryId]);
        }
    }

    public function getCategoriesByPageId($id): array | bool
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM " . $this->table . " WHERE page_id = :page_id");
        $query->execute(['page_id' => $id]);
        $result = $query->fetchAll();

        $category = new Categories();
        $categories = [];
        foreach ($result as $value) {
            $categories[] = $category->findById($value['category_id']);
        }
        return $categories;

    }
}
