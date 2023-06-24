<?php

namespace App\Core;

class Utils
{
    public static function var_dump($variable)
    {
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
    }

    public static function var_dump_die($variable)
    {
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
        die();
    }

    public static function setSession($user)
    {
        session_start();
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
    }
}
