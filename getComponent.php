<?php
//error_reporting(E_ALL & ~E_NOTICE); 
require_once("requires/Database.php");
$obj  = new Database();
$pid = $_GET["pid"];

?>

<select class="form-control" name="cid" id="input" onChange="showStructure(this.value)">
	<option value="" selected="selected">Select Component</option>
	<?php
	$rec = $obj->select('*', 'components', 'pid=' . $pid, 'cid ASC', '');
	while ($row = mysql_fetch_array($rec)) {
	?>
		<option value="<?php echo $row['cid'] ?>"><?php echo $row['detail'] ?></option>
	<?php
	}
	?>
</select>