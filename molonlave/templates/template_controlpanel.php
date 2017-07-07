<?php                        
    if(!isset($this)) {                      //If template isnt loaded from controler redirect,
        header("Location:../../404.html");  //aditional protection that Prevents direct display of template.
        exit();
    }       // print_r($_SESSION)."<h1>OOOO</h1>";
?>
<div id ="wrapper">
      <div id="content">
          <ul>
              <li><a href="controlnews.php"><img src="../img/64x64/new_page.png" /><p>NEWS</p></a></li>
              <li><a href="controlusers.php"><img src="../img/64x64/users.png" /><p>USERS</p></a></li>
              <li><a href="controltours.php"><img src="../img/64x64/tours.png" /><p>TOURS-FESTS</p></a></li>
              <li><a href="controlcomments.php"><img src="../img/64x64/comment.png" /><p>COMMENTS</p></a></li>
              <li><a href="controlbanned.php"><img src="../img/64x64/tag.png /"><p>BANNED</p></a></li>
          </ul>
      </div>
</div>
