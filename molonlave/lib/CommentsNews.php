<?php
require_once  "$_SERVER[DOCUMENT_ROOT]/boilerplate/lib/PdoDbException.php";

class CommentsNews {
    
      private  $connection;
      public $nea;
      public $comm;
      public $count;
       
      function  __construct(){
          $this->connection = null;
          $this->nea = array();          
          $this->comm = array(); 
          $this->count=0;
       }       
      function unset_con() {
          $this->connection = null;
      }        
      function set_data($res){
          $this->comm = $res;
      }
      function get_data(){
          $data[1] = $this->nea;
          $data[2] = $this->comm;
          $data[3] = $this->count;
          return $data;
      }
      function set_con($con){
          $this->connection = $con;
      }
      function get_count(){
          return $this->count;
      }
      function countData() {        
          
          try {
             $stmt = $this->connection->getDBH()->query('SELECT COUNT(*) as num FROM news');
             if($stmt) {
                $count = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
                return $count[0];
             }else return 0;
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEWS");
           }          
      }      
      function extract_data($start, $limit) {        
          
          try {
                $stmt = $this->connection->getDBH()->prepare('SELECT id, title, SUBSTRING(content,1,100) as content,
                post_date,post_by FROM news ORDER BY post_date LIMIT ?,?');
                $stmt->bindParam(1, $start, PDO::PARAM_INT);
                $stmt->bindParam(2, $limit, PDO::PARAM_INT);                
                if($stmt->execute()) {                
                    $i = 0;
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $i+=1;                    
                        $this->nea[$i] = $row;
                        $this->comm[$i] = null;
                        $stmt2 = $this->connection->getDBH()->prepare("(SELECT c_n.id, c_n.post_date, c_n.comment,c_n.reply,  c_n.id as id2, users.username, flags.flag 
                            FROM comments_news as c_n, flags, users WHERE reply=0
                            AND c_n.user=users.user_id AND c_n.flag=flags.flag_id AND c_n.new=?)
                            UNION
                            (SELECT c_n.id, c_n.post_date, c_n.comment,c_n.reply,  c_n.reply as id2, users.username, flags.flag 
                            FROM comments_news as c_n, flags, users WHERE reply >0
                            AND c_n.user=users.user_id AND c_n.flag=flags.flag_id AND c_n.new=?)
                            ORDER BY id2, post_date");
                        $stmt2->bindParam(1, $row['id'],PDO::PARAM_INT);
                        $stmt2->bindParam(2, $row['id'],PDO::PARAM_INT);                    
                        if ($stmt2->execute()) {
                            $this->comm[$i] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                         }
                        $stmt2->closeCursor();                     
                    }
                    $this->count = $i;
              }   
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT Comments");
           }          
      } 

    function extract($id){

         try {
            $stmt = $this->connection->getDBH()->prepare("SELECT * FROM  comments_news WHERE id=?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
               $this->comm = $stmt->fetch(PDO::FETCH_ASSOC);
             }
         }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT COMMENT NEW");           
         }   
    }
    function update(){
        
         try {
            $sql =  "UPDATE comments_news SET comment=?,flag=? WHERE id=?";
            $stmt = $this->connection->getDBH()->prepare($sql);
            $stmt->bindParam(1, $this->comm['comment'], PDO::PARAM_STR);
            $stmt->bindParam(2, $this->comm['flag'], PDO::PARAM_INT);
            $stmt->bindParam(3, $this->comm['id'], PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount())
                return TRUE;
            else
                return FALSE;
         }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/UPDATE COMMENT");           
         } 
    }
    
    function delete($id){
        
         try {
            $sql =  "DELETE FROM comments_news WHERE id=?";
            $stmt = $this->connection->getDBH()->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount())
                return TRUE;
            else
                return FALSE;
         }catch(PDOException $e){
                throw new PDOException($e,"DELETE ERROR/DELETE COMMENT NEW");           
         } 
    }
    
    function insert(){
        
         try {
            $sql =  "INSERT INTO comments_news(user, new, comment, flag, reply) VALUES
               (?,?,?,?,?)";
            $stmt = $this->connection->getDBH()->prepare($sql);
            $stmt->bindParam(1, $this->comm['user'], PDO::PARAM_INT);
            $stmt->bindParam(2, $this->comm['new'], PDO::PARAM_INT);            
            $stmt->bindParam(3, $this->comm['comment'], PDO::PARAM_STR);
            $stmt->bindParam(4, $this->comm['flag'], PDO::PARAM_INT);
            $stmt->bindParam(5, $this->comm['reply'], PDO::PARAM_INT);            
            if($stmt->execute())
                return TRUE;
            else
                return FALSE;
          }catch(PDOException $e){
                throw new PDOException($e);           
          } 
    } 
}
?>
