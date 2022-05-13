<?php
if ($objAdminUser->is_login == false) {
	header("location: index.php");
}


if (isset($_REQUEST['unique_id'])) {
	$unique_id = $_REQUEST['unique_id'];
	$dcode=substr($unique_id,0,2);
	$tcode=substr($unique_id,2,2);
	$vcode=substr($unique_id,4,4);
}




function getExtention($type){
	if($type == "application/pdf" || $type == "application/vnd.ms-excel" || $type =="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
		return "pdf";
	elseif($type == "application/vnd.ms-excel")
		return "xls";
	elseif($type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
		return "xlsx";
	elseif($type == "text/csv")
		return "csv";
}
$editflag = 0;
if(isset($_REQUEST['dpr_vid']))
{
	
$dpr_vid=$_REQUEST['dpr_vid'];
$pdSQL1="select * from tbl_dpr_village where dpr_vid = ".$dpr_vid;
$pdSQLResult1 = mysql_query($pdSQL1) or die(mysql_error());
$pdData1 = mysql_fetch_array($pdSQLResult1);
$dpr_vid1=$pdData1['dpr_vid'];
$al_file=$pdData1['item_name'];
	$dwg_date=$pdData1['item_date'];
	$image_name_eng=$pdData1['image_name_eng'];
	$editflag = 1;
	
}


if(isset($_GET['mode']) && $_GET['mode'] == "delete"){
				$dpid = $_GET['dpid'];
				$pdSQL = "select * from tbl_dpr_village where dpr_vid = ".$dpid;
$pdSQLResult = mysql_query($pdSQL);
$sql_num=mysql_num_rows($pdSQLResult);
$pdData = mysql_fetch_array($pdSQLResult);
$dpid=$_REQUEST['dpid'];
$old_al_file= $pdData["item_name"];
		if($old_al_file){
			if(isset($_FILES["al_file"]["name"])&&$_FILES["al_file"]["name"]!="")
			{			
				@unlink("DPRS/" .$old_al_file);
			}
					
				}
					 $sdelete= "Delete from tbl_dpr_village where dpr_vid=".$dpid;
	   mysql_query($sdelete);
				
	header("Location: /SWIS/?p=add_report&unique_id=".$dcode.$tcode.$vcode);
					}				
	if ($sdelete == TRUE) {
    $message=  "Record deleted successfully";
	} else {
    $message= mysql_error($db);
	}

/*$size=50;
$max_size=($size * 1024 * 1024);*/
if(isset($_REQUEST['save']))
{ 
    //$dwg_no=$_REQUEST['dwg_no'];
	//$dwg_title=($_REQUEST['dwg_title']);
	$dwg_date=$_REQUEST['dwg_date'];
	//$dwg_status=$_REQUEST['dwg_status'];
	$image_name_eng1=$_REQUEST['image_name_eng'];
		
	if(isset($_FILES["al_file"]["name"])&&$_FILES["al_file"]["name"]!="")
	{
	$extension=getExtention($_FILES["al_file"]["type"]);
	$loadfile = basename($_FILES["al_file"]["name"]);
        $target = "../DPRS/" . $load_file;	
	$file_name=$loadfile;
   
	if( 
	($_FILES["al_file"]["type"] == "application/pdf")|| 
	($_FILES["al_file"]["type"] == "application/vnd.ms-excel")|| 
	($_FILES["al_file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") || 
	($_FILES["al_file"]["type"] == "text/csv"))
	{ 
	$target_file=$file_path.$file_name;
        $target = "DPRS/" . $target_file;	
	if(move_uploaded_file($_FILES['al_file']['tmp_name'],$target))
	{
	 $sql_query="insert into tbl_dpr_village (dcode, tcode, vcode, image_name_eng, item_name, item_date) 
	values('".$dcode."', '".$tcode."', '".$vcode."', '".$image_name_eng1."', '".$file_name."', '".$dwg_date."')";
	$sql_pro=mysql_query($sql_query);
	if ($sql_pro == TRUE) {
    $message=  "New record added successfully";
	} else {
    $message= "Select file";
	}
	}
	}
	else
	{
    $message=  "Invalid File Format";
	}	
	}
	$al_file='';
	//$dwg_title='';
	$dwg_date='';
	//$dwg_status='';
	$image_name_eng1='';
		
	//$image_name_rus='';
	//header("Location: /SWIS/?p=add_report&unique_id=$dcode$tcode$vcode");
	//header("Location: /SWIS/index.php");
	
}

if(isset($_REQUEST['update']))
{
	//$dwg_title=$_REQUEST['dwg_title'];
	$dwg_date=$_REQUEST['dwg_date'];
	//$dwg_status=$_REQUEST['dwg_status'];
	$image_name_eng1=$_REQUEST['image_name_eng'];		
$pdSQL = "select * from tbl_dpr_village where dpr_vid = ".$dpr_vid;
$pdSQLResult = mysql_query($pdSQL);
$sql_num=mysql_num_rows($pdSQLResult);
$pdData = mysql_fetch_array($pdSQLResult);
$dpr_vid=$_REQUEST['dpr_vid'];
$old_al_file= $pdData["item_name"];
		if($old_al_file){
			if(isset($_FILES["al_file"]["name"])&&$_FILES["al_file"]["name"]!="")
			{			
				@unlink("../DPRS/" .$old_al_file);
			}
					
				}

	if(isset($_FILES["al_file"]["name"])&&$_FILES["al_file"]["name"]!="")
	{
	$extension=getExtention($_FILES["al_file"]["type"]);
	$loadfile = basename($_FILES["al_file"]["name"]);
        $target = "DPRS/" . $load_file;	
	 $file_name=$loadfile;
   
	if( 
	($_FILES["al_file"]["type"] == "application/pdf")|| 
	($_FILES["al_file"]["type"] == "application/vnd.ms-excel")|| 
	($_FILES["al_file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") || 
	($_FILES["al_file"]["type"] == "text/csv"))
	{ 
	$target_file=$file_path.$file_name;
        $target = "DPRS/" . $target_file;	
	if(move_uploaded_file($_FILES['al_file']['tmp_name'],$target))
	{
			
    $sql_pro="UPDATE tbl_dpr_village set image_name_eng = '".$image_name_eng1."', item_name = '".$file_name."', item_date = '".$dwg_date."' where dpr_vid=".$dpr_vid;
	
	$sql_proresult=mysql_query($sql_pro) or die(mysql_error());
	
	
		if ($sql_proresult == TRUE) {
		$message=  "Record updated successfully";
	} else {
		$message= mysql_error($db);
	}
	}
	}
	else
	{
	echo "Invalid File Format";
	}
	}
	else
	{
$sql_pro="UPDATE tbl_dpr_village set image_name_eng = '".$image_name_eng1."', item_date = '".$dwg_date."' where dpr_vid=".$dpr_vid;
echo $unique_id;
	$sql_proresult=mysql_query($sql_pro) or die(mysql_error());
	
		if ($sql_proresult == TRUE) {
		$message=  "Record updated successfully";
	} else {
		$message= mysql_error($db);
	}
	}
							redirect("/SWIS/?p=add_report&unique_id=".$unique_id);

}

?>

<script language="javascript" type="text/javascript">
function frmValidate(frm){
	
	var msg = "<?php echo _JS_FORM_ERROR;?>\r\n-----------------------------------------";
	var flag = true;
	if(frm.image_name_eng.value == ""){
		msg = msg + "\r\n<?php echo "Please add File name";?>";
		flag = false;
	}

	if(frm.dwg_date.value == ""){
		msg = msg + "\r\n<?php echo "Please select Date";?>";
		flag = false;
	}

	if(frm.al_file.value == ""){
		msg = msg + "\r\n<?php echo "Please select File";?>";
		flag = false;
	}
	if(flag == false){
		alert(msg);
		return false;
	}
	
//var GivenDate = '2020-11-22';
//var CurrentDate = new Date();
//GivenDate = new Date(GivenDate);

//if(GivenDate > CurrentDate){
  //  alert('Given date is greater than the current date.');
//}

}

  $(function() {
	
    $( "#dwg_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	
  });
   

function closeWindow() {
window.close();
window.opener.location.reload();
}

</script>
<section>
	<div class="container">
				<div class="card" id="tableContainer">
		<div class="row justify-content-center">
			<div class="col-md-6">
					<div class="card-body">
						<h5 class="card-title" style="text-align:center"><strong><?php echo "Upload Report"; ?></strong></h5></br></br>
						<h6 class="card-subtitle mb-2 text-muted"><?php echo _NOTE; ?></h6>
					</div>
					<?php echo $objCommon->displayMessage(); ?>
					<form id="frm-image-upload" name='frm-image-upload'   method="post" action="" enctype="multipart/form-data" onSubmit="return frmValidate(this);" class="form-horizontal">
						<div class="form-group row">
							<label for="first_name" class="col-sm-3 col-form-label">File Name<span style="color:#FF0000;">*</span></label>
							<div class="col-sm-9" id="componentdiv">
							<input class="form-control" type="text" name="image_name_eng" id="image_name_eng" 
                            value="<?php echo $image_name_eng; ?>" />
                            </div>
						</div>
						<div class="form-group row">
							<label for="last_name" class="col-sm-3 col-form-label">Upload Date<span style="color:#FF0000;">*</span></label>
							<div class="col-sm-9" id="subcomponentdiv">
							<input class="form-control" type="date" id="dwg_date"  name="dwg_date"  value="<?php echo $dwg_date;?>"/>
                            </div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Upload File<span style="color:#FF0000;">*</span> 
                            <span style="color:#666; font-size:11px">(Only pdf, excel & csv) </span>
                            </label>
							<div class="col-sm-9">
							<input class="form-control-file" type="file" name="al_file" id="al_file" value="<?php echo $al_file; ?>" />
                            </div>
						</div>
						<div class="card-footer">
                                                      <?php if(!empty($message)) { ?>
						<h6 style="color:#0F3" class="card-subtitle mb-2 text-muted"><?php echo $message; ?></h6>
    <?php }?>

                        <input style="margin-left:10px" class="btn btn-primary float-right" id="btn-submit" type="button" 
                        onClick="javascript:closeWindow();" value='<?php echo "Cancel"?>'>
                          <?php if(isset($_REQUEST['dpr_vid']))
	 {
		 
	 ?>
     <input class="btn btn-primary float-right" type="hidden" name="dwgid" id="dwgid" value="<?php echo $_REQUEST['dwgid']; ?>" />
     <input class="btn btn-primary float-right" type="submit" name="update" id="btn-submit" value="Update" />
	 <?php
	 }
	 else
	 {
	 ?>
	 <input class="btn btn-primary float-right" type="submit" name="save" id="btn-submit" value="Save" />
	 <?php
	 }
	 ?> 
<!--							<input type="submit" class="btn btn-primary float-right" value="Save" id="Save" name="Save" />
-->						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>



<section>
	<div class="fluid-container p-2">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-info text-white">
						<h3 class="card-title"><?php echo "Reports Details" ?></h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped display responsive nowrap" style="width:100%">
							<thead>
								<tr>
									<th><?php echo "FILE NAME"; ?></th>
									<th><?php echo "UPLOAD DATE"; ?></th>
									<th><?php echo "ITEM NAME"; ?></th>
									<th><?php echo "PACKAGE NAME"; ?></th>
									<th><?php echo "DISTRICT NAME"; ?></th>
									<th><?php echo "VILLAGE NAME"; ?></th>
									<th><?php echo ACTION; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query4 = "SELECT * FROM tbl_dpr_village";
								//echo $query4;
								$result4 = mysql_query($query4);
								mysql_num_rows($result4);
								if (mysql_num_rows($result4) > 0) {
									while ($row4 = mysql_fetch_assoc($result4)) {
										//$did = $row4['dcode'];
										$cquery = mysql_query("select * from  p2001district where code=$dcode");
										$cdata = mysql_fetch_array($cquery);
										$dquery = mysql_query("select * from  p2002tehsil where code=$tcode");
										$ddata = mysql_fetch_array($dquery);
										$equery = mysql_query("select * from  p2003village where code=$vcode");
										$edata = mysql_fetch_array($equery);
										//echo $cdata['name'];
								?>
										<?php
										//$queryt = "SELECT * FROM tbl_dpr where dcode=$did group by tcode";
										//echo $query4;
										//$resultt = mysql_query($queryt);
										//mysql_num_rows($resultt);
										//if (mysql_num_rows($resultt) > 0) {
											//while ($rowt = mysql_fetch_assoc($resultt)) {
												//$tid = $rowt['tcode'];
												//$cquery1 = mysql_query("select * from  p2002tehsil where code=$tid");
												//$cdata1 = mysql_fetch_array($cquery1);
										?>
												<?php
												//$querytd = "SELECT * FROM tbl_dpr where dcode=$did and tcode=$tid";
												//echo $query4;
												//$resulttd = mysql_query($querytd);
												//mysql_num_rows($resulttd);
												//if (mysql_num_rows($resulttd) > 0) {
													//while ($rowtd = mysql_fetch_assoc($resulttd)) {
														//$total_villages = $rowtd['total_villages'];
														//$completed = $rowtd['completed'];
														//$percent_completed = $rowtd['percent_completed'];
														//$dprid = $rowtd['dprid'];
												?>
														<tr>
															<td><?php echo $row4['image_name_eng']; ?></td>
															<td><?php echo $row4['item_date']; ?></td>
															<td><?php echo $row4['item_name']; ?></td>
															<td><?php echo $cdata['name']; ?></td>
															<td><?php echo $ddata['tehsil']; ?></td>
															<td><?php echo $edata['village']; ?></td>
															<td><a class="btn btn-danger btn-md" onClick="return confirm('Are you sure you want to delete this file?');" name="delete" href="?p=add_report&mode=delete&dpid=<?php echo $row4['dpr_vid'];?>&unique_id=<?php echo $unique_id; ?>" title="<?php echo DELETE; ?>"><i class="fas fa-trash">
																			</i>
																		</a>
                                                            <a class="btn btn-info btn-md" href="?p=add_report&dpr_vid=<?php echo $row4['dpr_vid'];?>&unique_id=<?php echo $unique_id; ?>" 
                                                            title="<?php echo EDIT; ?>"><i class="fas fa-pencil-alt">
																			</i>
																		</a>
																	</td>
																<?php
																}
																?>
														</tr>
								<?php
													//}
												//}
											//}
										//}
									//}
								}
								?>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div>
</section>
