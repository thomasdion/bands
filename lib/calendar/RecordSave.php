<?php
session_start();
include("sqlconnect.php");

class RecordSave extends sqlconnect
	{
		  function InsertRecord()
			{
 
			/* All variables */	
			
				 $title = $_POST['etitle'];
				 $syear = $_POST['syear']; 
				 $smonth = $_POST['smonth'];
				 $sday = $_POST['sday'];
				 $eyear = $_POST['eyear'];	  		
				 $emonth = $_POST['emonth'];
				 $eday = $_POST['eday'];
				 $edesc = $_POST['edesc'];
				 $exceptDate[] = $_POST['exceptDate'];
				 //print_r($exceptDate);
				 $num = count($exceptDate[0]);
				 $shour = $_POST['shour'];
				 $sminute = $_POST['sminute'];
				 $ssecond = $_POST['ssecond'];
				 $ehour = $_POST['ehour'];
				 $eminute = $_POST['eminute'];
				 $esecond = $_POST['esecond'];
				 $eprice = $_POST['evtPrice'];
				 $eplace = $_POST['evtPlace']; 
				 $eurl = $_POST['evtUrl'];
				 $stime = $shour.':'.$sminute.':'.$ssecond;
				 $etime = $ehour.':'.$eminute.':'.$esecond; 
				 $phone = $_POST['phone1'].'-'.$_POST['phone2'].'-'.$_POST['phone3'];
				 $person = $_POST['evtPerson'];
				 $ph1 = $_POST['phone1'];
				 $ph2 = $_POST['phone2'];
				 $ph3 = $_POST['phone3'];
				 
						 
			/*This $beginDate and $endDate used to store the date */ 
				
				$beginDate = $syear.'-'.$smonth.'-'.$sday;
				$endDate = $eyear.'-'.$emonth.'-'.$eday;

			/* Server side Validation */
			
			
			if(strlen(trim($_POST['etitle'])) == 0)
				{
					$_SESSION['evt_title'] = "<font color='red'>Please
 Give Your Title</font>";
				}
			if(ctype_digit($_POST['etitle']))
				{
					$_SESSION['evt_title'] = "<font color='red'>Dont put numbers</font>";
				}
			
			if( ($_POST['syear'] <> $_POST['eyear'])  || ($_POST['smonth'] <> $_POST['emonth']))
				{
					$_SESSION['evt_year'] = "<font color='red'>Events are Limited Days only</font>";
				}
			
			
			
			if($_POST['syear'] > $_POST['eyear'])
				{
					$_SESSION['evt_year'] = "<font color='red'>Please Check your year</font>";
				}
			
			
			if($_POST['syear'] == "Year" || $_POST['smonth'] == "Month" || $_POST['sday'] == "Day")
				{
					$_SESSION['evt_sdate'] = "<font color='red'>Please Give Start Date</font>";
				}
			
			
			if($_POST['eyear'] == "Year" || $_POST['emonth'] == "Month" || $_POST['eday'] == "Day")
				{
					$_SESSION['evt_year'] = "<font color='red'>Please Give End Date</font>";
				}
			
			if($_POST['shour'] == "HH" || $_POST['sminute'] == "MM" || $_POST['ssecond'] == "DD")
				{
					$_SESSION['evt_stime'] = "<font color='red'>Please Give Start Time</font>";
				}
			
			
			if($_POST['ehour'] == "HH" || $_POST['eminute'] == "MM" || $_POST['esecond'] == "DD")
				{
					$_SESSION['evt_etime'] = "<font color='red'>Please Give End Time</font>";
				}
			
			if(strlen(trim($_POST['edesc'])) == 0)
				{
					$_SESSION['evt_desc'] = "<br><font color='red'>Please Give Your Description</font>";
				}
			if(ctype_alpha($_POST['evtPrice']))
				{
					$_SESSION['evt_price'] =  "<br><font color='red'>Please USe only Digits</font>";
				}
			
			if(strlen(trim($_POST['evtPrice'])) == 0)
				{
					$_SESSION['evt_price'] =  "<br><font color='red'>Please
 Fill Ur Ticket Price</font>";
				}
			
			if(ctype_digit($_GET['evtPlace']))
				{
					$_SESSION['evt_place'] =  "<br><font color='red'>Place name use letters</font>";
				}
			if(strlen(trim($_POST['evtPlace'])) == 0)
				{
					$_SESSION['evt_place'] =  "<br><font color='red'>Please Fill Your Event Place</font>";
				}
			if(strlen(trim($_POST['evtUrl'])) == 0)
				{
					$_SESSION['evt_url'] =  "<br><font color='red'>Please Fill Your Event Url</font>";
				}
			function isValidURL($url)
			{
			 return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
			}  
		
		
			if(!isValidURL($_POST['evtUrl']))
			{
				$_SESSION['evt_url'] =  "<br><font color='red'>Please Fill Your Correct Url</font>";
			}
			 $phone = $_POST['phone1'].'-'.$_POST['phone2'].'-'.$_POST['phone3'];
			 
			 if( (strlen(trim($_POST['phone1'])) == 0) || (strlen(trim($_POST['phone2'])) == 0) ||(strlen(trim($_POST['phone3'])) == 0) )
			 {
				$_SESSION['evt_phone'] =  "<br><font color='red'>Please Give your Contact Number</font>";
			}
			
			$phone = $_POST['phone1'].'-'.$_POST['phone2'].'-'.$_POST['phone3'];
			if(ereg("^[0-9]{3}-[0-9]{3}-[0-9]{4}$", $phone) == false)
				{
					$_SESSION['evt_phone'] =  "<br><font color='red'>Please Give your Correct Number</font>";
				}
			if(strlen(trim($_POST['evtPerson'])) == 0)
				{
					$_SESSION['evt_person'] = "<br><font color='red'>Please Give your Contact Name</font>";
				}
			if(ctype_digit($_POST['evtPerson']))
				{
					$_SESSION['evt_person'] = "<br><font color='red'>Dont use Numbers</font>";
				}
				
			if($_POST['syear'] <> "Year" and $_POST['smonth'] <> "Month" and $_POST['sday'] <> "Day" 
						and $_POST['eyear'] <> "Year" and $_POST['emonth'] <> "Month" and $_POST['eday'] <> "Day")
				{
					if(checkdate($_POST['smonth'],$_POST['sday'], $_POST['syear']) == 0)
						{
							$_SESSION['evt_sdate'] = "<font color='red'>Please Check Your Start Date</font>";
						}
					
					
					if(checkdate($_POST['emonth'],$_POST['eday'], $_POST['eyear']) == 0)
						{
							$_SESSION['evt_year'] = "<font color='red'>Please Check Your End Date</font>";
						}
			
				}	
			
			/**
			*This is used to check all the entries whether correct or not in the event record.... 
			*/
			
			if(isset($_SESSION['evt_year']) || isset($_SESSION['evt_title']) || isset($_SESSION['evt_sdate']) || isset($_SESSION['evt_place']) || 
			isset($_SESSION['evt_url']) || isset($_SESSION['evt_stime']) || isset($_SESSION['evt_etime']) || isset($_SESSION['evt_price']) || 
			isset($_SESSION['evt_phone']) || isset($_SESSION['evt_person']) || isset($_SESSION['evt_desc']))
				{
					header("Location:../templates/record.php?title=$title&price=$eprice&place=$eplace&url=$eurl&person=$person&ph1=$ph1&ph2=$ph2&ph3=$ph3");
				}
			else
				{
 
				
				
					$a=explode("-", $beginDate);
					$b=explode("-", $endDate);
					
					$start_date=gregoriantojd($a[1], $a[2], $a[0]);
					$end_date=gregoriantojd($b[1], $b[2], $b[0]);
					$diff = $end_date - $start_date;
					
					$startDate = date("Y-m-d-D", mktime(0, 0, 0, $a[1], $a[2], $a[0]));
					$endDate = date("Y-m-d-D", mktime(0, 0, 0, $a[1],$a[2]+$diff,$a[0]));
					
					
					/**
					*This part is uesd to calculate the exception days without the event days
					*$temp[] contains the remaining days
					*$exceptDate[0] contains all the exception days from the user..
					*/
					
					
					if($num <> 0)
					{
						for($i=0;$i<$num;$i++)
						{
							$temp1[] = $exceptDate[0][$i];
						}
						for($j=0;$j<=$diff;$j++)
						{
							$temp2[] = date("Y-m-d", mktime(0, 0, 0,$a[1], $a[2]+$j, $a[0]));
						}
						
						$temp3 = array_diff($temp2,$temp1);
				
						foreach($temp3 as $temp4)
							{
								$temp[] = $temp4;
							}
						
						//print_r($temp);
						
						for($i=0;$i<count($temp);$i++)
							{
						$this->connection();
						
						$sql = "INSERT INTO eventcalender (`evt_id` ,`evt_title` ,`evt_date`,`evt_stime`, `evt_etime`, `evt_ticket` 
						,`evt_person`,`evt_phone`,`evt_place`, 	`evt_contact`,`evt_desc`)VALUES 
						('', '$title', '$temp[$i]', '$stime','$etime','$eprice','$person','$phone','$eplace','$eurl','$edesc');";
						
						$query = $this->ExecuteInsert($sql);
							
							}
					}
					else
					{
						for($j=0;$j<=$diff;$j++)
						{
							$temp[] = date("Y-m-d", mktime(0, 0, 0,$a[1], $a[2]+$j, $a[0]));
						}
						for($i=0;$i<count($temp);$i++)
							{
						$this->connection();
						
						$sql = "INSERT INTO eventcalender (`evt_id` ,`evt_title` ,`evt_date`,`evt_stime`, `evt_etime`, `evt_ticket` 
						,`evt_person`,`evt_phone`,`evt_place`, 	`evt_contact`,`evt_desc`)VALUES 
						('', '$title', '$temp[$i]', '$stime','$etime','$eprice','$person','$phone','$eplace','$eurl','$edesc');";
						
						$query = $this->ExecuteInsert($sql);
							
							}
						
					}
				
				if($query)
					{
							
						$_SESSION['info'] = "<font color='blue'><i><h2>Your Event is recorded Successfully</h2></i></font>";
						header("Location:../index.php");
						
					}
				}
		}
	}
$objSave = new RecordSave();
$objSave->InsertRecord();
?>