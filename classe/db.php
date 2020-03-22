<?php

class Db
{

    private static $conn;

    public static function getConnection()
    {
        include_once(__DIR__ . "/../settings/settings.php");

        if (self::$conn === null) {
            self::$conn = new PDO('mysql:host=' . SETTINGS['db']['host'] . ';dbname=' . SETTINGS['db']['db'] . ';port=' . SETTINGS['db']['port'] . "'", SETTINGS['db']['user'], SETTINGS['db']['password']);
            return self::$conn;
            var_dump($conn);
            echo $conn->connect_errno;
        } else {
            return self::$conn;
            var_dump($conn);
            echo $conn->connect_errno;
        }
    }
}
