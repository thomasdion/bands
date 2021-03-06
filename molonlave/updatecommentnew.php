<?php 
ob_start();
if(!isset($_POST['Logout'])) {
   $id = (isset($_GET["id"]))?(trim($_GET["id"])):(trim($_POST["id"]));
   if(!preg_match("/^([0-9]+)$/",$id)){            
      $xss = TRUE;
   }else $xss = FALSE;
} 
include_once dirname(__FILE__).'/control/ControlerExtended.php';
include_once(ABS_PATH.'lib/sanitize.php');

try{
   $controler = new ControlerExtended('CommentsNews');
   $controler->startSession();
   $controler->connect();     
   $valid = $controler->validateSession();
   if(isset($_POST['Logout'])||!$valid||$xss){
       $userId = $_SESSION['_USER_ID'];
       logHistory($controler->getConnection(), $userId, 'Logout');       
       $controler->logout();}   
   if(isset($_POST['update'])){
       isset($_POST['comment'])?$c=trim($_POST['comment']):$c='';
       isset($_POST['flag'])?$f=trim($_POST['flag']):$f='1';     
       isset($_POST['post_date'])?$pd=trim($_POST['post_date']):$pd='';       
       if($c&&$c)  {           
           $array = array('id'=>$id,'post_date'=>$pd,'comment'=>$c,'flag'=>$f);
           $array = sanitize($array,1);                      
           $controler->setData($array);
           $controler->update();
        }else {
           $array = array('id'=>$id,'post_date'=>$pd,'comment'=>$c,'flag'=>$f);
           $array = sanitize($array,1);                      
           $controler->setData($array);
        }                   
   }else {
       $controler->select($id);
       $array = $controler->getData(); //return $array[1] contents array with news, $array[2] contents array with comments
       $array = sanitize($array[2],1);     
       $controler->setData($array);     
   } 
   $comment = $controler->getData();
   $controler->loadPage($comment);
  }catch(InvalidArgumentException $iae){
            $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
            $error->write_log_error();
            //header('Location:../404.html');exit();
  }catch(PDOException $e) {
            $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
            $error->write_log_error();     
   }
?>
