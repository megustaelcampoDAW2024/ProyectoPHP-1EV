<?php
namespace App\Models;
use PDO;

class SingletonDB
{ 
    public $conn;
    private static $dns = "mysql:host=localhost;dbname=constructora"; 
    private static $user = "root";
    private static $pass = "";
    private static $instance;

    public function __construct ()
    {
       $this->conn = new PDO(self::$dns,self::$user,self::$pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
    ));
    }

    public static function getInstance()
    { 
        if(!isset(self::$instance)) 
        { 
            $object= __CLASS__;
            self::$instance=new $object;
        } 
        return self::$instance;
    }
}
?>