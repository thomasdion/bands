<?php 
    ob_start();
    include_once dirname(__FILE__).'/control/ControlerLogin.php';
    include_once dirname(__FILE__).'/securimage/securimage.php';

    try{
       $controler = new ControlerLogin();
       $controler->startSession();
       $controler->connect();
       $logged = $controler->validateSession();       
       if(!$logged&&isset($_POST['login']))
           if((isset($_POST['username']))&&($usr=trim($_POST['username']))&&(isset($_POST['password']))
               &&($psw=trim($_POST['password'])))  { 
               $controler->setUsr($usr);
               $controler->setPsw($psw);
               isset($_POST['keep_me'])?$keepLoged = TRUE:$keepLoged=FALSE;
               $controler->setLogged($keepLoged);
               if($controler->authenticateUser()) {   //If user succesfully loged       
                   if(isset($_SESSION['fattemps'])) 
                      $_SESSION['fattemps'] = 0;  
               $controler->startSessionLoged();      //initiate session security policy                   
               $logged = TRUE;    
               } 
          }
       if(isset($_POST['register']))
           if((isset($_POST['username']))&&($usr=trim($_POST['username']))&&(isset($_POST['password']))
              &&($psw=trim($_POST['password']))&&(isset($_POST['email']))&&($mail=trim($_POST['email']))) {
               $nl = $_POST['newsletter'];
               $controler->setUsr($usr);
               $controler->setPsw($psw); 
               $controler->setEmail($mail);
               $controler->setNewsletter($nl);
               $controler->registerUser();
           }             
       if($logged&&isset($_POST['logout'])){
           $userId = $_SESSION['_USER_ID'];
           logHistory($controler->getConnection(), $userId, 'Logout');
           $controler->logout();
           $logged=FALSE;           
       }$data='';
       if($logged&&isset($_POST['send'])) { 
           if(isset($_POST['text'])&&($text=trim($_POST['text']))) {
               $securimage = new Securimage();
               
$to      = 'koyrafexalos@yahoo.com'; //here i kept my mail 
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);               
                   mail("koyrafexalos@yahoo.com", 'Message from:'.$controler->user->getUsr() ,$text, "From:" . $controler->user->getEmail());
               
               if($securimage->check($_POST['captcha_code']) == true) {
                   mail("thomasdion@hotmail.gr", 'Message from:'.$controler->user->getUsr() ,$text, "From:" . $controler->user->getEmail());
                   $data="Message Send!";
               }  else 
                   $data='Wrong captcha try again!';               
           }else 
               $data='Message required';           
       }
       $controler->setAside();
       $latestNews = $controler->getSidebar();
       $controler->loadPageArgs($logged, $data, $latestNews);
      }catch(InvalidArgumentException $iae){
                $error = new error($iae->getCode(),date('d-m-y g:i a'),$iae->getFile(),$iae->getMessage());
                $error->write_log_error();
                //header('Location:../404.html');exit();
      }    

?>