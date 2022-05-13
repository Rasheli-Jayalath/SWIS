<?php
////error_reporting(E_ALL & ~E_NOTICE);
require('requires/auth.php');
require_once("requires/Database.php");
$obj= new Database();

include("fckeditor/fckeditor.php");

if(isset($_POST['pid']))
{
//----------------------------------
$values['pid'] 			= trim($_POST['pid']);
$values['cid'] 			= trim($_POST['cid']);
$values['sid'] 			= trim($_POST['sid']);
$values['code'] 			= trim($_POST['code']);
$values['detail']		 =trim($_POST['detail']);
$values['assig']		 =trim($_POST['assig']);
if($_POST["action-type"] == "Save Record")

  {
  	
    $result = $obj->insert('subcomponents',$values);
  }
	else if($_POST["action-type"] == "Update Record") 
	{ 
	 $result = $obj->update('subcomponents',$values, 's_id='.$_POST["s_id"]);
	}
	echo "<script>self.location ='subcomponents.php';</script>";
}	
/*update process*/
if(isset($_GET['action']) && ($_GET['action'] == 'edit'))
{
	$btn = 'Update';  
	$rec = $obj->select('*','subcomponents', 's_id = '.$_GET['s_id'], '','');
	$data = mysql_fetch_array($rec);
	$s_id = $data['s_id'];
	$sid = $data['sid'];
	$cid = $data['cid'];
	$pid= $data['pid'];
	$code = $data['code'];
	$detail = $data['detail'];
	$assig = $data['assig'];
	$action = "Update Record";
	}
else 
{
	$btn = 'Save';
	$s_id = '';
	$sid = '';
	$cid = '';
	$pid = '';
	$code = '';
	$detail = '';
	$assig = '';
	}
	
/*del process*/
if(isset($_GET['action']) && ($_GET['action'] == 'delete'))
{
    		$sql = "delete from subcomponents  where s_id = '".$_GET["s_id"]."'";
    		mysql_query($sql) or die ("Cannot Delete the Record");
}	
else if ($action=='') {
	$action = "Save Record";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="menu/chromestyle.css"/>
<script type="text/javascript" src="menu/chrome.js"></script>
<head>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="datepicker/Jquery_ui/jquery.ui.all.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="datepicker/script/jquery-1.4.2.js"></script>
<script type="text/javascript" src="datepicker/script/jquery.ui.core.js"></script>
<script type="text/javascript" src="datepicker/script/jquery.ui.widget.js"></script>
<script type="text/javascript" src="datepicker/script/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="datepicker/script/jquery.ui.datepicker-fr.js"></script>
<script  language="javascript"  type="text/javascript" src="datepicker/script/calender/calender.js">  </script>
<script src="js/selectListProjectCode.js"></script>
<script src="js/selectListStructure.js"></script>
<script src="js/selectPage.js"></script>
<!--<script type="text/javascript" src="js/validation.js"></script>
<script language="javascript" type="text/javascript">
						function validateForm2(){
                        if(checkSelectBox("pid", "Select the Project Code"))
							{												
								return false;
							}
							else if(checkSelectBox("cid", "Select the Component"))
							{												
								return false;
							}
							else if(checkSelectBox("sid", "Select the Construction"))
							{												
								return false;
							}
						 else if(checkEmpty("code", "Code is Missing"))
							{												
								return false;
							}
						
							
							else if(checkEmpty("detail", "Description is Missing"))
							{												
								return false;
							}
						
							else 
							{	
								return true;
							}

						}

</script>-->

</head>
<body> 
<div id="wrap">
   <?php
     include 'includes/header.php';
   ?>

   <div id="content">
  <div class="title">Add Sub-Components</div><div id="error" class="whitemsg"></div>
      <br/>
     <form name="subcomponent" id="subcomponent" action="subcomponents.php"  method="post"  onsubmit="return validateForm2()">
     
     
	  <table width="100%" border="0" class="table" align="center">
  <tr>
    <th width="11%">Project Code:</th>
    <td width="24%" style="padding-left:6px;"> 
      <?php 
			  if($btn == 'Save')
			  {
			  ?>  	
<select name="pid" id="input" style="width:150px;" onchange="showComponent(this.value)">
						 <option>Select Project Code</option>
               	<?php 
				$qq = $obj->select('*','projectcode','','pid ASC','');
				while($aa = mysql_fetch_array($qq))
				{	
				?>									
<option value="<?php echo $aa['pid'];?>"> <?php echo $aa['detail'];?></option>
<?php
}
?>
</select>
<?php 
	}
				  
				  else
		  {
		  $rec6 = $obj->select('*','projectcode', 'pid='.$data['pid'], '','');
		$data6 = mysql_fetch_array($rec6);
		echo $data6['detail'];
		echo '<input name="pid" type="hidden" id="pid" value="'.$data6['pid'].'" />';
		  
		  }
				  ?></td>
    <th width="10%"> Component:</th>
	<td width="23%" style="padding-left:6px;"> <div id="part">
   <?php 
			  if($btn == 'Save')
			  {
			  ?> 
			  <select name="cid" id="input" style="width:150px;">
				 <option selected="selected">Select Component</option>
			  </select>
               <?php 
	}
				  
				  else
		  {
		  $rec6 = $obj->select('*','components', 'cid='.$data['cid'], '','');
		$data6 = mysql_fetch_array($rec6);
		echo $data6['detail'];
		echo '<input name="cid" type="hidden" id="cid" value="'.$data6['cid'].'" />';
		  
		  }
				  ?>
       	  </div>   </td>
     <th colspan="4"> Construction:</th>
	 <td width="22%" style="padding-left:6px;"> <div id="Construction">
             <?php 
			  if($btn == 'Save')
			  {
			  ?> 
	<select name="sid" id="input" style="width:150px;">
						 <option selected="selected">Select Construction</option>
              </select>
                  <?php 
	}
				  
				  else
		  {
		  $rec6 = $obj->select('*','structure', 'sid='.$data['sid'], '','');
		$data6 = mysql_fetch_array($rec6);
		echo $data6['detail'];
		echo '<input name="sid" type="hidden" id="sid" value="'.$data6['sid'].'" />';
		  
		  }
				  ?>
          </div></td>
     </tr>  
  
</table>
<br/>
<table width="100%" border="0" class="table">
 <tr>
    <th width="25%">Code</th>
    <th>Description</th>
    <th width="28%" colspan="5">Assig-Weight</th>
     </tr>
  

  <tr  class="row_to_clone">
    <td ><input type="text" name="code"  value="<?php echo $code;?>" id="input"></td>
 <td width="25%"><input type="text" name="detail"  value="<?php echo $detail;?>" id="input"></td>
 <td colspan="5"><input type="text" name="assig"  value="<?php echo $assig;?>" id="input"></td>
</tr>
</table>

<div align="right">
        <input type="hidden" name="action-type" value="<?php echo $action; ?>">
	<input type="hidden" name="s_id" value="<?php echo $s_id; ?>">
    <input type="submit" name="submit" id="submit" value="Save" class="btn"/>
    &nbsp; <input type="reset" name="clear" value="Clear" class="btn"/>
	
        
	</div>  

	
    </form>
		 <br />
		<br />
		  <div id="Data" class="title">
			 Select Any Project Code to View Data
			</div>
	 <br clear="all" />
   </div>
   <?php include ("includes/footer.php"); ?>
</div>
</body>
</html>