<?php
require_once("config/config.php");

$objCommon 		= new Common;
$objMenu 		= new Menu;
$objNews 		= new News;
$objContent 	= new Content;
$objTemplate 	= new Template;
$objMail 		= new Mail;
$objCustomer 	= new Customer;
$objCart 	= new Cart;
$objAdminUser 	= new AdminUser;
$objProduct 	= new Product;
$objValidate 	= new Validate;
$objOrder 		= new Order;
$objLog 		= new Log;
require_once('rs_lang.admin.php');
require_once('rs_lang.website.php');
?><?php

	$activitytypeid = intval($_GET['activitytype']);
	$componentid = intval($_GET['component']);
	?>
<select class="form-control" name="subcomponentid" id="subcomponentid" onchange="getactivity(this.value)">
	<option value="0">Select District...</option>
	<?php
	$tquery = "select * from  p2002tehsil where dcode = " . $componentid . " order by code ASC";
	$tresult = mysql_query($tquery);
	while ($tdata = mysql_fetch_array($tresult)) {
	?>
		<option value="<?php echo $tdata['code']; ?>"><?php echo $tdata['code'] . " - " . $tdata['tehsil']; ?></option>
	<?php
	}
	?>
</select>