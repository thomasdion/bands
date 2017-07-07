<?php //If tamplate isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
?>
<div id ="wrapper">
<div id="content">    
<section>                                        
    <form id="update" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
   <hgroup>
      <h1>Administrator</h1>
      <h2>Update New</h2>
   </hgroup>
    <fieldset>
        <legend>Update data</legend>
        <div><label for="title_id">Title:</label>
             <input id="title_id" name="title" type="text" value="<?php echo $data['title'];?>" required aria-required="true"> 
             <?php if(isset($_POST['update']))if(trim($_POST['title'])=='') echo "*Title Required";?>             
        </div> 
         <div><label for="content_id">Content:</label>
              <textarea id="content_id" name="content" required aria-required="true"><?php echo $data['content'];?></textarea>
              <?php if(isset($_POST['update']))if(trim($_POST['content'])=='') echo "*Content Required";?>
        </div>                              
         <div>
               <img src="../img/news/<?php echo $data['image']."?=".time();?>" />                 
               <label for="image_id">Select image</label>
               <input id="image_id" name="image" type="file">
               <input type="hidden" name="img_name" value="<?php echo $data['image'];?>">
        </div>
        <div>
            <h2><?php if($this->checkUpdate()) echo "New Succesfully Updated"; ?></h2>
        </div>
    </fieldset>
    <input type="hidden" name="update">
    <input type ="hidden" name="id" value="<?php echo $data['id']; ?>">
    <input type="submit" name="update" value="Update new">
</form>        
</section>
  <p><a href='controlnews.php'><img src='../img/64x64/back.png' /><p>BACK</p></a></p>
</div>
</div>