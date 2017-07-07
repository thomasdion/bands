<script src="<?php echo ROOT_URL.'js/calendar.js';?>"></script>
<script src="<?php echo ROOT_URL.'js/calendar-setup.js';?>"></script>
<script src="<?php echo ROOT_URL.'js/calendar-en.js';?>"></script>
<link rel="stylesheet" href="<?php echo ROOT_URL.'css/calendar-win2k-cold-1.css'?>"/>
<section>    
    <header><h1>EVENT SEARCH</h1></header>
    <form name="eventRecord" method="get" action="<?php echo htmlentities(ROOT_URL.'searchResultPage.php');?>">
    <ul id="eventSearch">
        <li><h2>From</h2>
            <input type="search" id="cal-field-1" name="sdate" size="14" maxlength="10" required aria-required="true">
            <button type="submit" id="cal-button-1">...</button></li>
        <li><h2>To</h2>
            <input type="search" id="cal-field-2" name="edate" size="14" maxlength="10" required aria-required="true">
            <button type="submit" id="cal-button-2">...</button></li>
        <li><br><script type="text/javascript">
            Calendar.setup({
              inputField    : "cal-field-1",
              button        : "cal-button-1",
              align         : "Tr"
            });
          	</script>
            <input type="submit" value="Search" />
          	<p align="center">&nbsp;  </p>          
          	<script type="text/javascript">
            Calendar.setup({
              inputField    : "cal-field-2",
              button        : "cal-button-2"
            });
          	</script></li>
    </ul>
    </form>
</section>