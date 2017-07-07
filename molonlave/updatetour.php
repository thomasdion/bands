<?php 
ob_start();

if(!isset($_POST['Logout'])) {
   $id = (isset($_GET["id"]))?(trim($_GET["id"])):(trim($_POST["id"]));
   if(!preg_match("/^([0-9]+)$/",$id)){            
      $xss = TRUE;
   }else $xss = FALSE;
} 

include_once dirname(__FILE__).'/control/ControlerExtended.php';
include_once ABS_PATH.'lib/sanitize.php';

try{
   $controler = new ControlerExtended('Tours');
   $controler->startSession();
   $controler->connect();     
   $valid = $controler->validateSession();
   if(isset($_POST['Logout'])||!$valid||$xss){
       $userId = $_SESSION['_USER_ID'];
       logHistory($controler->getConnection(), $userId, 'Logout');     
       $controler->logout();}   
   if(isset($_POST['update'])){
       isset($_POST['tour_date'])?$td=trim($_POST['tour_date']):$td='';
       isset($_POST['town'])?$t=trim($_POST['town']):$t='';
       isset($_POST['place'])?$p=trim($_POST['place']):$p='';  
       isset($_POST['type'])?$tp=trim($_POST['type']):$tp='';    
       if($td&&$t&&$p)  {          
           $array = array('id'=>$id,'tour_date'=>$td,'town'=>$t,'place'=>$p,'type'=>$tp);
           $array = sanitize($array,1);
           $controler->setData($array);
           $controler->update();
        }else {
           $array = array('id'=>$id,'tour_date'=>$td,'town'=>$t,'place'=>$p,'type'=>$tp);
           $array = sanitize($array,1);           
           $controler->setData($array);
        }                   
   }else {
       $controler->select($id);
       $array = $controler->getData();
       $array = sanitize($array,1);     
       $controler->setData($array);      
   } 
   $tours = $controler->getData();
   $controler->loadPage($tours);
  }catch(InvalidArgumentException $iae){
            $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
            $error->write_log_error();
            //header('Location:../404.html');exit();
  }catch(PDOException $e) {
            $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
            $error->write_log_error();     
   }
?>

