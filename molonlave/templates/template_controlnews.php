<?php //If template isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
    $type='';
    if(isset($_POST['type'])&&preg_match("/^([0-9]+)$/",$_POST['type']))
        $type = $_POST['type'];
    else if(isset($_GET['type'])&&preg_match("/^([0-9]+)$/",$_GET['type']))
        $type = $_GET['type']; 
    $types =  array('All'=>'','Band'=>'','Site'=>'');
    switch ($type) {
      case 0:
          $types['All']='selected';
          break;               
      case 1:
          $types['Band']='selected';
          break;
      case 2:
          $types['Site']='selected';
          break;             
      default:
          $types['All']='selected';
          break;          
   }    
?>
<div id ="wrapper">
  <div id="content">  
      <section>
        <h1>Chose to Destroy or Regenarate or Create</h1>
        <form id="update" name='update_form' method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">        
            <div><label for=type_id">News:</label>
              <select id="type_id" name="type" onchange="document.update_form.submit();"> 
                  <option value="0" <?php echo $types['All']?>>All</option>
                  <option value="1" <?php echo $types['Band']?>>Band</option>
                  <option value="2" <?php echo $types['Site']?>>Site</option>                  
              </select><input type="submit" name="mysubmit" value="OK">              
            </div>           
        </form>                        
        <?php 
        foreach($data as $row) { 
          $row = sanitize($row, 1);
            echo<<<_END
              <div><p>$row[title] $row[content] $row[post_date]
                  <a href="updatenew.php?id=$row[id]">Update</a> 
                  <a href="deletenew.php?id=$row[id]">Delete</a></p></div>                                                                
_END;
         }
        $pagination = $this->getPagination();
        echo $pagination;   ?>
        
        <p> <a href='insertnew.php'><img src='../img/64x64/page_accept.png' /><p>INSERT A NEW</a>
            <a href='controlpanel.php'><img src='../img/64x64/back.png' />BACK</a></p>
     </section>
  </div>
</div>

