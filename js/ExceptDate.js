// JavaScript Document
var edate;
function exceptionDateShow()
	{
						   
			   var syear = document.getElementById("syear").value;
			   var smonth = document.getElementById("smonth").value;
			   var sday = document.getElementById("sday").value;
			   var eyear = document.getElementById("eyear").value;
			   var emonth = document.getElementById("emonth").value;
			   var eday = document.getElementById("eday").value;
			   
			   if(syear!="Year" && smonth!="Month" && sday!="Day" && eyear!="Year" && emonth!="Month" && eday!="Day")
			   	{
			   var url = "../classes/ExceptionDateShow.php";
			   
			   mkax();
				
				edate.onreadystatechange=function(){   
													if(edate.readyState == 4 )
														{    
													document.getElementById("exDate").innerHTML=edate.responseText;
														}
												 
												 }
												 //str="name";
												 //+"?month="+mon+"&year="+yr
												 
											edate.open("GET",url+"?byear="+syear+"&bmonth="+smonth+"&bday="+sday+"&lyear="+eyear+"&lmonth="+emonth+"&lday="+eday,true);	 
												edate.setRequestHeader("content_type","application/x_www_form_urlencoded");
												edate.send(null);
									
			   }
			   else
			   {
				   alert("Plz Select your Date Options");
			   }
				
				}
			
		
												 
			 function mkax()
							{
								try
								  {
								  // Firefox, Opera 8.0+, Safari
								  edate=new XMLHttpRequest();
								  }
								catch (e)
								  {
								  // Internet Explorer
								  try
									{
									edate=new ActiveXObject("Msxml2.XMLHTTP");
									}
								  catch (e)
									{
									try
									  {
									  edate=new ActiveXObject("Microsoft.XMLHTTP");
									  }
									catch (e)
									  {
									  alert("Your browser does not support AJAX!");
									  return false;
									  }
									}
								  }
							 }										 
