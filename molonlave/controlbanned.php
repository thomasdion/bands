<?php 
    ob_start();
    include_once dirname(__FILE__).'/control/ControlerExtended.php';
    include_once ABS_PATH.'lib/sanitize.php';
    try{
        $controler = new ControlerExtended('Banned');
        $controler->startSession();
        $controler->connect();        
        if(isset($_POST['Logout'])||!$controler->validateSession()){ //check if user pressed logout or if
           $userId = $_SESSION['_USER_ID'];                         //user wasnt validated
           logHistory($controler->getConnection(), $userId, 'Logout');            
           $controler->logout();}
        if(isset($_POST)){                         //If a submit was send
            foreach($_POST as $name => $content){  //use the submit buttons name as banned id to change banned status
               if(preg_match("/^([0-9]+)$/", $name)&&(in_array($content, array('Ban', 'Unban')))) { //extra check if we have a valid id
                   $banned['id'] = $name;                                                         //and a valid action
                   $banned['status'] = $content;                   
                   if($banned['status']=='Ban')
                       $banned['status']='Banned';
                   else $banned['status']='Unbanned';
                   $controler->setData($banned);
                   $controler->update();
               }
            }   
        }   
        if(isset($_GET['page'])&&preg_match("/^([0-9]+)$/",$_GET['page']))
            $page = $_GET['page'];
        else
            $page = 1;             
        $controler->select_data($page, 'controlbanned.php');
        $banned = $controler->getData();
        $controler->loadPage($banned);        
      }catch(InvalidArgumentException $iae){
                $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
                $error->write_log_error();
                //header('Location:../404.html');exit();
      }catch(PDOException $e) {
                $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
                $error->write_log_error();     
       }
?>