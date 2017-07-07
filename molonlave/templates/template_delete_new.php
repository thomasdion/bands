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
       echo "<div><h2>New Deleted</h2></div>" ;
}else { 
    ?>      
      <form id="delete_id" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
       <hgroup>
          <h1>Administrator</h1>
          <h2>Delete New</h2>
       </hgroup>
        <section>
           <div id="news2">
            <h2><?php echo $data['title'];?></h2>
            <img src="../img/news/<?php echo $data['image'];?>" />                 
            <p>Post by <?php echo $data['post_by']; 
              echo $data['post_date']."<br>";
              echo $data['content'];?></p>
           </div>
        </section>      
        <input type="hidden" name="delete">
        <input type ="hidden" name="id" value="<?php echo $data['id']; ?>">        
        <input type="submit" name="delete" value="Delete new">
     </form>        
 <?php }?> 
 </section> 
  <p><a href='controlnews.php'><img src='../img/64x64/back.png' /><p>BACK</p></a></p>
</div>
</div>