<?php
//error_reporting(E_ALL & ~E_NOTICE);
require('requires/auth.php');
require_once("requires/Database.php");
$obj= new Database();
include("fckeditor/fckeditor.php");

if(isset($_POST['pid']))
{
//----------------------------------
$pid 			= trim($_POST['pid']);
if(!(empty($_POST['pid'])))
	{
	$values['pid'] 			= $pid;
	 }
	 else
	 {
	  $values['pid'] = 0;
	 }


$cid 			= trim($_POST['cid']);
if(!(empty($_POST['cid'])))
	{
$values['cid'] 			= $cid;
}
	 else
	 {
	  $values['cid'] = 0;
	 }
	 
	 
$sid 			= trim($_POST['sid']);
if(!(empty($_POST['sid'])))
	{
$values['sid'] 			= $sid;
}
	 else
	 {
	  $values['sid'] = 0;
	 }

$s_id			        = trim($_POST['s_id']);
if(!(empty($_POST['s_id'])))
	{
$values['s_id']			= $s_id;
}
	 else
	 {
	  $values['s_id'] = 0;
	 }
	 
$aid 			        = trim($_POST['aid']);
if(!(empty($_POST['aid'])))
	{
$values['aid'] 			= $aid;
}
	 else
	 {
	  $values['aid'] = 0;
	 }



$qty             	=trim($_POST['qty']);
if(!(empty($_POST['qty'])))
	{
$values['qty']      =$qty;
}
	 else
	 {
	  $values['qty'] = 0;
	 }


$rs 		        = trim($_POST['rs']);
if(!(empty($_POST['rs'])))
	{
$values['rs'] 	=$rs;
}
	 else
	 {
	  $values['rs'] = 0;
	 }
	 
$es_qty             	=trim($_POST['es_qty']);
if(!(empty($_POST['es_qty'])))
	{
$values['es_qty']      =$es_qty;
}
	 else
	 {
	  $values['es_qty'] = 0;
	 }
	 

$es_rate		             =trim($_POST['es_rate']);
if(!(empty($_POST['es_rate'])))
	{
$values['es_rate']		=$es_rate;
}
	 else
	 {
	  $values['es_rate'] = 0;
	 }

$amount = $rs*$qty;
$values['amount'] = $amount;



$values['code'] 			= trim($_POST['code']);

	 
$values['detail']		 =trim($_POST['detail']);


$values['uom']		 =trim($_POST['uom']);


$values['remark']		 =trim($_POST['remark']);
	 
if($_POST["action-type"] == "Save Record")

  {
    $result = $obj->insert('sub_activity',$values);
	  	
$rec = $obj->select('*', 'sub_activity','aid="'.$aid.'"','','');
while ($data = mysql_fetch_array($rec))
{
$sum = $data['amount'];
$pase +=$sum;
 }
 $sql = "UPDATE activity SET  amount ='".$pase."' where aid = ".$aid."";  
   	 mysql_query($sql) or die("Cannot Update Record Because".mysql_error()."...");
	 
 
 $rec1 = $obj->select('*', 'sub_activity','s_id="'.$s_id.'"','','');
while ($data1 = mysql_fetch_array($rec1))
{
$sum1 = $data1['amount'];
$pase1 +=$sum1;
 }
	
	$sql = "UPDATE subcomponents SET  amount ='".$pase1."' where s_id = ".$s_id."";  
   	 mysql_query($sql) or die("Cannot Update Record Because".mysql_error()."...");
	
	
$rec2 = $obj->select('*', 'sub_activity','sid="'.$sid.'"','','');
while ($data2 = mysql_fetch_array($rec2))
{
$sum2 = $data2['amount'];

$pase2 +=$sum2;
 }
 
 $sql = "UPDATE structure SET  amount ='".$pase2."' where sid = ".$sid."";  
   	 mysql_query($sql) or die("Cannot Update Record Because".mysql_error()."...");
	 
 
 $rec3 = $obj->select('*', 'sub_activity','cid="'.$cid.'"','','');
while ($data3 = mysql_fetch_array($rec3))
{
$sum3 = $data3['amount'];
$pase3 +=$sum3;
 }
	
	$sql = "UPDATE components SET  amount ='".$pase3."' where cid = ".$cid."";  
   	 mysql_query($sql) or die("Cannot Update Record Because".mysql_error()."...");
	 
  
 $rec4 = $obj->select('*', 'sub_activity','pid="'.$pid.'"','','');
while ($data4 = mysql_fetch_array($rec4))
{
$sum4 = $data4['amount'];

$pase4 +=$sum4;
 }
	
	$sql = "UPDATE projectcode SET  amount ='".$pase4."' where pid = ".$pid."";  
   	 mysql_query($sql) or die("Cannot Update Record Because".mysql_error()."...");
	 	
  }
  
	else if($_POST["action-type"] == "Update Record") 
	{ 
	 $result = $obj->update('sub_activity',$values, 'sa_id='.$_POST["sa_id"]);
	 
$rec5 = $obj->select('*', 'sub_activity','aid="'.$aid.'"','','');
while ($data5 = mysql_fetch_array($rec5))
{
$sum5 = $data5['amount'];
$pase5 +=$sum5;
 }
 $sql = "UPDATE activity SET  amount ='".$pase5."' where aid = ".$aid."";  
   	 mysql_query($sql) or die("Cannot Update Record Because".mysql_error()."...");
	 
 
 $rec6 = $obj->select('*', 'sub_activity','s_id="'.$s_id.'"','','');
while ($data6 = mysql_fetch_array($rec6))
{
$sum6 = $data6['amount'];
$pase6 +=$sum6;
 }
	
	$sql = "UPDATE subcomponents SET  amount ='".$pase6."' where s_id = ".$s_id."";  
   	 mysql_query($sql) or die("Cannot Update Record Because".mysql_error()."...");
		
$rec7 = $obj->select('*', 'sub_activity','sid="'.$sid.'"','','');
while ($data7 = mysql_fetch_array($rec7))
{
$sum7 = $data7['amount'];
$pase7 +=$sum7;
 }
 $sql = "UPDATE structure SET  amount ='".$pase7."' where sid = ".$sid."";  
   	 mysql_query($sql) or die("Cannot Update Record Because".mysql_error()."...");
	 
 
 $rec8 = $obj->select('*', 'sub_activity','cid="'.$cid.'"','','');
while ($data8 = mysql_fetch_array($rec8))
{
$sum8 = $data8['amount'];

$pase8 +=$sum8;
 }
	
	$sql = "UPDATE components SET  amount ='".$pase8."' where cid = ".$cid."";  
   	 mysql_query($sql) or die("Cannot Update Record Because".mysql_error()."...");
	 	
$rec9 = $obj->select('*', 'sub_activity','pid="'.$pid.'"','','');
while ($data9 = mysql_fetch_array($rec9))
{
$sum9 = $data9['amount'];

$pase9 +=$sum9;
 }
	
	$sql = "UPDATE projectcode SET  amount ='".$pase9."' where pid = ".$pid."";  
   	 mysql_query($sql) or die("Cannot Update Record Because".mysql_error()."...");
	}
	echo "<script>self.location ='subactivity.php';</script>";
}
/*update process*/
if(isset($_GET['action']) && ($_GET['action'] == 'edit'))
{
	$btn = 'Update';  
	$rec = $obj->select('*','sub_activity', 'sa_id = '.$_GET['sa_id'], '','');
	$data = mysql_fetch_array($rec);
	$sa_id = $data['sa_id'];
	$pid = $data['pid'];
	$cid = $data['cid'];
	$sid = $data['sid'];
	$s_id = $data['s_id'];
	$aid = $data['aid'];
	$code = $data['code'];
	$detail = $data['detail'];
	$uom = $data['uom'];
	$qty = $data['qty'];
	$rs = $data['rs'];
	$es_qty = $data['es_qty'];
	$es_rate = $data['es_rate'];
	$action = "Update Record";
	}
else 
{
	$btn = 'Save';
	$pid = '';
    $cid = '';
	$sid = '';
	$s_id = '';
	$aid = '';
	$code = '';
	$detail = '';
	$uom = '';
	$qty = '';
	$rs = '';
	$es_rate = '';
	$es_qty = '';
	}
	
/*del process*/
if(isset($_GET['action']) && ($_GET['action'] == 'delete'))
{
    		$sql = "delete from sub_activity  where sa_id = '".$_GET["sa_id"]."'";
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
<script src="js/selectListProject.js"></script>
<script src="js/selectListConstruction.js"></script>
<script src="js/selectListSubComponent 1.js"></script>
<script src="js/selectListActivity.js"></script>
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
							else if(checkSelectBox("s_id", "Select the Sub_Component"))
							{												
								return false;
							}
							else if(checkSelectBox("aid", "Select the Activity"))
							{												
								return false;
							}
							 else if(checkEmpty("code", "Code is Missing"))
							{												
								return false;
						}
							 else if(checkEmpty("detail", "Activity Detail is Missing"))
							{												
								return false;
							}
						  
							else if(checkEmpty("uom", "UOM is Missing"))
							{												
								return false;
							}
							else if(checkEmpty("qty", "Quantity is Missing"))
							{												
								return false;
							}
															
							else if(checkEmpty("rs", "Bid Rate is Missing"))
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
  <div class="title">Add Sub-Activity</div><div id="error" class="whitemsg"></div>

      <br/>
  
        <form name="subactivity" id="subactivity" action="subactivity.php"  method="post" onsubmit="return validateForm2()">  
		<table width="100%" border="0" class="table" align="center">
          <tr>
    <th width="11%">Project Code:</th>
    <td width="36%" style="padding-left:6px;">
     <?php 
			  if($btn == 'Save')
			  {
			  ?> 
<select name="pid"  id="input" style="width:200px;" onchange="showComponent(this.value)">
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
				  ?>
</td>
<th width="12%"> Component:</th>
    <td width="41%" style="padding-left:6px;">   
    <div id="part">
    <?php 
			  if($btn == 'Save')
			  {
			  ?> 
				<select name="cid"  id="input" style="width:200px;">
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
       	  </div>  	</td>
  </tr>
  <tr>
  <th width="11%"> Construction:</th>
    <td width="36%" style="padding-left:6px;">
	<div id="Construction">
    <?php 
			  if($btn == 'Save')
			  {
			  ?> 
	<select name="sid"  id="input" style="width:200px;">
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
  <th width="12%"> Sub-Component:</th>
    <td width="41%" style="padding-left:6px;">
    <div id="SubPart">
     <?php 
			  if($btn == 'Save')
			  {
			  ?> 
	<select name="s_id"  id="input" style="width:200px;">
						 <option selected="selected">Select Sub-Component</option>
               	</select>
                 <?php 
	}
				  
				  else
		  {
		  $rec6 = $obj->select('*','subcomponents', 's_id='.$data['s_id'], '','');
		$data6 = mysql_fetch_array($rec6);
		echo $data6['detail'];
		echo '<input name="s_id" type="hidden" id="s_id" value="'.$data6['s_id'].'" />';
		  
		  }
				  ?>
                </div></td>
  </tr>
          <tr>
            <th width="11%">Activity:</th>
            <td colspan="3" style="padding-left:6px;">
            <div id="Action">
            <?php 
			  if($btn == 'Save')
			  {
			  ?> 
            <select name="aid" id="input" style="width:200px;">
                <option selected="selected">Select Activity</option>
            </select>
             <?php 
	}
				  
				  else
		  {
		  $rec6 = $obj->select('*','activity', 'aid='.$data['aid'], '','');
		$data6 = mysql_fetch_array($rec6);
		echo $data6['detail'];
		echo '<input name="aid" type="hidden" id="aid" value="'.$data6['aid'].'" />';
		  
		  }
				  ?>
            </div>            </td>
          </tr>
        </table>
		<br/>
        <table width="100%" border="0" cellpadding="0" class="table">
  <tr>
   <th width="8%">Item No</th>
     <th width="22%">Activity Detail</th>
   <th width="11%">UOM</th>
      <th width="11%">Unit Quantity</th>
     <th width="11%" >Bid Rate (Rs)</th>
    <th width="12%" >Estimate Quantity</th>
      <th width="13%">Estimate Rate (Rs)</th>
       <th width="12%">Remark</th>
  </tr>
  <tr class="row_to_clone">
    <td align="center"><input type="text" name="code"  value="<?php echo $code;?>" id="input" style="width:60px;"></td>
    <td align="center"><input type="text" name="detail"  value="<?php echo $detail;?>" id="input"></td>
    <td align="center"><input type="text" name="uom"   value="<?php echo $uom;?>"id="input" style="width:80px;"/></td>
    <td align="center"><input type="text" name="qty"  value="<?php echo $qty;?>"id="input" style="width:95px;"/></td>
    <td align="center"><input type="text" name="rs"  value="<?php echo $rs;?>" id="input" style="width:95px;"/></td>
    <td align="center"><input type="text" name="es_qty"  value="<?php echo $es_qty;?>" id="input" style="width:95px;"/></td>
    <td align="center"><input type="text" name="es_rate"  value="<?php echo $es_rate;?>" id="input" style="width:100px;"/></td>
     <td align="center"><input type="text" name="remark" value="<?php echo $remark; ?>" id="input" style="width:100px;"/> </td>   
  </tr>
</table>
<div align="right"> 
<input type="hidden" name="action-type" value="<?php echo $action; ?>" />
                <input type="hidden" name="sa_id" value="<?php echo $sa_id; ?>" />  
              <input type="submit" name="submit" id="submit" value="Save" class="btn"/>
              &nbsp;
                <input type="reset" name="clear" value="Clear" class="btn" />
                
    </div>
     </form>
	 <br />
		<br />
		<div id="Active" class="title">
			Select Any Project Code to View Data
			</div>
	 <br clear="all" />
   </div>
   <?php include ("includes/footer.php"); ?>
</div>
</body>
</html>
