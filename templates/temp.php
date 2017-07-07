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
    $message='Extra Content';
    $missingUsr='';
    $missingPsw='';
    $missingUsr2='';
    $missingPsw2='';    
    $missingEmail='';
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
    }?>
<div id='wrapper'>
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
                    <a id="open" class="open" href="#">Log In | Register</a>
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
     <div id="logo"></div> 
     <nav> 
       <ul id="ulNav">
        <li><a href="<?php echo ROOT_URL.'index.php'?>" class="house">HOME</a></li>
        <li><a class="info" href="<?php echo ROOT_URL.'news.php'?>" class="wrench">NEWS</a>
            <ul class="subs">
                <li><a class="wrench" href="<?php echo ROOT_URL.'news.php?type=1'?>">BAND NEWS</a></li>
                <li><a class="wrench" href="<?php echo ROOT_URL.'news.php?type=2'?>">SITE NEWS</a></li>
                <li><a class="wrench" href="<?php echo ROOT_URL.'tours.php'?>">TOUR DATES</a></li>                                        
                <li><a class="wrench" href="#">OTHER NEWS</a></li>                    
            </ul>
        </li>
        <li><a class="info" href="#">ABOUT</a>
            <ul class="subs">
                <li><a href="#" class="info">THE BAND</a></li>
                <li><a href="#" class="info">BAND MEMBERS</a></li>
                <li><a href="#" class="info">SISTER PROJECTS</a></li>
                <li><a href="<?php echo ROOT_URL.'discography.php'?>" class="info">DISCOGRAPHY</a></li>                    
            </ul>
        </li>
        <li><a href="#" class="wrench">STORE</a></li>            
        <li><a class="info" href="#">MEDIA</a>
            <ul class="subs">
                <li><a href="#" class="info">WALLPAPERS</a></li>
                <li><a href="#" class="info">AUDIO</a></li>
                <li><a href="#" class="info">VIDEOS</a></li>
                <li><a href="#" class="info">SCREENSAVERS</a></li>                    
            </ul>
        </li>
        <li><a class="envelope" href="#">LINKS</a>
            <ul class="subs">
                <li><a href="#" class="envelope">SISTER BANDS</a></li>
                <li><a href="#" class="envelope">SOCIAL MEDIA</a></li>
                <li><a href="#" class="envelope">ETC</a></li>
            </ul>
        </li>
        <li class="social"><a href="#1" class="envelope"><img src="<?php echo ROOT_URL.'img/social/png/facebook.png'?>" /></a></li>
        <li class="social"><a href="#2" class="envelope"><img src="<?php echo ROOT_URL.'img/social/png/twitter.png'?>" /></a></li>
        <li class="social"><a href="#3" class="envelope"><img src="<?php echo ROOT_URL.'img/social/png/instagram.png'?>" /></a></li>
        <li class="social"><a href="#4" class="envelope"><img src="<?php echo ROOT_URL.'img/social/png/youtube.png'?>" /></a></li>            
        <div id="lavalamp"></div>
    </ul>
    <div class="clear"></div>              
   </nav>      
  </header>
  <div id="stage"><!-- The dot divs are shown here --></div> 
  <main id="main">
     
         <section>
        <p>  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis erat magna. Aenean dui turpis, condimentum vitae pulvinar ac, faucibus id turpis. Aliquam vestibulum pellentesque urna, non semper orci facilisis vel. Cras sit amet ligula lectus. In ut justo arcu. Etiam interdum ipsum a est scelerisque pulvinar. Maecenas accumsan mauris in nulla aliquet at pretium nisl mattis. Vestibulum urna arcu, ultrices et egestas eget, gravida sit amet augue. Nullam eu mauris diam, non sagittis eros. Proin eu urna tempus nisl bibendum condimentum nec in quam. Phasellus nulla arcu, accumsan sed pharetra ac, ultricies at justo. Nulla vestibulum nisl et dui pulvinar in fermentum felis tincidunt. Nullam aliquam congue faucibus. Donec metus justo, interdum et faucibus at, convallis ac diam.
        </p><p>
        Morbi consectetur sapien id ipsum gravida placerat. Integer augue sem, ullamcorper non placerat vel, fringilla non diam. Morbi malesuada tellus a diam volutpat pharetra. Nunc cursus ullamcorper tortor. Ut id nunc massa. Vivamus sem elit, laoreet at venenatis sit amet, semper quis est. Phasellus et tortor imperdiet arcu volutpat rutrum.
        </p><p>
        Aliquam quis lectus ut neque porttitor condimentum eu nec dolor. Aliquam libero elit, bibendum non porta id, tempus et metus. Donec ac metus at metus aliquam vehicula ut quis sem. Sed ornare erat eget felis consectetur id facilisis metus molestie. Mauris laoreet nisl a est ultrices non fermentum odio ornare. Donec in mi tortor, sit amet interdum massa. Proin consectetur leo vel ligula blandit laoreet. Nulla ligula augue, mattis id fringilla sed, porta ut nulla. Vivamus ultrices convallis luctus. Donec leo metus, bibendum sit amet congue a, hendrerit in velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc nec porttitor ligula.
        </p> 
  </section>
      
          <aside>
        <header>
            <h1>Latest News</h1>
        </header>    
        <p>lerem ipsum dolores</p>
    </aside>  
    </main>    
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo ROOT_URL.'js/vendor/jquery-1.9.0.min.js';?>"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="<?php echo ROOT_URL.'js/main.js';?>"></script>
        <script src="<?php echo ROOT_URL.'js/slide.js';?>"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </div>    
    <div id="copywrite">      
      <p>Here goes the footer</p>
    </div> 
</div>
</body>
</html>