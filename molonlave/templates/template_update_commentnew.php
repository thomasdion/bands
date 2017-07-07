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
    <form id="update" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
   <hgroup>
      <h1>Administrator</h1>
      <h2>Update Comments For News</h2>
   </hgroup>
    <fieldset>
        <legend>Update data</legend>
        <div>Post By <span>...</span>  At <?php echo $comm['post_date'];?>          
        </div> 
         <div><label for="comment_id">Content:</label>
              <textarea id="comment_id" name="comment"><?php echo $comm['comment'];?></textarea>
        </div>                              
         <div>
               <label for="flag_id">Mark Comment As</label>
          <?php
           $marks =  array('Unpublished'=>'','Published'=>'','Spam'=>'');
           $mark = (int)$comm['flag'];
           switch ($mark) {
              case 1:
                  $marks['Unpublished']='selected';
                  break;               
              case 2:
                  $marks['Published']='selected';
                  break;
              case 3:
                  $marks['Spam']='selected';
                  break;                  
           } ?>
          <select id='flag_id' name='flag'>
              <option value='1' <?php echo $marks['Unpublished'] ?>>Unpublished</option>
              <option value='2' <?php echo $marks['Published'] ?>>Published</option>
              <option value='3' <?php echo $marks['Spam'] ?>>Spam</option>
          </select>             
        </div>
        <div>
            <h2><?php if($this->checkUpdate()) echo "Comment Succesfully Updated"; ?></h2>
        </div>
    </fieldset>
    <input type="hidden" name="update">
    <input type ="hidden" name="id" value="<?php echo $comm['id']; ?>">
    <input type="submit" name="update" value="Update Comment">
</form>        
</section>
  <p><a href="controlcommentnews.php"><img src='../img/64x64/back.png' /><p>BACK</p></a></p>
</div>
</div>