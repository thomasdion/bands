<?php //If template isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
?>
<div id ="wrapper">
<div id="content">    
<section>    
<?php 
   if($this->checkDelete()) {        
       echo "<div><h2>Tour Deleted</h2></div>" ;
   }else { 
      $tour = $this->getData(); 
 ?>      
      <form id="delete_id" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
       <hgroup>
          <h1>Administrator</h1>
          <h2>Delete Tour</h2>
       </hgroup>
        <section>
           <div id="tours2">           
            <p> <?php echo $data['tour_date'];
                      echo $data['town']; 
                      echo $data['place'];
                      echo $data['type'];?></p>
           </div>
        </section>      
        <input type="hidden" name="delete">
        <input type ="hidden" name="id" value="<?php echo $data['id']; ?>">            
        <input type="submit" name="delete" value="Delete Tour">
     </form>        
<?php }?> 
 </section> 
  <p><a href='controltours.php'><img src='../img/64x64/back.png' /><p>BACK</p></a></p>
</div>
</div>