<?php
 //error_reporting(0);
 require_once dirname(__FILE__).'/../config.php';      
 require_once(ABS_PATH.'/lib/Connection.php');
 include(ABS_PATH.'/lib/login.php'); 
 include(ABS_PATH.'lib/Error.php');
 include ABS_PATH.'/lib/SesControl.php';
  
class Controler {
    
    public $header;
    public $template;
    public $footer;
    public $title;
    public $sidebar;
    public $error;
    public $dir;
    protected $connection='';
    protected $session;
     
    function __construct() {

        $params = set_params();
        $this->dir = ABS_PATH.'templates/';
        $this->controlerLoaded = TRUE;
        try { 
            if(!file_exists($this->dir.$params['HEADER'])) 
                throw new InvalidArgumentException('MISSING HEADER');
            else if(!file_exists($this->dir.$params['FOOTER']))
                throw new InvalidArgumentException('MISSING FOOTER');
            else if(!file_exists($this->dir.$params['TEMPLATE']))
                throw new InvalidArgumentException('MISSING TEMPLATE');
            $this->header = $params['HEADER'];
            $this->template = $params['TEMPLATE'];
            $this->footer = $params['FOOTER'];
            $this->title = $params['TITLE'];
        }catch (InvalidArgumentException $msg){
                throw new InvalidArgumentException($msg);        
         }
    }
    
    function connect(){
        try {
            $this->connection = new Connection();
        }catch(PDOException $PdoDb) { //na allaxtei mesa sti clasi Connection             
            throw new PDOException($PdoDb);        
         }
    }
    
    function getConnection() {
        return $this->connection;
    }
    /*
    public function __call($method_name, $arguments) {
        
        echo "ASSAD";
        $accepted_methods = array("loadPage");
        if(!in_array($method_name, $accepted_methods))
            throw new InvalidArgumentException($msg."Wrong method name");
        if(count($arguments) == 0)
        {
        $this->loadPage2($arguments);
        }
        elseif(count($arguments) == 8)
        {
        $this->loadPage2($arguments);
        }            
    } */   
    function loadPage($logged, $sidebar) {
        include $this->dir.$this->header;
        include $this->dir.$this->template;
        include $this->dir.$this->footer; 
    } 
    function loadPageArgs($logged, $data, $sidebar) {
        include $this->dir.$this->header;
        include $this->dir.$this->template;
        include $this->dir.$this->footer; 
    }     
    /*
    function loadPage2($data) {
        include $this->dir.$this->header;
        include $this->dir.$this->template;
        include $this->dir.$this->footer;
    }   */ 
    
    function startSession() {
        
        $this->session = new SesControl();
        $this->session->set_ini();    //call ini_set. must be called in every script cause it doesnt remain!
    }
    
    function validateSession(){
        
        $valid = $this->session->validate($this->connection); //connection needed for retrieving tokenId from DB      
        $this->session->wClose();
        return $valid;

    }
    
    function setAside() {
        
        try {
            $stmt = $this->connection->getDBH()->query('SELECT id, SUBSTRING(title, 1,50) as title, post_date
            FROM news ORDER BY post_date DESC LIMIT 0,4');             
            if($stmt) {
                $this->sidebar = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }catch(PDOException $e){
            throw new PDOException($e,"SELECT ERROR/EXTRACT NEWS");
        }        
    }
     
    function getSidebar(){
        return $this->sidebar;
    }     
    function logout() {
        
        $this->session->endSession();

    }
}

?>
