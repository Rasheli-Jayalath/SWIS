<?php
include_once("includes/dbconnect.php");
$activityid = intval($_GET['activity']);
?>
<select class="form-control" name="subactivityid" id="subactivityid">
	<option value="0">Select Village...</option>
	<?php
	$bquery = "select * from p2003village where tid = " . $activityid;
	$bresult = mysql_query($bquery);
	while ($bdata = mysql_fetch_array($bresult)) {
	?>
		<option value="<?php echo $bdata['code']; ?>"><?php echo $bdata['code'] . " - " . $bdata['village']; ?></option>
	<?php
	}
	?>
</select>