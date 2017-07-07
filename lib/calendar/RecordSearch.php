<?php
require_once  "$_SERVER[DOCUMENT_ROOT]/boilerplate/lib/PdoDbException.php";


class RecordSearch {
    
      private $connection;
      public $events;
      
      function  __construct(){
          $this->connection = null;
          $this->events=null; 
       }       
      function unset_con() {
          $this->connection = null;
      }        
      function get_data(){
          return $this->events;
      }
      function set_data($res){
          $this->events = $res;
      }
      function set_con($con){
          $this->connection = $con;
      }          
                  
      
      function countData() {        
          
          try {
             $stmt = $this->connection->getDBH()->query('SELECT COUNT(*) as num FROM eventcalender');
             if($stmt) {
                $count = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
                return $count[0];
             }else return 0;
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEWS");
           }          
      }
      
      function countDataType($args) {        
          
         $a=explode("/", $args["sdate"]);
         $a[1] = (int)$a[1];
         $a[2] = (int)$a[2];
         $a[0] = (int)$a[0];           
         $start_date=gregoriantojd($a[1], $a[2], $a[0]);         
         if(isset($args["edate"])) { print("--OK--");//If two dates are given
               $query = 'SELECT COUNT(*) as num FROM eventcalender WHERE evt_date >= ? and evt_date <= ? ORDER BY evt_date';                                                                              
               $b=explode("/", $args["edate"]);
               $end_date=gregoriantojd($b[1], $b[2], $b[0]);
               $diff = $end_date - $start_date;  
               $endDate = date("Y-m-d-D", mktime(0, 0, 0, $a[1],$a[2]+$diff,$a[0]));                
         }else {         
               $startDate = date("Y-m-d-D", mktime(0, 0, 0, $a[1], $a[2], $a[0]));       
               $query = 'SELECT COUNT(*) as num FROM eventcalender WHERE evt_date = ?';               
         }
         try {             
                $stmt = $this->connection->getDBH()->prepare($query);
                $stmt->bindParam(1, $startDate, PDO::PARAM_INT);
                if(isset($args["edate"]))
                    $stmt->bindParam(2, $endDate, PDO::PARAM_INT);             
                if($stmt->execute()) {
                    $count = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
                    return $count[0];
                }else return 0;
          }catch(PDOException $e){              print_r($e);
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEWS");
           }          
      }      
      
      function extract_data($start, $limit) {        

          try {
                $stmt = $this->connection->getDBH()->prepare('SELECT COUNT(*) as num FROM eventcalender WHERE evt_date >= ? and evt_date <= ?
                                                              ORDER BY post_date DESC LIMIT ?,?');
                $stmt->bindParam(1, $start, PDO::PARAM_INT);
                $stmt->bindParam(2, $limit, PDO::PARAM_INT);                  
                $stmt->bindParam(3, $start, PDO::PARAM_INT);
                $stmt->bindParam(4, $limit, PDO::PARAM_INT);                
                if($stmt->execute()) {
                    $this->events = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEWS");
           }          
      } 
      function extract_dataType($start, $limit, $args) {        
          
          $a=explode("/", $args["sdate"]);
          try {
              if(isset($args["edate"])) {  //If two dates are given
                    $b=explode("/", $args["edate"]);
                    $end_date=gregoriantojd($b[1], $b[2], $b[0]);
                    $start_date=gregoriantojd($a[1], $a[2], $a[0]);                    
                    $diff = $end_date - $start_date;
                    $startDate = date("Y-m-d-D", mktime(0, 0, 0, $a[1], $a[2], $a[0]));
                    $endDate = date("Y-m-d-D", mktime(0, 0, 0, $a[1],$a[2]+$diff,$a[0]));
                    $query = 'SELECT * FROM eventcalender WHERE evt_date >= ? and evt_date <= ?
                                                                  ORDER BY evt_date ASC LIMIT ?,?';
                    $stmt = $this->connection->getDBH()->prepare($query);
                    $stmt->bindParam(1, $startDate, PDO::PARAM_INT);
                    $stmt->bindParam(2, $endDate, PDO::PARAM_INT);                  
                    $stmt->bindParam(3, $start, PDO::PARAM_INT);
                    $stmt->bindParam(4, $limit, PDO::PARAM_INT);                     
              }else {
                    $a[1] = (int)$a[1];
                    $a[2] = (int)$a[2];
                    $a[0] = (int)$a[0]; 
                    $start_date=gregoriantojd($a[1], $a[2], $a[0]);                    
                    $startDate = date("Y-m-d-D", mktime(0, 0, 0, $a[1], $a[2], $a[0]));
                    $query = 'SELECT * FROM eventcalender WHERE evt_date = ?';  
                    $stmt = $this->connection->getDBH()->prepare($query);
                    $stmt->bindParam(1, $startDate, PDO::PARAM_INT);                      
              }                          
              if($stmt->execute()) {
                    $this->events = $stmt->fetchAll(PDO::FETCH_ASSOC);
               }
          }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEWS");
           }          
      } 
    function extract($id){

         try {
            $stmt = $this->connection->getDBH()->prepare("SELECT * FROM  eventcalender WHERE id=?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
               $this->events = $stmt->fetch(PDO::FETCH_ASSOC);
             }
         }catch(PDOException $e){
                throw new PDOException($e,"SELECT ERROR/EXTRACT NEW");           
         }   
    }

    function insert(){
        
         try {
            $evt_date = $this->events['year'].'-'.$this->events['month'].'-'.$this->events['day'];
            $evt_stime = $this->events['shour'].':'.$this->events['sminute'].':00';
            $sql =  "INSERT INTO eventcalender(evt_title, evt_date, evt_stime, evt_place, evt_ticket, evt_desc, evt_phone, evt_contact) VALUES
               (?,?,?,?,?,?,?,?)";
            $stmt = $this->connection->getDBH()->prepare($sql);
            $stmt->bindParam(1, $this->events['title'], PDO::PARAM_STR);
            $stmt->bindParam(2, $evt_date, PDO::PARAM_STR);
            $stmt->bindParam(3, $evt_stime, PDO::PARAM_STR);
            $stmt->bindParam(4, $this->events['place'], PDO::PARAM_STR);
            $stmt->bindParam(5, $this->events['ticket'], PDO::PARAM_INT); 
            $stmt->bindParam(6, $this->events['desc'], PDO::PARAM_STR);
            $stmt->bindParam(7, $this->events['phone'], PDO::PARAM_STR);
            $stmt->bindParam(8, $this->events['url'], PDO::PARAM_STR);            
            if($stmt->execute())
                return TRUE;
            else 
                return FALSE;            
          }catch(PDOException $e){
               print $e;
                throw new PDOException($e);           
          } 
    }
} ?>

<script type="text/javascript">
function searchBack()
{
	window.history.back();
}
</script>
