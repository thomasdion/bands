<?php 
    ob_start();
    include_once dirname(__FILE__).'/control/ControlerExtended.php';
    include_once(ABS_PATH.'lib/sanitize.php');

    try{
        $controler = new ControlerExtended('News');
        $controler->startSession();        
        $controler->connect();
        $logged = $controler->validateSession();
        if(!$logged&&isset($_POST['login']))
           if((isset($_POST['username']))&&($usr=trim($_POST['username']))&&(isset($_POST['password']))
               &&($psw=trim($_POST['password'])))  { 
               $controler->setUsr($usr);
               $controler->setPsw($psw);
               isset($_POST['keep_me'])?$keepLoged = TRUE:$keepLoged=FALSE;
               $controler->setLogged($keepLoged);
               if($controler->authenticateUser()) {   //If user succesfully loged       
                   if(isset($_SESSION['fattemps'])) 
                      $_SESSION['fattemps'] = 0;  
               $controler->startSessionLoged();         //initiate session security policy                   
               $logged = TRUE;    
               } 
          }          
        if($logged&&isset($_POST['logout'])){
           $userId = $_SESSION['_USER_ID'];
           logHistory($controler->getConnection(), $userId, 'Logout');
           $controler->logout();   
           $logged=FALSE;           
        }         
        $args = NULL;   
        if(isset($_GET['page'])&&preg_match("/^([0-9]+)$/",$_GET['page']))
           $page = $_GET['page'];
        else
           $page = 0;
        if(isset($_GET['type'])&&preg_match("/^([1-2]+)$/",$_GET['type'])){
            $args['type'] = $_GET['type'];
            $controler->select_dataArgs($page, $args,'news.php');                   
        }else {
            $args['type'] = 0;
            $controler->select_data($page,'news.php');                               
        }
        $data = $controler->getData();  
        $controler->setAside();
        $latestNews = $controler->getSidebar();        
        $controler->loadPageArgs($logged, $data, $latestNews);
      }catch(InvalidArgumentException $iae){
                $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
                $error->write_log_error();
                //header('Location:../404.html');exit();
      }catch(PDOException $e) {
                $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
                $error->write_log_error();     
       }
?>