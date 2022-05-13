<?php 
if($objAdminUser->is_login== false){
	header("location: index.php");
}

?>
<?php
$mode	= "I";

if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	  $code 		= trim($_POST['code']);
	  $detail 	= trim($_POST['detail']);
	  $start_date = trim($_POST['start_date']);
	  $end_date 	= trim($_POST['end_date']);
	  $pamount 	= trim($_POST['pamount']);
	  $mode=$_POST['mode'];
	  $pid=$_POST['pid'];
	$vResult = array();
	if(empty($_POST['code'])){
		
		$objCommon->setMessage("Code is required ", 'Valid');
		redirect('./?p=projects-cms');
	}
	
	if(!$vResult){
		echo $pid = ($_POST['mode'] == "U") ? $_POST['pid'] : $objAdminUser->genCode("project", "pid");
		$objProduct->setProperty("pid",   $pid);
		$objProduct->setProperty("code", $code);
		$objProduct->setProperty("detail", $detail);
		$objProduct->setProperty("pstartdate", $start_date);
		$objProduct->setProperty("penddate", $end_date);
		$objProduct->setProperty("pamount", $pamount);
	
		if($objProduct->actProject($mode)){
		 $objProduct->getSQL();
			if($_POST['mode']=="U")
			{
			$objCommon->setMessage("Project Updated successfully", 'Update');
			}
			else
			{
			$objCommon->setMessage("New Project added successfully", 'Info');
			}
			redirect('./?p=projects');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['pid']) && !empty($_GET['pid']))
		$pid = $_GET['pid'];
	else if(isset($_POST['pid']) && !empty($_POST['pid']))
		$pid = $_POST['pid'];
	if(isset($pid) && !empty($pid)){
		$objProduct->setProperty("pid", $pid);
		$objProduct->lstProject();
		$data = $objProduct->dbFetchArray(1);
		$mode	= "U";
		extract($data);
		
	
	}
}
?>
<div id="wrapperPRight">
		<div id="pageContentName" class="shadowWhite"><?php echo ($mode == "U") ? "Update Project" : "Add New Project";?></div>
		
		<div class="clear"></div>
	<?php echo $objCommon->displayMessage();?>
		<div class="clear"></div>
		<div class="NoteTxt"><?php echo _NOTE;?></div>
		<div id="tableContainer">
		
			<div class="clear"></div>
<table width="566"  align="left" cellpadding="0px" cellspacing="4px" style="border:0px ;  padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:normal">
<form action="" method="post" name="project_form" id="project_form" onSubmit="return frmValidate(this);">

<tr >
<td width="142" align="left" valign="middle"  >
 <strong>Code: </strong></td>
<td width="410" align="left" valign="middle" style="border:0px ; margin:5px; padding:5px; font-family: