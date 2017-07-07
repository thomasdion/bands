<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Events Calender</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/DateCalender.js"></script>
</head>
<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="header"><a href="../index.php"><img src="../images/header_1.jpg" width="328" height="149" border="0" /></a></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="26%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><p>
                <?php 
			  			include("EventRecord.php");
						$obj = new EventRecord();
						echo $obj->storeRecord();
					?>
              </p>
              </td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td align="center"><div id="nav"> <a  href="../templates/record.php">Save My Event</a>   <a  href="../templates/search.php">Search Event</a> </div></td>
            </tr>
        	</table></td>
        	<td width="74%" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td bgcolor="#ECE9D8" class="tit">TODAY's EVENTS </td>
            </tr>
            <tr>
              <td><table width="100%" border="1" align="center" cellpadding="2" cellspacing="2" bordercolor="#c1c8d2" style="border-collapse: collapse">
                  <tr><td><?php 
				  				include("EventShow.php");
								$obj = new EventShow();
								echo $obj->EventList();
								
								?></td></tr>
                  </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="btm" colspan="2"><a href="http://www.ajsquare.com">Ajsquare Inc </a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>