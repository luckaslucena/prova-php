<?php
class Database
{
    public static  $connection;

    public static function getConnection()
    {
        $databaseFile = realpath("./database/db.sqlite");

        try {
            self::$connection = new PDO("sqlite:{$databaseFile}");
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$connection;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
}