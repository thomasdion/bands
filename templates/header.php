<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $this->title ?></title>
<meta name="description" content="">
<meta name="viewport" content="initial-scale=1.0, width=device-width"/>
<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link rel="stylesheet" href="<?php echo ROOT_URL.'css/normalize.css'?>"/>
<link rel="stylesheet" href="<?php echo ROOT_URL.'css/main.css'?>"/>
<!--Used for adaptive images-->
<link rel="shortcut icon" href="<?php echo ROOT_URL.'img/aos_icon.png'?>">
<script>document.cookie='resolution='+Math.max(screen.width,screen.
height)+'; path=/';</script>
<script src="<?php echo ROOT_URL.'js/vendor/modernizr-2.6.2.min.js';?>"></script>
</head>
<body>
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
 <?php 
    include_once dirname(__FILE__).'/../lib/calendar/CalenderShowc.php';
    $message='Extra Content';
    $missingUsr='';
    $missingPsw='';
    $missingUsr2='';
    $missingPsw2='';    
    $missingEmail='';
    $missingName='';
    $missingSname='';
    //Check for showing appropriate messages in the login/register panel
    if(isset($_POST['login'])) {  
       if($logged==FALSE)       //if user provided wrong usr/psw
           $message = 'False Login';                  
       if(trim($_POST['username']=='')) { //if user didnt provide usr/psw
           $missingUsr = '*Required';
           $message = 'Missing Args';
       }    
       if(trim($_POST['password']=='')){
           $missingPsw = '*Required';
           $message = 'Missing Args';
       }           
    }else   
    if(isset($_POST['register'])) { //if user didnt provide usr/psw
        //if user can not register ...
       if(trim($_POST['username']=='')){
           $missingUsr2 = '*Required';
           $message = 'Missing Args';
       }           
       if(trim($_POST['password']=='')){
           $missingPsw2 = '*Required';  
           $message = 'Missing Args';
       }
       if(trim($_POST['email']=='')){
           $missingEmail = '*Required';  
           $message = 'Missing Args';
       }  
       if(trim($_POST['name']=='')){
           $missingName = '*Required';  
           $message = 'Missing Args';
       }
       if(trim($_POST['surname']=='')){
           $missingSname = '*Required';  
           $message = 'Missing Args';
       }        
    }?>
<div class="bg-fade">
    <span></span>
</div>
 <!-- This is the login form -->
  <div id="toppanel"><?php
  if(!$logged) {   //If user not loged the toppanel has login-register?>
    <article>
    <div id="panel">
        <div class="content clearfix">
          <header class="left">
                <h1>Art Of Simplicity</h1>
                <img src="<?php echo ROOT_URL.'img/aos_login.jpg' ?>">                         
          </header>  
          <section class="left">
                <form class="clearfix" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                    <header>                        
                      <h1>Member Login</h1>
                    </header>  
                    <label class="grey" for="username">Username:</label>
                    <input class="field" type="text" name="username" id="username" value="" size="23" required aria-required="true"><?php echo $missingUsr; $missing ='Missing';?>
                    <label class="grey" for="password">Password:</label>
                    <input class="field" type="password" name="password" id="password" size="23" required aria-required="true"><?php echo $missingPsw; $missing ='Missing';?>                    
                    <label><input name="keep_me" id="keep_me" type="checkbox" checked="checked" value="forever"> &nbsp;Remember me</label>
                    <div class="clear"></div>
                    <input type="hidden" name="login" value="login">
                    <input type="submit" name="submit" value="Login" class="bt_login">
                    <a class="lost-pwd" href="#">Lost your password?</a>
                </form>
                <p>Login to gain access to our FORUM, extra material etc.</p>
           </section>
            <section class="left right">
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                    <header>
                        <h1>Not a member yet? Sign Up!</h1>				
                    </header>
                    <label class="grey" for="username">Username:</label>
                    <input class="field" type="text" name="username" id="username" value="" size="23" required aria-required="true"><?php  echo $missingUsr2;?>
                    <label class="grey" for="password">Password:</label>
                    <input class="field" type="text" name="password" id="password" value="" size="23" required aria-required="true"><?php  echo $missingPsw2;?>                                    
                    <label class="grey" for="email">Email:</label>
                    <input class="field" type="email" name="email" id="email" size="23" required aria-required="true"><?php  echo $missingEmail;?>                    
                    <label class="grey" for="name">Name:</label>
                    <input class="field" type="text" name="name" id="name" value="" size="23" required aria-required="true"><?php echo $missingName; $missing ='Missing';?>                    
                    <label class="grey" for="surname">Surname:</label>
                    <input class="field" type="text" name="surname" id="surname" value="" size="23" required aria-required="true"><?php echo $missingSname; $missing ='Missing';?>                                        
                    <label><input name="newsletter" id="newsletter" type="checkbox" checked="checked" value="yes"> &nbsp;Newsletter</label>
                    <input type="hidden" name="register" value="register">
                    <input type="submit" name="submit" value="Register" class="bt_register">
                </form>
            </section>     
        </div>
    </div>	
        <footer class="tab"> 
         <ul class="login">
            <li class="left">&nbsp;</li>
            <li><?php echo $message;?></li>
            <li class="sep">|</li>
            <li id="toggle">
                    <a id="open" class="open" href="#">Log - Register</a>
                    <a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
            </li>
            <li class="right">&nbsp;</li>
         </ul>
        </footer>    
    </article>       
<?php } else { //If user is  logged the panel shows members extras ?>
    <article>   
     <div id="panel">
       <div class="content clearfix">
           <header class="left">
                <h1>Art Of Simplicity</h1>
                <p class="grey"><img src="<?php echo ROOT_URL.'img/aos_login.jpg' ?>"></p>
                <h2>Download</h2>                            
           </header>
           <article class="left">               
                <form class="clearfix" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                    <header>
                        <h1>Member Area</h1>
                    </header>    
                     <h2><a  href="<?php echo ROOT_URL.'#'?>">ENTER THE FORUM</a></h2>
                     <h2><a  href="<?php echo ROOT_URL.'#'?>">BLOG & ROCK</a></h2>
                     <h2><a  href="<?php echo ROOT_URL.'#'?>">EXTRA STAFF</a></h2>                                     
            <div class="clear"></div>
                    <input type="hidden" name="logout" value="logout">
                    <input type="submit" name="submit" value="Logout" class="bt_login">
                    <a class="lost-pwd" href="#">Something</a>
                </form>
            </article>
            <aside class="left right">			
                <!-- Register Form -->
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                    <header>
                        <h1>Enter our Contest!</h1>				
                    </header>    
                    <p>Which member of our craw is the ugliest?</p>                                    
                    <label class="grey" for="password">Enter your Choise:</label>
                      <select id="type_id" name="type">
                          <option value="tour">Member1</option>
                          <option value="festival" >Member2</option> 
                          <option value="festival" >Member3</option>                                                                              
                      </select>
                    <input type="hidden" name="contest" value="contest">
                    <input type="submit" name="submit" value="VOTE" class="bt_register">
                    <a class="lost-pwd" href="#">Snick to Results</a>
                </form>
            </aside>   
           </div>
     </div> <!-- /login -->	
        <!-- The tab on top -->	
       <footer class="tab">  
        <ul class="login">
            <li class="left">&nbsp;</li>
            <li>Welcome to AOS</li>
            <li class="sep">|</li>
            <li id="toggle">
                <a id="open" class="open" href="#">Enter | Logout</a>
                <a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
            </li>
            <li class="right">&nbsp;</li>
        </ul>
       </footer>     
   </article>            
 <?php }?>           
  </div> <!--panel -->  
<div id ="content">  
  <header>
      <h1>Art Of Simplicity</h1> 
     <nav> 
       <ul id="ulNav">
        <li><a href="<?php echo ROOT_URL.'index.php'?>" class="house">HOME</a></li>
        <li><a class="info" href="<?php echo ROOT_URL.'news.php'?>" class="wrench">NEWS</a>
            <ul class="subs">
                <li><a class="wrench" href="<?php echo ROOT_URL.'news.php?type=1'?>">BAND NEWS</a></li>
                <li><a class="wrench" href="<?php echo ROOT_URL.'news.php?type=2'?>">OTHER NEWS</a></li>
                <li><a class="wrench" href="<?php echo ROOT_URL.'tours.php'?>">RELATED PROJECTS</a></li>                                        
            </ul>
        </li>
        <li><a class="info" href="<?php echo ROOT_URL.'index.php?page=band'?>">ABOUT</a>
            <ul class="subs">
                <li><a href="<?php echo ROOT_URL.'index.php?page=band'?>" class="info">THE BAND</a></li>
                <li><a href="<?php echo ROOT_URL.'index.php?page=disc'?>" class="info">DISCOGRAPHY</a></li>                    
            </ul>
        </li>
        <li><a href="http://artofsimplicity.bandcamp.com/" class="wrench" target="_blank">STORE</a></li>            
        <li><a class="info" href="#">MEDIA</a>
            <ul class="subs">
                <li><a href="#" class="info">WALLPAPERS</a></li>
                <li><a href="<?php echo ROOT_URL.'photos.php'?>" class="info">PHOTOS</a></li>                
                <li><a href="#" class="info">AUDIO-VIDEO</a></li>
                <li><a href="#" class="info">SCREENSAVERS</a></li>                    
            </ul>
        </li>
        <li><a class="envelope" href="#">LINKS</a>
            <ul class="subs">
                <li><a href="<?php echo ROOT_URL.'contact.php'?>" class="envelope">CONTACT</a></li>                
                <li><a href="#" class="envelope">SISTER BANDS</a></li>
                <li><a href="#" class="envelope">SOCIAL MEDIA</a></li>
                <li><a href="#" class="envelope">ETC</a></li>
            </ul>
        </li>
        <li class="social"><a class="envelope" href="#"><img src="<?php echo ROOT_URL.'img/social/png/social.png'?>" /></a>
            <ul class="subs subsfinal">
                <li class="social"><a href="http://www.facebook.com/groups/78686290091/" class="envelope" target="_blank"><img src="<?php echo ROOT_URL.'img/social/png/facebook.png'?>" /></a></li>
                <li class="social"><a href="https://twitter.com/aosofficial" class="envelope" target="_blank"><img src="<?php echo ROOT_URL.'img/social/png/twitter.png'?>" /></a></li>
                <li class="social"><a href="https://www.youtube.com/channel/UCOuokZo..." class="envelope" target="_blank"><img src="<?php echo ROOT_URL.'img/social/png/youtube.png'?>" /></a></li>  
                <li class="social"><a href="https://soundcloud.com/art-of-simplicity" class="envelope" target="_blank"><img src="<?php echo ROOT_URL.'img/social/png/soundcloud.png'?>" /></a></li>                  
                <li class="social"><a href="https://www.myspace.com/artofsimplicity" class="envelope" target="_blank"><img src="<?php echo ROOT_URL.'img/social/png/myspace.png'?>" /></a></li>                                  
                <li class="social"><a href="http://www.reverbnation.com/artofsimplicity" class="envelope" target="_blank"><img src="<?php echo ROOT_URL.'img/social/png/reverbn.png'?>" /></a></li>                                                  
                <li class="social"><a href="http://www.songkick.com/artists/353448" class="envelope" target="_blank"><img src="<?php echo ROOT_URL.'img/social/png/songkick.png'?>" /></a></li>                                                                  
                <li class="social"><a href="http://www.last.fm/music/Art+Of+Simplicity?ac=art%20of%20simplicity" class="envelope" target="_blank"><img src="<?php echo ROOT_URL.'img/social/png/lastfm.png'?>" /></a></li>                
                <li class="social"><a href="http://www.tumblr.com/blog/aosofficial" class="envelope" target="_blank"><img src="<?php echo ROOT_URL.'img/social/png/tumblr.png'?>" /></a></li>                
            </ul>            
        </li>                  
        <div id="lavalamp"></div>
    </ul>
    <div class="clear"></div>              
   </nav>      
  </header>
  <main id="main">

