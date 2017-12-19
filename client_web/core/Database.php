<?php 

class Database {

    private static $db;
    
    static function getDb() {
        self::$db = new PDO("mysql:host=localhost;dbname=fantacalcio","root","");  
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db->exec("set names utf8");
        return self::$db;
    }
}

?>