<?php
require_once("config/config.php");
/*require_once("requires/Database.php");
$obj= new Database();*/
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

	if ($objAdminUser->is_login == false) {
		header("location: index.php");
	}
	//include_once("includes/dbconnect.php");
	$projectid = intval($_GET['project']);
	$uquery = "select * from mis_tbl_user_rights where user_cd = " . $objAdminUser->user_cd . " order by menu_cd";

	$uresult = mysql_query($uquery);
	$res = mysql_num_rows($uresult); ?>
<select class="form-control" name="componentid" id="componentid" onchange="getsubcomponent(this.value)">
	<option value="0">Select Package...</option>
	<?php
	$cquery = "select * from p2001district a  order by a.did ASC";

	$cresult = mysql_query($cquery);
	while ($cdata = mysql_fetch_array($cresult)) {
	?>
		<option value="<?php echo $cdata['did']; ?>"><?php echo $cdata['code'] . " - " . $cdata['name']; ?></option>
	<?php
	}

	?>
</select>