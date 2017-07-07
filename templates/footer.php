    <aside>
        <header>
            <h1>Latest News</h1>
        </header>
        <ul> 
        <?php  
        foreach($sidebar as $row) {
            $row = sanitize($row, 2);
            $pdate =  date('M d', strtotime($row['post_date']));
            echo "<li><a href=news2.php?id=$row[id]>$row[title]</a></li>";      
         } ?>
        </ul>
    </aside>   
    <aside><?php
                $obj = new CalenderShowc();
                echo $obj->showCalender();?>
                <div class="event"> 
                <?php if($logged) {?><a  href=<?php echo ROOT_URL."saveEvent.php"?> >Save My Event</a>  |  <?php } ?><a  href=<?php echo ROOT_URL."index.php?page=search"?> >Search Event</a></div>             
    </aside>      
  </main>
        <div class="clear"></div>              
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo ROOT_URL.'js/vendor/jquery-1.9.0.min.js';?>"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="<?php echo ROOT_URL.'js/slide.js';?>"></script> 
        <script src="<?php echo ROOT_URL.'js/DateCalender.js';?>"></script>        
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </div>    
    <div id='bottom'>      
      <p>Copyright © Art Of Simplicity. All rights reserved</p>
    </div>                  
</body>
</html>