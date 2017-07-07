<section>    
    <header><h1>NEW EVENT</h1></header>
    <form id="eventForm" name="eventRecord" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
        <table>
        <tr><td><label for="title">Title:</label></td>
            <td><input class="field" type="text" name="title" id="title" value="" size="23" maxlength="35" required aria-required="true"></td></tr>
        <tr><td>Date:</td>
               <td><select id="year_id" name="year">
                        <option>Year</option>
               <?php for($year=2013;$year<=2035;$year++) 
                         print("<option value=$year>$year</option>"); ?>                          
                  </select>
                  <select id="month_id" name="month">
                        <option>Month</option>
               <?php $month=array("Jan"=>01,"Feb"=>02,"Mar"=>03,"Apr"=>04,"May"=>05,"Jun"=>06,"Jul"=>07,"Aug"=>08,"Sep"=>09,"Oct"=>10,"Noe"=>11,"Dec"=>12);
                      foreach ($month as $key => $value) 
                          print("<option value=$value>$key</option>"); ?>                          
                   </select>
                   <select id="day_id" name="day">
                        <option>Day</option>
               <?php for($day=01;$day<=31;$day++) 
                         print("<option value=$day>$day</option>"); ?>                          
                  </select>                   
               </td></tr>
        <tr><td>Start Time</td>
               <td><select id="shour_id" name="shour">
                        <option>HH</option>
               <?php for($shour=01;$shour<=24;$shour++) 
                         print("<option value=$shour>$shour</option>"); ?>                          
                  </select>            
                   <select id="sminute_id" name="sminute">
                        <option>MM</option>
               <?php for($sminute=01;$sminute<=59;$sminute++) 
                         print("<option value=$sminute>$sminute</option>"); ?>                          
                  </select>                   
               </td></tr>                   
        </tr>
        <tr><td><label for="place">Event Place:</label></td>
            <td><input class="field" type="text" name="place" id="place" value="" size="23" maxlength="30" required aria-required="true"></td></tr>        
        <tr><td><label for="ticket">Ticket:</label></td>
            <td><input class="field" type="number" name="ticket" id="ticket" value="" size="10" maxlength="3"></td></tr>         
        <tr><td><label for="desc">Description:</label></td>
            <td><textarea name='desc' placeholder="Details about the event" maxlength="140" tabindex="5"></textarea></td></tr> 
        <tr><td><label for="phone">Telephone:</label></td>
            <td><input class="field" type="text" name="phone" id="phone" value="" size="23" maxlength="30"></td></tr>        
        <tr><td><label for="url">Contact Url:</label></td>
            <td><input class="field" type="text" name="url" id="url" value="" size="23" maxlength="30"></td></tr>                       
        <tr><td colspan="2"><input type="hidden" name="saveEvent" value="saveEvent">      
        <input type="submit" name="submit" value="Save Event"></td></tr>    
        </table><div><?php if($this->checkInsert()) echo 'New Event Entered. Please wait for confirmation.'; ?></div>        
    </form>
</section>