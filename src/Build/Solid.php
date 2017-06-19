<?php

namespace CodeBot\Build;

use CodeBot\Bot;

class Solid
{
    private static $instance;

    private function __construct() {}
    private function __clone() {}

    public static function factory()
    {
        if (self::$instance === null) {
            self::$instance = new Bot;
        }
        return self::$instance;
    }

    public static function __callStatic($name, $arguments)
    {
        call_user_func_array([self::$instance, $name], $arguments);
    }
}