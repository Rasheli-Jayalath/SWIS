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
	  $type = trim($_POST['type']);
	  $pid 	= trim($_POST['pid']);
	  $mode =$_POST['mode'];
	
	$vResult = array();
	if(empty($_POST['code'])){
		
		$objCommon->setMessage("Code is required ", 'Valid');
		redirect('./?p=components-cms');
	}
	
	if(!$vResult){
		$cid = ($_POST['mode'] == "U") ? $_POST['cid'] : $objAdminUser->genCode("components", "cid");
		$objProduct->setProperty("cid",   $cid);
		$objProduct->setProperty("pid",   $pid);
		$objProduct->setProperty("code", $code);
		$objProduct->setProperty("detail", $detail);
		$objProduct->setProperty("assig", $assig);
		$objProduct->setProperty("type", $type);
		
	
		if($objProduct->actComponent($mode)){
		echo $objProduct->getSQL();
			if($_POST['mode']=="U")
			{
			$objCommon->setMessage("Component Updated successfully", 'Update');
			}
			else
			{
			$objCommon->setMessage("New Component added successfully", 'Info');
			}
			redirect('./?p=components');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['cid']) && !empty($_GET['cid']))
		$cid = $_GET['cid'];
	else if(isset($_POST['cid']) && !empty($_POST['cid']))
		$cid = $_POST['cid'];
	if(isset($cid) && !empty($cid)){
		$objProduct->setProperty("cid", $cid);
		$objProduct->lstComponent();
		$data = $objProduct->dbFetchArray(1);
		$mode	= "U";
		extract($data);
		
	
	}
}
?>
<div id="wrapperPRight">
		<div id="pageContentName" class="shadowWhite"><?php echo ($mode == "U") ? "Update Component" : "Add New Component";?></div>
		
		<div class="clear"></div>
	<?php echo $objCommon->displayMessage();?>
		<div class="clear"></div>
		<div class="NoteTxt"><?php echo _NOTE;?></div>
		<div id="tableContainer">
		
			<div class="clear"></div>
<table width="566"  align="left" cellpadding="0px" cellspacing="4px" style="border:0px ;  padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal">
<form action="" method="post" name="component_form" id="component_form" onSubmit="return frmValidate(this);">

<tr >
  <td align="left" valign="middle"  ><strong>Project:</strong></td>
  <td align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
 	 <select name="pid" id="pid"  style="width:200px;" >
			<option value=""  selected="selected">--- Projects---</option>
			<?php
			echo $objProduct->ProjectCombo($pid);
			?>
		</select></td>
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
 <input class="rr_input" name="assig" value="<?php if($assig!=NULL)
 echo $assig;?>" type="text" id="assig" size="40"  
 style="width:100px; text-align:left"/> </td>
</tr>
<tr >
  <td width="142" align="left" valign="middle"  >
    <strong>Component Type: </strong></td>
  <td width="410" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal" >
     <input class="rr_input" type="radio" name="type" id="type" 
            value="1" <?php if($type==2)
 {?>checked="checked" <?php }?>/>Non-Civilwork
            <input class="rr_input" type="radio" name="type" id="type" 
            value="2"  <?php if($type==1)
 {?>checked="checked" <?php }?>/>Civilwork </td>
</tr>
<tr>
  <td >&nbsp;</td>
  <td>
    
  
    <input type="hidden" id="cid" name="cid" value="<?php echo $cid;?>"  />
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
</form>
</table>
</div>

</div>


