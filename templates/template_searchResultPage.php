<article> 
      <header>    
        <h1>EVENTS</h1>
      </header>       
<?php if(count($data)==0) 
           echo 'NO EVENTS FOUND.'; 
      else {?>         
      <table id="eventsList">  
          <tr><th>Event</th><th>Place</th><th>Date</th></tr>  
  <?php   $pagination = $this->getPagination(); 
           foreach($data as $row) {
                $row = sanitize($row, 2);
                $evdate =  date('D,  d/m/y', strtotime($row['evt_date']));
                echo<<<_END
                <tr><td>$row[evt_title]</td><td>$row[evt_place]</td><td>$evdate</td></tr>    
                <div class="clear"></div>                                
_END;
        }
         echo $pagination['pagination'];
      }?>
          <tr><td colspan="3"><a href="<?php echo ROOT_URL.'index.php?page=search'?>">BACK</a></td></tr> 
     </table>     
</article>              

