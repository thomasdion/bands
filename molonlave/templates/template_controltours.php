<?php //If template isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
?>
<div id ="wrapper">
  <div id="content">  
      <section>
        <h1>Chose to Destroy or Regenarate or Create</h1>
        <?php 
        foreach($data as $row) { //generates error when table empty
                  $row = sanitize($row, 1);
                    echo<<<_END
                      <div><p>$row[tour_date] $row[town] $row[place] $row[type]
                          <a href="updatetour.php?id=$row[id]">Update</a> 
                          <a href="deletetour.php?id=$row[id]">Delete</a></p></div>                                                                
_END;
                }
        $pagination = $this->getPagination();
        echo $pagination;                ?>
        <p><a href='inserttour.php'><img src='../img/64x64/page_accept.png' /><p>INSERT A TOUR</a>
              <a href='controlpanel.php'><img src='../img/64x64/back.png' />BACK</a></p>
        </section>
  </div>
</div>