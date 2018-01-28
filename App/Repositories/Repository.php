<?php

namespace App\Repositories;

use \PDO;

abstract class Repository
{
    /**
     * @var PDO
     */
    private static $db;

    /**
     * @throws \PDOException
     */
    public static function getDb()
    {
        if (null === self::$db) {
            self::$db = new PDO(
                'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME'),
                getenv('DB_USER'),
                getenv('DB_PASS')
            );

            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;
    }

    /**
     * @param PDO $db
     */
    public static function setDb(PDO $db)
    {
        self::$db = $db;
    }
}
