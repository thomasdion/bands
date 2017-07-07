<?php //If template isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
?>
<div id ="wrapper">
  <div id="content">    
    <section>                                        
    <form id="insert_id" method="POST" action="<?php echo  htmlentities($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
       <hgroup>
          <h1>Administrator</h1>
          <h2>Insert New</h2>
       </hgroup>
        <fieldset>
            <legend>Give data</legend>
            <div><label for="title_id">Title:</label>
                 <input id="title_id" name="title" type="text" value="<?php echo $data['title'];?>" required aria-required="true"> 
                 <?php if(isset($_POST['insert']))if(trim($_POST['title'])=='') echo "*Title Required";?>
            </div> 
             <div><label for="content_id">Content:</label>
                  <textarea id="content_id" name="content" required aria-required="true"><?php echo $data['content'];?></textarea>
                  <?php if(isset($_POST['insert']))if(trim($_POST['content'])=='') echo "*Content Required";?>
            </div>  
            <div><label for=type_id">Type:</label>
                  <select id="type_id" name="type">
                      <option value="1" selected>Band New</option>
                      <option value="2">Site New</option>
                  </select>
            </div>              
             <div>
                   <label for="image_id">Select image</label>
                   <input id="image_id" name="image" type="file">
            </div>
            <div>
                <h2><?php if($this->checkInsert()) echo "New Succesfully Entered"; ?></h2>
            </div>
        </fieldset>
        <input type="hidden" name="insert">
        <input type="submit" name="submit" value="Insert new">
    </form>        
    </section>
      <p><a href='controlnews.php'><img src='../img/64x64/back.png' /><p>BACK</p></a></p>
 </div>
</div>

