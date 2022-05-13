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
		//echo $objProduct->getSQL();
			if($_POST['mode']=="U")
			{
			$objCommon->setMessage("Project Updated successfully", 'Update');
			}
			else
			{
			$objCommon->setMessage("New Project added successfully", 'Info');
			}
			redirect('./?p=projects-cms');
		}
	}
	extract($_POST);
}
else{
	if(isset($_GET['account_id']) && !empty($_GET['account_id']))
		$account_id = $_GET['account_id'];
	else if(isset($_POST['account_id']) && !empty($_POST['account_id']))
		$account_id = $_POST['account_id'];
	if(isset($account_id) && !empty($account_id)){
		$objProduct->setProperty("account_id", $account_id);
		$objProduct->lstAccount();
		$data = $objProduct->dbFetchArray(1);
		$mode	= "U";
		extract($data);
		
	}
}
?>
<div id="wrapperPRight">
		<div id="pageContentName" class="shadowWhite"><?php echo "Milestones";?></div>
		
		<div class="clear"></div>
	<?php echo $objCommon->displayMessage();?>
		<div class="clear"></div>
		<div class="NoteTxt"><?php echo _NOTE;?></div>
		  <div id="containerContent" class="box" style="padding:0px">
          <div id="pageContentRight" style="float:right; padding:0; margin:0px">
        
			<div class="menu1" style="padding:0">
				<ul >
				<li><a href="./?p=activity-cms"  ><?php echo "Add Milestone";?></a></li>				
				</ul>
				
			</div>
		</div>
          <div id="tableContainer" class="table">
		
			<div class="clear"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr >
        <th width="7%" style="text-align:left"><?php echo 'S-Code';?></th>
		<th width="7%" style="text-align:left"><?php echo 'M-Code';?></th>
        <th width="37%" style="text-align:left"><?php echo 'Milestone';?></th>
        <th width="35%" style="text-align:left"><?php echo 'Sub-Component';?></th>	
         <th width="2%" style="text-align:left"><?php echo 'Assigned Weight';?></th>
		
		<th colspan="2">Action</th>
		</tr>
           
			 <?php
			 $objProductM=new Product();
			 
	$objProductM->resetProperty();
	$objProductM->setProperty("limit", PERPAGE);

	$objProductM->lstActivities();
	$SqlM = $objProductM->getSQL();
	if($objProductM->totalRecords() >= 1){
		while($rows = $objProductM->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			
			?>
			<!-- Start Your Php Code her For Display Record's -->
			<tr bgcolor="<?php echo $bgcolor;?>">
				<td><?php echo $rows['scode'];?></td>
                <td><?php echo $rows['code'];?></td>
				<td><?php echo $rows['detail'];?></td>
                <td><?php echo $rows['subcomponent'];?></td>
				<td ><?php echo $rows['assig'];?></td>
                	
			<td width="2%" align="center">
					<a href="./?p=activity-cms&aid=<?php echo $rows['aid'];?>" title
					="header=[Modify Record] body=[&nbsp;] fade=[on]">
					<img src="images/iconedit.png" width="16" height="16" alt="" /></a></td>
					<td width="10%" align="center">
					<a href="./?p=activity-cms&mode=Delete&aid=<?php echo $rows['aid'];?>" onClick="return doConfirm('Are you sure you want to delete this Activity? ');" title="header=[Delete Record] body=[&nbsp;] fade=[on]">
				<img src="images/icondelete.png" width="16" height="16" alt="" /></a>
				</td>
				</tr>
			<?php
			
		}
    }?>
    <tr><td colspan="7" style="padding:0"><div id="tblFooter">
			<?php
if($objProductM->totalRecords() >= 1){
	$objPaginate = new Paginate($SqlM, PERPAGE, OFFSET, "./?p=activities");
	?>
	
	<div style="float:left;width:190px;font-weight:bold"><?php $objPaginate->recordMessage();?></div>
	<div id="paging" style="float:right;text-align:right; padding-right:5px;  font-weight:bold">
	    <?php $objPaginate->showpages();?>
	</div>
<?php }?>
			</div></td></tr>
      
			</table>
</div>

</div></div>


