<?php 
    ob_start();
    if(!isset($_POST['Logout'])) {
       $new = (isset($_GET["new"]))?(trim($_GET["new"])):(trim($_POST["new"]));      
       if(!preg_match("/^([0-9]+)$/",$new)){            
          $xss = TRUE;
       }else $xss = FALSE;  
       if(isset($_GET["reply"]))
          $reply=$_GET["reply"];
       else if(isset($_POST["reply"]))
          $reply=$_POST["reply"];
       else 
          $reply=0;
       if(!preg_match("/^([0-9]*)$/",$reply))
         $xss = TRUE;
    }    
    include_once dirname(__FILE__).'/control/ControlerExtended.php';
    include_once ABS_PATH.'lib/sanitize.php';

    try{
       $controler = new ControlerExtended('CommentsNews');
       $controler->startSession();
       $controler->connect();     
       $valid = $controler->validateSession();
       if(isset($_POST['Logout'])||!$valid||$xss){
           $userId = $_SESSION['_USER_ID'];
           logHistory($controler->getConnection(), $userId, 'Logout');           
           $controler->logout();}      
       if(isset($_POST['insert'])){
           isset($_POST['comment'])?$c=trim($_POST['comment']):$c='';
           isset($_POST['flag'])?$f=trim($_POST['flag']):$f='';
           isset($_SESSION['_USER_ID'])?$uid=trim($_SESSION['_USER_ID']):$uid='';
           if($c&&$f&&$uid)  {  
               $array = array('new'=>$new,'user'=>$uid,'comment'=>$c,'flag'=>$f,'reply'=>$reply);
               $controler->setData($array);//On input in db only sql sanitize is needed
               $controler->insert();
               $array = array('new'=>'','user'=>'','comment'=>'','flag'=>'','reply'=>$reply);//after insert clear form for new input 
               $controler->setData($array);               
            }else {    
               $array = array('new'=>$new,'user'=>$uid,'comment'=>$c,'flag'=>$f,'reply'=>$reply); 
               $array = sanitize($array,1); //If html aria required doesnt work, form reappears with sanitize output                              
               $controler->setData($array);           
            }
       }  else {
           $array = array('new'=>$new,'user'=>'','comment'=>'','flag'=>'','reply'=>$reply);//In the first load of page set values to Null 
           $controler->setData($array);                               //except the new's id that is been commented  
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