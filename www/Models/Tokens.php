<?php

namespace App\Models;

use App\Core\Sql;

class Tokens extends Sql{

    protected Int $id;
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

    public function createToken(Int $user_id, String $token): void
    {
        $this->setUserId($user_id);
        $this->setToken($token);
        $this->save();
    }

}