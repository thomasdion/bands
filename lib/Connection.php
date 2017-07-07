<?php
    require_once  "$_SERVER[DOCUMENT_ROOT]/../login.php";
    require_once  "$_SERVER[DOCUMENT_ROOT]/boilerplate/lib/PdoDbException.php";


    class Connection {
        private static $host = DB_HOST;
        private static $db   = DB_NAME;
        private static $user = DB_USER;
        private static $psw = DB_PASSWORD;
        private  $DBH='';

        function __construct() {
            $this->connect();
        }
        function getDBH(){
            return $this->DBH;
        }
        
        public function connect(){
         try {  
            $this->DBH = new PDO("mysql:host=".self::$host.";dbname=".self::$db, self::$user, self::$psw);  
            $this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
         }  
         catch(PDOException $e) {              
            throw new PdoDbException($e,"PDODatabase Error");
          }
        }
        
    }

?>
