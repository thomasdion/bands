<?php
require_once  "$_SERVER[DOCUMENT_ROOT]/boilerplate/lib/PdoDbException.php";

class Banned {
    
      private $connection;
      public $banned;
       
      function  __construct(){
          $this->connection = null;
          $this->banned=null; 
       }       
      function unset_con() {
          $this->connection = null;
      }        
      function set_data($res){
          $this->banned = $res;
      }
      function get_data(){
          return $this->banned;
      }
      function set_con($con){
          $this->connection = $con;
      }
      function countData() {        
          
          try {
             $stmt = $this->connection->getDBH()->query('SELECT COUNT(*) as num FROM users');
             if($stmt) {
                $count = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
                return $count[0];
             }else return 0;
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT USERS");
           }          
      }      
      function extract_data($start, $limit) {        
          
          try {
                $stmt = $this->connection->getDBH()->prepare('SELECT id, ip, status FROM banned LIMIT ?,?');              
                $stmt->bindParam(1, $start, PDO::PARAM_INT);
                $stmt->bindParam(2, $limit, PDO::PARAM_INT);                
                if($stmt->execute()) {
                    $this->banned = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }                  
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT USERS");
           }          
      } 

    function extract($id){

         try {
            $stmt = $this->connection->getDBH()->prepare('SELECT users.user_id, username, name, surname, email, newsletter,
                                roles.role_id,role as role_des FROM users, roles, user_role
                                WHERE roles.role_id = user_role.role_id
                                AND user_role.user_id = users.user_id AND users.user_id=?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
               $this->users = $stmt->fetch(PDO::FETCH_ASSOC);
             }
         }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEW");           
         }   
    }
    function update(){
        
         $us_upd=FALSE;
         $role_upd=FALSE;
         try {
            $sql =  'UPDATE banned SET status=? WHERE id=?';
            $stmt = $this->connection->getDBH()->prepare($sql);
            $stmt->bindParam(1, $this->banned['status'], PDO::PARAM_STR);
            $stmt->bindParam(2, $this->banned['id'], PDO::PARAM_STR);            
            $stmt->execute();
            if($stmt->rowCount())
                return TRUE;
            return FALSE;
         }catch(PDOException $e){
                throw new PDOException($e."SELECT ERROR/UPDATE USER");           
         } 
    }
    
    function delete($id){
        
         try {
            $sql =  "DELETE FROM news WHERE id=?";
            $stmt = $this->connection->getDBH()->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount())
                return TRUE;
            else
                return FALSE;
         }catch(PDOException $e){
                throw new PDOException($e,"DELETE ERROR/DELETE NEW");           
         } 
    }
    
    function insert(){
        
         try {
            $sql =  "INSERT INTO news(title, content, post_by, image) VALUES
               (?,?,?,?)";
            $stmt = $this->connection->getDBH()->prepare($sql);
            $stmt->bindParam(1, $this->nea['title'], PDO::PARAM_STR);
            $stmt->bindParam(2, $this->nea['content'], PDO::PARAM_STR);
            $stmt->bindParam(3, $this->nea['post_by'], PDO::PARAM_INT);
            $stmt->bindParam(4, $this->nea['image'], PDO::PARAM_STR);
            $stmt->execute();
          }catch(PDOException $e){
                throw new PDOException($e);           
          } 
    }
}
?>
