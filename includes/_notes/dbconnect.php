<?php error_reporting(E_ALL & ~E_NOTICE);
$db = mysql_connect("localhost", "lbdcip", "Lbdcip_786_pitb") or die("Could not connect.");
if(!$db) 
die("no db");
if(!mysql_select_db("lbdcip",$db))
die("No database selected.");?>
