<?php 
require_once("config/config.php");
$objCommon 		= new Common;
$objMenu 		= new Menu;
$objNews 		= new News;
$objContent 	= new Content;
$objTemplate 	= new Template;
$objMail 		= new Mail;
$objCustomer 	= new Customer;
$objCart 	= new Cart;
$objAdminUser 	= new AdminUser;
$objProduct 	= new Product;
$objValidate 	= new Validate;
$objOrder 		= new Order;
$objLog 		= new Log;
require_once('rs_lang.admin.php');
require_once('rs_lang.website.php');
?><?php 

if($objAdminUser->is_login== false){
	header("location: index.php");
}

$projectid = $_REQUEST['projectid'];
$msgFlag=false;
$graphflag=false;
$data=NULL;
$subactivityflag2=0;
if($projectid == 0 || $projectid =='') {
	$projectflag=0;
} else {
	$projectflag=1;
}
 $componentid = $_REQUEST['componentid'];
if($componentid == 0 || $componentid =='') {
	$componentflag=0;
} else {
	$componentflag=1;
}
$activitytypeid = $_REQUEST['activitytypeid'];
if($activitytypeid == 0 || $activitytypeid =='') {
	$activitytypeflag=0;
} else {
	$activitytypeflag=1;
}
$subcomponentid = $_REQUEST['subcomponentid'];
if($subcomponentid == 0 || $subcomponentid =='') {
	$subcomponentflag=0;
} else {
	$subcomponentflag=1;
}
 $activityid = $_REQUEST['activityid'];
if($activityid == 0 || $activityid =='') {
	$activityflag=0;
} else {
	$activityflag=1;
}

 $behavid = $_REQUEST['behavid'];
if($behavid == 0 || $behavid =='') {
	$behavflag=0;
} else {
	$behavflag=1;
}
if($componentid!="" && $subcomponentid!="" && $activityid!="")
{
	$SQLbf = "Select * from p2003village where dcode = ".$componentid." and tcode=".$subcomponentid." and code=".$activityid;
	$reportresultbf= mysql_query($SQLbf);
	$reportdatabf = mysql_fetch_array($reportresultbf);
	$latbf = $reportdatabf['y'];  
   $lngbf = $reportdatabf['x'];   
   
}
?>
<?php 
function dateDiff($start, $end) 
{   
$start_ts = strtotime($start);  
$end_ts = strtotime($end);  
$diff = $end_ts - $start_ts;  
return round($diff / 86400); 
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
    <!-- This page is copyright Elated Communications Ltd. (www.elated.com) -->

    <title>SMEC Water Information System</title>

    <link href="css/CssAdminStyle.css" rel="stylesheet" type="text/css" />
<link href="css/CssLogin2.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css_map/index.css"/>
<link rel="stylesheet" type="text/css" href="css_map/map.css"/>

<script language="javascript" type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
		return xmlhttp;
    }
	function getManagementReport(activitytypeid, subcomponentid,componentid)
	{
	if (activitytypeid!=0) {
		var strURL="findManagementReports.php?activitytype="+activitytypeid+"&subcomponent="+subcomponentid+"&componentid="+componentid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('result4').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}
	}
	
	function getEditProgress(subactivityid,activityid,activitytypeid,subcomponentid,componentid,projectid)
	{
	
	if (subactivityid!=0) {
		
		var strURL="findEditProgress.php?subactivityid="+subactivityid+"&activityid="+activityid+"&activitytypeid="+activitytypeid+"&subcomponentid="+subcomponentid+"&componentid="+componentid+"&projectid="+projectid;
		
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('result5').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}
	}
	
	function getDetailProgressReport(projectid,componentid)
	{
	if (componentid!=0) {
		var strURL="findDetailProgressReports.php?projectid="+projectid+"&componentid="+componentid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('result3').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}
	}
	
	function getProjectReport(projectid,componentid)
	{
	if (projectid!=0) {
		var strURL="findProjectReports.php?projectid="+projectid+"&componentid="+componentid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('result2').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP 1:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}
	}
	
	function getProgressReport(projectid,componentid)
	{
	if (componentid!=0) {
		var strURL="findProgressReports.php?projectid="+projectid+"&componentid="+componentid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('result3').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}
	}

	function getExceedActivity(activitytypeid, subcomponentid,activityid)
	{
	
	if (activitytypeid!=0) {
		var strURL="findExceedActivity.php?activitytypeid="+activitytypeid+"&subcomponentid="+subcomponentid+"&activityid="+activityid;
		

			var req = getXMLHTTP();			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {	
										
							document.getElementById('result9').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
		
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}}
		function getIPCActivity(activitytypeid, subcomponentid,activityid,componentid)
	{
	
	if (activitytypeid!=0) {
		var strURL="findIPCActivities.php?activitytypeid="+activitytypeid+"&subcomponentid="+subcomponentid+"&activityid="+activityid+"&componentid="+componentid;
		
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {	
										
							document.getElementById('result9').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
		
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}}
		function getIPCSubcomponent(activitytypeid, subcomponentid,componentid)
	{
	
	if (activitytypeid!=0) {
		var strURL="findIPCSubcomponent.php?activitytypeid="+activitytypeid+"&subcomponentid="+subcomponentid+"&componentid="+componentid;
		
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {	
										
							document.getElementById('result10').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP 3:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
		
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}}
	function getExceedSubComponent(activitytypeid,subcomponentid)
	{
	if (subcomponentid!=0) {
		var strURL="findExceedSubComponent.php?activitytypeid="+activitytypeid+"&subcomponentid="+subcomponentid;
		
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {	
										
							document.getElementById('result10').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
		    document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}}
	function getExceedComponent(projectid,componentid)
	{
	if (componentid!=0) {
		var strURL="findExComponent.php?projectid="+projectid+"&componentid="+componentid;
		
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('result3').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}
		}
	function getcomponent(projectid) {
			
		if (projectid!=0) {
			var strURL="findcomponent.php?project="+projectid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('componentdiv').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP COM:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} else {
			document.getElementById('componentid').value = 0;
			document.getElementById('componentid').disabled = true;
			document.getElementById('activitytypeid').value = 0;
			document.getElementById('activitytypeid').disabled = true;
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;	
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;	
		}
		   document.getElementById('componentid').value = 0;
			document.getElementById('componentid').disabled = true;
			document.getElementById('activitytypeid').value = 0;
			document.getElementById('activitytypeid').disabled = true;
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;	
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;	
	}

	function getactivitytype(componentid) {		
		if (componentid!=0) {
			var strURL="findactivitytype.php?component="+componentid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('activitytypediv').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:4\n " + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} else {
			document.getElementById('activitytypeid').value = 0;
			document.getElementById('activitytypeid').disabled = true;
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}
		    document.getElementById('activitytypeid').value = 0;
			document.getElementById('activitytypeid').disabled = true;
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
	}
	
	function getsubcomponent(componentid) {
		
		if (componentid!=0) {
		var strURL="findsubcomponent.php?component="+componentid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('subcomponentdiv').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP: 5\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		else {
		    
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}
		    document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
		    document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;	
	}
	
	function getactivity(subcomponentid) {	
	
		if (subcomponentid!=0) {
			var strURL="findactivity.php?subcomponent="+subcomponentid;
			
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('activitydiv').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:6\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} else {
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}
		document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;	
	}
	
	function getactivitytech(subcomponentid) {	
	
		if (subcomponentid!=0) {
			var strURL="findactivitytechnical.php?subcomponent="+subcomponentid;
			
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('activitydiv').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:6\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} else {
			document.getElementById('activityidt').value = 0;
			document.getElementById('activityidt').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;		
		}
		document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;	
	}
	
	
	function getsubactivity(activityid) {
	
		if (activityid!=0) {
			var strURL="findsubactivity.php?activity="+activityid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('subactivitydiv').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} else {
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;				
		}
	}
	
	
function getbehav(behavid) {
		if (behavid!=0) {
			var strURL="findbehav.php?behav="+behavid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('behavdiv').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
	}
	function GetProgressQuantity(bid,activityid) 
	{
			
		if (bid!=0) {
			var strURL="findProgressQuantity.php?bid="+bid+"&activityid="+activityid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('ProgressQunatity').innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
		} 
		   
	}
	function frmValidate(frm){
	var flag = true;
	
	if(frm.bid.value == 0){
		msg = "Progress month is required";
		flag = false;
	}
	if(flag == false){
		alert(msg);
		return false;
	}
	}
	function frmValidate1(frm){
	var flag = true;
	var msg="";
	if(frm.projectid.value == "0"){
				msg = msg + "\r\n<?php echo "Please Select the Project";?>";
				
				flag = false;
			}
	if(flag == false){
				alert(msg);
				return false;
			}
	}
	
	function doToggle(ele){ 

	var obj = document.getElementById(ele);
	
	if(obj){
		if(obj.style.display == ""){
			obj.style.display = "none";
		}
		else{
			obj.style.display = "";
		}
	}
}

function doToggle1(ele){ 
	
	if (ele=="fun_1")
	{
	document.getElementById("fun_1").style.display = 'block';
	document.getElementById("nfun_1").style.display = 'none';
	document.getElementById("aban_1").style.display = 'none';
	
	}
	else if (ele=="nfun_1")
	{
	document.getElementById("fun_1").style.display = 'none';
	document.getElementById("nfun_1").style.display = 'block';
	document.getElementById("aban_1").style.display = 'none';
	}
	else if (ele=="aban_1")
	{
	document.getElementById("fun_1").style.display = 'none';
	document.getElementById("nfun_1").style.display = 'none';
	document.getElementById("aban_1").style.display = 'block';
	}
}
	
</script>
<style type="text/css">
 body { font: normal 10pt Helvetica, Arial; }
 #map { width: 630px; height: 450px; border: 0px; padding: 0px;  }
 </style>
<?php /*?> <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script><?php */?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWFe6ijGINThkuKWZlI_UI-qxu88RxGQU"></script>
<?php /*?><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script><?php */?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<?php /*?> <script src="highcharts/js/highcharts.js"></script>
<script src="highcharts/js/modules/exporting.js"></script><?php */?>




<style type="text/css">
      body { font-size: 80%; font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif; }
      ul#tabs { list-style-type: none; margin: 30px 0 0 0; padding: 0 0 0.3em 0; }
      ul#tabs li { display: inline; }
      ul#tabs li a { color: #fff; background-color: #003399; border: 1px solid #c9c3ba; border-bottom: none; padding: 0.5em; text-decoration: none; }
      ul#tabs li a:hover { background-color: #8B8B8B;  color:white;}
      ul#tabs li a.selected { color: #fff; background-color: #003399; font-weight: bold; padding: 0.7em 0.3em 0.38em 0.3em; }
      div.tabContent { border: 1px solid #c9c3ba; padding: 0.5em; background-color: #f1f0ee; }
      div.tabContent.hide { display: none; }
	  
	  ul#gmaps { list-style-type: none;  padding: 0 0 0.3em 0; margin-left:110px; margin-bottom:5px; margin-top:30px; }
      ul#gmaps li { display: inline; }
     ul#gmaps li a { color: #fff; background-color: #003399; border: 1px solid #c9c3ba; border-bottom: none; padding: 0.5em; text-decoration: none; }
      ul#gmaps li a:hover {  background-color: #8B8B8B;  color:white; }
     ul#gmaps li a.selected { color: #fff; background-color: #003399; font-weight: bold; padding: 0.7em 0.3em 0.38em 0.3em; }
	  div.tabContent { border: 1px solid #c9c3ba; padding: 0.5em; background-color: #f1f0ee; }
      div.tabContent.hide { display: none; }
    </style>

    <script type="text/javascript">
    //<![CDATA[

    var tabLinks = new Array();
    var contentDivs = new Array();

    function init() {

      // Grab the tab links and content divs from the page
      var tabListItems = document.getElementById('tabs').childNodes;
      for ( var i = 0; i < tabListItems.length; i++ ) {
        if ( tabListItems[i].nodeName == "LI" ) {
          var tabLink = getFirstChildWithTagName( tabListItems[i], 'A' );
          var id = getHash( tabLink.getAttribute('href') );
          tabLinks[id] = tabLink;
          contentDivs[id] = document.getElementById( id );
        }
      }

      // Assign onclick events to the tab links, and
      // highlight the first tab
      var i = 0;

      for ( var id in tabLinks ) {
        tabLinks[id].onclick = showTab;
        tabLinks[id].onfocus = function() { this.blur() };
        if ( i == 0 ) tabLinks[id].className = 'selected';
        i++;
      }

      // Hide all content divs except the first
      var i = 0;

      for ( var id in contentDivs ) {
        if ( i != 0 ) contentDivs[id].className = 'tabContent hide';
        i++;
      }
    }

    function showTab() {
      var selectedId = getHash( this.getAttribute('href') );
	  

      // Highlight the selected tab, and dim all others.
      // Also show the selected content div, and hide all others.
      for ( var id in contentDivs ) {
        if ( id == selectedId ) {
          tabLinks[id].className = 'selected';
          contentDivs[id].className = 'tabContent';
        } else {
          tabLinks[id].className = '';
          contentDivs[id].className = 'tabContent hide';
        }
      }

      // Stop the browser following the link
      return false;
    }

    function getFirstChildWithTagName( element, tagName ) {
      for ( var i = 0; i < element.childNodes.length; i++ ) {
        if ( element.childNodes[i].nodeName == tagName ) return element.childNodes[i];
      }
    }

    function getHash( url ) {
	
      var hashPos = url.lastIndexOf ( '#' );
	  
	  
      return url.substring( hashPos + 1 );
    }

    //]]>
    </script>
	<style type="text/css">
select option.red {
color: #76031B;

}
select option.green {
color:#006C00;

}
select option.blue {
color:#000055;

}
#mainTable table tr td a:hover
		{
		font-weight:bold;
		font-size:14px;
		
		
		}
</style>

  </head>
  <body onload="init();">
  
<div style="width:100%; height:110px; background-color:#06f; text-align:center">

<a href="./index.php"><img src="images/home2.png"    title="Home" width="120" height="100" align="left" style="border-color:#ccc; border-radius:1px" /></a><img src="images/water-bgtop.png"  /><a href="./qrdash-home.php" ><img src="images/dboard.png"    width="117" height="100" align="right" style="border-color:#ccc; border-radius:1px"  title="Main Dashboard"/></a></div>
<table cellpadding="0px" cellspacing="0px" align="center" width="100%" style="border: solid 1px #ccc;" > 
<tr> 
<td width="165" align="left" valign="top" style="border-right: solid 1px #ccc;">
<div id="wrapper_MemberLogin" style="margin-bottom:0px; height:270px;">
  <h1 style="color:#000;"><?php echo "Progress Monitoring Dashboard";?> </h1>
  <div class="clear"></div>
  <div id="LoginBox" class="borderRound borderShadow" >
    <form action="qrdash-home.php" method="post" name="boqlevel" id="boqlevel" onsubmit="return frmValidate1(this);">
      <table border="0px" cellpadding="0px" cellspacing="0px" align="center"  >
        <tr>
          <td ><label>Project</label></td>
          <td>
		  <div id="projectdiv">
            <select name="projectid" id="projectid" onchange="getcomponent(this.value)" >
              <!--<option value="0">Seclect Package..</option>-->
              <?php
$pquery = "select * from p2000projectpkg";
$presult = mysql_query($pquery);
while ($pdata = mysql_fetch_array($presult)) {
?>
              <option value="<?php echo $pdata['name']; ?>"  selected="selected">
                <?php 
	echo $pdata['name']; ?>
                </option>
              <?php
}
?>
            </select>
          </div></td>
        </tr>
        <tr>
          <td ><label>Package</label></td>
          <td><div id="componentdiv">
                   <select name="componentid" id="componentid" onchange="getsubcomponent(this.value)">
              <option value="0">Select District..</option>
              <?php
$cquery = "select * from  p2001district order by did";

$cresult = mysql_query($cquery);
while ($cdata = mysql_fetch_array($cresult)) {
?>
              <option value="<?php echo $cdata['code']; ?>" <?php if ($componentid == $cdata['code']) {echo ' selected="selected"';} ?>><?php echo $cdata['code']." - ".$cdata['name']; ?></option>
              <?php
}
?>
            </select>
            <?php
//}
?>
          </div></td>
        </tr>
        <tr>
          <td ><label>District</label></td>
          <td><div id="subcomponentdiv">
            <?php
if ($subcomponentflag !=1 && $componentid == 0) {
?>
            <select name="subcomponentid" id="subcomponentid" disabled="disabled" >
              <option>Select Tehsil..</option>
            </select>
            <?php
} else {
?>
            <select name="subcomponentid" id="subcomponentid" onchange="getactivity(this.value)">
              <option value="0">Select Tehsil..</option>
              <?php
$tquery = "select * from  p2002tehsil where dcode = ".$componentid. " order by code";
$tresult = mysql_query($tquery);
while ($tdata = mysql_fetch_array($tresult)) {
?>
              <option value="<?php echo $tdata['code']; ?>" <?php if ($subcomponentid == $tdata['code']) {echo ' selected="selected"';} ?>><?php echo $tdata['code']." - ".$tdata['tehsil']; ?></option>
              <?php
}
?>
            </select>
            <?php
}
?>
          </div></td>
        </tr>
        <tr>
          <td ><label>Village</label></td>
          <td><div id="activitydiv">
            <?php
if ($activityflag !=1 && $subcomponentid == 0) {
?>
            <select name="activityid" id="activityid" disabled="disabled" >
              <option>Select Village..</option>
            </select>
            <?php
} else {
?>
            <select name="activityid" id="activityid" onchange="getsubactivity(this.value)">
              <option value="0">Select Village..</option>
              <?php
			  
			  

$aquery = "SELECT b.village as village,b.code as code,b.tcode as tcode from p2004vp a inner join p2003village b on (a.giscode=b.giscode) where b.tcode=".$subcomponentid."
UNION 
SELECT b.village as village,b.code as code,b.tcode as tcode from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.tcode=".$subcomponentid;
$aresult = mysql_query($aquery);
while ($adata = mysql_fetch_array($aresult)) {

 echo $v_code=$adata['code'];
  $t_code=$adata['tcode'];

$aquery_s = "SELECT vcode,tcode from p2004vp where tcode=".$t_code." and vcode=".$v_code;
$aresult_s = mysql_query($aquery_s);
$rows_s=mysql_num_rows($aresult_s);
$adata_s = mysql_fetch_array($aresult_s);

$aquery_t = "SELECT vcode from p2005wss where tcode=".$t_code." and vcode=".$v_code;
$aresult_t = mysql_query($aquery_t);
$rows_t=mysql_num_rows($aresult_t);
if($rows_s==1 && $rows_t==1)
{
?>

<?php
$flag1=1;
$v_name= $adata['code']." - ".$adata['village'];

}
else if($rows_s==1 && $rows_t==0)
{
?>

<?php
$flag2=2;
$v_name= $adata['code']." - ".$adata['village'];

}
else if($rows_s==0 && $rows_t==1)
{
?>

<?php
$flag3=3;
$v_name= $adata['code']." - ".$adata['village'];

}
?>

              <option value="<?php echo $adata['code']?>"  <?php  if ($flag1==1)
	{
	?>
	class="red"
	<?php
	$flag1="";
	} 
	if ($flag2==2)
	{
	?>
	class="green"
	<?php
	$flag2="";
	} 
	if ($flag3==3)
	{
	?>
	class="blue"
	<?php
	$flag3="";
	} ?> <?php if ($activityid == $adata['code']) {echo ' selected="selected"';} ?>><?php echo $v_name; ?></option>
              <?php
}
?>
            </select>
            <?php
}
?>

          </div></td>
        </tr>
		
		<tr>
          <td ><label></label></td>
          <td>
		  <div id="behaviour">
                   <select name="behavid" id="behavid" onchange="getbehav(this.value)"  >
              <option value="1" selected="selected">Social</option>
			  <option value="3" <?php if($_REQUEST['behavid']==3){echo ' selected="selected"';} ?>>Technical</option>
			  <option value="2" <?php if($_REQUEST['behavid']==2){echo ' selected="selected"';} ?> >Water Quality Maps</option>
              
            </select>
           
          </div></td>
        </tr>
      
        <tr >
          <td style="padding-top:20px" align="right">
            <input type="submit" value="Generate Report"  id="uLogin2"/>
            </td>
          <td>   </td>
        </tr>
        <tr>
          <td colspan="2"></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<div style=" margin-left:21px; font-size:10px;"> <b>Note:</b><br />
Social=Green<br />
Technical=Blue<br />
social+technical=Red</div>

<?php
if($behavid ==3)
{
?>
<div id="wrapper_MemberLogin" style="margin-top:0px; height:220px;">
  <h3 style="color:#000;"><?php echo "Buffer Info";?> </h3>
  <div class="clear"></div>
<div id="LoginBox" class="borderRound borderShadow" >
<form>
		<table border="0px" cellpadding="0px" cellspacing="0px" align="center">
		
			<tr>
				<td><label>Buffer(meters)</label></td>
				<td style="padding-left:10px">
				<input type="text" id="mapdistance" value="5000"   /> </td>
			</tr>
			
			<!--<tr>
				<td>Center to marker:</td>
				<td><input type="checkbox" id="mapcenter" /></td>
			</tr>-->
			<tr>
				<td><label>Latitude</label></td>
				<td style="padding-left:10px"><input type="text" id="maplat" value="<?php if($latbf!="")
				{echo $latbf;
				}
				else
				{
				echo "";
				}?>"   /></td></tr>
				 
				<tr>
				<td ><label>Longitude</label></td>
				<td style="padding-left:10px"><input type="text" id="maplng" value=
					"<?php if($lngbf!="")
				{
				echo $lngbf;
				}
				else
				{
				echo "";
				}?>"
				  />
				</td>
			</tr>
			
			<tr>
				<td colspan="2" style="padding-top:10px; padding-bottom:10px;text-align:right; color:#0000A0; font-size:10px" >Click anywhere on the map / write lat,lng</td>
				
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" id="drawpoint" value="Draw Buffer" onclick="drawByLocation(); return false;"/> 
					<input type="submit" id="bufferof" value="Buffer Off" onclick="bufferoff(); return false;"/> 
				</td>
			</tr>
		</table>
	</form>	
	</div>
	</div>
	<div id="buffer_detail"></div>
	<?php
	}
	?>
</td>
<td valign="top" >


<?php //include("includes/functions.php")?>
<?php include("includes/social_default.php");?>
<?php include("includes/district_level.php"); ?>
<?php include("includes/tehsil_level.php"); ?>
<?php include("includes/village_level.php"); ?>

</td>
</tr>

</table>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
   <script src="highcharts/js/highcharts.js"></script>
  <script src="highcharts/js/modules/exporting.js"></script>
  <script src="highcharts/js/modules/jquery.highchartTable.js"></script>
  <script src="highcharts/js/highcharts-more.js"></script>


<div class="clear"></div>
	<?php include("includes/footer.php");?>
	<div class="clear"></div>
</body>
</html>