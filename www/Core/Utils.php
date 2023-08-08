<?php

namespace App\Core;

class Utils
{
    public static function var_dump($variable): void
    {
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
    }

    public static function var_dump_die($variable): void
    {
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
        die();
    }

    public static function setSession($user, $token): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user'] = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'email_verified' => $user['email_verified'],
            'date_inserted' => $user['date_inserted'],
            'date_updated' => $user['date_updated'],
        ];
        $_SESSION['token'] = $token;
    }

    public static function setSessionToken($token): void
    {
        $_SESSION['token'] = $token;
    }

    public static function redirect($url): void
    {
        //if already at the right url, don't redirect
        if (trim($_SERVER['REQUEST_URI'], '/') === $url) {
            return;
        }

        header("Location: " . $url);
        exit();
    }

    public static function isAdmin(): bool
    {
        $user = $_SESSION['user'];
        if ($user['role_id'] == '1') {
            return true;
        }
        return false;
    }
}
