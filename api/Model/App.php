<?php

class App
{
    static $db = null;

    /**
     * @return Database|null
     */
    static function getDatabase()
    {
        if (!self::$db) {
            self::$db = new Database('root', '', 'rush2_db');
        }

        return self::$db;
    }
}