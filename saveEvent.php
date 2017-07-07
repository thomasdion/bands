<?php
ob_start();
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
   if(isset($_POST['saveEvent'])){
        isset($_POST['title'])?$t=trim($_POST['title']):$t='';
        isset($_POST['year'])?$y=trim($_POST['year']):$y='';
        isset($_POST['month'])?$m=trim($_POST['month']):$m='';
        isset($_POST['day'])?$d=trim($_POST['day']):$d='';
        isset($_POST['shour'])?$sh=trim($_POST['shour']):$sh='';
        isset($_POST['sminute'])?$sm=trim($_POST['sminute']):$sm='';  
        isset($_POST['place'])?$p=trim($_POST['place']):$p='';
        isset($_POST['ticket'])?$t=trim($_POST['ticket']):$t='';
        isset($_POST['desc'])?$des=trim($_POST['desc']):$$des=''; 
        isset($_POST['phone'])?$ph=trim($_POST['phone']):$ph='';
        isset($_POST['url'])?$u=trim($_POST['url']):$u='';   
        if($t&&$y&&$m&&$d&&$p) {
               $array = array('title'=>$t,'year'=>$y,'month'=>$m,'day'=>$d,'shour'=>$sh,'sminute'=>$sm,'place'=>$p,'ticket'=>$t,'desc'=>$des,'phone'=>$ph,'url'=>$u);
               $controler->setData($array);
               $controler->insert(); //On input in db only sql sanitize is needed
               $array = array('title'=>'','year'=>'','month'=>'','day'=>'','shour'=>'','sminute'=>'','place'=>'','ticket'=>'','desc'=>'','phone'=>'','url'=>'');
               $controler->setData($array);            
        }else {    
               $array = array('title'=>$t,'year'=>$y,'month'=>$m,'day'=>$d,'shour'=>$sh,'sminute'=>$sm,'place'=>$p,'ticket'=>$t,'desc'=>$des,'phone'=>$ph,'url'=>$u);
               $array = sanitize($array,1); //If html aria required doesnt work, form reappears with sanitize output
               $controler->setData($array);
            }
   }else {
       $array = array('title'=>'','year'=>'','month'=>'','day'=>'','shour'=>'','sminute'=>'','place'=>'','ticket'=>'','desc'=>'','phone'=>'','url'=>'');
       $controler->setData($array);        
    }
   $controler->setAside();
   $latestNews = $controler->getSidebar();     
   $controler->loadPage($logged,$latestNews);    
  }catch(InvalidArgumentException $iae){
            $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
            $error->write_log_error();
            //header('Location:../404.html');exit();
  }catch(PDOException $e) {
            $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
            $error->write_log_error();     
   }
?>