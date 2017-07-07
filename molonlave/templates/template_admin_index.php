<?php   //If template isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    } ?>
<div id ="wrapper">
  <div id="content">
      <section>
          <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
              <ul>
              <li><h1>Administrator Login</h1></li>                              
              <li><label for="username"> Your username:</label>
                  <input type="text" id="username" name="username" required aria-required="true">
              <?php  if(isset($_POST['enter']))if(trim($_POST['username']=='')) echo "*Username Required";?></li>                             
              <li><label for="password"> Your password:</label>
              <input type="password" id="password" name="password" required aria-required="true">
              <?php  if(isset($_POST['enter']))if(trim($_POST['password']=='')) echo "*Password Required";?> </li> 
              <li><input type="checkbox" name="keep_me" value="keep_me_logged"/> Keep me logged!</li>
              <li><input type="hidden" name="enter" value="enter">
                  <input type="submit" value="login"></li>
              </ul>
          </form>
          <div id='fattemps'>
            <?php 
                if(isset($_SESSION['fattemps'])&&($_SESSION['fattemps']>=1&&$_SESSION['fattemps']<5))
                      echo 'WRONG USERNAME AND/OR PASSWORD:'.$_SESSION['fattemps'];;
             ?>  
          </div>
      </section>   
  </div>
</div>