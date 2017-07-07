<?php 
    ob_start();
    include_once dirname(__FILE__).'/control/ControlerLogin.php';
    
    try{ 
       $controler = new ControlerLogin();
       if($controler->checkBanned()) { //check if users IP is in the Banned List
           header("Location:".ROOT_URL."banned.php"); // then redirect to the BANNED page!!!
           exit(); 
       }
       if(isset($_POST['enter']))
           if((isset($_POST['username']))&&($usr=trim($_POST['username']))&&(isset($_POST['password']))
               &&($psw=trim($_POST['password'])))  { 
               $controler->setUsr($usr);
               $controler->setPsw($psw);
               isset($_POST['keep_me'])?$logged = TRUE:$logged=FALSE; //if true user wants to remain logged
               $controler->setLogged($logged);
               if($controler->authenticateUser()) {   //If user succesfully loged        
                   session_start();                 //start to check if previous session fattemps exists
                   if(isset($_SESSION['fattemps'])) 
                      $_SESSION['fattemps'] = 0;     //reset false attemps if any                                                                  
                   session_write_close();           //close session to initiate a new one
                   $controler->startSession();         //initiate session security policy                   
                   header("Location:".ROOT_URL."controlpanel.php"); //then redirect to controlpanel
                   exit();             
               }else {
                  session_start(); 
                  if(!isset($_SESSION['fattemps'])) 
                     $_SESSION['fattemps'] = 1;                     
                  else 
                     $_SESSION['fattemps']+=1;
                     if($_SESSION['fattemps']>3) 
                        $controler->banIP();                     
               }
            }                  
       $controler->loadPage(NULL);
      }catch(InvalidArgumentException $iae){
                $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
                $error->write_log_error();
                //header('Location:../404.html');exit();
      }catch(PDOException $pdoe) {
                $error = new error($$pdoe->getCode(),date('d-m-y g:i a'),$$pdoe->getFile(),$$pdoe->getMessage());
                $error->write_log_error();     
       }catch(Exception $e) {
                $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
                $error->write_log_error();     
       }    

?>
