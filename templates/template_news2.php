      <article>       
        <?php 
        if(isset($_GET['page'])&&preg_match("/^([0-9]+)$/",$_GET['page']))
           $page = $_GET['page'];
        else $page = 0;
        if(isset($_GET['type'])&&preg_match("/^([1-2]+)$/",$_GET['type']))
            $type = $_GET['type'];
        else $type = 0;
        if(isset($data)){
            $news = $data[1];
            $comments = $data[2];              
            $news =sanitize($news, 2);
            $pdate =  date('M d Y', strtotime($news['post_date']));
            $commCount = count($comments);
            echo<<<_END
                   <article id='new2'>
                    <header>
                        <h1>$news[title]</h1>
                        <p>$pdate</p>
                    <header>
                    <a href=news.php?page=$page&type=$type#$news[id]><img src="img/news/$news[image]" /></a>
                    <p class='newContent'>$news[content]...</p>   
                    <div class='clear'></div>   
                    <footer>
                       <ul>
                         <li></li>
                         <li></li>
                         <li></li>                    
                       </ul>
                    <span>Post by $news[post_by]</span>
                       <a href=news.php?page=$page&type=$type#$news[id]>Back</a>
                    </footer>
                  </article>  
                  <section id='comments'>
                    <header><h2>$commCount COMMENTS</h2></header>
_END;
            foreach($comments as $comm) {
                  $comm = sanitize($comm, 1);                        
                         if((int)$comm['reply']>0) $rep .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; //shloud be handled with css
                         else
                             $rep ='';
                    echo<<<_END
                      <div class='comment'>   
                          <div class='blank'>$rep</div>
                          <section class='commentContent'>
                             <header><h2><span>$comm[username]</span> SAYS:</h2></header>
                               <p>$comm[comment]</p>
                          </section><span class='date'>$comm[post_date]</span>
                      </div>      
                      <div class='clear'></div>   
                                                            
_END;
                }                             
        } ?>
                 </section>
        </article>


