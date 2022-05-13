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
?>

<style type="text/css">
	select option.red {
		color: #76031B;

	}

	select option.green {
		color: #006C00;

	}

	select option.blue {
		color: #000055;

	}
</style>

<?php
$subcomponentid = intval($_GET['subcomponent']);


?>
<select class="form-control" name="activityid" id="activityid" onchange="getsubactivity(this.value)">
	<option value="0">Select Village...</option>
	<?php

	/*
$aquery = "SELECT b.village as village,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.tcode=
".$subcomponentid." Order by code ASC";*/
	$aquery = "SELECT b.village as village,b.code as code,b.tcode as tcode from p2004vp a inner join p2003village b on (a.giscode=b.giscode) where b.tcode=" . $subcomponentid . "
UNION 
SELECT b.village as village,b.code as code,b.tcode as tcode from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.tcode=" . $subcomponentid;
	$aresult = mysql_query($aquery);
	while ($adata = mysql_fetch_array($aresult)) {

		echo $v_code = $adata['code'];
		$t_code = $adata['tcode'];

		$aquery_s = "SELECT vcode,tcode from p2004vp where tcode=" . $t_code . " and vcode=" . $v_code;
		$aresult_s = mysql_query($aquery_s);
		$rows_s = mysql_num_rows($aresult_s);
		$adata_s = mysql_fetch_array($aresult_s);

		$aquery_t = "SELECT vcode from p2005wss where tcode=" . $t_code . " and vcode=" . $v_code;
		$aresult_t = mysql_query($aquery_t);
		$rows_t = mysql_num_rows($aresult_t);
		if ($rows_s == 1 && $rows_t == 1) {
	?>

		<?php
			$flag1 = 1;
			$v_name = $adata['code'] . " - " . $adata['village'];
		} else if ($rows_s == 1 && $rows_t == 0) {
		?>

		<?php
			$flag2 = 2;
			$v_name = $adata['code'] . " - " . $adata['village'];
		} else if ($rows_s == 0 && $rows_t == 1) {
		?>

		<?php
			$flag3 = 3;
			$v_name = $adata['code'] . " - " . $adata['village'];
		}
		?>
		<option value="<?php echo $adata['code'] ?>" <?php if ($flag1 == 1) {
														?> class="red" <?php
																	$flag1 = "";
																}
																if ($flag2 == 2) {
																	?> class="green" <?php
																	$flag2 = "";
																}
																if ($flag3 == 3) {
										?> class="blue" <?php
																	$flag3 = "";
																} ?>><?php echo $v_name; ?></option>
	<?php
	}

	?>
</select>