<?php
class DateChange
{
	  function ChangeShow()
	{
		if($_GET['month'] <> "Month" and $_GET['year'] <> "Year")
		{
			$month = $_GET['month'];
			$year = $_GET['year'];
			
			$date = mktime(12, 0, 0, $month, 1, $year);
			$daysInMonth = date("t", $date);
			
			$offset = date("w", $date);
			$rows = 1;
			$output = "<h1>".date("F Y", $date)."</h1>\n";
			$output.="<table border='0' cellspacing='5' cellpadding='5'>\n";
			$output.="\t<tr class = 'tit' ><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";
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
				elseif($day == $sun[0] || $day == $sun[1] || $day == $sun[2] || $day == $sun[3] || $day == $sun[4])
					{
				$output.="<td bgcolor='#669900'>";	
					}
				else
					{
				$output.="<td>";
					}
				$output.="<strong><a href='EventRecordShow.php?rday=$day&rmonth=$month&ryear=$year'>" . $day . "</a></strong></td>";
			}
			while( ($day + $offset) <= $rows * 7)
			{
				$output.="<td></td>";
				$day++;
			}
			$output.="</tr>\n";
			$output.="</table>\n";
		}
		else
		{
			$output = "Select your month and year";
		}
		return $output;
	}
}
$objChange = new DateChange();
echo $objChange->ChangeShow();
?>