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
        $args = NULL;   
        if(isset($_GET['page'])&&preg_match("/^([0-9]+)$/",$_GET['page']))
           $page = $_GET['page'];
        else
           $page = 0;
        $args['type'] = 0;
        if(isset($_POST['type'])&&preg_match("/^([0-9]+)$/",$_POST['type']))
            $args['type'] = $_POST['type'];
        else if(isset($_GET['type'])&&preg_match("/^([0-9]+)$/",$_GET['type']))
            $args['type'] = $_GET['type'];
        if($args['type'] == 0)
            $controler->select_data($page,'controlnews.php');                   
        else
            $controler->select_dataArgs($page, $args,'controlnews.php');                   
        $data = $controler->getData();        
        $controler->loadPage($data);
      }catch(InvalidArgumentException $iae){
                $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
                $error->write_log_error();
                //header('Location:../404.html');exit();
      }catch(PDOException $e) {
                $error = new error($e->getCode(),date('d-m-y g:i a'),$e->getFile(),$e->getMessage());
                $error->write_log_error();     
       }
?>
