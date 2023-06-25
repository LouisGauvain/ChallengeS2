<?php

namespace App\Models;

use App\Core\Sql;

class Tokens extends Sql
{

    protected Int $id = -1;
    protected Int $user_id;
    protected String $token;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Int $id
     */
    public function setId(Int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Int
     */
    public function getUserId(): Int
    {
        return $this->user_id;
    }

    /**
     * @param Int $user_id
     */
    public function setUserId(Int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return String
     */
    public function getToken(): String
    {
        return $this->token;
    }

    /**
     * @param String $token
     */
    public function setToken(String $token): void
    {
        $this->token = $token;
    }

    public function createToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $this->setToken($token);
        $this->save();

        return $token;
    }

    public function checkToken(): bool
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM esgi_tokens WHERE token = :token AND user_id = :user_id");
        $query->execute([
            'token' => $this->getToken(),
            'user_id' => $_SESSION['user']['id']
        ]);
        $result = $query->fetch();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateToken(): void
    {

        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM esgi_tokens WHERE token = :token AND user_id = :user_id");
        $query->execute([
            'token' => $this->getToken(),
            'user_id' => $_SESSION['user']['id']
        ]);
        echo "<pre>";
        var_dump($query);
        var_dump($this->getToken());
        var_dump($_SESSION['user']['id']);
        echo "</pre>";
        $result = $query->fetch();
        if (!$result) {
            $this->createToken();
        } else {
            $token = bin2hex(random_bytes(32));
            $this->setId($result['id']);
            $this->setToken($token);
            $this->save();

        }
    }
}
