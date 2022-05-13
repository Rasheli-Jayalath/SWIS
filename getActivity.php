<?php
//error_reporting(E_ALL & ~E_NOTICE);
require_once("requires/Database.php");
$obj  = new Database();
$s_id = $_GET["s_id"];
?>
<select class="form-control" name="aid" id="input" onchange="showAct(this.value)">
	<option value="" selected="selected">Select Activity</option>

	<?php
	$rec = $obj->select('*', 'activity', 's_id=' . $s_id, 'aid ASC', '');
	while ($row = mysql_fetch_array($rec)) {
	?>
		<option value="<?php echo $row['aid'] ?>"><?php echo $row['detail'] ?></option>
	<?php
	}
	?>
</select>