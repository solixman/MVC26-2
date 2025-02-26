<?php 



class Database {
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "Jaafar@27";
    private static $dbname = "MVC";
    private static $connexion;
    private static $instance;
   
    private function __construct(){
        if (!self::$connexion) {
            try {
                self::$connexion = new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname.";charset=UTF8",self::$username,self::$password);
                self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo("connexion done with no issues");
            } catch (PDOException $e) {
                echo'Error:'.$e;
            }
        }
        
    }

    public static function getInstance() {
        if(!self::$instance){
            self::$instance = new Database();
        }
            return self::$instance ;
        }
        
        public function getConnection(){
            return self::$connexion;
        }



       
}

// Database::getInstance()->getConnection();
