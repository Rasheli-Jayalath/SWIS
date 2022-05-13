<?php 
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
	  $cid = trim($_POST['cid']);
	  $pid 	= trim($_POST['pid']);
	  $mode =$_POST['mode'];
	
	$vResult = array();
	if(empty($_POST['code'])){
		
		$objCommon->setMessage("Code is required ", 'Valid');
		redirect('./?p=sub-components-cms');
	}
	
	if(!$vResult){
		$s_id = ($_POST['mode'] == "U") ? $_POST['s_id'] : $objAdminUser->genCode("mis_tbl_3_subcomponents", "s_id");
		$objProduct->setProperty("s_id",   $s_id);
		/*$objProduct->setProperty("pid",   $pid);*/
		$objProduct->setProperty("cid",   $cid);
		$objProduct->setProperty("code", $code);
		$objProduct->setProperty("detail", $detail);
		$objProduct->setProperty("assig", $assig);
	
		if($objProduct->actSubComponent($mode)){
		//echo $objProduct->getSQL();
			if($_POST['mode']=="U")
			{
			$objCommon->setMessage("Sub Component Updated successfully", 'Update');
			}
			else
			{
			$objCommon->setMessage("New Sub Component added successfully", 'Info');
			}
			redirect('./?p=sub-components');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['s_id']) && !empty($_GET['s_id']))
		$s_id = $_GET['s_id'];
	else if(isset($_POST['s_id']) && !empty($_POST['s_id']))
		$s_id= $_POST['s_id'];
	if(isset($s_id) && !empty($s_id)){
		$objProduct->setProperty("s_id", $s_id);
		$objProduct->lstSubComponent();
		//echo $objProduct->getSQL();
		$data = $objProduct->dbFetchArray(1);
		$mode	= "U";
		extract($data);
		//echo $data["pid"];
		////echo "<br/>";
		///echo $data["cid"];
	
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
	
	/*function getactivitytype(componentid) {		

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
	}*/
</script>
<div id="wrapperPRight">
		<div id="pageContentName" class="shadowWhite"><?php echo ($mode == "U") ? "Update Sub Component" : "Add New Sub Component";?></div>
		
		<div class="clear"></div>
	<?php echo $objCommon->displayMessage();?>
		<div class="clear"></div>
		<div class="NoteTxt"><?php echo _NOTE;?></div>
		<div id="tableContainer">
		
			<div class="clear"></div>
            <form action="" method="post" name="subcomponent_form" id="subcomponent_form" onSubmit="return frmValidate(this);">
<table width="566"  align="left" cellpadding="0px" cellspacing="4px" style="border:0px ;  padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal">


<tr >
  <td align="left" valign="middle"  ><strong>Project:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
  <select name="pid" id="pid"  style="width:200px;" onchange="getcomponent(this.value)" >
    <option value=""  selected="selected">Projects..</option>
    <?php
			echo $objProduct->ProjectCombo($pid);
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
			echo $objProduct->ComponentCombo($cid);
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
    <strong>Assigned Weight</strong></td>
  <td width="410" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
    <input class="rr_input" name="assig" value="<?php if($assig!="")
 echo $assig;?>" type="text" id="assig" size="40"  
 style="width:100px; text-align:left"/> </td>
</tr>
<tr>
  <td >&nbsp;</td>
  <td>
    
    
    <input type="hidden" id="s_id" name="s_id" value="<?php echo $s_id;?>"  />
      <input type="hidden" id="mode" name="mode" value="<?php echo $mode;?>"  />
    </td>
</tr>
<tr >
<td style="padding-top:20px; padding-right:350px" colspan="2" align="center">
<input type="submit" value="<?php echo ($mode == "U") ? " Update " : " Save ";?>" name="add_component"   id="uLogin"/>
</td>
</tr>
<tr>
<td colspan="2"></td>
</tr>

</table>
</form>
</div>

</div>


