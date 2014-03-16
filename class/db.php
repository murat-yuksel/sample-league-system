<?php


class db {

    public static $dbhost = 'localhost';
    public static $dbname = 'champions';
    public static $dbuser = 'root';
    public static $dbpass = '';
    static $db;

    public function __construct()
    {
        if(empty(self::$db))
        {
            try {
                self::$db = new PDO('mysql:host='.self::$dbhost.';dbname='.self::$dbname.';charset=utf8',
                    self::$dbuser,self::$dbpass);
            }
            catch (\PDOException $e)
            {
                die('Bağlantı hatası');
            }
        }

        self::charset('utf8');
    }

    public static function getdb()
    {
        if(empty(self::$db))
            new db();

        return self::$db;
    }

    static function charset($ch = 'utf8')
    {
        self::$db->exec("set names ".$ch);
    }

    public static function getDbName()
    {
        return self::$dbname;
    }

}