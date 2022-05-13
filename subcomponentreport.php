<?php
//error_reporting(E_ALL & ~E_NOTICE);
require('requires/auth.php');
require_once("requires/Database.php");
$obj= new Database();
include("fckeditor/fckeditor.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="datepicker/Jquery_ui/jquery.ui.all.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="menu/chromestyle.css"/>
<script type="text/javascript" src="menu/chrome.js"></script>
<script language="javascript" type="text/javascript" src="datepicker/script/jquery-1.4.2.js"></script>
<script type="text/javascript" src="datepicker/script/jquery.ui.core.js"></script>
<script type="text/javascript" src="datepicker/script/jquery.ui.widget.js"></script>
<script type="text/javascript" src="datepicker/script/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="datepicker/script/jquery.ui.datepicker-fr.js"></script>
<script  language="javascript"  type="text/javascript" src="datepicker/script/calender/calender.js">  </script>
<script src="js/showStructure1.js"></script>
<script src="js/selectListSubcomponent_date.js"></script>
<script src="js/selectSubcomponent_data.js"></script>
</head>

<body> 
<div id="wrap">
   <?php
     include 'includes/header.php';
   ?>

   <div id="content">
  <div class="title">Sub Component Report</div>
      <br/>	  
	  <table width="78%" border="0" class="table" align="center">
  <tr>
    <th width="14%">Project Code:</th>
    <td width="37%" style="padding-left:6px;">
  	
<select name="pid" id="input" style="width:200px;"  onChange="showComponent(this.value)">
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
</td>
<th width="12%"> Component:</th>
    <td width="37%" style="padding-left:6px;">
<div id="part">
				<select name="cid" id="input" style="width:200px;">
				 <option selected="selected">Select Component</option>
				</select>
          	</div>  	
</td>
  </tr>
  <tr>
    <th width="14%"> Month:</th>
<td width="37%" style="padding-left:6px;"><div id="Date">
				<select name="date" id="input" style="width:200px;">
				 <option selected="selected">Select Month</option>
				</select>
          	</div>  	</td>
    <th>&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
 </table>

		 <br />
		<br />
		<div id="Data1" class="title">
			Select Any Project Code to View Data
			</div>
			
		<br clear="all" />
   </div>
   <?php include ("includes/footer.php"); ?>
</div>
</body>
</html>
