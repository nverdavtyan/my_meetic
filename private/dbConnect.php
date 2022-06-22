<?php
/* Connect to MySQL database with PDO */
class dbConnect{

    private static $Host = "localhost";
    private static $Name = "meetic";
    private static $User = "root";
    private static $UserPassword = "";
    private static $connection = null;
    public static function connect()
    {
        try
        {
            self::$connection = new PDO("mysql:host=" .self::$Host .";dbname=" . self::$Name,self::$User,self::$UserPassword);
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }

        return self::$connection;

    }


    public static function disconnect()
    {
        self::$connection = null;
    }

}
dbConnect::connect();