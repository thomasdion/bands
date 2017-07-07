<?php

class SesControl {
    
    private $tokenId='';
    CONST _COOKIE_EXPIRE_ = 3600;         //Cookies' expiration time 1 hour
    CONST _SESSION_NAME_ = 'aossessid'; //Change from the default PHPSESSID name 
    CONST _SESSION_CONFIRMATION_ = '_LOGED_IN_AOS'; //If session==true user is loged
    CONST _SESSION_ENTROPY_ = '/dev/urandom';    //Set the entropy
    CONST _SESSION_ENTROPY_LENGTH = '32';       //Set the entropy length
    CONST _SESSION_HASH_ = 'sha256';            //Set the hash method
    CONST _TOKEN_SALT_ = 'RE$@Gp98&.mn%65';    
    
    function set_ini(){
        //Change the predefined PHPSESSID name of Sessions
        session_name(self::_SESSION_NAME_);                
        //ini_set('session.name',self::_SESSION_NAME_);
        // **PREVENTING SESSION HIJACKING**
        // Prevents javascript XSS attacks aimed to steal the session ID (jscript cant access cookies now)
        ini_set('session.cookie_httponly', 1);
        // Adds entropy into the randomization of the session ID, as PHP's random number
        // generator has some known flaws
        ini_set('session.entropy_file', self::_SESSION_ENTROPY_);
        ini_set('session.entropy_length', self::_SESSION_ENTROPY_LENGTH);        
        // Uses a strong hash
        ini_set('session.hash_function', self::_SESSION_HASH_);
        // **PREVENTING SESSION FIXATION**
        // Session ID cannot be passed through URLs
        ini_set('session.use_cookies', 'true');       
        ini_set('session.use_only_cookies', 1);
        // Uses a secure connection (HTTPS) if possible
        //if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') 
           //ini_set('session.cookie_secure', 1);        
        session_start();

    }
    
    function regenerate(){
        
        session_regenerate_id();  //regenerate the session
    }
    
    function generateTokenId($con,$usrId){
        
        $tokenID = openssl_random_pseudo_bytes(64, $cstrong);
        if (!$cstrong) { //check if strong algorithm was used to produce the pseudo-random bytes,
          // exit 'This should not happen';
        }        
         try {
            $sql =  "UPDATE users SET token_id=? WHERE user_id=?";
            $stmt = $con->getDBH()->prepare($sql);
            $stmt->bindParam(1, $tokenID, PDO::PARAM_STR);
            $stmt->bindParam(2, $usrId, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount()){
                $this->tokenId = $tokenID;
                return TRUE;
            }
            else
                return FALSE;  
         }catch(PDOException $e){
                throw new PDOException($e,"UPDATE ERROR/UPDATE TokenId");           
         }     
    }
    
    function getTokenId($con,$usrId){
        
         try {
            $sql =  "SELECT token_id FROM users WHERE user_id=?";
            $stmt = $con->getDBH()->prepare($sql);
            $stmt->bindParam(1, $usrId, PDO::PARAM_STR);
            if ($stmt->execute()) {  
               $this->tokenId = $stmt->fetch(PDO::FETCH_COLUMN,0);     
               return TRUE;               
             }
          return FALSE;   
         }catch(PDOException $e){
                throw new PdoDbException($e,"AUTHENTICATION ERROR");           
         }        
    }
    
    function getToken() {
        return $this->tokenId;
    }
    
    function initiateToken($token, $userId) {
        
        $_SESSION['_USER_ID'] = $userId;
        $_SESSION['_USER_TOKEN'] = $token;
        
    }
    
    function initiate($logged){
       
      $_SESSION[self::_SESSION_CONFIRMATION_]= TRUE;  // User is logged
 //Loose IP set       
       $_SESSION['_USER_LOOSE_IP'] = long2ip(ip2long($_SERVER['REMOTE_ADDR'])&ip2long("255.255.0.0"));
       $_SESSION['_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT']; 
//Contents of the Accept: header from the current request, if there is one.               
       $_SESSION['_USER_ACCEPT'] = $_SERVER['HTTP_ACCEPT'];  
//Contents of the Accept-Encoding: header from the current request, if there is one. Example: 'gzip'.       
       $_SESSION['_USER_ACCEPT_ENC'] = $_SERVER['HTTP_ACCEPT_ENCODING'];       
       $_SESSION['_USER_ACCEPT_LANG'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
//Contents of the Accept-Charset: header from the current request, if there is one. Example: 'iso-8859-1,*,utf-8'.              
       $_SESSION['_USER_ACCEPT_CHAR'] = $_SERVER['HTTP_ACCEPT_CHARSET'];
       $_SESSION['_TOKEN_ID'] = $this->getToken();
       $_SESSION['_KEEP_ME_LOGGED_'] = $logged;
    }
    
    function setExpiration(){
        
       $_SESSION['_USER_LAST_ACTIVITY'] = time();
       $_SESSION['SESSION_START_TIME'] = time();
    }
    
    function setCookie(){
        
      setcookie(self::_SESSION_NAME_,      // Name
      session_id(),         // Value
      time()+self::_COOKIE_EXPIRE_, // Expiry
      "/",                  // Path
      "boilerplate",       // Domain
      true,                 // HTTPS Only
      true);                // HTTP Only    
    }
    
    function validate($con){
        
       if(!$_SESSION[self::_SESSION_CONFIRMATION_])
           return FALSE;
       if($_SESSION['_USER_LOOSE_IP'] != long2ip(ip2long($_SERVER['REMOTE_ADDR'])&ip2long("255.255.0.0"))||
          $_SESSION['_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT']||
          $_SESSION['_USER_ACCEPT'] != $_SERVER['HTTP_ACCEPT']||
          $_SESSION['_USER_ACCEPT_ENC'] != $_SERVER['HTTP_ACCEPT_ENCODING']||       
          $_SESSION['_USER_ACCEPT_LANG'] != $_SERVER['HTTP_ACCEPT_LANGUAGE']||
          $_SESSION['_USER_ACCEPT_CHAR'] != $_SERVER['HTTP_ACCEPT_CHARSET'])
            return FALSE;
       if($this->getTokenId($con, $_SESSION['_USER_ID'])) {           //Get tokenId from db
          if($_SESSION['_USER_TOKEN'] != $this->tokenId) //and see if matches with session
              return FALSE;
       }else return FALSE;     
       $current_time = time();
       if($_SESSION['_KEEP_ME_LOGGED_']==TRUE) {
           $idle = 7200; //remains idle for 2 hours before logout
           $loggedTime = 10800; //remains logged for 3 hours before logout         
       }else {
           $idle = 400; //remains idle for twenty minutes
           $loggedTime = 3600; //remains logged for 1 hour
       }
       if(isset($_SESSION['_USER_LAST_ACTIVITY'])&&($current_time - $_SESSION['_USER_LAST_ACTIVITY'])>$idle) //check the time that user is idle
            return FALSE;           
       else 
           $_SESSION['_USER_LAST_ACTIVITY']=$current_time;
       if(($current_time - $_SESSION['SESSION_START_TIME'] > $loggedTime)) //check the time that user is logged
           return FALSE;  
       return TRUE;
       //check tokenid    
    }
    function wClose() {
        
        session_write_close();
    }
    
    function endSession() {
        
        session_start();
        $_SESSION = array(); 
        $params = session_get_cookie_params();
        setcookie(session_name(self::_SESSION_NAME_), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));        
        session_destroy();
        $this->wClose();        
    }
}

?>
