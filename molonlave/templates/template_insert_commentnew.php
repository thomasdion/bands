<?php //If tamplate isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
    $comm = $data[2];  
?>
<div id ="wrapper">
  <div id="content">    
    <section>                                        
    <form id="insert_id" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
       <hgroup>
          <h1>Administrator</h1>
          <h2>Make a Comment</h2>
       </hgroup>
        <fieldset>
            <legend>Give data</legend>
             <div><label for="comment_id">Content:</label>
                  <textarea id="content_id" name="comment" required aria-required='true'><?php echo $comm['comment'];?></textarea>
                  <?php if(isset($_POST['insert']))if(trim($_POST['comment'])=='') echo "*Leave a Comment Please";?>
            </div>                            
            <div><label for="flag_id">Type:</label>
                  <select id="flag_id" name="flag">
                      <option value="1" >Unpublished</option>
                      <option value="2" selected>Published</option>                      
                  </select>
            </div>  
            <div>
                <h2><?php if($this->checkInsert()) echo "Comment Succesfully Entered"; ?></h2>
            </div>
        </fieldset>
        <input type="hidden" name="insert">
        <input type ="hidden" name="new" value="<?php echo $comm['new']; ?>"> 
        <input type ="hidden" name="reply" value="<?php echo $comm['reply']; ?>">                
        <input type="submit" name="submit" value="Make Comment">
    </form>        
    </section>
      <p><a href='controlcommentnews.php'><img src='../img/64x64/back.png' /><p>BACK</p></a></p>
 </div>
</div>

