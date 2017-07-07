<?php 
ob_start();

if(!isset($_POST['Logout'])) {
   $id = (isset($_GET["id"]))?(trim($_GET["id"])):(trim($_POST["id"]));
   if(!preg_match("/^([0-9]+)$/",$id)){            
      $xss = TRUE;
   }else $xss = FALSE;
} 
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i(worry)") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); 

include_once dirname(__FILE__).'/control/ControlerExtended.php';
include_once(ABS_PATH.'lib/sanitize.php');

try{
   $controler = new ControlerExtended('News');
   $controler->startSession();
   $controler->connect();     
   $valid = $controler->validateSession();
   if(isset($_POST['Logout'])||!$valid||$xss){
       $userId = $_SESSION['_USER_ID'];
       logHistory($controler->getConnection(), $userId, 'Logout');       
       $controler->logout();}   
   if(isset($_POST['update'])){
       isset($_POST['title'])?$t=trim($_POST['title']):$t='';
       isset($_POST['content'])?$c=trim($_POST['content']):$c='';       
       $i=trim($_POST['img_name']);
       if($t&&$c)  {
           if(($_FILES['image']['tmp_name'])) {
              $i = sanitize_upload_image();
           }           
           $array = array('id'=>$id,'title'=>$t,'content'=>$c,'image'=>$i);
           $array = sanitize($array,1);           
           $controler->setData($array);
           $controler->update();
        }else {
           $array = array('id'=>$id,'title'=>$t,'content'=>$c,'image'=>$i);
           $array = sanitize($array,1);                      
           $controler->setData($array);
        }                   
   }else {
       $controler->select($id);
       $array = $controler->getData();
       $array = sanitize($array,1);     
       $controler->setData($array);
   } 
   $news = $controler->getData();       
   $controler->loadPage($news);
  }catch(InvalidArgumentException $iae){
            $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
            $error->write_log_error();
            //header('Location:../404.html');exit();
  }catch(PDOException $e) {
            $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
            $error->write_log_error();     
   }
?>
