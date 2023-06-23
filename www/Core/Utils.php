<?php

namespace App\Core;

class Utils {
    public static function var_dump($variable) {
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
    }

    public static function var_dump_die($variable) {
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
    }
}
