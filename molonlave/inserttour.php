<?php 
    ob_start();
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
       if(isset($_POST['insert'])){
           isset($_POST['tour_date'])?$d=trim($_POST['tour_date']):$d='';
           isset($_POST['town'])?$t=trim($_POST['town']):$t='';
           isset($_POST['place'])?$p=trim($_POST['place']):$p='';
           isset($_POST['type'])?$tp=trim($_POST['type']):$tp='';
           if($d&&$t&&$p)  {  
               $array = array('tour_date'=>$d,'town'=>$t,'place'=>$p,'type'=>$tp);
               $controler->setData($array);
               $controler->insert();//On input in db only sql sanitize is needed
               $array = array('tour_date'=>'','town'=>'','place'=>'','type'=>'');//after insert clear form for new input
               $controler->setData($array);               
            }else {    
               $array = array('tour_date'=>$d,'town'=>$t,'place'=>$p,'type'=>$tp);
               $array = sanitize($array,1); //If html aria required doesnt work, form reappears with sanitize output               
               $controler->setData($array);           
            }
       }else {
           $array = array('tour_date'=>'','town'=>'','place'=>'','type'=>'');//In the first load of page set values to Null
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