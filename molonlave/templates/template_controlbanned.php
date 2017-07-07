<?php //If template isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
?>
<div id ="wrapper">
    <div id="content">  
      <section>
        <form id="update_id" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
           <hgroup>
              <h1>Administrator</h1>
              <h2>Banned IP's</h2>          
        <?php 
        foreach($data as $row) { //generates error when table empty
                  $row = sanitize($row, 1);
                  if($row['status']=='Banned')
                      $action = 'Unban';
                  else
                      $action = 'Ban';
                  echo "<div><p>$row[ip] $row[status] <input type='submit' name='$row[id]' value='$action' </p></div>";
                } ?>
        </form>
        <p><a href='controlpanel.php'><img src='../img/64x64/back.png' />BACK</a></p>
        </section>
    </div>
</div>