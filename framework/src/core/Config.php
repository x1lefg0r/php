<?php
namespace src\core;

class Config
{
    private static $db = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'database' => 'framework_db',
        'charset' => 'utf8mb4',
        'port' => 3306
    ];

    public static function getDbConfig(): array {
        return self::$db;
    }

    public static function get($key) {
        return self::$db[$key] ?? null;
    }
}