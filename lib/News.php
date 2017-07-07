<?php
require_once  "$_SERVER[DOCUMENT_ROOT]/boilerplate/lib/PdoDbException.php";
 
class News {
    
      private $connection;
      public $news;
      
      function  __construct(){
          $this->connection = null;
          $this->news=null; 
       }       
      function unset_con() {
          $this->connection = null;
      }        
      function get_data(){
          return $this->news;
      }
      function set_data($res){
          $this->news = $res;
      }
      function set_con($con){
          $this->connection = $con;
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
      function countDataType($args) {        
          
          try {
             $stmt = $this->connection->getDBH()->prepare('SELECT COUNT(*) as num FROM news WHERE type=?');
             $stmt->bindParam(1, $args['type'], PDO::PARAM_INT);
             if($stmt->execute()) {
                $count = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
                return $count[0];
             }else return 0;
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEWS");
           }          
      }      
      function extract_data($start, $limit) {        

          try {
                $stmt = $this->connection->getDBH()->prepare('SELECT id, title, SUBSTRING(content,1,200) as content,
                post_date, post_by, image FROM news ORDER BY post_date DESC LIMIT ?,?');
                $stmt->bindParam(1, $start, PDO::PARAM_INT);
                $stmt->bindParam(2, $limit, PDO::PARAM_INT);                
                if($stmt->execute()) {
                    $this->news = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEWS");
           }          
      } 
      function extract_dataType($start, $limit, $args) {        

          try {
                $stmt = $this->connection->getDBH()->prepare('SELECT id, title, SUBSTRING(content,1,200) as content,
                post_date, post_by, image FROM news WHERE type=? ORDER BY post_date DESC LIMIT ?,?');
                $stmt->bindParam(1, $args['type'], PDO::PARAM_INT);
                $stmt->bindParam(2, $start, PDO::PARAM_INT);
                $stmt->bindParam(3, $limit, PDO::PARAM_INT);                
                if($stmt->execute()) {
                    $this->news = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEWS");
           }          
      } 
    function extract($id){

         try {
            $stmt = $this->connection->getDBH()->prepare("SELECT * FROM  news WHERE id=?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
               $this->news = $stmt->fetch(PDO::FETCH_ASSOC);
             }
         }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEW");           
         }   
    }

}
?>
