<?php //If template isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
?>
<div id ="wrapper">
  <div id="content">  
      <section>
        <h1>Chose to Destroy or Regenarate or Create</h1>
        <?php 
        foreach($data as $row) { //generates error when table empty
                  $row = sanitize($row, 1);
                      echo "<div><p>$row[username] $row[name] $row[surname] $row[email] $row[newsletter] $row[role_des]";
                      if($row['role_id']!=1) {                              
                         echo "<a href='updateuser.php?user_id=$row[user_id]' />Update</a> ";
                         echo "<a href='deleteuser.php?user_id=$row[user_id]' />Delete</a></p></div>";  
                      }    
                } ?>
        <p><a href='controlpanel.php'><img src='../img/64x64/back.png' />BACK</a></p>
        </section>
  </div>
</div>