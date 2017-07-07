<?php
include_once dirname(__FILE__).'/Controler.php';
include_once ABS_PATH.'/lib/Admin.php';

 
class ControlerLogin extends Controler {

    private $admin;
    
    function setUsr($usr){
        $this->admin->setUsr($usr);
    }
    function setPsw($psw){
        $this->admin->setPsw($psw);
    }
    function setLogged($logged){
        $this->admin->setKeepMeLogged($logged);        
    }
    function __construct() {
        parent::__construct();
        $this->admin = new Admin();
    }
        
    function authenticateUser() {
                
       if($this->admin->validateUsernamePassword()) { 
          $this->connect();
          $this->admin->set_con($this->connection);
          if($this->admin->login())  
             return TRUE;           
       } 
       return FALSE;
    
    }
    
    function banIP() {
        
        $ip = getIP();
        $this->connect();
        $this->admin->set_con($this->connection);        
        $this->admin->ban($ip);
    }
    function checkBanned() {
        
        $ip = getIP();
        $this->connect();
        $this->admin->set_con($this->connection);        
        return $this->admin->checkBan($ip);
    }
    function startSession() {
        
        $this->session = new SesControl();
        $this->session->set_ini();    //call ini_set. must be called in every script cause it doesnt remain!
        $this->session->regenerate(); //regenerate the session id
        $this->session->generateTokenId($this->connection,$this->admin->getUsrID());  //return the tokenId      
        $this->session->initiate($this->admin->getKeepMeLogged());   //set values for ip, agent... confirmation
        $this->session->initiateToken($this->session->getToken(), $this->admin->getUsrID());
        $this->session->setExpiration(); //set the expiration of idle session
        $this->session->setCookie();  //secure the session cookie
        $this->session->wClose();

    }
}
?>
