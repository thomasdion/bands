<?php 
    ob_start();
    include_once dirname(__FILE__).'/control/ControlerLogin.php';
    
    try{
       $controler = new ControlerLogin();
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
               $controler->startSessionLoged();      //initiate session security policy                   
               $logged = TRUE;    
               } 
          }
       if(isset($_POST['register']))
           if((isset($_POST['username']))&&($usr=trim($_POST['username']))&&(isset($_POST['password']))
              &&($psw=trim($_POST['password']))&&(isset($_POST['email']))&&($mail=trim($_POST['email']))) {
               $nl = $_POST['newsletter'];
               $controler->setUsr($usr);
               $controler->setPsw($psw); 
               $controler->setEmail($mail);
               $controler->setNewsletter($nl);
               $controler->registerUser();
           }   
          
       if($logged&&isset($_POST['logout'])){
           $userId = $_SESSION['_USER_ID'];
           logHistory($controler->getConnection(), $userId, 'Logout');
           $controler->logout();
           $logged=FALSE;           
       }
       $controler->setAside();
       $latestNews = $controler->getSidebar();
       $controler->loadPage($logged,$latestNews);
      }catch(InvalidArgumentException $iae){
                $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
                $error->write_log_error();
                //header('Location:../404.html');exit();
      }    

?>