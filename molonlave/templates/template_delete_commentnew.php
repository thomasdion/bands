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
     echo "<div><h2>Comment Deleted</h2></div>" ;
}else { 
    $comm = $data[2];
    ?>      
    <form id="delete_id" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
       <hgroup>
          <h1>Administrator</h1>
          <h2>Delete Comment</h2>
       </hgroup>
        <section>
           <div id="news2">           
            <p> <?php echo $comm['post_date'];
                 echo $comm['comment']; ?> 
            </p>
           </div>
        </section>      
        <input type="hidden" name="delete">
        <input type ="hidden" name="id" value="<?php echo $comm['id']; ?>">            
        <input type="submit" name="delete" value="Delete Comment">
    </form>        
 <?php }?> 
 </section> 
  <p><a href="controlcommentnews.php"><img src='../img/64x64/back.png' /><p>BACK</p></a></p>
</div>
</div>