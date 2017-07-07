<?php
/**
 * Description of Tours
 *
 * @author Διονύσης
 */
class Tours {
    
      private  $connection;
      public $tours;
       
      function  __construct(){
          $this->connection = null;
          $this->tours=null;
       }       
      function unset_con() {
          $this->connection = null;
      }        
      function set_data($res){
          $this->tours = $res;
      }
      function get_data(){
          return $this->tours;
      }
      function set_con($con){
          $this->connection = $con;
      }
      function countData() {        
          
          try {
             $stmt = $this->connection->getDBH()->query('SELECT COUNT(*) as num FROM tours');
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
                $stmt = $this->connection->getDBH()->prepare('SELECT * FROM tours ORDER BY tour_date LIMIT ?,?');
                $stmt->bindParam(1, $start, PDO::PARAM_INT);
                $stmt->bindParam(2, $limit, PDO::PARAM_INT);                
                if($stmt->execute()) {
                    $this->tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }                
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT TOURS");
          }          
      }
      
      function extract($id){

         try {
            $stmt = $this->connection->getDBH()->prepare("SELECT * FROM  tours WHERE id=?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
               $this->tours = $stmt->fetch(PDO::FETCH_ASSOC);
             }
         }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT TOUR");           
         }   
      } 
}

?>
