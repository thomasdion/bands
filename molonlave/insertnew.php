<?php 
    ob_start();
    include_once dirname(__FILE__).'/control/ControlerExtended.php';
    include_once(ABS_PATH.'lib/sanitize.php');

    try{
       $controler = new ControlerExtended('News');
       $controler->startSession();
       $controler->connect();       
       $valid = $controler->validateSession();
       if(isset($_POST['Logout'])||!$valid){
           $userId = $_SESSION['_USER_ID'];
           logHistory($controler->getConnection(), $userId, 'Logout');           
           $controler->logout();}       
       if(isset($_POST['insert'])){
           isset($_POST['title'])?$t=trim($_POST['title']):$t='';
           isset($_POST['content'])?$c=trim($_POST['content']):$c='';
           isset($_POST['type'])?$tp=trim($_POST['type']):$tp=1;  //if no type in select make it a band new          
           $i='';
           if($t&&$c)  {
               if(($_FILES['image']['tmp_name'])) {
                   $i = sanitize_upload_image();
               }   
               $array = array('title'=>$t,'content'=>$c,'image'=>$i,'type'=>$tp);
               $controler->setData($array);
               $controler->insert(); //On input in db only sql sanitize is needed
               $array = array('title'=>'','content'=>'','image'=>'','type'=>$tp); //after insert clear form for new input
               $controler->setData($array);                
            }else {    
               $array = array('title'=>$t,'content'=>$c,'image'=>$i,'type'=>$tp);
               $array = sanitize($array,1); //If html aria required doesnt work, form reappears with sanitize output
               $controler->setNews($array);
            }
       }else {
           $array = array('title'=>'','content'=>'','image'=>'','type'=>'');//In the first load of page set values to Null
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