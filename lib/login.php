<?php
    
       function logHistory($con, $userId, $oper) {
         try {
            $sql =  "INSERT INTO log_history(us_id, operation, ip) VALUES
               (?,?,?)";
            $stmt = $con->getDBH()->prepare($sql);
            $stmt->bindParam(1, $userId, PDO::PARAM_STR);
            $stmt->bindParam(2, $oper, PDO::PARAM_STR);
            $ip = getIP();
            $stmt->bindParam(3, $ip, PDO::PARAM_INT);
            $stmt->execute();
          }catch(PDOException $e){
                throw new PDOException($e);           
          }         
    }
    
      function getIP() {
          
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        //Is it a proxy address
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        //The value of $ip at this point would look something like: "192.0.34.166"
        $ip = ip2long($ip);
        //The $ip would now look something like: 1073732954
        return $ip;
     }
?>
