<?php

namespace App\Core;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

abstract class Sql
{

    protected $pdo;
    private $table;

    public function __construct()
    {
        //Mettre en place un SINGLETON
        try {
            $dbHost = $_ENV['DB_HOST'];
            $dbName = $_ENV['DB_NAME'];
            $dbUsername = $_ENV['DB_USERNAME'];
            $dbPassword = $_ENV['DB_PASSWORD'];
            $this->pdo = new \PDO("pgsql:host=$dbHost;port=5432;dbname=$dbName", $dbUsername, $dbPassword);
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = end($classExploded);
        $this->table = "esgi_" . strtolower($this->table);
    }

    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToDeleted = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToDeleted);
        unset($columns["id"]);

        if (is_numeric($this->getId()) && $this->getId() > 0) {
            $columnsUpdate = [];
            foreach ($columns as $key => $value) {
                $columnsUpdate[] = $key . "=:" . $key;
            }
            $queryPrepared = $this->pdo->prepare("UPDATE " . $this->table . " SET " . implode(",", $columnsUpdate) . " WHERE id=" . $this->getId());
        } else {
            $queryPrepared = $this->pdo->prepare("INSERT INTO " . $this->table . " (" . implode(",", array_keys($columns)) . ") 
                            VALUES (:" . implode(",:", array_keys($columns)) . ")");
        }

        $queryPrepared->execute($columns);
    }
}
