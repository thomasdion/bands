<article> 
      <header>    
        <h1>News Archive</h1>
      </header>  
        <?php
        $pagination = $this->getPagination(); 
        foreach($data as $row) {
            $row = sanitize($row, 2);
            $pdate =  date('M d', strtotime($row['post_date']));
            echo<<<_END
              <article class='new'>                  
                  <a href=news2.php?id=$row[id]&page=$pagination[page]&type=$pagination[type]>
                  <div class='imageholder'>
                      <img src="img/news/$row[image]" />
                      <time datetime='m dd' pubdate>$pdate</time>
                  </div>
                  <div class='textholder'> 
                     <header> 
                        <h1>$row[title]</h1>
                     </header>
                  </a>      
                     <p>$row[content]</p> 
                     <p id=$row[id]><a href=news2.php?id=$row[id]&page=$pagination[page]&type=$pagination[type]>Read more</a></p>
                  </div> 
              </article>
             <div class="clear"></div>              
                  
_END;
        }
         echo $pagination['pagination'];?>
</article>              

