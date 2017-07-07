<?php
require_once  "$_SERVER[DOCUMENT_ROOT]/boilerplate/lib/PdoDbException.php";
include_once(ABS_PATH.'lib/sanitize.php');

class Admin {
    
      private $connection;
      private $username;
      private $password;
      public $keepMeLogged;
      private $php_salt='dj@kf93tb.q%*pk@1aszdoo9$.'; //internal salt incase db is exposed
      private $db_private; //will fetch db pasw and salt
      private $login=FALSE;
      
      
      function  __construct(){
          $this->connection = null;
          $this->nea=null; 
       }       
      function unset_con() {
          $this->connection = null;
      }        
      function setUsr($usr){
          $this->username=$usr;
      }
      function setPsw($psw){
          $this->password=$psw;
      }
      function getUsr(){
          return $this->username;
      }   
      function getUsrID(){
          return $this->db_private['user_id'];
      }
      function setKeepMeLogged($logged){
          $this->keepMeLogged = $logged;
      }      
      function getKeepMeLogged(){
          return $this->keepMeLogged;
      }
      function set_con($con){
          $this->connection = $con;
      }
      
     function validateUsernamePassword(){
        
        if(!(strlen($this->username)<6||strlen($this->username)>35||strlen($this->password)<8||strlen($this->password)>256)) {
           $usr_reg = "/(?!^[0-9]*$)(?!^[a-zA-Z_@$.\s+&*]*$)(?!^[0-9_@$.\s+&*]*$)(?!^[0-9_@$.\s+&*]{1})^([a-zA-Z0-9_@$.\s+&*]{6,35})$/";
             /*"/(?!^[0-9]*$)           #Ensure that username isnt consisting by numbers only
             (?!^[a-zA-Z_@$.\s+&*]*$)   #Ensure it isnt consisting by letters and extra chars only 
             (?!^[0-9_@$.\s+&*]*$)      #Ensure it isnt consisting by numbs and extra chars only 
             (?!^[0-9_@$.\s+&*]{1})     #Ensure it isnt starting with numb or spec char
             ^([a-zA-Z0-9_@$.\s+&*]{6,35})$
            /"; */ 
           if(preg_match($usr_reg, $this->username)){
               $psw_reg = "/(?!^[0-9]*$)(?!^[a-zA-Z]*$)^(.{8,256})$/";
               if(preg_match($psw_reg, $this->password))
                   return TRUE;
           }              
        }
        return FALSE;
     }
    
    function login() {
        
         try {
            $sql =  "SELECT user_id, password, salt FROM users WHERE username=?";
            $stmt = $this->connection->getDBH()->prepare($sql);
            $stmt->bindParam(1, $this->username, PDO::PARAM_STR);
            if ($stmt->execute()) {  
               $this->db_private = $stmt->fetch(PDO::FETCH_ASSOC);
               $salt = $this->db_private['salt'].$this->php_salt;
               $this->password =  pbkdf2('sha256',$this->password,$salt,6000,64);
               $stmt->closeCursor();/*
                $sql =  "UPDATE users SET password=? WHERE username='thomasdion34'";
                $stmt = $this->connection->getDBH()->prepare($sql);
                $stmt->bindParam(1, $this->password, PDO::PARAM_STR);   
                $stmt->execute();*/ 
               
               if($this->db_private['password']==$this->password) {
                  logHistory($this->connection, $this->db_private['user_id'], "login");
                  return TRUE;               
               }  
             }
          return FALSE;   
         }catch(PDOException $e){
                throw new PDOException($e);           
         }         
    }
    
    function ban($ip){
        
         try {
            $sql =  "INSERT INTO banned(ip) VALUES(?)";
            $stmt = $this->connection->getDBH()->prepare($sql);
            $stmt->bindParam(1, $ip, PDO::PARAM_INT);
            $stmt->execute();
            $stmt = NULL;
          }catch(PDOException $e){
                throw new PDOException($e);           
          }         
    }   
   function checkBan($ip){
        
         try {
            $stmt = $this->connection->getDBH()->prepare("SELECT * FROM  banned WHERE ip=? AND status='Banned'");
            $stmt->bindParam(1, $ip, PDO::PARAM_INT);
            $stmt->execute();
             if($stmt->rowCount())
                return TRUE;
            else
                return FALSE;
            $stmt = NULL;
         }catch(PDOException $e){
                throw new PdoDbException($e,"SELECT ERROR/EXTRACT BANNED");           
         }          
    }     

}
?>
