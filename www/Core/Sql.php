<?php

namespace App\Core;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

abstract class Sql
{
    private static $instance;
    protected $pdo;
    protected $table;

    abstract public function getId(): int;

    public function __construct()
    {
        //Mettre en place un SINGLETON
        try {
            $dbHost = $_ENV['DB_HOST'];
            $dbName = $_ENV['DB_NAME'];
            $dbUsername = $_ENV['DB_USERNAME'];
            $dbPassword = $_ENV['DB_PASSWORD'];
            $dbPrefix = $_ENV['DB_PREFIX'];
            $this->pdo = new \PDO("pgsql:host=$dbHost;port=5432;dbname=$dbName", $dbUsername, $dbPassword);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = end($classExploded);
        $this->table = preg_replace('/(?<!^)[A-Z]/', '_$0', $this->table);
        $this->table = $dbPrefix . strtolower($this->table);
    }

    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function query($sql): \PDOStatement
    {
        return $this->pdo->query($sql);
    }

    public function prepare($sql): \PDOStatement
    {
        return $this->pdo->prepare($sql);
    }

    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToDeleted = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToDeleted);
        unset($columns["id"]);
        unset($columns[""]);

        foreach ($columns as $key => $value) {
            if (empty($value)) {
                unset($columns[$key]);
            }
        }

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

    public function findAll($sort = null, $order = null ): array
    {
        if ($sort && $order) {
            $query = $this->pdo->query("SELECT * FROM " . $this->table . " ORDER BY " . $sort . " " . $order);
        } else {
            $query = $this->pdo->query("SELECT * FROM " . $this->table);
        }
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete ($id): void
    {
        $queryPrepared = $this->pdo->prepare("DELETE FROM " . $this->table . " WHERE id=:id");
        $queryPrepared->execute(["id" => $id]);
    }

    public function find($id): array
    {
        $queryPrepared = $this->pdo->prepare("SELECT * FROM " . $this->table . " WHERE id=:id");
        $queryPrepared->execute(["id" => $id]);
        return $queryPrepared->fetch(\PDO::FETCH_ASSOC);
    }
}
