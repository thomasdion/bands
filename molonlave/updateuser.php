<?php 
ob_start();

if(!isset($_POST['Logout'])) {
   $id = (isset($_GET["user_id"]))?(trim($_GET["user_id"])):(trim($_POST["user_id"]));
   if(!preg_match("/^([0-9]+)$/",$id)){            
      $xss = TRUE;
   }else $xss = FALSE;
} 

include_once dirname(__FILE__).'/control/ControlerExtended.php';
include_once ABS_PATH.'lib/sanitize.php';

try{
   $controler = new ControlerExtended('Users');
   $controler->startSession();
   $controler->connect();     
   $valid = $controler->validateSession();
   if(isset($_POST['Logout'])||!$valid||$xss){
       $userId = $_SESSION['_USER_ID'];
       logHistory($controler->getConnection(), $userId, 'Logout');       
       $controler->logout();}   
   if(isset($_POST['update'])){
       isset($_POST['name'])?$n=trim($_POST['name']):$n='';
       isset($_POST['surname'])?$sn=trim($_POST['surname']):$sn='';
       isset($_POST['email'])?$e=trim($_POST['email']):$e='';  
       isset($_POST['newsletter'])?$nl=trim($_POST['newsletter']):$nl=''; 
       isset($_POST['role_id'])?$r=trim($_POST['role_id']):$r='';           
       if($n&&$sn&&$e&&$r)  {          
           $array = array('user_id'=>$id,'name'=>$n,'surname'=>$sn,'email'=>$e,'newsletter'=>$nl,'role_id'=>$r);
           $array = sanitize($array,1);           
           $controler->setData($array);
           $controler->update();            
        }else {
           $array = array('user_id'=>$id,'name'=>$n,'surname'=>$sn,'email'=>$e,'newsletter'=>$nl,'role_id'=>$r);
           $array = sanitize($array,1);           
           $controler->setData($array);           
        }                   
   }else {
       $controler->select($id);
       $array = $controler->getData();
       $array = sanitize($array,1);        
       $controler->setData($array);           
   } 
   $users = $controler->getData();
   $controler->loadPage($users); 
  }catch(InvalidArgumentException $iae){
            $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
            $error->write_log_error();
            //header('Location:../404.html');exit();
  }catch(PDOException $e) {
            $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
            $error->write_log_error();     
   }
?>

