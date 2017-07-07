<?php
include_once dirname(__FILE__).'/Controler.php';
include_once ABS_PATH.'/lib/User.php';

 
class ControlerLogin extends Controler {

    public $user;
    
    function setUsr($usr){
        $this->user->setUsr($usr);
    }
    function setPsw($psw){
        $this->user->setPsw($psw);
    }
    function setEmail($mail){
        $this->user->setEmail($mail);
    }
    function setNewsletter($nl) {
        $this->user->setNewsletter($nl);
    }
    function setLogged($logged){
        $this->user->setKeepMeLogged($logged);        
    }
    function __construct() {
        parent::__construct();
        $this->user = new User();
    }
        
    function authenticateUser() {
                
       if($this->user->validateUsernamePassword()) { 
          $this->user->set_con($this->connection);
          if($this->user->login())  
             return TRUE;           
       } 
       return FALSE;
    
    }
    
    function registerUser() {

       if($this->user->validateUsernamePassword()) {
           $this->user->set_con($this->connection);
           if(!$this->user->usernameExists()){
               if($this->user->register())
                  return TRUE;
               else
                 return FALSE;  
           }else
               return FALSE;
       }else 
           return FALSE;          
        
    }
    
    function banIP() {
        
        $ip = getIP();
        $this->connect();
        $this->user->set_con($this->connection);        
        $this->user->ban($ip);
    }
    function checkBanned() {
        
        $ip = getIP();
        $this->connect();
        $this->user->set_con($this->connection);        
        return $this->user->checkBan($ip);
    }
    function startSessionLoged() {
        
        //$this->session = new SesControl();
        $this->session->set_ini();    //call ini_set. must be called in every script cause it doesnt remain!
        $this->session->regenerate(); //regenerate the session id
        $this->session->generateTokenId($this->connection,$this->user->getUsrID());  //return the tokenId      
        $this->session->initiate($this->user->getKeepMeLogged());   //set values for ip, agent... confirmation
        $this->session->initiateToken($this->session->getToken(), $this->user->getUsrID());
        $this->session->setExpiration(); //set the expiration of idle session
        $this->session->setCookie();  //secure the session cookie
        $this->session->wClose();

    }
}
?>
