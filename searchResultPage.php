<?php
ob_start();
if(isset($_GET["sdate"])&&!isset($_GET["edate"])) { //When we hit a specific day in the calendar
    $sdate = trim($_GET["sdate"]);    
    list($year,$month,$day) = explode("/",$sdate);
    $year = (int)$year;
    $month = (int)$month;
    $day = (int)$day;    
    if(!checkdate($month,$day,$year)){
        \header("Location:index.php?page=search");
        exit();
    }
   $args["sdate"]=$sdate;
}else { //When we define a range of dates in the search form
    $sdate = (isset($_GET["sdate"]))?(trim($_GET["sdate"])):'';
    $edate = (isset($_GET["edate"]))?(trim($_GET["edate"])):'';
    list($year,$month,$day) = explode("/",$sdate);
    if(!checkdate($month,$day,$year)){
        \header("Location:index.php?page=search");
        exit();
    }
    list($year,$month,$day) = explode("/",$edate);
    if(!checkdate($month,$day,$year)){
        \header("Location:index.php?page=search");
        exit();
    }
   $args["sdate"]=$sdate;
   $args["edate"]=$edate;   
}
include_once dirname(__FILE__).'/control/ControlerExtended.php';
include_once(ABS_PATH.'lib/sanitize.php');

try{
   $controler = new ControlerExtended('calendar/RecordSearch');
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
   if(isset($_GET['page'])&&preg_match("/^([0-9]+)$/",$_GET['page']))
      $page = $_GET['page'];
   else
      $page = 0; 
   $args["type"]='';    
   $controler->select_dataArgs($page, $args, 'searchResultPage.php');                      
   $events = $controler->getData(); 
   $controler->setAside();
   $latestNews = $controler->getSidebar();    
   $controler->loadPageArgs($logged, $events, $latestNews);
  }catch(InvalidArgumentException $iae){
            $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
            $error->write_log_error();
            //header('Location:../404.html');exit();
  }catch(PDOException $e) {
            $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
            $error->write_log_error();     
   }
?>