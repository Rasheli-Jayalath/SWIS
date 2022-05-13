<?php 

require_once("config/config.php");
/*require_once("requires/Database.php");
$obj= new Database();*/
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
include_once("includes/dbconnect.php");
//include_once("contigencyAmount.php");
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
$subactivityid = $_REQUEST['subactivityid'];
if($subactivityid == 0 || $subactivityid =='') {
	$subactivityflag=0;
} else {
	$subactivityflag=1;
}

if($_SERVER['REQUEST_METHOD']=="POST" &&isset($_POST['edit_subactivity']))
{
 $sa_id=$_POST["sa_id"];
 $aid=$_POST["aid"];
 $sid=$_POST["sid"];
 $s_id=$_POST["s_id"];
 $cid=$_POST["cid"];
 $pid=$_POST["pid"];
 $pqty=$_POST["pqty"];
 $bid=$_POST["bid"];
 $code=$_POST["code"];
 $detail=$_POST["detail"];
 $qty=$_POST["qty"];
 $rate=$_POST["rs"];
 $subactivityid=$sa_id;
 $activityid=$aid;
 $activitytypeid=$sid;
 $subcomponentid=$s_id;
 $componentid=$cid;
 $projectid=$pid;
 $subactivityflag=1;
$subactivityflag2=0;

$activitytypeflag=1;
$subcomponentflag=1;
$componentflag=1;
$projectflag=1;
$query_1='UPDATE subactivity SET code="'.$code.'", detail="'.$detail.'" , qty="'.$qty.'" , rs="'.$rate.'" where sa_id='.$sa_id;
$result_1 = mysql_query($query_1)or die(mysql_error());
//$res_data_1=mysql_fetch_array($result_1);

if($result_1)
{
 $msgFlag=true;
}
}
if($_SERVER['REQUEST_METHOD']=="POST" &&isset($_POST['add_subactivity']))
{
  $msgFlag=false;
$activityid_add=$_POST["activityid_add"];
$sid=$_POST["sid"];
$s_id=$_POST["s_id"];
$cid=$_POST["cid"];
$pid=$_POST["pid"];
$pqty=$_POST["pqty"];
$unit=$_POST["unit"];
$uom=$_POST["uom"];
$order=$_POST["order"];
$remark=$_POST["remark"];
$code=$_POST["code"];
$detail=$_POST["detail"];
$qty=$_POST["qty"];
$rate=$_POST["rs"];
$activityid=$aid;
$activitytypeid=$sid;
$subcomponentid=$s_id;
$componentid=$cid;
$projectid=$pid;
$subactivityid=0;
$subactivityflag=0;
$subactivityflag2=0;
$activityflag=0; 
$activitytypeflag=1;
$subcomponentflag=1;
$componentflag=1;
$projectflag=1;////

$query_1='INSERT INTO subactivity(aid,code,detail,qty,rs,unit,uom,remark)VALUES( '.$activityid_add.',"'.$code.'", "'.$detail.'" , "'.$qty.'" , "'.$rate.'" , "'.$unit.'", "'.$uom.'" , "'.$remark.'" '.' )';
$result_1 = mysql_query($query_1)or die(mysql_error());
//$res_data_1=mysql_fetch_array($result_1);

if($result_1)
{
 $msgFlag=true;
}
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue-01-Jan-1980-1:00:00-GMT" />
<meta http-equiv="pragma" content="no-cache" />
<title>Physical Progress Monitoring Dashboard</title>
<link href="css/CssAdminStyle.css" rel="stylesheet" type="text/css" />
<link href="css/CssLogin.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
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
		
		var strURL="findUpdateSubactivity.php?subactivityid="+subactivityid+"&activityid="+activityid+"&activitytypeid="+activitytypeid+"&subcomponentid="+subcomponentid+"&componentid="+componentid+"&projectid="+projectid;
		
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
/*	function getGeneralReport(activitytypeid, subcomponentid)
	{
	if (activitytypeid!=0) {
		var strURL="mosactlevel.php?activitytype="+activitytypeid+"&subcomponent="+subcomponentid;
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
	}*/
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
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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
	
	function getsubcomponent(activitytypeid, componentid) {	
		
		if (activitytypeid!=0) {
		var strURL="findsubcomponent.php?activitytype="+activitytypeid+"&component="+componentid;
			var req = getXMLHTTP();
			
			if (req) {
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('subcomponentdiv').innerHTML=req.responseText;						
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
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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
	function GetProgressQuantity(bid,subactivityid) 
	{
			
		if (bid!=0) {
			var strURL="findUpdateSubactivity.php?bid="+bid+"&subactivityid="+subactivityid;
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
	
	if(frm.detail.value == 0){
		msg = "Detail is required";
		flag = false;
	}
	if(frm.code.value == 0){
		msg = "Code is required";
		flag = false;
	}
	/*if(frm.qty.value == 0){
		msg = "Quantity is required";
		flag = false;
	}*/
	if(flag == false){
		alert(msg);
		return false;
	}
	}
</script>
<style type="text/css">
<!--
.style1 {color: #3C804D;
font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:18px;
	font-weight:bold;
	text-align:center;}
-->
</style>
<style type="text/css"> 
.imgA1 { position:absolute;  z-index: 3; } 
.imgB1 { position:relative;  z-index: 3;
float:right;
padding:10px 10px 0 0; } 
</style> 
<style type="text/css"> 
.msg_list {
	margin: 0px;
	padding: 0px;
	width: 100%;
}
.msg_head {
	padding: 5px 10px;
	cursor: pointer;
	position: relative;
	background-color:#FF0033;
	margin:1px;
}
.msg_body {
	padding: 5px 10px 15px;
	background-color:#F4F4F8;
}
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	//hide the all of the element with class msg_body
	$(".msg_body").hide();
	//toggle the componenet with class msg_body
	$(".msg_head").click(function(){
		$(this).next(".msg_body").slideToggle(600);
	});
});
</script>

</head>
<body>

<table border="0px" cellpadding="0px" cellspacing="0px" align="center" width="945px" >
<tr>
<td>
<?php  include 'includes/header.php'; ?></td></tr>
<tr>
<td width="305">
  <?php include("includes/menu.php");?>
  </td>
</tr>
</table>
        
<div id="wrapper_MemberLogin">
<h1><?php echo "Physical/Financial Progress Monitoring Dashboard";?>
</h1>
	<div class="clear"></div>
	<!--<div class="imgbutton">
			   <ul>
               <li><a href="#" >
				<img src="images/ico_print.gif"  alt="Print" title="Print"/>
				</a></li>
				 <li><a href="#" >
				<img src="images/database-process-icon.png"  alt="Import"  title="Import"/>
				</a></li>
		  </ul>
		  </div>-->
<div id="LoginBox" class="borderRound borderShadow" <?php if($componentflag == 1 && $activitytypeid == 0){?>style="width:550px;"<?php } ?><?php if($activityflag == 1 && $subactivityid == 0){?>style="width:550px;"<?php } ?>>

<table border="0px" cellpadding="0px" cellspacing="0px" align="center"  >

<form action="mosactlevel-cms.php" method="post" name="boqlevel" id="boqlevel">
<tr>
<td ><label>Project</label></td>
<td>
<div id="projectdiv">
<select name="projectid" id="projectid" onchange="getcomponent(this.value)" >
<option value="0">Seclect Project..</option>
<?php
$pquery = "select * from project";
$presult = mysql_query($pquery);
while ($pdata = mysql_fetch_array($presult)) {
?>
	<option value="<?php echo $pdata['pid']; ?>" <?php if ($projectid == $pdata['pid']) {echo ' selected="selected"';} ?>><?php echo $pdata['code']." - ".$pdata['detail']; ?></option>
<?php
}
?>
</select>
</div></td>
</tr>
<tr>
<td ><label>Component</label></td>
<td>
<div id="componentdiv">
<?php
if ($componentflag !=1 && $projectid == 0) {
?>
<select name="componentid" id="componentid" disabled="disabled" >
		<option>Select Component..</option>
    </select>
<?php
} else {
?>
<select name="componentid" id="componentid" onchange="getactivitytype(this.value)">
<option value="0">Select Component..</option>
<?php
$cquery = "select * from components where pid = ".$projectid." order by cid";
echo $cquery;
$cresult = mysql_query($cquery);
while ($cdata = mysql_fetch_array($cresult)) {
?>
	<option value="<?php echo $cdata['cid']; ?>" <?php if ($componentid == $cdata['cid']) {echo ' selected="selected"';} ?>><?php echo $cdata['code']." - ".$cdata['detail']; ?></option>
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
<td ><label>Activity Type</label></td>
<td>
<div id="activitytypediv">
<?php
if ($activitytypeflag !=1 && $componentid == 0) {
?>
	<select name="activitytypeid" id="activitytypeid"  disabled="disabled" >
		<option>Select Activity Type..</option>
    </select>
<?php
} else {
?>
<select name="activitytypeid" id="activitytypeid" onchange="getsubcomponent(this.value, componentid.value)">
<option value="0">Select Activity Type..</option>
<?php
$query="SELECT * FROM subcomponents where (sid=3 OR sid=4) and cid=".$componentid;
$queryresult = mysql_query($query);
$numrows=mysql_num_rows($queryresult);
if($numrows>0)
{
$squery = "select * from activitytype Limit 0,4";
}
else
{
if($componentid==13)
{
$squery = "select * from activitytype where sid=5 OR sid=6";
}
else
{
$squery = "select * from activitytype where sid=1";
}
}
$sresult = mysql_query($squery);
while ($sdata = mysql_fetch_array($sresult)) {
?>
	<option value="<?php echo $sdata['sid']; ?>" <?php if ($activitytypeid == $sdata['sid']) {echo ' selected="selected"';} ?>><?php echo $sdata['code']." - ".$sdata['detail']; ?></option>
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
<td ><label>Sub Component</label></td>
<td>
<div id="subcomponentdiv">
<?php
if ($subcomponentflag !=1 && $activitytypeid == 0) {
?>
	<select name="subcomponentid" id="subcomponentid" disabled="disabled" >
		<option>Select Sub Component..</option>
    </select>
<?php
} else {
?>
<select name="subcomponentid" id="subcomponentid" onchange="getactivity(this.value)">
<option value="0">Select Sub Component..</option>
<?php
$tquery = "select * from subcomponents where cid = ".$componentid." and sid = ".$activitytypeid;
$tresult = mysql_query($tquery);
while ($tdata = mysql_fetch_array($tresult)) {
?>
	<option value="<?php echo $tdata['s_id']; ?>" <?php if ($subcomponentid == $tdata['s_id']) {echo ' selected="selected"';} ?>><?php echo $tdata['code']." - ".$tdata['detail']; ?></option>
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
<td ><label>Activity</label></td>
<td>
<div id="activitydiv">
<?php if(isset($_REQUEST['activityid_add'])&&$_REQUEST['activityid_add']!="")
{

$activityflag=0;
//$activitytypeid=0;
$activityid=$_REQUEST['activityid_add'];

}?>
<?php
if ($activityflag !=1 && $subcomponentid == 0) {
?>
	<select name="activityid" id="activityid" disabled="disabled" >
		<option>Select Activity..</option>
    </select>

<?php
} else {
	/*if(isset($_REQUEST['activityid_add'])&&$_REQUEST['activityid_add']!="")
{

$aquery = "select * from activity where s_id = ".$subcomponentid." AND aid=".$activityid;
}
else
{
	$aquery = "select * from activity where s_id = ".$subcomponentid;
}*/
?>

<select name="activityid" id="activityid" onchange="getsubactivity(this.value)">
<option value="0">Select Activity..</option>
<?php
$aquery = "select * from activity where s_id = ".$subcomponentid;
$aresult = mysql_query($aquery);
while ($adata = mysql_fetch_array($aresult)) {
	
?>
	<option value="<?php echo $adata['aid']; ?>" <?php if ($activityid==$adata['aid']) {echo ' selected="selected"';} ?>>
	<?php echo $adata['code']." - ".$adata['detail'];  ?></option>
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
<td ><label>Sub Activity</label></td>
<td>
<div id="subactivitydiv">
<?php
if ($subactivityflag !=1 && $activityid == 0) {
?>
	<select name="subactivityid" id="subactivityid" disabled="disabled" >
		<option>Select Sub Activity..</option>
    </select>
<?php
} else { 
?>
<select name="subactivityid" id="subactivityid" >
<option value="0">Select Sub Activity..</option>
<?php
$bquery = "select * from subactivity where aid = ".$activityid;
$bresult = mysql_query($bquery);
while ($bdata = mysql_fetch_array($bresult)) {
?>
	<option value="<?php echo $bdata['sa_id']; ?>" <?php if ($subactivityid == $bdata['sa_id']) {echo ' selected="selected"';} ?>> <?php echo $bdata['code']." - ".$bdata['detail']; ?></option>
<?php
}
?>
</select>
<?php
}
?>   
</div></td>
</tr>

<tr >
<td style="padding-top:20px" align="right"><input type="submit" value="Generate Report"  id="uLogin"/></td>
<td style="padding-top:20px;"align="right">
<?php
if ($subactivityflag == 1) {
if($subactivityflag2!=1)
{?>
<a href="./mosactlevel-cms.php?subactivityid=<?php echo $subactivityid?>&activityid=<?php echo $activityid; ?>&activitytypeid=<?php echo $activitytypeid; ?>&subcomponentid=<?php echo $subcomponentid;?>&componentid=<?php echo $componentid;?>&projectid=<?php echo $projectid; ?>&mode=U">Update Subactivity</a>
<?php }} ?>
<?php
if ($activityflag == 1) {
if($activityflag2!=1)
{?>
<a href="./mosactlevel-cms.php?activityid_add=<?php echo $activityid; ?>&activitytypeid=<?php echo $activitytypeid; ?>&subcomponentid=<?php echo $subcomponentid;?>&componentid=<?php echo $componentid;?>&projectid=<?php echo $projectid; ?>">Add Subactivity</a>
<?php }} ?>
<?php
if ($componentflag == 1) {
?>
<?php /*?><a href="./mosactlevel-cms.php?subcomponentid=<?php echo $subcomponentid;?>&componentid=<?php echo $componentid;?>&projectid=<?php echo $projectid; ?>">Update Consultant</a><?php */?>
<?php } ?>
</td>
</tr>
<tr>
<td colspan="2"></td>
</tr>
</form>
</table>
</div>
</div>

<!--Start Project Table Here--><!--Start Component Table Here-->
<div align="center" style="color:#009966; text-decoration:blink; font-size:14px"><?php if($msgFlag==true)
{
	echo "New Item has been added";
}?></div>
<div id="result3">
<?php
if ($componentflag == 1 && $activitytypeid == 0 ) {
?>
<?php
}
?>
</div>


<!-- Start Avtivity Type  Table here-->
<?php if(isset($_REQUEST['activityid_add'])&&$_REQUEST['activityid_add']!="")
{
$activityid=1;
//$subcomponentid=0;
}?>
<div id="result4">
<?php
if ($activitytypeflag == 1 && $subcomponentid == 0 ) {
$query="SELECT * FROM subcomponents where (sid=3 OR sid=4) and cid=".$componentid;
$queryresult = mysql_query($query);
$numrows=mysql_num_rows($queryresult);
if($numrows>0)
{
function getComponentName($cid)
{
$sql="SELECT detail as c_name FROM  `components` where cid=".$cid;
$amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
$data=mysql_fetch_array($amountresult);
return $data;
}
$com_name=getComponentName($componentid);
//$last_date=ProgressDate();
$time=0;
$time_elapsed_percent=0;

?>


<?php
}
}
?>
</div>

<!-- Start Subcomponent  Table here-->

<div id="result10">
<?php
if ($subcomponentflag == 1 && $activityid == 0 ) {
$query="SELECT * FROM subcomponents where (sid=3 OR sid=4) and cid=".$componentid;
$queryresult = mysql_query($query);
$numrows=mysql_num_rows($queryresult);
if($numrows>0)
{?>
<table id="tblList" cellpadding="0px" cellspacing="0px"   width="98%" align="center" >
<tr  id="title">
<td colspan="18" align="center"><span class="white"><strong>General Report At Sub-Component Level(<?php echo $subcomponentid; ?>)</strong></span> 
  </th></tr>
<tr id="tblHeading">
<th rowspan="2" width="70px;"> Sr.No.</th>
      <th rowspan="2" width="70px;"> Code</th>
    <th rowspan="2" width="200px;">Activity Name</th>
    <th rowspan="2" width="100px;"> Contract Amount </th>
    <th colspan="2">Starting Date</th>
    <th colspan="2"> Ending Date</th>
    <th colspan="2">No of Days </th>
    <th colspan="2">Time Elps % </th>
    <th rowspan="2">Last Month</th>
    <th rowspan="2">During Month</th>
    <th rowspan="2">To Date Progress</th>   
      <th rowspan="2" width="70px;">Upto Date Percent</th>
    <th rowspan="2"width="70px;">Planned Progress</th>
    <th rowspan="2">SPI</th>
	</tr>
  <tr id="tblHeading">
    <th>Scheduled </th>
    <th>Actual</th>
    <th> Scheduled</th>
    <th>Actual</th>
    <th>Scheduled</th>
    <th>Actual</th>
    <th>Scheduled</th>
    <th>Actual</th>
</tr>

<?php
function getVariationData($aid)
{ 
$sql2="SELECT sum(vd.vqty) As tvqty, sum(vd.vrate*cc.quantity) as variation_in_rate_amount, sum(vd.vqty*dd.prs) as variation_in_qty_amount,sum(vd.`vamount`) as variation_in_amount,vd.`vo_id`,vd.`contigency_code`,vd.`vono`,vd.`vodate`,vd.`bid`,vd.`remark`,vd.`vstatus`,vd.`bdate`
FROM variationdata vd
LEFT OUTER JOIN (subactivitydata cc) on (vd.sa_id = cc.sa_id) 
LEFT OUTER JOIN (progressdata dd) on (vd.sa_id = dd.sa_id) where cc.aid=".$aid." GROUP BY cc.aid";
$pamountresultp = mysql_query($sql2)or die(mysql_error());
$pgdata=mysql_fetch_array($pamountresultp);
return $pgdata;
}
function getThisMonthVariationData($aid,$bid)
{ 
$sql2="SELECT sum(vd.vqty) As tvqty, sum(vd.vrate*cc.quantity) as variation_in_rate_amount, sum(vd.vqty*dd.prs) as variation_in_qty_amount,sum(vd.`vamount`) as variation_in_amount,vd.`vo_id`,vd.`contigency_code`,vd.`vono`,vd.`vodate`,vd.`bid`,vd.`remark`,vd.`vstatus`,vd.`bdate`
FROM variationdata vd
LEFT OUTER JOIN (subactivitydata cc) on (vd.sa_id = cc.sa_id)
LEFT OUTER JOIN (progressdata dd) on (vd.sa_id = dd.sa_id) where cc.aid=".$aid." AND vd.bid=".$bid." GROUP BY cc.aid";
$pamountresultp = mysql_query($sql2)or die(mysql_error());
$pgdata=mysql_fetch_array($pamountresultp);
return $pgdata;
}
function getSubComponentProgressAmount($cid,$sid,$sa_id,$s_id)
{
 $sql2="SELECT sa_id,sum( pamount) AS tamount, max( bdate ) AS lastdate
FROM `progress` 
WHERE sa_id =".$sa_id." AND cid=".$cid." AND sid=".$sid." AND s_id=".$s_id." GROUP BY sa_id";
$pamountresult2 = mysql_query($sql2)or die(mysql_error());
$pdata=mysql_fetch_array($pamountresult2);
return $pdata;
}
function getThisMonthSubComponentProgress($sa_id)
{
 $thismonth=date('Ym');
 $sql2="SELECT sum(pamount) AS cprogress
FROM `progressdata` 
WHERE  sa_id =".$sa_id."  AND lbdate LIKE '%".$thismonth."%' GROUP BY sa_id";
$pamountresultp = mysql_query($sql2)or die(mysql_error());
$pgdata=mysql_fetch_array($pamountresultp);
return $pgdata;
}
function getCode($aid)
{
 $sql="SELECT code FROM  `activity` where aid=".$aid;
 
$amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
$data=mysql_fetch_array($amountresult);

return $data;
}
function LastMonthProgressDate()
{
$sql="SELECT  MIN(bdate) as lastMonthdate,bid FROM  `progressmonth` Group by bid order by bid ASC";
$amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
$data=mysql_fetch_array($amountresult);
return $data;
}
function ThisMonthProgressDate()
{
$sql="SELECT  MAX(bdate) as lastMonthdate,bid FROM  `progressmonth` Group by bid order by bid desc";
$amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
$data=mysql_fetch_array($amountresult);
return $data;
}
$this_month_data=ThisMonthProgressDate();
$this_month_bid=$this_month_data["bid"];
$grand_total=0;
$total_progress=0;
$total_current_month_progress=0;
$total_upto_last_month_progress=0;
$total_noofdays=0;
$total_timeElps=0;
$total_planned_progress=0;
$to_date_progress=0;

$reportquery ="SELECT  ca.cid,cc.lqty, sum( cc.lqty*ca.rates) as lastamount,ca.activityname,ca.aid,ca.s_id,ca.sa_id,ca.sid,ca.startdate, min(ca.startdate) as mindate, ca.enddate, max(ca.enddate) as maxdate,  ca.quantity, ca.rates, cb.pqty, sum(ca.quantity*ca.rates) as amount, sum(cb.pamount)As totalamount,cb.pamount, cb.lbdate as lastdate FROM subactivitydata ca 
LEFT OUTER join (progressdata cb)
on (ca.sa_id = cb.sa_id )
LEFT OUTER join (lastmonthdata cc) 
on (cb.sa_id = cc.sa_id) Where ca.sid=".$activitytypeid." AND ca.s_id=".$subcomponentid." GROUP BY ca.aid";
$reportresult = mysql_query($reportquery);
$i=0;
while ($reportdata = mysql_fetch_array($reportresult)) {
$bgcolor = ($bgcolor == "#FFFFFF") ? "#EAF4FF" : "#FFFFFF";
$mindate=$reportdata["mindate"];
$maxdate=$reportdata["maxdate"];
$codeData=getCode($reportdata['aid']);
$current_month_progress=$reportdata['lastamount'];
$upto_last_month_progress=$reportdata['totalamount']-$reportdata['lastamount'];

$variation_data=getVariationData($reportdata['aid']);///////////////variation data

$this_variation_data=getThisMonthVariationData($reportdata['aid'],$this_month_bid);//////////////this variation data

$vo_thismonth=$this_variation_data["variation_in_qty_amount"]+$this_variation_data["variation_in_rate_amount"];
$this_month_progress=$current_month_progress+$vo_thismonth;
$total_this_month_progress+=$this_month_progress;
$vo_total_todate=$variation_data["variation_in_qty_amount"]+$variation_data["variation_in_rate_amount"];
$vo_uptolastmonth=$vo_total_todate-$vo_thismonth;
$uptolast_month_progress=$upto_last_month_progress+$vo_uptolastmonth;
 $total_uptolast_month_progress+=$uptolast_month_progress;
$to_date_progress=$this_month_progress+$uptolast_month_progress;
$total_progress+=$to_date_progress;

if($noofdays!=0)
{
$planned_progress=($reportdata['amount']/$noofdays) * $timeElps;
}
$total_planned_progress+=$planned_progress;
?>
<?php
$aenddate = strtotime(substr($reportdata['enddate'],0,4)."-".substr($reportdata['enddate'],4,2)."-".substr($reportdata['enddate'],6,2));
$astartdate = strtotime(substr($reportdata['startdate'],0,4)."-".substr($reportdata['startdate'],4,2)."-".substr($reportdata['startdate'],6,2));
$datediff = $aenddate - $astartdate;
$noofdays = number_format($datediff/(60*60*24),0);
$noofdays=trim(str_replace(",","",$noofdays));
$total_noofdays+=$noofdays;
?>

<?php
$aenddate = strtotime(substr($reportdata['startdate'],0,4)."-".substr($reportdata['startdate'],4,2)."-".substr($reportdata['startdate'],6,2));
$tlbdate = strtotime(substr($reportdata['lastdate'],0,4)."-".substr($reportdata['lastdate'],4,2)."-".substr($reportdata['lastdate'],6,2));
//$aenddate = strtotime(substr($reportdata['enddate'],0,4)."-".substr($reportdata['enddate'],4,2)."-".substr($reportdata['enddate'],6,2));
//$tlbdate = strtotime(substr($reportdata['lastdate'],0,4)."-".substr($reportdata['lastdate'],4,2)."-".substr($reportdata['lastdate'],6,2));
$datediff = $tlbdate-$aenddate ;
$timeElps = number_format($datediff/(60*60*24),0);
$total_timeElps+=$timeElps;
$i++;
?>
<?php if($to_date_progress>$reportdata['amount'])
{
$bgcolor="#FF0000";
}?>
<tr style="background-color:<?php echo $bgcolor;?>;">
<td style="text-align:center;"><?php echo $i;?> </td>
<td style="text-align:center;"><?php echo $codeData['code']; ?></td>
<td style="text-align:left;"><?php echo $reportdata['activityname']; ?></td>
<td style="text-align:right;"> <?php echo number_format(($reportdata['amount']),2); 
$grand_total+=$reportdata['amount'];?></td>
<td align="left" style="min-width:75px"><?php if($reportdata['startdate']!=""){									
$time = strtotime($reportdata['startdate']);
$Date = date( 'd-M-Y', $time );
echo $Date;
} ?> </td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:left; min-width:75px"><?php if($reportdata['enddate']!=""){									
$time = strtotime($reportdata['enddate']);
$Date = date( 'd-M-Y', $time );
echo $Date;
}?></td>
<td style="text-align:right;">&nbsp;  </td>
<td style="text-align:right;"> <?php echo $noofdays; ?>  </td>
<td style="text-align:right;">&nbsp;  </td>
<td style="text-align:right;"><?php  if($timeElps<0)
										{
										$timeElps=0;
										echo "0" ;
										}
										else
										{
										echo $timeElps;
										}?> </td>
<td style="text-align:right;">&nbsp;  </td>
<td style="text-align:right;"> <?php 
									echo number_format($uptolast_month_progress,2);
									?> </td>
<td style="text-align:right;"><?php echo number_format(($this_month_progress),2); ?></td>
<td style="text-align:right;"><?php 
						
										echo number_format(($to_date_progress),2);
										 ?></td>
<td style="text-align:right;"> <?php if($reportdata['amount']!=0)
{
	echo  number_format (($to_date_progress  / $reportdata['amount']*100),2);
}else
{
	echo  number_format (0,2);
	}?></td>
<td style="text-align:right;">  <?php 
									
									
									echo number_format ($planned_progress,2); ?></td>
<td style="text-align:right;"> <?php if($to_date_progress!=0&&$planned_progress!=0)
										{
										$SPI=$to_date_progress/$planned_progress;
									     echo number_format($SPI,2);
										 }
										 else
										 {
										 echo "0.0";} ?></td>
</tr>




<?php
}
?>
<tr align="right" id="grand_total">
<td colspan="3" align="right">
<strong>Grand Total:
</strong></td>
<td align="right">
<?php echo number_format($grand_total,2);?>
</td>
<td align="left" style="min-width:75px">
<?php $yr=substr($mindate,0,4);
$month=substr($mindate,4,-2);
$day=substr($mindate,6,8);
if($mindate!="")
{									
$time = strtotime($mindate);
$Date = date( 'd-m-Y', $time );
echo $Date;
}?> 
</td>
<td>
<?php //echo $maxdate;?> 
</td>
<td align="left" style="min-width:75px">
<?php $yr=substr($maxdate,0,4);
$month=substr($maxdate,4,-2);
$day=substr($maxdate,6,8);
if($maxdate!="")
{	
$time = strtotime($mindate);
$Date = date( 'd-m-Y', $time );
echo $Date;								
}
?> 
</td>
<td>
<?php //echo $total_noofdays;?> 
</td>
<td>
<?php $mindate=str_replace("/","-",$mindate);
      
      $maxdate=str_replace("/","-",$maxdate);
	  
	  echo $ress=dateDiff($mindate,$maxdate);?> 
</td>
<td>
<?php //echo $mindate;?> 
</td>
<td>
<?php echo $timeElps;?> 
</td>
<td>
<?php //echo $mindate;?> 
</td>
<td>
<?php echo  number_format($total_uptolast_month_progress,2);?>
</td>
<td align="right">
<?php echo  number_format($total_this_month_progress,2);?>
</td>
<td align="right">
<?php echo  number_format($total_progress,2);?>
</td>
<td align="right">
<?php echo  number_format(($total_progress/$grand_total*100),2);?>
</td>
<td align="right">
<?php echo  number_format($total_planned_progress,2);?>
</td>
<td align="right">
<?php if($total_progress!=0&&$total_planned_progress!=0)
{
 echo  number_format(($total_progress/$total_planned_progress),2);
 }
 else
 {
echo "0.0";
}
?>
</td>
</tr>
</table>
<?php }
?>

<?php
}
?>

</div>
<!-- Start Activity  Table here-->

<div id="result9">
<?php

if ($activityflag == 1 && $subactivityid == 0 ) {
$query="SELECT * FROM subcomponents where (sid=3 OR sid=4) and cid=".$componentid;
$queryresult = mysql_query($query);
$numrows=mysql_num_rows($queryresult);
if($numrows>0)
{
?>


<table id="tblList" cellpadding="0px" cellspacing="0px"   width="98%" align="center" >
<tr  id="title">
<td colspan="18" align="center"><span class="white"><strong>General Report At Activity Level (<?php echo $activityid; ?>)</strong></span> 
  </th></tr>
<tr id="tblHeading">
<th rowspan="2"> Sr. No. </th>
<th rowspan="2">Description </th>
<th rowspan="2"> UOM </th>
<!--<th colspan="3">As Per Estimate</th>-->
<th colspan="3"> As Per Bid</th>
<th colspan="2">Paid Upoto Previous </th>
<th colspan="2">Due This Certificate </th>
<th colspan="2">(Executed) Upto Date </th>
<th rowspan="2"> % in Progress</th>
</tr>
<tr id="tblHeading">
<!--<th>Qty. (Units) </th>
<th>Rate </th>
<th> Amount</th>-->
<th>Qty. (Units) </th>
<th>Rate (Rs.) </th>
<th>Amount (Rs.) </th>
<th> Qty. (Units)</th>
<th> Amount(Rs.)</th>
<th> Qty. (Units)</th>
<th> Amount(Rs.)</th>
<th> Qty. (Units)</th>
<th> Amount(Rs.)</th>
</tr>
<?php

function getActivityProgressAmount($cid,$sid,$sa_id,$s_id,$aid)
{
 
$sql2="SELECT sa_id,sum( pqty * prs ) AS tamount, max( bdate ) AS lastdate
FROM `progress` 
WHERE sa_id =".$sa_id." AND cid=".$cid." AND sid=".$sid." AND s_id=".$s_id." AND aid=".$aid." GROUP BY sa_id";
$pamountresult3 = mysql_query($sql2)or die(mysql_error());
$pdata=mysql_fetch_array($pamountresult3);
return $pdata;
}
function getCode_new($sa_id)
{
 $sql="SELECT code FROM  `subactivity` where sa_id=".$sa_id;
 
$amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
$data=mysql_fetch_array($amountresult);

return $data;
}
function getSubActivityVariationData($sa_id)
{ 
$sql2="SELECT sum(vd.vqty) As tvqty, sum(vd.vrate*cc.quantity) as variation_in_rate_amount, sum(vd.vqty*dd.prs) as variation_in_qty_amount,sum(vd.`vamount`) as variation_in_amount,vd.`vo_id`,vd.`contigency_code`,vd.`vono`,vd.`vodate`,vd.`bid`,vd.`remark`,vd.`vstatus`,vd.`bdate`
FROM variationdata vd
LEFT OUTER JOIN (subactivitydata cc) on (vd.sa_id = cc.sa_id) 
LEFT OUTER JOIN (progressdata dd) on (vd.sa_id = dd.sa_id) where cc.sa_id=".$sa_id." GROUP BY cc.sa_id";
$pamountresultp = mysql_query($sql2)or die(mysql_error());
$pgdata=mysql_fetch_array($pamountresultp);
return $pgdata;
}
function getThisMonthSubactivityVariationData($sa_id,$bid)
{ 
 $sql2="SELECT sum(vd.vqty) As lvqty, sum(vd.vrate*cc.quantity) as last_variation_in_rate_amount, sum(vd.vqty*dd.prs) as last_variation_in_qty_amount,sum(vd.`vamount`) as last_variation_in_amount,vd.`vo_id`,vd.`contigency_code`,vd.`vono`,vd.`vodate`,vd.`bid`,vd.`remark`,vd.`vstatus`,vd.`bdate`
FROM variationdata vd
LEFT OUTER JOIN (subactivitydata cc) on (vd.sa_id = cc.sa_id)
LEFT OUTER JOIN (progressdata dd) on (vd.sa_id = dd.sa_id) where cc.sa_id=".$sa_id." AND vd.bid=".$bid." GROUP BY cc.sa_id";
$pamountresultp = mysql_query($sql2)or die(mysql_error());
$pgdata=mysql_fetch_array($pamountresultp);
return $pgdata;
}
function LastMonthProgressDate()
{
$sql="SELECT  MIN(bdate) as lastMonthdate,bid FROM  `progressmonth` Group by bid order by bid ASC";
$amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
$data=mysql_fetch_array($amountresult);
return $data;
}
function ThisMonthProgressDate()
{
$sql="SELECT  MAX(bdate) as lastMonthdate,bid FROM  `progressmonth` Group by bid order by bid desc";
$amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
$data=mysql_fetch_array($amountresult);
return $data;
}
$this_month_data=ThisMonthProgressDate();
 $this_month_bid=$this_month_data["bid"];
$reportquerynew ="SELECT  ca.cid,sum(cc.lqty) as lqty, sum(cc.lqty*ca.rates) as lastamount,ca.subactivityname,ca.aid,ca.s_id,ca.sa_id,ca.sid,ca.startdate,ca.units, min(ca.startdate) as mindate, ca.enddate, max(ca.enddate) as maxdate,  ca.quantity, ca.rates, cb.pqty, sum(cb.pqty) as tpqty,sum(ca.quantity*ca.rates) as amount, sum(ca.quantity) as tqty ,sum(cb.pamount)As totalamount,cb.pamount, cb.lbdate as lastdate , cb.prs FROM subactivitydata ca 
LEFT OUTER join (progressdata cb)
on (ca.sa_id = cb.sa_id )
LEFT OUTER join (lastmonthdata cc) 
on (cb.sa_id = cc.sa_id)Where ca.sid=".$activitytypeid." AND ca.s_id=".$subcomponentid." AND ca.aid=".$activityid." GROUP BY ca.sa_id";

/*$reportquerynew ="SELECT ca.subactivityname,ca.aid,ca.s_id,ca.sa_id,ca.sid,ca.startdate,ca.units, min(ca.startdate) as mindate, ca.enddate, max(ca.enddate) as maxdate,  ca.quantity, ca.rates,sum(ca.quantity*ca.rates) as amount, sum(ca.quantity) as tqty ,sum(vd.vqty) As tvqty, sum(vd.vrate*ca.quantity) as variation_in_rate_amount, sum(vd.vqty*ca.rates) as variation_in_qty_amount,sum(vd.`vamount`) as variation_in_amount,vd.`vo_id`,vd.`contigency_code`,vd.`vono`,vd.`vodate`,vd.`bid`,vd.`remark`,vd.`vstatus`,vd.`bdate`
FROM variationdata vd
LEFT OUTER JOIN (subactivitydata ca) on (vd.sa_id = ca.sa_id) where ca.aid=".$reportdata['aid']." GROUP BY ca.sa_id";*/
$reportresult_act = mysql_query($reportquerynew)or die(mysql_error());
while ($reportdata_act = mysql_fetch_array($reportresult_act)) {
 $bgcolor = ($bgcolor == "#FFFFFF") ? "#EAF4FF" : "#FFFFFF";
/*$bgcolor = ($bgcolor == "#FF9999") ? "#FFD5D5" : "#FF9999";*/

$variation_data_sub=getSubActivityVariationData($reportdata_act['sa_id']);
$variation_this_data_sub=getThisMonthSubactivityVariationData($reportdata_act['sa_id'],$this_month_bid);

$upto_last_variation=$variation_data_sub['tvqty']-$variation_this_data_sub['lvqty'];
$total_amount_act=$reportdata_act['amount'];
$last_amount=$reportdata_act['lastamount'];
$grand_last_amount+=$last_amount;
$grand_total+=$total_amount_act;
$codeData_new=getCode_new($reportdata_act['sa_id']);
$total_qty=$variation_data_sub['tvqty']+$reportdata_act['tpqty'];
$last_progress_qty=$reportdata_act['tpqty']-$reportdata_act['lqty'];
$total_last_qty=$upto_last_variation+$last_progress_qty; //lqty is during this month qty
if($variation_data_sub['vrate']==0)
{
$this_month_act=(($reportdata_act['lqty'] + $variation_this_data_sub['lvqty']) * $reportdata_act['prs']);
}
else
{
$this_month_act=(($reportdata_act['lqty'] + $variation_this_data_sub['lvqty']) * $variation_data_sub['vrate']);
}
$this_month_act_total+=$this_month_act;
if($variation_last_data_sub['vrate']==0)
{
$last_month_act=($total_last_qty) * $reportdata_act['prs'];
}
else
{
$last_month_act=($total_last_qty) * $variation_last_data_sub['vrate'];
}
$last_month_act_total+=$last_month_act;
if($variation_data_sub['vrate']==0)
{
$total_month=($total_qty) * $reportdata_act['prs'];
}
else
{
$total_month=($total_qty) * $variation_data_sub['vrate'];
}
$total_month_total+=$total_month;
?>
<?php if($variation_data_sub['tvqty']>0)
{
$bgcolor="#FF0000";
}?>
<tr style="background-color:<?php echo $bgcolor;?>;">
<td style="text-align:center;"><?php echo  $codeData_new['code']; ?></td>
<td style="text-align:left;"><?php   echo $reportdata_act['subactivityname']; ?></td>
<td style="text-align:center;"><?php echo $reportdata_act['units']; ?></td>
<?php /*?><td style="text-align:center;"><?php echo number_format($reportdata['quantity'],2); ?></td>
<td style="text-align:right;"><?php  echo number_format($reportdata['rates'],2); ?></td>
<td style="text-align:right;"><?php  echo number_format (($reportdata['quantity'] * $reportdata['rates']),2) ; ?></td><?php */?>
<td style="text-align:center;"><?php echo number_format($reportdata_act['tqty'],2); ?></td>
<td style="text-align:right;"><?php  echo number_format($reportdata_act['rates'],2); ?></td>
<td style="text-align:right;"><?php  echo number_format (($reportdata_act['tqty'] * $reportdata_act['rates']),2) ; ?></td>
<td style="text-align:center;"><?php echo number_format ($total_last_qty,2); ?></td>
<td style="text-align:right;"><?php  echo number_format (($last_month_act),2) ; ?></td>
<td style="text-align:center;"><?php echo number_format ($total_qty - $total_last_qty,2); ?></td>
<td style="text-align:right;"><?php  echo number_format($this_month_act,2) ; ?></td>
<td style="text-align:center;"><?php echo number_format ($total_qty,2); ?></td>   
<td style="text-align:right;"><?php  echo number_format (($total_month),2) ; ?></td>
<td style="text-align:right;"><?php  if($reportdata_act['tpqty']!=0 && $reportdata_act['tqty']!=0)
{
echo number_format((($total_qty / $reportdata_act['tqty'])*100),2);
}
else
{
echo "0.0";
} ?></td>
</tr>

<?php
}
?>
<tr align="right" id="grand_total">
<td style="text-align:right;" colspan="5"><strong><?php echo  "Grand Total:"; ?></strong></td>
<?php /*?><td style="text-align:center;"><?php echo number_format ($grand_total,2); ?></td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td><?php */?>
<td style="text-align:right;"><?php  
echo number_format ($grand_total,2); ?></td>
<td style="text-align:center;">&nbsp;</td>
<td style="text-align:right;"><?php  echo  number_format ($last_month_act_total,2) ; ?></td>
<td style="text-align:center;">&nbsp;</td>
<td style="text-align:right;"><?php  echo number_format (($this_month_act_total),2) ; ?></td>
<td style="text-align:center;">&nbsp;</td>   
<td style="text-align:right;"><?php  echo  number_format ($total_month_total,2) ; ?></td>
<td style="text-align:right;"><?php  if($total_month_total!=0&&$grand_total!=0)
{
echo number_format((($total_month_total/$grand_total)*100),2);
}
else
{
echo "0.0";
} ?></td>
</tr>
</table> <!--///New-->
<?php
}
?>
<table width="566"  align="center" cellpadding="0px" cellspacing="4px" style="border:0px ;  padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal">
<form action="mosactlevel-cms.php" method="post" name="consultant" id="consultant" onSubmit="return frmValidate(this);">

<tr >
<td width="174" align="left" valign="middle"  >
 <strong>Code: </strong></td>
<td width="463" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
 <input class="rr_input" name="code" value="" type="text" id="code" size="40"  
 style="width:100px; text-align:right"/> </td>
</tr>
<tr >
<td width="174" align="left" valign="middle"  >
 <strong> Description: </strong></td>
<td width="463" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><textarea name="detail" cols="200" rows="5" class="rr_input" id="detail" style="width:400px; text-align:left" multiple="multiple"></textarea>
</td>
</tr>
<tr>

<td colspan="2" valign="top"  >
<div id="AllProgressQunatity"><table width="514" height="64" border="0" align="center">
  <tr>
    <td width="75"><strong>Rate </strong></td>
    <td width="146"><strong>Progress Quantity</strong></td>
    </tr>
    
  <tr>
  <td><input class="rr_input" name="rs" value=" " type="text" id="rs" size="40"  
 style="width:100px; text-align:right" />
</td>
    <td><input class="rr_input" name="qty" value="" type="text" id="qty" size="40"  
 style="width:100px; text-align:right" /></td>
    </tr>
    <tr>
    <td width="75"><strong>Unit </strong></td>
    <td width="146"><strong>UOM</strong></td>
    <td width="146"><strong>Remark</strong></td>
    <td width="146"><strong>Order</strong></td>
    </tr>
    
  <tr>
  <td><input class="rr_input" name="unit" value=" " type="text" id="unit" size="40"  
 style="width:100px; text-align:right" />
</td>
    <td><input class="rr_input" name="uom" value="" type="text" id="uom" size="40"  
 style="width:100px; text-align:right" /></td>
     <td><input class="rr_input" name="remark" value="" type="text" id="remark" size="40"  
 style="width:100px; text-align:right" /></td>
     <td><input class="rr_input" name="order" value="" type="text" id="order" size="40"  
 style="width:100px; text-align:right" /></td>
    </tr>
    
</table>
</div></td>
</tr>
<tr>
  <td >&nbsp;</td>
  <td>
    
  <input type="hidden" id="sa_id" name="sa_id" value="<?php echo $subactivityid;?>" />
  <input type="hidden" id="activityid_add" name="activityid_add" value="<?php echo $_REQUEST["activityid_add"];?>" />
  <input type="hidden" id="sid" name="sid" value="<?php echo $activitytypeid;?>"   />
  <input type="hidden" id="s_id" name="s_id" value="<?php echo $subcomponentid;?>" />
  <input type="hidden" id="cid" name="cid" value="<?php echo $componentid;?>"  />
  <input type="hidden" id="pid" name="pid" value="<?php echo $projectid;?>"    />
  </td>
</tr>
<tr >
<td style="padding-top:20px; padding-right:350px" colspan="2" align="center">
<input type="submit" value="Add Subactivity" name="add_subactivity"   id="uLogin"/>
</td>
</tr>
<tr>
<td colspan="2"></td>
</tr>
</form>
</table>
<?php 
}
?>
<?php
if(isset($_REQUEST['activityid_add'])&&$_REQUEST['activityid_add']!="")
{
$activityid=1;
/*$activitytypeid=0;
$subcomponentid=0;
$componentid=0;
$projectid=0;
$subactivityid=0;*/?>    
<table width="566"  align="center" cellpadding="0px" cellspacing="4px" style="border:0px ;  padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal">
<form action="mosactlevel-cms.php" method="post" name="add" id="add" onSubmit="return frmValidate(this);">

<tr >
<td width="174" align="left" valign="middle"  >
 <strong>Code: </strong></td>
<td width="463" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
 <input class="rr_input" name="code" value="" type="text" id="code" size="40"  
 style="width:100px; text-align:right"/> </td>
</tr>
<tr >
<td width="174" align="left" valign="middle"  >
 <strong> Description: </strong></td>
<td width="463" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><textarea name="detail" cols="200" rows="5" class="rr_input" id="detail" style="width:400px; text-align:left" multiple="multiple"></textarea>
</td>
</tr>
<tr>

<td colspan="2" valign="top"  >
<div id="AllProgressQunatity"><table width="514" height="64" border="0" align="center">
  <tr>
    <td width="75"><strong>Rate </strong></td>
    <td width="146"><strong>Progress Quantity</strong></td>
    </tr>
    
  <tr>
  <td><input class="rr_input" name="rs" value=" " type="text" id="rs" size="40"  
 style="width:100px; text-align:right" />
</td>
    <td><input class="rr_input" name="qty" value="" type="text" id="qty" size="40"  
 style="width:100px; text-align:right" /></td>
    </tr>
    <tr>
    <td width="75"><strong>Unit </strong></td>
    <td width="146"><strong>UOM</strong></td>
    <td width="146"><strong>Remark</strong></td>
    <td width="146"><strong>Order</strong></td>
    </tr>
    
  <tr>
  <td><input class="rr_input" name="unit" value=" " type="text" id="unit" size="40"  
 style="width:100px; text-align:right" />
</td>
    <td><input class="rr_input" name="uom" value="" type="text" id="uom" size="40"  
 style="width:100px; text-align:right" /></td>
     <td><input class="rr_input" name="remark" value="" type="text" id="remark" size="40"  
 style="width:100px; text-align:right" /></td>
     <td><input class="rr_input" name="order" value="" type="text" id="order" size="40"  
 style="width:100px; text-align:right" /></td>
    </tr>
    
</table>
</div></td>
</tr>
<tr>
  <td >&nbsp;</td>
  <td>
    
  <input type="hidden" id="sa_id" name="sa_id" value="<?php echo $subactivityid;?>" />
  <input type="hidden" id="activityid_add" name="activityid_add" value="<?php echo $_REQUEST["activityid_add"];?>" />
  <input type="hidden" id="sid" name="sid" value="<?php echo $activitytypeid;?>"   />
  <input type="hidden" id="s_id" name="s_id" value="<?php echo $subcomponentid;?>" />
  <input type="hidden" id="cid" name="cid" value="<?php echo $componentid;?>"  />
  <input type="hidden" id="pid" name="pid" value="<?php echo $projectid;?>"    />
  </td>
</tr>
<tr >
<td style="padding-top:20px; padding-right:350px" colspan="2" align="center">
<input type="submit" value="Add Subactivity" name="add_subactivity"   id="uLogin"/>
</td>
</tr>
<tr>
<td colspan="2"></td>
</tr>
</form>
</table> 

<?php }?>
</div>

<!-- Start Sub Activity  Table here-->
<div id="result5">
<?php
if ($subactivityflag == 1) {
$query="SELECT * FROM subcomponents where (sid=3 OR sid=4) and cid=".$componentid;
$queryresult = mysql_query($query);
$numrows=mysql_num_rows($queryresult);
if($numrows>0)
{?>
<table id="tblList" cellpadding="0px" cellspacing="0px"   width="98%" align="center" >
<tr  id="title">
<td colspan="18" align="center"><span class="white"><strong>General Report At Sub-Activity Level (<?php echo $subactivityid; ?>)</strong></span> 
  </th></tr>
<tr id="tblHeading">
<th rowspan="2"> Sr. No. </th>
<th rowspan="2">Description </th>
<th rowspan="2"> UOM </th>
<!--<th colspan="3">As Per Estimate</th>-->
<th colspan="3"> As Per Bid</th>
<th colspan="2">Paid Upoto Previous </th>
<th colspan="2">Due This Certificate </th>
<th colspan="2">(Executed) Upto Date </th>
<th rowspan="2"> % in Progress</th>
</tr>
<tr id="tblHeading">
<!--<th>Qty. (Units) </th>
<th>Rate </th>
<th> Amount</th>-->
<th>Qty. (Units) </th>
<th>Rate (Rs.) </th>
<th>Amount (Rs.) </th>
<th> Qty. (Units)</th>
<th> Amount(Rs.)</th>
<th> Qty. (Units)</th>
<th> Amount(Rs.)</th>
<th> Qty. (Units)</th>
<th> Amount(Rs.)</th>
</tr>
<?php

function getActivityProgressAmount($cid,$sid,$sa_id,$s_id,$aid)
{
 
$sql2="SELECT sa_id,sum( pqty * prs ) AS tamount, max( bdate ) AS lastdate
FROM `progress` 
WHERE sa_id =".$sa_id." AND cid=".$cid." AND sid=".$sid." AND s_id=".$s_id." AND aid=".$aid." GROUP BY sa_id";
$pamountresult3 = mysql_query($sql2)or die(mysql_error());
$pdata=mysql_fetch_array($pamountresult3);
return $pdata;
}
function getCode_new($sa_id)
{
 $sql="SELECT code FROM  `subactivity` where sa_id=".$sa_id;
 
$amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
$data=mysql_fetch_array($amountresult);

return $data;
}
function getSubActivityVariationData($sa_id)
{ 
$sql2="SELECT sum(vd.vqty) As tvqty, sum(vd.vrate*cc.quantity) as variation_in_rate_amount, sum(vd.vqty*dd.prs) as variation_in_qty_amount,sum(vd.`vamount`) as variation_in_amount,vd.`vo_id`,vd.`contigency_code`,vd.`vono`,vd.`vodate`,vd.`bid`,vd.`remark`,vd.`vstatus`,vd.`bdate`
FROM variationdata vd
LEFT OUTER JOIN (subactivitydata cc) on (vd.sa_id = cc.sa_id) 
LEFT OUTER JOIN (progressdata dd) on (vd.sa_id = dd.sa_id) where cc.sa_id=".$sa_id." GROUP BY cc.sa_id";
$pamountresultp = mysql_query($sql2)or die(mysql_error());
$pgdata=mysql_fetch_array($pamountresultp);
return $pgdata;
}
function getThisMonthSubactivityVariationData($sa_id,$bid)
{ 
 $sql2="SELECT sum(vd.vqty) As lvqty, sum(vd.vrate*cc.quantity) as last_variation_in_rate_amount, sum(vd.vqty*dd.prs) as last_variation_in_qty_amount,sum(vd.`vamount`) as last_variation_in_amount,vd.`vo_id`,vd.`contigency_code`,vd.`vono`,vd.`vodate`,vd.`bid`,vd.`remark`,vd.`vstatus`,vd.`bdate`
FROM variationdata vd
LEFT OUTER JOIN (subactivitydata cc) on (vd.sa_id = cc.sa_id)
LEFT OUTER JOIN (progressdata dd) on (vd.sa_id = dd.sa_id) where cc.sa_id=".$sa_id." AND vd.bid=".$bid." GROUP BY cc.sa_id";
$pamountresultp = mysql_query($sql2)or die(mysql_error());
$pgdata=mysql_fetch_array($pamountresultp);
return $pgdata;
}
function LastMonthProgressDate()
{
$sql="SELECT  MIN(bdate) as lastMonthdate,bid FROM  `progressmonth` Group by bid order by bid ASC";
$amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
$data=mysql_fetch_array($amountresult);
return $data;
}
function ThisMonthProgressDate()
{
$sql="SELECT  MAX(bdate) as lastMonthdate,bid FROM  `progressmonth` Group by bid order by bid desc";
$amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
$data=mysql_fetch_array($amountresult);
return $data;
}
$this_month_data=ThisMonthProgressDate();
 $this_month_bid=$this_month_data["bid"];
$reportquerynew ="SELECT  ca.cid,sum(cc.lqty) as lqty, sum(cc.lqty*ca.rates) as lastamount,ca.subactivityname,ca.aid,ca.s_id,ca.sa_id,ca.sid,ca.startdate,ca.units, min(ca.startdate) as mindate, ca.enddate, max(ca.enddate) as maxdate,  ca.quantity, ca.rates, cb.pqty, sum(cb.pqty) as tpqty,sum(ca.quantity*ca.rates) as amount, sum(ca.quantity) as tqty ,sum(cb.pamount)As totalamount,cb.pamount, cb.lbdate as lastdate , cb.prs FROM subactivitydata ca 
LEFT OUTER join (progressdata cb)
on (ca.sa_id = cb.sa_id )
LEFT OUTER join (lastmonthdata cc) 
on (cb.sa_id = cc.sa_id)Where ca.sid=".$activitytypeid." AND ca.s_id=".$subcomponentid." AND ca.aid=".$activityid." AND ca.sa_id=".$subactivityid." GROUP BY ca.sa_id";

/*$reportquerynew ="SELECT ca.subactivityname,ca.aid,ca.s_id,ca.sa_id,ca.sid,ca.startdate,ca.units, min(ca.startdate) as mindate, ca.enddate, max(ca.enddate) as maxdate,  ca.quantity, ca.rates,sum(ca.quantity*ca.rates) as amount, sum(ca.quantity) as tqty ,sum(vd.vqty) As tvqty, sum(vd.vrate*ca.quantity) as variation_in_rate_amount, sum(vd.vqty*ca.rates) as variation_in_qty_amount,sum(vd.`vamount`) as variation_in_amount,vd.`vo_id`,vd.`contigency_code`,vd.`vono`,vd.`vodate`,vd.`bid`,vd.`remark`,vd.`vstatus`,vd.`bdate`
FROM variationdata vd
LEFT OUTER JOIN (subactivitydata ca) on (vd.sa_id = ca.sa_id) where ca.aid=".$reportdata['aid']." GROUP BY ca.sa_id";*/
$reportresult_act = mysql_query($reportquerynew)or die(mysql_error());
while ($reportdata_act = mysql_fetch_array($reportresult_act)) {
 $bgcolor = ($bgcolor == "#FFFFFF") ? "#EAF4FF" : "#FFFFFF";
/*$bgcolor = ($bgcolor == "#FF9999") ? "#FFD5D5" : "#FF9999";*/
$variation_data_sub=getSubActivityVariationData($reportdata_act['sa_id']);
$variation_this_data_sub=getThisMonthSubactivityVariationData($reportdata_act['sa_id'],$this_month_bid);

$upto_last_variation=$variation_data_sub['tvqty']-$variation_this_data_sub['lvqty'];
$total_amount_act=$reportdata_act['amount'];
$last_amount=$reportdata_act['lastamount'];
$grand_last_amount+=$last_amount;
$grand_total+=$total_amount_act;
$codeData_new=getCode_new($reportdata_act['sa_id']);
$total_qty=$variation_data_sub['tvqty']+$reportdata_act['tpqty'];
$last_progress_qty=$reportdata_act['tpqty']-$reportdata_act['lqty'];
$total_last_qty=$upto_last_variation+$last_progress_qty; //lqty is during this month qty
if($variation_data_sub['vrate']==0)
{
$this_month_act=(($reportdata_act['lqty'] + $variation_this_data_sub['lvqty']) * $reportdata_act['prs']);
}
else
{
$this_month_act=(($reportdata_act['lqty'] + $variation_this_data_sub['lvqty']) * $variation_data_sub['vrate']);
}
$this_month_act_total+=$this_month_act;
if($variation_last_data_sub['vrate']==0)
{
$last_month_act=($total_last_qty) * $reportdata_act['prs'];
}
else
{
$last_month_act=($total_last_qty) * $variation_last_data_sub['vrate'];
}
$last_month_act_total+=$last_month_act;
if($variation_data_sub['vrate']==0)
{
$total_month=($total_qty) * $reportdata_act['prs'];
}
else
{
$total_month=($total_qty) * $variation_data_sub['vrate'];
}
$total_month_total+=$total_month;
?>
<?php if($variation_data_sub['tvqty']>0)
{
$bgcolor="#FF0000";
}?>
<tr style="background-color:<?php echo $bgcolor;?>;">
<td style="text-align:center;"><?php echo  $codeData_new['code']; ?></td>
<td style="text-align:left;"><?php   echo $reportdata_act['subactivityname']; ?></td>
<td style="text-align:center;"><?php echo $reportdata_act['units']; ?></td>
<?php /*?><td style="text-align:center;"><?php echo number_format($reportdata['quantity'],2); ?></td>
<td style="text-align:right;"><?php  echo number_format($reportdata['rates'],2); ?></td>
<td style="text-align:right;"><?php  echo number_format (($reportdata['quantity'] * $reportdata['rates']),2) ; ?></td><?php */?>
<td style="text-align:center;"><?php echo number_format($reportdata_act['tqty'],2); ?></td>
<td style="text-align:right;"><?php  echo number_format($reportdata_act['rates'],2); ?></td>
<td style="text-align:right;"><?php  echo number_format (($reportdata_act['tqty'] * $reportdata_act['rates']),2) ; ?></td>
<td style="text-align:center;"><?php echo number_format ($total_last_qty,2); ?></td>
<td style="text-align:right;"><?php  echo number_format (($last_month_act),2) ; ?></td>
<td style="text-align:center;"><?php echo number_format ($total_qty - $total_last_qty,2); ?></td>
<td style="text-align:right;"><?php  echo number_format($this_month_act,2) ; ?></td>
<td style="text-align:center;"><?php echo number_format ($total_qty,2); ?></td>   
<td style="text-align:right;"><?php  echo number_format (($total_month),2) ; ?></td>
<td style="text-align:right;"><?php  if($reportdata_act['tpqty']!=0 && $reportdata_act['tqty']!=0)
{
echo number_format((($total_qty / $reportdata_act['tqty'])*100),2);
}
else
{
echo "0.0";
} ?></td>
</tr>

<?php
}
?>
<tr align="right" id="grand_total">
<td style="text-align:right;" colspan="5"><strong><?php echo  "Grand Total:"; ?></strong></td>
<?php /*?><td style="text-align:center;"><?php echo number_format ($grand_total,2); ?></td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td><?php */?>
<td style="text-align:right;"><?php  
echo number_format ($grand_total,2); ?></td>
<td style="text-align:center;">&nbsp;</td>
<td style="text-align:right;"><?php  echo  number_format ($last_month_act_total,2) ; ?></td>
<td style="text-align:center;">&nbsp;</td>
<td style="text-align:right;"><?php  echo number_format (($this_month_act_total),2) ; ?></td>
<td style="text-align:center;">&nbsp;</td>   
<td style="text-align:right;"><?php  echo  number_format ($total_month_total,2) ; ?></td>
<td style="text-align:right;"><?php  if($total_month_total!=0&&$grand_total!=0)
{
echo number_format((($total_month_total/$grand_total)*100),2);
}
else
{
echo "0.0";
} ?></td>
</tr>
</table>
<?php
}
?>
<?php $bid = intval($_REQUEST['bid']);
$subactivityid = intval($_REQUEST['subactivityid']);

$q="SELECT * from subactivity where sa_id=".$subactivityid;
$res=mysql_query($q);
$resdata=mysql_fetch_array($res);
if(isset($_REQUEST['subactivityid'])&&$_REQUEST['subactivityid']!=""&&$_REQUEST['mode']=='U')
{?>    
<table width="566"  align="center" cellpadding="0px" cellspacing="4px" style="border:0px ;  padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal">
<form action="mosactlevel-cms.php" method="post" name="edit" id="edit" onSubmit="return frmValidate(this);">

<tr >
<td width="174" align="left" valign="middle"  >
 <strong>Code: </strong></td>
<td width="463" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
 <input class="rr_input" name="code" value="<?php echo $resdata["code"];?>" type="text" id="code" size="40"  
 style="width:100px; text-align:right"/> </td>
</tr>
<tr >
<td width="174" align="left" valign="middle"  >
 <strong> Description: </strong></td>
<td width="463" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><textarea name="detail" cols="200" rows="5" class="rr_input" id="detail" style="width:400px; text-align:left" multiple="multiple"><?php echo $resdata["detail"];?></textarea>
</td>
</tr>
<tr>

<td colspan="2" valign="top"  >
<div id="AllProgressQunatity"><table width="514" height="64" border="0" align="center">
  <tr>
    <td width="75"><strong>Rate </strong></td>
    <td width="146"><strong>Progress Quantity</strong></td>
    </tr>
    
  <tr>
  <td><input class="rr_input" name="rs" value=" <?php echo number_format($resdata["rs"],2);?>" type="text" id="rs" size="40"  
 style="width:100px; text-align:right" />
</td>
    <td><input class="rr_input" name="qty" value="<?php echo number_format($resdata["qty"],2);?>" type="text" id="qty" size="40"  
 style="width:100px; text-align:right" /></td>
    </tr>
    
</table>
</div></td>
</tr>
<tr>
  <td >&nbsp;</td>
  <td>
    
  <input type="hidden" id="sa_id" name="sa_id" value="<?php echo $subactivityid;?>" />
  <input type="hidden" id="aid" name="aid" value="<?php echo $activityid;?>" />
  <input type="hidden" id="sid" name="sid" value="<?php echo $activitytypeid;?>" />
  <input type="hidden" id="s_id" name="s_id" value="<?php echo $subcomponentid;?>" />
  <input type="hidden" id="cid" name="cid" value="<?php echo $componentid;?>" />
  <input type="hidden" id="pid" name="pid" value="<?php echo $projectid;?>" /></td>
</tr>
<tr >
<td style="padding-top:20px; padding-right:350px" colspan="2" align="center">
<input type="submit" value="Update Progress" name="edit_subactivity"   id="uLogin"/>
</td>
</tr>
<tr>
<td colspan="2"></td>
</tr>
</form>
</table> 
<?php 
}
}
?>
</div>
<div class="clear"></div>
<div class="clear"></div>
	<?php include("includes/footer.php");?>
	<div class="clear"></div>
</body>
</html>

