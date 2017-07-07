<?php
session_start();
class CalenderShowc
{ 
function showCalender()
	{
				$mon = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
				$output="<table><tr class = 'tit'><td><select name='month' onChange='dateShow()' id='month'>";
															for($i = 1;$i<=12;$i++)
															{
															$output.="<option value='$i'>".$mon[$i-1]."</option>";
															}
       							$output.="</select></td><td> <select name='year'  onChange='dateShow()' id='year'>";
															for($i = date("Y");$i<=date("Y")+30;$i++)
															{
															$output.="<option value='$i'>".$i."</option>";
															}
				$output.="</select></td></tr></table><table border='0'><tr><td id='dateShow1'>";
			
					
					$month = date("n");
					$year = date("Y");
					
					$date = mktime(12, 0, 0, $month, 1, $year);
					$daysInMonth = date("t", $date);
					
					$offset = date("w", $date);
					$rows = 1;
					$output.="<h2>Activities ".date("F Y", $date)."</h2>\n";
					$output.="<table>\n";
					$output.="\t<tr class= 'tit'><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri
					</th><th>Sat</th></tr>";		
					$output.="\n\t<tr bgcolor='#F5F5F5'>";
					for($i = 1; $i <= $offset; $i++)
					{
						$output.="<td></td>";
					}
					
					
					for($i=0;$i<=$daysInMonth;$i++)
									{
										if(substr($temp[] = date("Y-m-d-D", mktime(0, 0, 0,$month, $i, $year)),-3) == "Sun")
											{
												 $sun[] = substr(date("Y-m-d-D", mktime(0, 0, 0,$month, $i, $year)),8,-4);
														
											}
									}
					
								
					for($day = 1; $day <= $daysInMonth; $day++)
					{
						if( ($day + $offset - 1) % 7 == 0 && $day != 1)
						{
							$output.="</tr>\n\t<tr bgcolor='#F5F5F5'>";
							$rows++;
						}
				
								
					if($day == date("j"))
						{
					$output.="<td bgcolor='#cccccc'>";
						}
					elseif($day == $sun[0] || $day == $sun[1] || $day == $sun[2] || $day == $sun[3])
						{
					$output.="<td bgcolor='#669900'>";	
						}
					else
						{
					$output.="<td>";
						}$eventDate = $year.'/'.$month.'/'.$day;
					$output.="<strong><a href=".ROOT_URL."searchResultPage.php?sdate=$eventDate'>" . $day . "</a></strong></td>";
												
												
					}
					while( ($day + $offset) <= $rows * 7)
					{
						$output.="<td></td>";
						$day++;
					}
					$output.="</tr>\n</table>\n</td></tr></table>";
				
					return $output;
			  }
}
?>