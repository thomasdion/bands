<?php
class ExceptionDateShow
{
	function DateShow()
	{
		 $byear = $_GET['byear'];
		 $bmonth = $_GET['bmonth'];
		 $bday = $_GET['bday'];
		 $lyear = $_GET['lyear'];
		 $lmonth = $_GET['lmonth'];
		 $lday = $_GET['lday'];
		 
		 $beginDate = $byear.'-'.$bmonth.'-'.$bday;
		 $endDate = $lyear.'-'.$lmonth.'-'.$lday;
		 
		$a=explode("-", $beginDate);
		$b=explode("-", $endDate);
		
		$start_date=gregoriantojd($a[1], $a[2], $a[0]);
		$end_date=gregoriantojd($b[1], $b[2], $b[0]);
		$diff = $end_date - $start_date;
		
		$output = "<select name='exceptDate[]' multiple='multiple' size='10'>";
		for($i=0;$i<=$diff;$i++)
			{
				$output.="<option>".date("Y-m-d", mktime(0, 0, 0,$a[1], $a[2]+$i, $a[0]))."</option>";
			}
		$output.= "</select>";
		
		return $output;
			
	}
}
$obj = new ExceptionDateShow();
echo $obj->DateShow();
?>