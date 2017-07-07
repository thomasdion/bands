<?php //If tamplate isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
?>
<div id ="wrapper">
  <div id="content">    
    <section>                                        
    <form id="insert_id" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
       <hgroup>
          <h1>Administrator</h1>
          <h2>Insert Tour</h2>
       </hgroup>
        <fieldset>
            <legend>Give data</legend>
            <div><label for ="tour_date_id">Date:</label>
                 <input id="tour_date_id" name="tour_date" type="datetime-local" value="<?php echo $data['tour_date'];?>" required aria-required="true"> 
                 <?php if(isset($_POST['insert']))if(trim($_POST['tour_date'])=='') echo "*Date Required";?>
            </div> 
             <div><label for="town_id">Town:</label>
                  <input id="town_id" name="town" type="text" value="<?php echo $data['town'];?>" required aria-required="true"> 
                  <?php if(isset($_POST['insert']))if(trim($_POST['town'])=='') echo "*Town Required";?>
            </div>                              
             <div><label for=place_id">Place:</label>
                  <input id="place_id" name="place" type="text" value="<?php echo $data['place'];?>" required aria-required="true"> 
                  <?php if(isset($_POST['insert']))if(trim($_POST['place'])=='') echo "*Place Required";?>
            </div> 
            <div><label for=type_id">Type:</label>
                  <select id="type_id" name="type">
                      <option value="tour" selected>Tour</option>
                      <option value="festival">Festival</option>
                  </select>
            </div>  
            <div>
                <h2><?php if($this->checkInsert()) echo "Tour Succesfully Entered"; ?></h2>
            </div>
        </fieldset>
        <input type="hidden" name="insert">
        <input type="submit" name="submit" value="Insert Tour">
    </form>        
    </section>
      <p><a href='controltours.php'><img src='../img/64x64/back.png' /><p>BACK</p></a></p>
 </div>
</div>

