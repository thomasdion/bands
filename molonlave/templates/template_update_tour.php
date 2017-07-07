<?php //If tamplate isnt loaded from controler redirect
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
      <h2>Update Tour</h2>
   </hgroup>
    <fieldset>
        <legend>Update data</legend>
        <div><label for="tour_date_id">Tour Date:</label>
       <?php
              $id = $data['id'];
              $s = $data['tour_date'];
              $date = strtotime($s);
              echo date('d/m/Y H:i:a', $date);
        ?>  
            <input id="tour_date_id" name="tour_date" type="datetime-local" value="<?php echo  date('d/m/Y H:i:a', $date);?>" required aria-required="true"> 
             <?php if(isset($_POST['update']))if(trim($_POST['tour_date'])=='') echo "*Date Required";?>           
        </div> 
        <div><label for="town_id">Town:</label>
             <input id="town_id" name="town" type="text" value="<?php echo $data['town'];?>" required aria-required="true"> 
             <?php if(isset($_POST['update']))if(trim($_POST['town'])=='') echo "*Town Required";?>             
        </div>                             
        <div><label for="place_id">Place:</label>
             <input id="place_id" name="place" type="text" value="<?php echo $data['place'];?>" required aria-required="true"> 
             <?php if(isset($_POST['update']))if(trim($_POST['place'])=='') echo "*Place Required";?>             
        </div> 
            <div><label for=type_id">Type:</label>
                  <select id="type_id" name="type">
                      <?php $tour="";
                            $fest="";
                            if($data['type']=='tour') 
                                $tour='selected';
                            else $fest='selected';?>
                      <option value="tour" <?php echo $tour ?>>Tour</option>
                      <option value="festival" <?php echo $fest ?>>Festival</option>
                  </select>
            </div>         
        <div>
            <h2><?php if($this->checkUpdate()) echo "Tour Succesfully Updated"; ?></h2>
        </div>
    </fieldset>
    <input type="hidden" name="update">
    <input type ="hidden" name="id" value="<?php echo $id; ?>">    
    <input type="submit" name="update" value="Update Tour">
</form>        
</section>
  <p><a href='controltours.php'><img src='../img/64x64/back.png' /><p>BACK</p></a></p>
</div>
</div>