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

if($objAdminUser->is_login== false){
	header("location: index.php");
}

$projectid = $_REQUEST['projectid'];
$msgFlag=false;
$graphflag=false;
$data=NULL;
$subactivityflag2=0;
if($projectid == 0 || $projectid =='') {
	$projectflag=0;
} else {
	$projectflag=1;
}
 $componentid = $_REQUEST['componentid'];
if($componentid == 0 || $componentid =='') {
	$componentflag=0;
} else {
	$componentflag=1;
}
$activitytypeid = $_REQUEST['activitytypeid'];
if($activitytypeid == 0 || $activitytypeid =='') {
	$activitytypeflag=0;
} else {
	$activitytypeflag=1;
}
$subcomponentid = $_REQUEST['subcomponentid'];
if($subcomponentid == 0 || $subcomponentid =='') {
	$subcomponentflag=0;
} else {
	$subcomponentflag=1;
}
 $activityid = $_REQUEST['activityid'];
if($activityid == 0 || $activityid =='') {
	$activityflag=0;
} else {
	$activityflag=1;
}

 $behavid = $_REQUEST['behavid'];
if($behavid == 0 || $behavid =='') {
	$behavflag=0;
} else {
	$behavflag=1;
}
if($componentid!="" && $subcomponentid!="" && $activityid!="")
{
	$SQLbf = "Select * from p2003village where dcode = ".$componentid." and tcode=".$subcomponentid." and code=".$activityid;
	$reportresultbf= mysql_query($SQLbf);
	$reportdatabf = mysql_fetch_array($reportresultbf);
	$latbf = $reportdatabf['y'];  
   $lngbf = $reportdatabf['x'];   
   
}
?>
<?php 
function dateDiff($start, $end) 
{   
$start_ts = strtotime($start);  
$end_ts = strtotime($end);  
$diff = $end_ts - $start_ts;  
return round($diff / 86400); 
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <!-- This page is copyright Elated Communications Ltd. (www.elated.com) -->

    <title>Punjab Saaf Pani Project Dashboard</title>
	

  </head>
  <body>
  
<div style="width:100%; height:110px; background-color:#06f; text-align:center">

<a href="./index.php"><img src="images/home2.png"    title="Home" width="120" height="100" align="left" style="border-color:#ccc; border-radius:1px" /></a><img src="images/water-bgtop.png"  /><a href="./qrdash-home.php" ><img src="images/dboard.png"    width="117" height="100" align="right" style="border-color:#ccc; border-radius:1px"  title="Main Dashboard"/></a></div>
<table cellpadding="0px" cellspacing="0px" align="center" width="100%" style="border: solid 1px #ccc;" > 
<tr> 

<?php
 $dcode=$componentid;
 $tcode=$subcomponentid;
 $vcode=$activityid;
 $vcode=$vcode;
 $behavid=$behavid;

$iCount = 0;
$SQL = "Select * from p2005wss where dcode = ".$dcode." and tcode=".$tcode." and vcode=".$vcode;
$reportresult= mysql_query($SQL);
    $iCount=mysql_num_rows($reportresult);
    if($iCount>0) {
	while($reportdata = mysql_fetch_array($reportresult)) {
       
	    $sno		=$reportdata['sno'];
        $datadate	= $reportdata['datadate'];
        $databy		=$reportdata['databy'];
        $wssname	= $reportdata['wssname'];
		 $condate		=$reportdata['condate'];
        $exeagencyval	= $reportdata['exeagencyval'];
        $omagencyval		=$reportdata['omagencyval'];
        $statusval	= $reportdata['statusval'];
		
		$reasonval		=$reportdata['reasonval'];
        $nohh	= $reportdata['nohh'];
        $contypedom		=$reportdata['contypedom'];
        $contypecom	= $reportdata['contypecom'];
		 $condate		=$reportdata['condate'];
        $nocon	= $reportdata['nocon'];
        $wssourceval		=$reportdata['wssourceval'];
        $zoneval	= $reportdata['zoneval'];
		
		$dilmodval		=$reportdata['dilmodval'];
        $twdepth	= $reportdata['twdepth'];
        $wtable		=$reportdata['wtable'];
        $hpipe	= $reportdata['hpipe'];
		 $bpipe		=$reportdata['bpipe'];
        $stainer	= $reportdata['stainer'];
        $q		=$reportdata['q'];
        $head	= $reportdata['head'];
		$bhp		=$reportdata['bhp'];
        $Dia	= $reportdata['Dia'];
        $srno		=$reportdata['srno'];
        $ework	= $reportdata['ework'];
		 $mwork		=$reportdata['mwork'];
        $chlorination	= $reportdata['chlorination'];
        $moverval		=$reportdata['moverval'];
        $wstypesurfval	= $reportdata['wstypesurfval'];
		$wstypesurfdelval		=$reportdata['wstypesurfdelval'];
        $wstreatsurfval	= $reportdata['wstreatsurfval'];
        $rmainno		=$reportdata['rmainno'];
        $rmainmat	= $reportdata['rmainmat'];
		 $rmdia		=$reportdata['rmdia'];
        $rmlength	= $reportdata['rmlength'];
        $novalve		=$reportdata['novalve'];
		
		$tankshape	= $reportdata['tankshape'];
        $tankcapacity		=$reportdata['tankcapacity'];
        $tankdim	= $reportdata['tankdim'];
		$tankheight		=$reportdata['tankheight'];
        $tankplumb	= $reportdata['tankplumb'];
        $wdnmat		=$reportdata['wdnmat'];
        $wdndia	= $reportdata['wdndia'];
		 $wdnlength		=$reportdata['wdnlength'];
        $sketch	= $reportdata['sketch'];
        $remarks		=$reportdata['remarks'];
		$photolink1		=$reportdata['photolink1'];
		$photolink2		=$reportdata['photolink2'];
		$photolink3		=$reportdata['photolink3'];
		$photolink4		=$reportdata['photolink4'];
		
}		
}
$result_dis = mysql_query("SELECT name FROM p2001district where code=".$dcode);
$data_dis=mysql_fetch_array($result_dis); 
$result_th = mysql_query("SELECT tehsil FROM p2002tehsil where code=".$tcode);
$data_th=mysql_fetch_array($result_th);
$result_vi = "Select village FROM  p2003village where dcode = ".$dcode." and tcode=".$tcode." and code=".$vcode;
	$result_vi2= mysql_query($result_vi);
	$data_vi = mysql_fetch_array($result_vi2);
   
	
?>
<td valign="top"   >
<h3 style="margin-left:130px"><span style="font-size:24px"><?=$data_dis['name'];  ?> &raquo;</span><span style="font-size:22px"> <?=$data_th['tehsil'];?> &raquo;</span><span style="font-size:20px"> <?=$data_vi['village'];?></span></h3>
<h2 style="margin-left:130px"><?php echo "Water Supply Scheme: ".$wssname; ?></h2>
<table cellspacing="0" cellpadding="0" border="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; margin-left:130px">
  <col width="353">
  <col width="217">
  <col width="140">
  <col width="64" span="3">
  <tr>
    <td rowspan="14" width="215" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Basic Data of Water Supply Scheme</td>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Sr. No.</td>
    <td width="210" bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;" align="center"><?=$sno; ?></td>
    <td width="8" rowspan="48">	
	<?php if($photolink1!="")
	{?>
	<img src="technical/<?php echo $photolink1; ?>" width="300" /><br /><br />
	<?php
	}
	if($photolink2!="")
	{
	?>
    <img src="technical/<?php echo $photolink2; ?>" width="300" /><br /><br />
	<?php
	}
	if($photolink3!="")
	{
	?>
    <img src="technical/<?php echo $photolink3; ?>" width="300" /><br /><br />
	<?php
	}
	if($photolink4!="")
	{
	?>
    <img src="technical/<?php echo $photolink4; ?>" width="300" /> 
	<?php
	}
	?>
	
        </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Date</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$datadate; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Data given by</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$databy; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Name of WS Schemes</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$wssname; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Date of Constrction/Completion</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$condate; ?>
    </td>
  </tr>

  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Executing Agnecy PHED=1 TMA=2 CBO=3 Other=4</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$exeagencyval; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Operating &amp; Maintianing Agnecy PHED=1, TMA=2, CBO=3 Other=4</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$omagencyval; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Staus Funcioning=1, Non-Functional=2</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$statusval; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">If non fuctional then Reason for non funtioing, Transformer Steeling=1 Mehcinal Fault=2 Community Confilct=3 Other=4</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$reasonval; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">No. of HH using WS facility</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$nohh; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Domestic Connections</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$contypedom; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Commercial Connections</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$contypecom; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Total Connections</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$nocon; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">Source, Ground water=1 Surface Water=2</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$wssourceval; ?>
    </td>
  </tr>
  <tr>
    <td rowspan="11" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Technical Data related to Tubewell</td>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Water Zone of WSS Sweet=1 Brackish=2 Mixed sweet &amp; brackish=3</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$zoneval; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">If Ground Water supply then Mode of Deliver, Open Well with Pump=1 Tube wells=2 </td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$dilmodval; ?>
    </td>
  </tr>
  <tr>
    <td rowspan="5" width="80" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Tubewell Detail</td>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Depth of Tubewell (Ft)</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$twdepth; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Depth of Water Table (Ft)</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$wtable; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Hosing Pipe (inches)</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$hpipe; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Blind Pipe (inches)</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$bpipe; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Stainer</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$stainer; ?>
    </td>
  </tr>
  <tr>
    <td rowspan="4" width="80" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Pump room Detail</td>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Q</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$q; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Head</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$head; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">BHP</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$bhp; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#CFF">Dia of Q pipe</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$Dia; ?>
    </td>
  </tr>
  <tr>
    <td rowspan="23" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Technical    Data related to Tubewell</td>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Sr.    No.</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$srno; ?>
    </td>
  </tr>
  <tr>
    <td rowspan="3" width="80" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Pump room Detail</td>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Electrical Work</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$ework; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Mechnical Work</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$mwork; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Chlorination</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$chlorination; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Prime mover of Pump/TW,   Diesel =1 Electricity =2</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$moverval; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">If surface water supply then type  Canal=1      River=2    Storge Pond=3         Other=4</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$wstypesurfval; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">If surface water supply then Mode of Delivery,    Pump=1,  Gravity Flow=2 Other=3</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$wstypesurfdelval; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">If Surface Water mode of treatment,      Slow sand filtration plant =1        Reverse Osmosis=2 Other=3</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$wstreatsurfval; ?>
    </td>
  </tr>
  <tr>
    <td rowspan="5" width="80" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Rising Main</td>
    <td rowspan="2" width="54" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Rising    Main (No,)</td>
    <td width="59" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">No</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$rmainno; ?>
    </td>
  </tr>
  <tr>
    <td width="59" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Material</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$rmainmat; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Dia</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$rmdia; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Length</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$rmlength; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">No. of valve, if any</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$novalve; ?>
    </td>
  </tr>
  <tr>
    <td rowspan="5" width="80" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Storage Tank Detail</td>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Shape</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$tankshape; ?>
    </td>

  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Capacity</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$tankcapacity; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Dimensions</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$tankdim; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Height upto top slabe</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$tankheight; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Plumbing Detail</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$tankplumb; ?>
    </td>
  </tr>
  <tr>
    <td rowspan="3" width="80" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Water distribution Network</td>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Type    of Material </td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;" align="center">
      <?=$wdnmat; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Dia</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$wdndia; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Length </td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$wdnlength; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Any Sketch available of WSS</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;" align="center">
      <?=$sketch; ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FCF">Remarks</td>
    <td bgcolor="#FFFFCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " align="center">
      <?=$remarks; ?>
    </td>
  </tr>
</table>

</td>
</tr>

</table>



<div class="clear"></div>
	<?php include("includes/footer.php");?>
	<div class="clear"></div>
</body>
</html>