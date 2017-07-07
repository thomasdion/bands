<?php
ob_start();
$id = (isset($_GET["id"]))?(trim($_GET["id"])):'';
if(!preg_match("/^([0-9]+)$/",$id)){ 
    \header("Location:index.php");
    exit();
}
include_once dirname(__FILE__).'/control/ControlerExtended.php';
include_once(ABS_PATH.'lib/sanitize.php');

try{
   $controler = new ControlerExtended('CommentsNews');
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
   $controler->select($id);
   $news = $controler->getData(); 
   $controler->setAside();
   $latestNews = $controler->getSidebar();    
   $controler->loadPageArgs($logged, $news, $latestNews);
  }catch(InvalidArgumentException $iae){
            $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
            $error->write_log_error();
            //header('Location:../404.html');exit();
  }catch(PDOException $e) {
            $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
            $error->write_log_error();     
   }
?>