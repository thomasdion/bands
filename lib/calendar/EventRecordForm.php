<?php
class EventRecordForm
{
	function eventRecord()
	{
		$output="<table width='778' height='418' border='0' cellspacing='0' align='center'><tr>
        <td width='387' height='57'><strong>Title</strong></td>
        <td width='381'><input type='text' name='etitle' value='";
		if(isset($_SESSION['evt_year']) || isset($_SESSION['evt_title']) || isset($_SESSION['evt_sdate']) || isset($_SESSION['evt_place']) || 
		isset($_SESSION['evt_url']) || isset($_SESSION['evt_stime']) || isset($_SESSION['evt_etime']) || isset($_SESSION['evt_price']) || 
		isset($_SESSION['evt_phone']) || isset($_SESSION['evt_person']) || isset($_SESSION['evt_desc']))
		{
			$output.=$_GET['title']; 
		}
		else
		{
			$output.="";
		}
		
		$output.="'/></td><td width='150'>";
        if(isset($_SESSION['evt_title']))
		{
			$output.=$_SESSION['evt_title']; 
			unset($_SESSION['evt_title']);
		}
		$output.="</td></tr><tr><td height='50'><strong>Starting Date</strong></td>
				<td><select name='syear' id='syear'><option>Year</option>";
				for($i = date('Y');$i<=date('Y')+30;$i++)
					{
				$output.="<option value='$i'>".$i."</option>";
					}
				
				$mon = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Act","Nov","Dec");		
				
				$output.="</select>
				
				<select name='smonth' id='smonth'><option>Month</option>";
				for($i = 1;$i<=12;$i++)
					{
				if(strlen($i) == 1)
					{
				$output.="<option value='0$i'>".$mon[$i-1]."</option>";
					}
				else
					{
				$output.="<option value='$i'>".$mon[$i-1]."</option>";
					}
					}
				$output.="</select>
				
				<select name='sday' id='sday'><option>Day</option>";
				for($i = 01;$i<=31;$i++)
					{
				if(strlen($i) == 1)
					{
				$output.="<option value='0$i'>".'0'.$i."</option>";
					}
				else
					{
				$output.="<option value='$i'>".$i."</option>";
					}
					}
				$output.="</select></td><td>";
         if(isset($_SESSION['evt_sdate']))
			{
				$output.=$_SESSION['evt_sdate']; 
				unset($_SESSION['evt_sdate']);
			}
															
       $output.="</td></tr><tr height = '50'><td height='57'><strong>End Date</strong></td>
				<td><select name='eyear' id='eyear'><option>Year</option>";
				for($i = date('Y');$i<=date('Y')+30;$i++)	
					{
				$output.="<option value='$i'>".$i."</option>";
					}
				
				
				
				$output.="</select>
				
				<select name='emonth' id='emonth'><option>Month</option>";
				for($i = 1;$i<=12;$i++)
					{
				if(strlen($i) == 1)
					{
				$output.="<option value='0$i'>".$mon[$i-1]."</option>";
					}
				else
					{
				$output.="<option value='$i'>".$mon[$i-1]."</option>";
					}
					}
				$output.="</select>
			   
			   <select name='eday' id='eday' onChange='exceptionDateShow()'><option>Day</option>";
				for($i = 1;$i<=31;$i++)
					{
				if(strlen($i) == 1)
					{
				$output.="<option value='0$i'>".'0'.$i."</option>";
					}
				else
					{
				$output.="<option value='$i'>".$i."</option>";
					}
					}
				$output.="</select></td><td>"; 
                                                            
                                                          
         if(isset($_SESSION['evt_year']))
			{
				$output.=$_SESSION['evt_year']; 
				unset($_SESSION['evt_year']);
			}
			
      $output.="</td></tr><tr height = '50'><td><strong>Exception Days</strong></td><td id='exDate'></td></tr> 
     	<tr><td><strong>Start Time</strong></td><td><select name='shour' id='shour'><option>HH</option>";
		for($i =01;$i<=24;$i++)
			{
		if(strlen($i) == 1)
			{
		$output.="<option value='0$i'>".'0'.$i."</option>";
			}
		else
			{
		$output.="<option value='$i'>".$i."</option>";
			}
			}
		$output.="</select>
		
		<select name='sminute' id='sminute'><option>MM</option>";
		for($i = 00;$i<=59;$i++)
			{
		if(strlen($i) == 1)
			{
		$output.="<option value='0$i'>".'0'.$i."</option>";
			}
		else
			{
		$output.="<option value='$i'>".$i."</option>";
			}
			}
		$output.="</select>
	   
	   <select name='ssecond' id='ssecond'><option>SS</option>";
		for($i = 00;$i<=59;$i++)
			{
		if(strlen($i) == 1)
			{
		$output.="<option value='0$i'>".'0'.$i."</option>";
			}
		else
			{
		$output.="<option value='$i'>".$i."</option>";
			}
			}
		$output.="</select></td><td>";
		  if(isset($_SESSION['evt_stime']))
			{
				$output.=$_SESSION['evt_stime']; 
				unset($_SESSION['evt_stime']);
			}
		
		$output.="</td></tr>";
		
		$output.="<tr height = '80'><td><strong>End Time</strong></td><td><select name='ehour' id='ehour'><option>HH</option>";
		for($i =01;$i<=24;$i++)
			{
		if(strlen($i) == 1)
			{
		$output.="<option value='0$i'>".'0'.$i."</option>";
			}
		else
			{
		$output.="<option value='$i'>".$i."</option>";
			}
			}
		$output.="</select>
		
		<select name='eminute' id='eminute'><option>MM</option>";
		for($i = 00;$i<=59;$i++)
			{
		if(strlen($i) == 1)
			{
		$output.="<option value='0$i'>".'0'.$i."</option>";
			}
		else
			{
		$output.="<option value='$i'>".$i."</option>";
			}
			}
		$output.="</select>
	   
	   <select name='esecond' id='esecond'><option>SS</option>";
		for($i = 00;$i<=59;$i++)
			{
		if(strlen($i) == 1)
			{
		$output.="<option value='0$i'>".'0'.$i."</option>";
			}
		else
			{
		$output.="<option value='$i'>".$i."</option>";
			}
			}
		$output.="</select></td><td>";
		if(isset($_SESSION['evt_etime']))
			{
				$output.=$_SESSION['evt_etime']; 
				unset($_SESSION['evt_etime']);
			}
															$output.="</td></tr></tr>";
	  $output.="<tr height = '50'><td><strong>Ticket Price</strong></td><td><input type='text' name='evtPrice' size='5' value='";
	 if(isset($_SESSION['evt_year']) || isset($_SESSION['evt_title']) || isset($_SESSION['evt_sdate']) || isset($_SESSION['evt_place']) || 
				isset($_SESSION['evt_url']) || isset($_SESSION['evt_stime']) || isset($_SESSION['evt_etime']) || isset($_SESSION['evt_price']) || 
				isset($_SESSION['evt_phone']) || isset($_SESSION['evt_person']) || isset($_SESSION['evt_desc']))
		{
			$output.=$_GET['price']; 
		}
		else
		{
			$output.="";
		}
		
	  $output.="'/></td><td>";
	  if(isset($_SESSION['evt_price']))
		{
			$output.=$_SESSION['evt_price']; 
			unset($_SESSION['evt_price']);
		}
	  $output.="</td></tr><tr height = '50'><td><strong>Event Place</strong></td><td><input type='text' name='evtPlace' size='30' 	value='";
	  if(isset($_SESSION['evt_year']) || isset($_SESSION['evt_title']) || isset($_SESSION['evt_sdate']) || isset($_SESSION['evt_place']) || 
				isset($_SESSION['evt_url']) || isset($_SESSION['evt_stime']) || isset($_SESSION['evt_etime']) || isset($_SESSION['evt_price']) || 
				isset($_SESSION['evt_phone']) || isset($_SESSION['evt_person']) || isset($_SESSION['evt_desc']))
		{
			
			$output.=$_GET['place']; 
		}
		else
		{
			$output.="";
		}
		
	  $output.="'/></td><td>";
	  if(isset($_SESSION['evt_place']))
		{
			$output.=$_SESSION['evt_place']; 
			unset($_SESSION['evt_place']);
		}
	  $output.="</td></tr>
	  <tr height= '50'><td><strong>Contact Url</strong></td><td><input type='text' name='evtUrl' size='40' value='";
	  if(isset($_SESSION['evt_year']) || isset($_SESSION['evt_title']) || isset($_SESSION['evt_sdate']) || isset($_SESSION['evt_place']) || 
				isset($_SESSION['evt_url']) || isset($_SESSION['evt_stime']) || isset($_SESSION['evt_etime']) || isset($_SESSION['evt_price']) || 
				isset($_SESSION['evt_phone']) || isset($_SESSION['evt_person']) || isset($_SESSION['evt_desc']))
		{
			$output.=$_GET['url']; 
		}
		else
		{
			$output.="";
		}
		
	  $output.="'></td><td>";
	   if(isset($_SESSION['evt_url']))
		{
			$output.=$_SESSION['evt_url']; 
			unset($_SESSION['evt_url']);
		}
	  $output.="</td></tr><tr height='50'><td><strong>Contact Person</strong></td><td><input type='text' name='evtPerson' id='evtPerson' value='";
	  if(isset($_SESSION['evt_year']) || isset($_SESSION['evt_title']) || isset($_SESSION['evt_sdate']) || isset($_SESSION['evt_place']) || 
				isset($_SESSION['evt_url']) || isset($_SESSION['evt_stime']) || isset($_SESSION['evt_etime']) || isset($_SESSION['evt_price']) || 
				isset($_SESSION['evt_phone']) || isset($_SESSION['evt_person']) || isset($_SESSION['evt_desc']))
		{
			$output.=$_GET['person']; 
		}
		else
		{
			$output.="";
		}
	  $output.="'></td><td>";
	  if(isset($_SESSION['evt_person']))
		{
			$output.=$_SESSION['evt_person']; 
			unset($_SESSION['evt_person']);
		}
	  
	  $output.="</td></tr><tr height='50'><td><strong>Contact Number</strong></td><td><input type='text' name='phone1' id='phone1' size='3' maxlength='3' value='";
	  if(isset($_SESSION['evt_year']) || isset($_SESSION['evt_title']) || isset($_SESSION['evt_sdate']) || isset($_SESSION['evt_place']) || 
				isset($_SESSION['evt_url']) || isset($_SESSION['evt_stime']) || isset($_SESSION['evt_etime']) || isset($_SESSION['evt_price']) || 
				isset($_SESSION['evt_phone']) || isset($_SESSION['evt_person']) || isset($_SESSION['evt_desc']))
		{
			$output.=$_GET['ph1']; 
		}
		else
		{
			$output.="";
		}
	  $output.="'>-<input type='text' name='phone2' id='phone2' size='3' maxlength='3' value='";
	  if(isset($_SESSION['evt_year']) || isset($_SESSION['evt_title']) || isset($_SESSION['evt_sdate']) || isset($_SESSION['evt_place']) || 
				isset($_SESSION['evt_url']) || isset($_SESSION['evt_stime']) || isset($_SESSION['evt_etime']) || isset($_SESSION['evt_price']) || 
				isset($_SESSION['evt_phone']) || isset($_SESSION['evt_person']) || isset($_SESSION['evt_desc']))
		{
			$output.=$_GET['ph2']; 
		}
		else
		{
			$output.="";
		}
	  $output.="'>-<input type='text' name='phone3' id='phone3' size='4' maxlength='4' value='";
	 if(isset($_SESSION['evt_year']) || isset($_SESSION['evt_title']) || isset($_SESSION['evt_sdate']) || isset($_SESSION['evt_place']) || 
				isset($_SESSION['evt_url']) || isset($_SESSION['evt_stime']) || isset($_SESSION['evt_etime']) || isset($_SESSION['evt_price']) || 
				isset($_SESSION['evt_phone']) || isset($_SESSION['evt_person']) || isset($_SESSION['evt_desc']))
		{
			$output.=$_GET['ph3']; 
		}
		else
		{
			$output.="";
		}
	  $output.="'></td><td>";
	  if(isset($_SESSION['evt_phone']))
		{
			$output.=$_SESSION['evt_phone']; 
			unset($_SESSION['evt_phone']);
		}

	  $output.="</td></tr><tr>
        <td height='191'><strong>Event Description</strong></td>
        <td><textarea name='edesc' cols='40' rows='10'></textarea></td><td>";
        												
	if(isset($_SESSION['evt_desc']))
	{
		$output.=$_SESSION['evt_desc']; 
		unset($_SESSION['evt_desc']);
	}

      $output.="</tr><tr height='50'><td colspan = '3' align = 'center'><input type='submit' value='Record Ur Events'></td></tr></table>";
	return $output;
	}
}
?>