<?php
require_once  "$_SERVER[DOCUMENT_ROOT]/boilerplate/lib/PdoDbException.php";

class Users {
    
      private $connection;
      public $users;
       
      function  __construct(){
          $this->connection = null;
          $this->users=null; 
       }       
      function unset_con() {
          $this->connection = null;
      }        
      function set_data($res){
          $this->users = $res;
      }
      function get_data(){
          return $this->users;
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
                $stmt = $this->connection->getDBH()->prepare('SELECT users.user_id, username, name, surname, email, newsletter, 
                                roles.role_id, role as role_des FROM users, roles, user_role
                                WHERE roles.role_id = user_role.role_id
                                AND user_role.user_id = users.user_id
                                ORDER BY username LIMIT ?,?');              

                $stmt->bindParam(1, $start, PDO::PARAM_INT);
                $stmt->bindParam(2, $limit, PDO::PARAM_INT);                
                if($stmt->execute()) {
                    $this->users = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            $sql =  'UPDATE users SET name=?,surname=?,email=?,newsletter=? WHERE user_id=?';
            $stmt = $this->connection->getDBH()->prepare($sql);
            $stmt->bindParam(1, $this->users['name'], PDO::PARAM_STR);
            $stmt->bindParam(2, $this->users['surname'], PDO::PARAM_STR);
            $stmt->bindParam(3, $this->users['email'], PDO::PARAM_STR);
            $stmt->bindParam(4, $this->users['newsletter'], PDO::PARAM_INT);
            $stmt->bindParam(5, $this->users['user_id'], PDO::PARAM_INT);            
            $stmt->execute();
            if($stmt->rowCount())
                $us_upd=TRUE;
            $stmt->closeCursor();
            $sql = 'UPDATE user_role SET role_id=? WHERE user_id=?';
            $stmt2 = $this->connection->getDBH()->prepare($sql);          
            $stmt2->bindParam(1, $this->users['role_id'], PDO::PARAM_INT);
            $stmt2->bindParam(2, $this->users['user_id'], PDO::PARAM_INT);
            $stmt2->execute();
            if($stmt->rowCount())
                $role_upd=TRUE;
            return($us_upd&&$role_upd);
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
