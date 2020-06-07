<?php
class DBConn{
private static $connection = NULL;

public static function getConnection(){

    if(is_null(self::$connection)){
       $dsn = "mysql:host=localhost;dbname=tw";
       $user = "alex2";
       $passwd = "Test1234@";

       self::$connection = new PDO($dsn,$user,$passwd);
    }

    return self::$connection;
}
//Alexandru Ichim
}
?>