<?php 
    ob_start();
    include_once dirname(__FILE__).'/control/Controler.php';
    
    try{
       $controler = new Controler(); 
       $controler->loadPage();
      }catch(InvalidArgumentException $iae){
                $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
                $error->write_log_error();
                //header('Location:../404.html');exit();
      }    

?>
