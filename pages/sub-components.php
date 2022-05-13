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
		$pid = ($_POST['mode'] == "U") ? $_POST['pid'] : $objAdminUser->genCode("project", "pid");
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

?>
<div id="wrapperPRight">
		<div id="pageContentName" class="shadowWhite"><?php echo "Sub-Components";?></div>
		
		<div class="clear"></div>
	<?php echo $objCommon->displayMessage();?>
		<div class="clear"></div>
		<div class="NoteTxt"><?php echo _NOTE;?></div>
		  <div id="containerContent" class="box" style="padding:0px">
          <div id="tableContainer" class="table">
		
			<div class="clear"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr >
		<th width="8%" style="text-align:left"><?php echo 'C-Code';?></th>
        <th width="42%" style="text-align:left"><?php echo 'Component';?></th>
        <th width="9%" style="text-align:left"><?php echo 'S-Code';?></th>
        <th width="33%" style="text-align:left"><?php echo 'Sub-Component';?></th>
        <th width="2%" style="text-align:left"><?php echo 'Assigned Weight';?></th>
		
		<th colspan="2">Action</th>
		</tr>
           
			 <?php
			 $objProductM=new Product();
			 
	$objProductM->resetProperty();
	$objProductM->setProperty("limit", PERPAGE);

	$objProductM->lstSubComponent();
	$SqlM = $objProductM->getSQL();
	if($objProductM->totalRecords() >= 1){
		while($rows = $objProductM->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			
			?>
			<!-- Start Your Php Code her For Display Record's -->
			<tr bgcolor="<?php echo $bgcolor;?>">
            <td><?php echo $rows['c_code'];?></td>
             <td><?php echo $rows['component'];?></td>
				<td><?php echo $rows['code'];?></td>
				<td><?php echo $rows['detail'];?></td>
                <td ><?php echo $rows['assig'];?></td>
                	
			<td width="2%" align="center">
					<a href="./?p=sub-components-cms&s_id=<?php echo $rows['s_id'];?>" title
					="header=[Modify Record] body=[&nbsp;] fade=[on]">
					<img src="images/iconedit.png" width="16" height="16" alt="" /></a></td>
					<td width="4%" align="center">
					<a href="./?p=subcomponents-cms&mode=Delete&s_id=<?php echo $rows['s_id'];?>" 
                    onClick="return doConfirm('Are you sure you want to delete this Sub-Component? ');" title="header=[Delete Record] body=[&nbsp;] fade=[on]">
				<img src="images/icondelete.png" width="16" height="16" alt="" /></a>
				</td>
				</tr>
			<?php
			
		}
    }?>
    <tr><td colspan="7" style="padding:0"><div id="tblFooter">
			<?php
if($objProductM->totalRecords() >= 1){
	$objPaginate = new Paginate($SqlM, PERPAGE, OFFSET, "./?p=sub-components");
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


