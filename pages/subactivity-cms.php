<?php 
 
if($objAdminUser->is_login== false){
	header("location: index.php");
}

?>
<?php
$mode	= "I";
$objProductT= new Product();
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	 $aid = trim($_POST['aid']);
	 $sa_id = trim($_POST['sa_id']);
	 $btid = trim($_POST['btid']);
	 $code = trim($_POST['code']);
	 $detail = trim($_POST['detail']);
	 $unit = trim($_POST['unit']);
	 $uom = trim($_POST['uom']);
	 $bid = trim($_POST['bid']);
	 $targets = trim($_POST['targets']);
	 $mode =$_POST['mode'];
	
	$vResult = array();
	if(empty($_POST['code'])){
		
		$objCommon->setMessage("Code is required ", 'Valid');
		redirect('./?p=subactivity-cms');
	}
	
	if(!$vResult){
		$sa_id = ($_POST['mode'] == "U") ? $_POST['sa_id'] : $objAdminUser->genCode("mis_tbl_5_milstone_units", "sa_id");
		$btid = ($_POST['mode'] == "U") ? $_POST['btid'] : $objAdminUser->genCode("mis_tbl_5_units_targets", "btid");
		$objProduct->setProperty("sa_id",   $sa_id);
		$objProduct->setProperty("aid",  $aid);
		$objProduct->setProperty("code",  $code);
		$objProduct->setProperty("detail",$detail);
		$objProduct->setProperty("unit", $unit);
		$objProduct->setProperty("uom", $uom);
		$objProductT->setProperty("btid", $btid);
		$objProductT->setProperty("bid", $bid);
		$objProductT->setProperty("sa_id", $sa_id);
		$objProductT->setProperty("targets",$targets);
		
		if($objProduct->actSubActivity($mode)){
			$objProductT->actMilestoneUnitTarget($mode);
			
			if($_POST['mode']=="U")
			{
			$objCommon->setMessage("Milestone Item Updated successfully", 'Update');
			}
			else
			{
			$objCommon->setMessage("New Milestone Item added successfully", 'Info');
			}
			redirect('./?p=subactivities');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['sa_id']) && !empty($_GET['sa_id']))
		$sa_id = $_GET['sa_id'];
	else if(isset($_POST['sa_id']) && !empty($_POST['sa_id']))
		$sa_id= $_POST['sa_id'];
	if(isset($sa_id) && !empty($sa_id)){
		$objProduct->setProperty("sa_id", $sa_id);
		$objProduct->lstSubActivities();
		$data = $objProduct->dbFetchArray(1);
		$mode	= "U";
		extract($data);
		
		
		$objProduct->setProperty("aid", $aid);
		$objProduct->lstSubActivitiesData();
		$sub_act_data = $objProduct->dbFetchArray(1);
	
	}
}
?>
<!--<script>
/*function getXMLHTTP() { //fuction to return the xml http object
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
    }*/
	function getXMLHttp()
{
  var xmlHttp

  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}
function getactivity(subcomponentid)
{
  
  
  var xmlHttp = getXMLHttp();

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
      getactivityResponse(xmlHttp.responseText);
    }
  }

  xmlHttp.open("GET", "findactivity-cms.php?subcomponent="+subcomponentid, true); 
  xmlHttp.send(null);
}
function getactivityResponse(response)
{
  document.getElementById('activitydiv').innerHTML = response;
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
	

function getsubcomponent(activitytypeid, componentid) {	
		
		if (activitytypeid!=0) {
		var strURL="findsubcomponent-cms.php?activitytype="+activitytypeid+"&component="+componentid;
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
		} 	
	}
/*function getactivity(subcomponentid) {		
		if (subcomponentid!=0) {
			var strURL="findactivity-cms.php?subcomponent="+subcomponentid;
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
		} 	
	}*/
	
/*function getsubactivity(activityid) {
		alert(activityid);
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
		} 
	}*/
</script>-->
<script language="javascript" type="text/javascript">
function getXMLHttp()
{
  var xmlHttp

  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}
	function getactivity(subcomponentid)
{
  
  
  var xmlHttp = getXMLHttp();

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
      getactivityResponse(xmlHttp.responseText);
    }
  }

  xmlHttp.open("GET", "findactivity-cms.php?subcomponent="+subcomponentid, true); 
  xmlHttp.send(null);
}
function getactivityResponse(response)
{
  document.getElementById('activitydiv').innerHTML = response;
}
function getsubcomponent(componentid)
{
  	var xmlHttp = getXMLHttp();

  	xmlHttp.onreadystatechange = function()
 	 {
   	 if(xmlHttp.readyState == 4)
    	{
      	getsubcomponentResponse(xmlHttp.responseText);
    	}
 	 }

  	xmlHttp.open("GET", "findsubcomponent-cms.php?component="+componentid, true); 
  	xmlHttp.send(null);
}
function getsubcomponentResponse(response)
{
  document.getElementById('subcomponentdiv').innerHTML = response;
}



function getactivitytype(componentid)
{
  	var xmlHttp = getXMLHttp();

  	xmlHttp.onreadystatechange = function()
 	 {
   	 if(xmlHttp.readyState == 4)
    	{
      	getactivitytypeResponse(xmlHttp.responseText);
    	}
 	 }

  	xmlHttp.open("GET", "findactivitytype-cms.php?component="+componentid, true); 
  	xmlHttp.send(null);
}
function getactivitytypeResponse(response)
{
  document.getElementById('activitytypediv').innerHTML = response;
}

	
function getcomponent(projectid)
{
  	
	var xmlHttp = getXMLHttp();

  	xmlHttp.onreadystatechange = function()
 	 {
   	 if(xmlHttp.readyState == 4)
    	{
      	getcomponentResponse(xmlHttp.responseText);
    	}
 	 }

  	
	 xmlHttp.open("GET", "findcomponent-cms.php?project="+projectid, true); 
  	xmlHttp.send(null);
}
function getcomponentResponse(response)
{
  //alert("hello");
  document.getElementById('componentdiv').innerHTML = response;
}
</script>
<div id="wrapperPRight">
		<div id="pageContentName" class="shadowWhite"><?php echo ($mode == "U") ? "Update Milestone Items" : "Add New Milestone Items";?></div>
		
		<div class="clear"></div>
	<?php echo $objCommon->displayMessage();?>
		<div class="clear"></div>
		<div class="NoteTxt"><?php echo _NOTE;?></div>
		<div id="tableContainer">
		
			<div class="clear"></div>
             <form method="post" name="test" id="test" action="">
<table width="566"  align="left" cellpadding="0px" cellspacing="4px" style="border:0px ;  padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal">


<tr >
  <td align="left" valign="middle"  ><strong>Project:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><select name="pid" id="pid"  style="width:200px;" onchange="getcomponent(this.value)" >
    <option value=""  selected="selected">Projects..</option>
    <?php
			echo $objProduct->ProjectCombo($sub_act_data["pid"]);
			?>
  </select></td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>Component:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><div id="componentdiv">
    <select name="cid" id="cid"  style="width:200px;" >
      <option value=""  selected="selected" onchange="getsubcomponent(this.value);">Components..</option>
      <?php
			echo $objProduct->ComponentCombo($sub_act_data["cid"]);
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

echo $objProduct->SubComponentCombo($sub_act_data["s_id"]);
?>
    </select>
  </div></td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>Activity:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><div id="activitydiv">
    <select name="aid" id="aid" >
      <option value="0">Activity..</option>
      <?php

echo $objProduct->ActivityCombo($sub_act_data["aid"]);
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
  <td align="left" valign="middle"  ><strong>Unit:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
  <input class="rr_input" name="unit" value="<?php if($unit!="")
 echo $unit;?>" type="text" id="unit" size="40"  
 style="width:100px; text-align:left"/></td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>UOM:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><input class="rr_input" name="uom" value="<?php if($uom!="")
 echo $uom;?>" type="text" id="uom" size="40"  
 style="width:100px; text-align:left"/></td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>Target Month:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
  <select name="bid" id="bid"  style="width:150px">
<option value="0" selected="selected"> Month..</option>
<?php
$squery = "SELECT * FROM mis_tbl_6_progressmonth";
$sresult = mysql_query($squery);
$bid=$sdata['bid'];
while ($sdata = mysql_fetch_array($sresult)) {
$time = strtotime($sdata['bdate']);
$Date = date( 'F, Y', $time );
?>
<option value="<?php echo $sdata['bid']; ?>"  <?php if($sdata['bid']==$data['bid']){?> selected="selected"<?php }?>><?php echo $Date; ?></option>
<?php
}
?>
</select></td>
</tr>
<tr >
  <td align="left" valign="middle"  ><strong>Targets:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" ><input class="rr_input" name="targets" value="<?php if($data["targets"]!="")
 echo $data["targets"];?>" type="text" id="targets" size="40"  
 style="width:100px; text-align:left"/></td>
</tr>

<tr>
  <td >&nbsp;</td>
  <td>
    
    
    <input type="hidden" id="sa_id" name="sa_id" value="<?php echo $sa_id;?>"  />
    <input type="hidden" id="btid" name="btid" value="<?php echo $btid;?>"  />
      <input type="hidden" id="mode" name="mode" value="<?php echo $mode;?>"  />
    </td>
</tr>
<tr >
<td style="padding-top:20px; padding-right:350px" colspan="2" align="center">
<input type="submit" value="<?php echo ($mode == "U") ? " Update " : " Save ";?>" name="add_subactivity"   id="uLogin"/>
</td>
</tr>
<tr>
<td colspan="2"></td>
</tr>

</table>
</form>

</div>

</div>


