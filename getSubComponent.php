<?php
//error_reporting(E_ALL & ~E_NOTICE); 
require_once("requires/Database.php");
$obj  = new Database();
$sid = $_GET["sid"];

?>
<select class="form-control" name="s_id" id="input" onchange="showDscription(this.value)">
	<option value="" selected="selected">Select Sub-Component</option>
	<?php
	$rec = $obj->select('*', 'subcomponents', 'sid=' . $sid, 's_id ASC', '');
	while ($row = mysql_fetch_array($rec)) {
	?>
		<option value="<?php echo $row['s_id'] ?>"><?php echo $row['detail'] ?></option>
	<?php
	}
	?>
</select>