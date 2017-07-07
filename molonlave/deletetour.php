<?php 
ob_start();
if(!isset($_POST['Logout'])) {
   $id = (isset($_GET["id"]))?(trim($_GET["id"])):(trim($_POST["id"]));
   if(!preg_match("/^([0-9]+)$/",$id)){ 
      \header("Location:index.php");
      exit();
   }
} 
 
include_once dirname(__FILE__).'/control/ControlerExtended.php';
include_once ABS_PATH.'lib/sanitize.php';

try{
   $controler = new ControlerExtended('Tours');
   $controler->startSession();
   $controler->connect();
   $valid = $controler->validateSession();
   if(isset($_POST['Logout'])||!$valid){
       $userId = $_SESSION['_USER_ID'];
       logHistory($controler->getConnection(), $userId, 'Logout');       
       $controler->logout();}   
   if(isset($_POST['delete'])){          
      $controler->delete($id);
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

