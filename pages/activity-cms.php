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

?>
<?php
$mode	= "I";

if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	  $code = trim($_POST['code']);
	  $detail = trim($_POST['detail']);
	  $assig = trim($_POST['assig']);
	   $s_id = trim($_POST['s_id']);
	    $aid = trim($_POST['aid']);
	  $activity_start_date   	= trim($_POST['activity_start_date']);
	  $activity_end_date 	    = trim($_POST['activity_end_date']);
	  $activity_act_start_date 	= trim($_POST['activity_act_start_date']);
	  $activity_act_end_date 	= trim($_POST['activity_act_end_date']);
	 $order =$_POST['order'];
	 $baseline =trim(str_replace(",","",$_POST['baseline']));
	  $mode =$_POST['mode'];
	
	$vResult = array();
	if(empty($_POST['code'])){
		
		$objCommon->setMessage("Code is required ", 'Valid');
		redirect('./?p=activity-cms');
	}
	
	if(!$vResult){
		$aid = ($_POST['mode'] == "U") ? $_POST['aid'] : $objAdminUser->genCode("mis_tbl_4_milstones", "aid");
		$objProduct->setProperty("aid",   $aid);
		$objProduct->setProperty("s_id",  $s_id);
		$objProduct->setProperty("code",  $code);
		$objProduct->setProperty("detail",$detail);
		$objProduct->setProperty("assig", $assig);
		$objProduct->setProperty("startdate", $activity_start_date);
		$objProduct->setProperty("enddate", $activity_end_date);
		$objProduct->setProperty("actual_stardate",  $activity_act_start_date);
		$objProduct->setProperty("actual_enddate",  $activity_act_end_date );
		$objProduct->setProperty("order", $order);
		$objProduct->setProperty("baseline", $baseline);
		
	
		if($objProduct->actActivity($mode)){
			$objProduct->getSQL();
			if($_POST['mode']=="U")
			{
			$objCommon->setMessage("Activity Updated successfully", 'Update');
			}
			else
			{
			$objCommon->setMessage("New Activity added successfully", 'Info');
			}
			redirect('./?p=activities');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['aid']) && !empty($_GET['aid']))
		$aid = $_GET['aid'];
	else if(isset($_POST['aid']) && !empty($_POST['aid']))
		$aid= $_POST['aid'];
	if(isset($aid) && !empty($aid)){
		$objProduct->setProperty("aid", $aid);
		$objProduct->lstActivities();
		$data = $objProduct->dbFetchArray(1);
		$mode	= "U";
		extract($data);
		$objProduct->setProperty("s_id", $s_id);
		$objProduct->lstSubComponent();
		$sub_data = $objProduct->dbFetchArray(1);
	
		$objProduct->setProperty("cid", $cid);
		$objProduct->lstComponent();
		$sub_data_pr = $objProduct->dbFetchArray(1);
	
	}
}
?>
<script>
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
function getcomponent(projectid) {		
		if (projectid!=0) {
			var strURL="findcomponent-cms.php?project="+projectid;
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
		} 
	}
function getsubcomponent(componentid) {	
		
		if (componentid!=0) {
		var strURL="findsubcomponent-cms.php?component="+componentid;
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
function getactivitytype(componentid) {		

		if (componentid!=0) {
			var strURL="findactivitytype-cms.php?component="+componentid;
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
</script>
<div id="wrapperPRight">
		<div id="pageContentName" class="shadowWhite"><?php echo ($mode == "U") ? "Update Sub Component" : "Add New Sub Component";?></div>
		<div id="pageContentRight" style="float:right; padding:0; margin:0px">
        
			<div class="menu1" style="padding:0">
				<ul >
				<li><a href="./?p=activities"  ><?php echo "Back";?></a></li>				
				</ul>
				
			</div>
		</div>
		<div class="clear"></div>
	<?php echo $objCommon->displayMessage();?>
		<div class="clear"></div>
		<div class="NoteTxt"><?php echo _NOTE;?></div>
		<div id="tableContainer">
		
			<div class="clear"></div>
            <form action="" method="post" name="activity_form" id="activity_form" onSubmit="return frmValidate(this);">
<table width="566"  align="left" cellpadding="0px" cellspacing="4px" style="border:0px ;  padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal">


<tr >
  <td align="left" valign="middle"  ><strong>Project:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
  <select name="pid" id="pid"  style="width:200px;" onchange="getcomponent(this.value)" >
    <option value=""  selected="selected">Projects..</option>
    <?php
			echo $objProduct->ProjectCombo($sub_data_pr["pid"]);
			?>
  </select></td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>Component:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
  <div id="componentdiv">
  <select name="cid" id="cid"  style="width:200px;" >
    <option value=""  selected="selected" onchange="getsubcomponent(this.value)">Components..</option>
    <?php
			echo $objProduct->ComponentCombo($sub_data["cid"]);
			?>
  </select>
  </div></td>
</tr>

<tr >
  <td align="left" valign="middle"  ><strong>Sub Component:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
  <div id="subcomponentdiv">
  <select name="s_id" id="s_id" onchange="getactivity(this.value)">
<option value="0">Sub Component..</option>
<?php

echo $objProduct->SubComponentCombo($s_id);
?>
</select>
</div></td>
</tr>
<tr >
<td width="142" align="left" valign="middle"  >
 <strong>Code: </strong></td>
<td width="410" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
 <input class="rr_input" name="code" value="<?php echo $code;?>" type="text" id="code" size="40"  
 style="width:100px; text-align:left"/> </td>
</tr>
<tr >
<td width="142" align="left" valign="middle"  >
 <strong> Description: </strong></td>
<td width="410" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><textarea name="detail" cols="200" rows="5" class="rr_input" id="detail" style="width:400px; text-align:left" multiple="multiple"><?php echo $detail;?></textarea>
</td>
</tr>
<tr >
<td width="142" align="left" valign="middle"  >
 <strong>Baseline: </strong></td>
<td width="410" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
 <input class="rr_input" name="baseline" value="<?php echo number_format($baseline,2);?>" type="text" id="baseline" size="40"  
 style="width:100px; text-align:left"/> </td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>Start Date:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
  <input class="rr_input" name="activity_start_date" value="<?php if($startdate!="")
 echo date('Y-m-d',strtotime($startdate));?>" type="text" id="activity_start_date" size="40"  
 style="width:100px; text-align:left"/></td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>End Date:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><input class="rr_input" name="activity_end_date" value="<?php if($enddate!="")
 echo date('Y-m-d',strtotime($enddate));?>" type="text" id="activity_end_date" size="40"  
 style="width:100px; text-align:left"/></td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>Actual Start Date:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><input class="rr_input" name="activity_act_start_date" value="<?php if($actual_stardate!="")
 echo date('Y-m-d',strtotime($actual_stardate));?>" type="text" id="activity_act_start_date" size="40"  
 style="width:100px; text-align:left"/></td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>Actual End Date:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><input class="rr_input" name="activity_act_end_date" value="<?php if($actual_enddate!="")
 echo date('Y-m-d',strtotime($actual_enddate));?>" type="text" id="activity_act_end_date" size="40"  
 style="width:100px; text-align:left"/></td>
</tr>
<tr >
  <td width="142" align="left" valign="middle"  >
    <strong>Assigned Weight</strong></td>
  <td width="410" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
    <input class="rr_input" name="assig" value="<?php if($assig!="")
 echo $assig;?>" type="text" id="assig" size="40"  
 style="width:100px; text-align:left"/> </td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>Order:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><input class="rr_input" name="order" value="<?php if($order!="")
 echo $order;?>" type="text" id="order" size="40"  
 style="width:100px; text-align:left"/></td>
</tr>
<tr>
  <td >&nbsp;</td>
  <td>
    
    
    <input type="hidden" id="aid" name="aid" value="<?php echo $aid;?>"  />
      <input type="hidden" id="mode" name="mode" value="<?php echo $mode;?>"  />
    </td>
</tr>
<tr >
<td style="padding-top:20px; padding-right:350px" colspan="2" align="center">
<input type="submit" value="<?php echo ($mode == "U") ? " Update " : " Save ";?>" name="add_activity"   id="uLogin"/>
</td>
</tr>
<tr>
<td colspan="2"></td>
</tr>

</table>
</form>
</div>

</div>


