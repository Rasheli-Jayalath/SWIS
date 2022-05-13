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
	$componentid = intval($_GET['component']);
	$query1 = "SELECT type FROM components where cid=" . $componentid;
	$queryresult1 = mysql_query($query1);
	$sdata1 = mysql_fetch_array($queryresult1);
	?>
<select class="form-control" name="activitytypeid" id="activitytypeid" onchange="getsubcomponent(this.value, <?php echo $componentid; ?>)">
	<option value="0">Select Activity Type...</option>
	<?php

	/*
$squery = "select * from activitytype ";
if($sdata1["type"]==3)
{
	$squery.="where sid=14";
}
else
{
$squery.="where assig=".$sdata1["type"];
}
$squery.=" ORDER BY code ASC";
$sresult = mysql_query($squery);
while ($sdata = mysql_fetch_array($sresult)) {*/
	?><?php
		$query = "SELECT * FROM subcomponents where (sid=3 OR sid=4) and cid=" . $componentid;
		$queryresult = mysql_query($query);
		$numrows = mysql_num_rows($queryresult);
		if ($numrows > 0) {
			$squery = "select * from activitytype Limit 0,4";
		} else {
			if ($componentid == 13) {
				$squery = "select * from activitytype where sid=5 OR sid=6";
			} else {
				$squery = "select * from activitytype where sid=1";
			}
		}
		$sresult = mysql_query($squery);
		while ($sdata = mysql_fetch_array($sresult)) {
		?>
	<option value="<?php echo $sdata['sid']; ?>"><?php echo $sdata['code'] . " - " . $sdata['detail']; ?></option>
<?php
		}
?>
</select>