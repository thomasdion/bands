<?php //If template isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
?>
<div id ="wrapper">
  <div id="content">  
      <article>
        <h1>Chose to Destroy or Regenarate or Create</h1>           
        <?php 
        $news = $data[1];
        $comments = $data[2];
        $count = $data[3];     
        
        for($i=1;$i<=$count ;$i++) {
                  $row = $news[$i];
                  $row = sanitize($row, 1);
                    echo<<<_END
                      <section>  
                      <header>
                        <div><h2>$row[title] $row[content] $row[post_date]</h2></div>                                                                
                      </header>
_END;
            foreach($comments[$i] as $comm) {
                  $comm = sanitize($comm, 1);                        
                         if((int)$comm['reply']>0) $rep = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; //shloud be handled with css
                         else
                             $rep ='';
                    echo<<<_END
                        <div>_____________$rep $comm[comment] $comm[post_date] $comm[username] $comm[flag]
                            <a href="updatecommentnew.php?id=$comm[id]">Update</a> 
                            <a href="deletecommentnew.php?id=$comm[id]">Delete</a>
                            <a href="insertcommentnew.php?new=$row[id]&reply=$comm[id]">Reply</a>
                       </div>                                                                                  
                      </section>                                                            
_END;
                } 
                      echo "<p><a href=insertcommentnew.php?new=$row[id]>Make a Comment</a></p>";
        }
        $pagination = $this->getPagination();
        echo $pagination;        ?>
        <p><a href='controlcomments.php'><img src='../img/64x64/back.png' />BACK</a></p>
        </article>
  </div>
</div>

