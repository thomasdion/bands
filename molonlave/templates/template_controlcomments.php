<?php                        
    if(!isset($this)) {                      //If template isnt loaded from controler redirect,
        header("Location:../../404.html");  //aditional protection that Prevents direct display of template.
        exit();
    }       // print_r($_SESSION)."<h1>OOOO</h1>";
?>
<div id ="wrapper">
      <div id="content">
          <ul>
              <li><a href="controlcommentnews.php"><img src="../img/64x64/new_page.png" /><p>NEWS</p></a></li>
              <li><a href="controlnews.php"><img src="../img/64x64/calendar.png" /><p>SHOWS</p></a></li>
              <li><a href="controlnews.php"><img src="../img/64x64/headphones.png" /><p>ALBUMS</p></a></li>
              <li><a href="controlpanel.php"><img src="../img/64x64/back.png" /><p>BACK</p></a></li>
          </ul>
      </div>
</div>
