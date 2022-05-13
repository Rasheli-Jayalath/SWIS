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
				$dpr_vid = $_GET['dpr_vid'];
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
					$sdelete= "Delete from tbl_dpr_village where dpr_vid=".$dpr_vid;
	   mysql_query($sdelete);
	if ($sdelete == TRUE) {
    $message=  "Record deleted successfully";
	} else {
    $message= mysql_error($db);
	}
				
						redirect('/SWIS/?p=add_report&unique_id='.'$dcode'.'$tcode'.'$vcode');
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
        $target = "../DPRS/" . $target_file;	
	if(move_uploaded_file($_FILES['al_file']['tmp_name'],$target))
	{
		

	echo $sql_query="insert into tbl_dpr_village (dpr_vid, dcode, tcode, vcode, image_name_eng, item_name, item_date) 
	values('".$dpr_vid."',".$dcode.", '".$tcode."', '".$vcode."', '".$image_name_eng1."', '".$file_name."', '".$dwg_date."')";
	$sql_pro=mysql_query($sql_query);
	if ($sql_pro == TRUE) {
    $message=  "New record added successfully";
	} else {
    $message= "Select file";
	}
	}
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
        $target = "../DPRS/" . $load_file;	
	 $file_name=$loadfile;
   
	if( 
	($_FILES["al_file"]["type"] == "application/pdf")|| 
	($_FILES["al_file"]["type"] == "application/vnd.ms-excel")|| 
	($_FILES["al_file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") || 
	($_FILES["al_file"]["type"] == "text/csv"))
	{ 
	$target_file=$file_path.$file_name;
        $target = "../DPRS/" . $target_file;	
	if(move_uploaded_file($_FILES['al_file']['tmp_name'],$target))
	{
			
    $sql_pro="UPDATE tbl_dpr_village set dpr_vid = '".$dpr_vid."', dcode = '".$dcode."', tcode = '".$tcode."', vcode = '".$vcode."', image_name_eng = '".$image_name_eng1."'  item_name = '".$file_name."', item_date = '".$dwg_date."' where dpr_vid=".$dpr_vid;
	
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
$sql_pro="UPDATE tbl_dpr_village set dpr_vid = '".$dpr_vid."', dcode = '".$dcode."', tcode = '".$tcode."', vcode = '".$vcode."', image_name_eng = '".$image_name_eng1."'  item_name = '".$file_name."', item_date = '".$dwg_date."' where dpr_vid=".$dpr_vid;
	$sql_proresult=mysql_query($sql_pro) or die(mysql_error());
	
		if ($sql_proresult == TRUE) {
		$message=  "Record updated successfully";
	} else {
		$message= mysql_error($db);
	}
	}
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
	
	if(flag == false){
		alert(msg);
		return false;
	}
}
 </script>
 <script>
  $(function() {
	
    $( "#dwg_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	
  });
   


</script>
<section>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card" id="tableContainer">
					<div class="card-body">
						<h5 class="card-title" style="text-align:center"><strong><?php echo "Upload Report"; ?></strong></h5></br></br>
						<h6 class="card-subtitle mb-2 text-muted"><?php echo _NOTE; ?></h6>
                              <?php if(!empty($message)) { ?>
						<h6 class="card-subtitle mb-2 text-muted"><?php echo $message; ?></h6>
    <?php }?>
					</div>
					<?php echo $objCommon->displayMessage(); ?>
					<form action="" method="post" name="boqlevel" id="boqlevel" enctype="multipart/form-data" onSubmit="return frmValidate(this);" class="form-horizontal">
						<div class="form-group row">
							<label for="first_name" class="col-sm-3 col-form-label">File Name</label>
							<div class="col-sm-9" id="componentdiv">
							<input class="custom-select d-block w-100" type="text" name="image_name_eng" id="image_name_eng" 
                            value="<?php echo $image_name_eng; ?>" />
                            </div>
						</div>
						<div class="form-group row">
							<label for="last_name" class="col-sm-3 col-form-label">Upload Date</label>
							<div class="col-sm-9" id="subcomponentdiv">
							<input class="custom-select d-block w-100" type="text" id="dwg_date"  name="dwg_date"  value="<?php echo $dwg_date;?>"/>
                            </div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Upload File</label>
							<div class="col-sm-9">
							<input class="form-control-file" type="file" name="al_file" id="al_file" value="<?php echo $al_file; ?>" />
                            </div>
						</div>
						<div class="card-footer">
                        <input style="margin-left:10px" class="btn btn-primary float-right" id="btn-submit" type=button onClick="parent.location='detail_link.php?gps_id=<?php echo $gps_id?>'" value='<?php echo "Cancel"?>'>
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