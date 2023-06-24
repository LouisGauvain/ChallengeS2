<?php

namespace App\Models;

use App\Core\Sql;

class Users extends Sql
{

    protected Int $id = -1;
    protected String $firstname;
    protected String $lastname;
    protected String $email;
    protected String $password;
    protected Int $role_id;
    protected String $verification_token;
    protected Int $email_verified;
    protected $date_inserted;
    protected $date_updated;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return String
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     */
    public function setRoleId(int $role_id): void
    {
        $this->role_id = $role_id;
    }

    /**
     * @return int
     */
    public function getVericationToken(): int
    {
        return $this->verification_token;
    }

    /**
     * @param int $verification_token
     */
    public function setVericationToken(String $verification_token): void
    {
        $this->verification_token = $verification_token;
    }

    /**
     * @return int
     */
    public function getEmailVerified(): int
    {
        return $this->email_verified;
    }

    /**
     * @param int $email_verified
     */
    public function setEmailVerified(int $email_verified): void
    {
        $this->email_verified = $email_verified;
    }

    /**
     * @return mixed
     */
    public function getDateInserted()
    {
        return $this->date_inserted;
    }

    /**
     * @param mixed $date_inserted
     */
    public function setDateInserted($date_inserted): void
    {
        $this->date_inserted = $date_inserted;
    }

    /**
     * @return mixed
     */
    public function getDateUpdated()
    {
        return $this->date_updated;
    }

    /**
     * 
     * @param mixed $date_updated
     */
    public function setDateUpdated($date_updated): void
    {
        $this->date_updated = $date_updated;
    }

    public function login(): array
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM esgi_users WHERE email=:email");
        $query->execute([
            'email' => $this->getEmail()
        ]);

        $user = $query->fetch();
        if (!$user) {
            return false;
        }

        if (!password_verify($_POST['user_password'], $this->getPassword())) {
            var_dump($this->getPassword());
            var_dump($user['password']);
            return false;
        }

        return $user;
    }

    public function emailExist($email): bool
    {
        $db = $this::getInstance();
        $query = $db->prepare("SELECT * FROM esgi_users WHERE email=:email");
        $query->execute([
            'email' => $email
        ]);

        $user = $query->fetch();
        if (!$user) {
            return false;
        }
        return true;
    }
}
