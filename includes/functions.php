<?php
function getComponentDetail($s_id)
{
  $sql="SELECT *  FROM  `mis_tbl_3_subcomponents` where s_id=".$s_id ;
 $amountresult = mysql_query($sql);
 if($amountresult!=0)
 {
//echo $amountsize= mysql_num_rows($amountresult);
 $data=mysql_fetch_array($amountresult);
 $cid=$data["cid"];
 }
 else
 {
	 $cid=0;
	}

return $cid;
	} 
	
	
function getFirst_Level($cid)
{
   $sql="SELECT *  FROM  `p009_vo2_boq_schedule_level_1` where sh_level1_id=".$cid ;
 $amountresult = mysql_query($sql);
 if($amountresult!=0)
 {
//echo $amountsize= mysql_num_rows($amountresult);
 $data=mysql_fetch_array($amountresult);

 }
 return $data;
	} 
	
function getSec_Level($cid,$subcomponentid)
{
   $sql="SELECT *  FROM  `p009_vo2_boq_schedule_level_2` where sh_level1_id=".$cid." AND sh_level2_id=".$subcomponentid ;
 $amountresult = mysql_query($sql);
 if($amountresult!=0)
 {
//echo $amountsize= mysql_num_rows($amountresult);
 $data=mysql_fetch_array($amountresult);
 //$cid=$data["code"]."-".$data["detail"];
 }
 else
 {
	 $cid="";
	}

return $data;
	} 
	
	
function get3rd_Level($cid,$subcomponentid,$milestone_unit)
{
   $sql="SELECT *  FROM  `p009_vo2_boq_schedule_level_3` where sh_level2_id=".$subcomponentid." AND sh_level3_id=".$milestone_unit ;
 $amountresult = mysql_query($sql);
 if($amountresult!=0)
 {
//echo $amountsize= mysql_num_rows($amountresult);
 $data=mysql_fetch_array($amountresult);
 $cid=$data["code"]."-".$data["detail"];
 }
 else
 {
	 $data="";
	}

return $data;
	} 
	
function getMilestoneDetail($cid,$subcomponentid,$aid)
{
   $sql="SELECT *  FROM  `p006_vo2_sch_activity` where l1=".$cid." AND l2=".$subcomponentid." AND aid=".$aid ;
 $amountresult = mysql_query($sql);
 if($amountresult!=0)
 {
//echo $amountsize= mysql_num_rows($amountresult);
 $data=mysql_fetch_array($amountresult);

 }
 else
 {
	 $data="";
	}

return $data;
	}
	
function getSubComponentCommProg($s_id)
{
$latest_month=0;
$latest_achieved=0;
 $cid=getComponentDetail($s_id);
$reportquery ="SELECT aid, baseline as milestoneBaseline, assig FROM mis_tbl_4_milstones where s_id=".$s_id." Group by s_id,aid order by s_id";
$reportresult = mysql_query($reportquery);
$counter=mysql_num_rows($reportresult);
while ($reportdata = mysql_fetch_array($reportresult)) {
	 $latest_month=getLatestMonth($reportdata['aid']);
  if($latest_month!=0)
  {
  $latest_achieved=getLatestMilestoneProgress($reportdata['aid'],$latest_month);
  }
if($latest_achieved!=0&&$reportdata['milestoneBaseline']!=0)
 {
	 $comm_progress+=($latest_achieved/$reportdata['milestoneBaseline'])*($reportdata['assig']/100);
 $latest_achieved=0;
 }
 
}
if($counter!=0)
{
	if($cid==3||$cid==4)
	{
		$res=$comm_progress;
	}
	else
	{
		$res=$comm_progress/$counter;
	}
}
else
{
	$res=0;}
return $res;
}
function getSubComponentPlannedProg($s_id)
{
$latest_month=0;
$latest_planned=0;
$reportquery ="SELECT aid, baseline as milestoneBaseline FROM mis_tbl_4_milstones where s_id=".$s_id." Group by s_id,aid order by s_id";
$reportresult = mysql_query($reportquery);
if($reportresult!=0)
{
$counter=mysql_num_rows($reportresult);
}
while ($reportdata = mysql_fetch_array($reportresult)) {
	 $latest_month=getLatestMonth($reportdata['aid']);
  if($latest_month!=0)
  {
  $latest_planned=getLatestMilestonePlanned($reportdata['aid'],$latest_month);
  }
if($latest_planned!=0&&$reportdata['milestoneBaseline']!=0)
 {
	 $comm_progress+=($latest_planned/$reportdata['milestoneBaseline']);
 
 }
 
}
if($counter!=0)
{
$res=$comm_progress/$counter;
}
else
{
	$res=0;}
return $res;
}
function getLatestMonth($aid)
{
	$sql="SELECT max(bid) lastest_month FROM  `mis_tbl_5_milestone_targets` where aid=".$aid . " AND achieved<>0";
 $amountresult = mysql_query($sql);
 if($amountresult!=0)
 {
//echo $amountsize= mysql_num_rows($amountresult);
 $data=mysql_fetch_array($amountresult);
 $lastest_month=$data["lastest_month"];
 }
 else
 {
	 $lastest_month=0;
	}

return $lastest_month;
	} 
	
function getLatestMilestoneProgress($aid,$bid)
{
	 $sql="SELECT achieved FROM  `mis_tbl_5_milestone_targets` where aid=".$aid. " AND bid=".$bid;
 $amountresult = mysql_query($sql);
 if($amountresult!=0)
 {
//echo $amountsize= mysql_num_rows($amountresult);
 $data=mysql_fetch_array($amountresult);
 $achieved=$data["achieved"];
 }
 else
 {
	 $achieved=0;
	}

return $achieved;
	} 
function getLatestMilestonePlanned($aid,$bid)
{
	 $sql="SELECT targets FROM  `mis_tbl_5_milestone_targets` where aid=".$aid. " AND bid=".$bid;
 $amountresult = mysql_query($sql);
 if($amountresult!=0)
 {
//echo $amountsize= mysql_num_rows($amountresult);
 $data=mysql_fetch_array($amountresult);
 $targets=$data["targets"];
 }
 else
 {
	 $targets=0;
	}

return $targets;
	}
function getItemTargets($bid,$sa_id)
{
	$sql="SELECT targets FROM  `test1` where sa_id=".$sa_id." And bid=".$bid;
 $amountresult = mysql_query($sql);
 if($amountresult!=0)
 {
//echo $amountsize= mysql_num_rows($amountresult);
 $data=mysql_fetch_array($amountresult);
 $targets=$data["targets"];
 }
 else
 {
	 $targets=0;}

return $targets;
	} 

function getItemAchieve($bid,$sa_id)
{
	$sql="SELECT achieved FROM  `test1` where sa_id=".$sa_id." And bid=".$bid;
 $amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
if($amountresult!=0)
{
 $data=mysql_fetch_array($amountresult);
 $achieved=$data["achieved"];
}
else
{
$achieved=0;
}

return $achieved;
	} 
	
function getMilestoneTargets($bid,$aid)
{
	$sql="SELECT sum(targets) as milestone_targets FROM  `test1` where aid=".$aid." And bid=".$bid;
 $amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
if($amountresult!=0)
{
 $data=mysql_fetch_array($amountresult);
 $milestone_targets=$data["milestone_targets"];
}
else
{
$milestone_targets=$data["milestone_targets"];
}
return $milestone_targets;
	} 
	
function getMilestoneAchieve($bid,$aid)
{
	$sql="SELECT sum(achieved) as milestone_achieved FROM  `test1` where aid=".$aid." And bid=".$bid;
 $amountresult = mysql_query($sql);
//echo $amountsize= mysql_num_rows($amountresult);
if($amountresult!=0)
{
 $data=mysql_fetch_array($amountresult);
$milestone_achieved=$data["milestone_achieved"];
}
else
{
	$milestone_achieved=0;
}
return $milestone_achieved;
	} 
	
function getResources($aid,$start_date,$end_date)
{
$reportquery ="SELECT sum(pqty* `iunitpkr`) as pkrAmount, sum(pqty* `iunitfcurrency`) as usdAmount, ifcrate FROM `resources` WHERE aid=".$aid." AND `planned_date` BETWEEN '".$start_date."'AND '".$end_date."'";
$reportresult = mysql_query($reportquery);
$counter=mysql_num_rows($reportresult);
$reportdata = mysql_fetch_array($reportresult);
return $reportdata;
}
function getResourceDetail($aid,$rid,$start_date,$end_date)
{
$reportquery ="SELECT rid,sum(pqty)as total_pqty, sum(pqty* `iunitpkr`) as pkrAmount, sum(pqty* `iunitfcurrency`) as usdAmount, ifcrate FROM `resources` WHERE aid=".$aid." AND rid=".$rid." AND `planned_date` BETWEEN '".$start_date."'AND '".$end_date."'";
$reportresult = mysql_query($reportquery);
if($reportresult!=""&&$reportresult!=0)
{
$counter=mysql_num_rows($reportresult);
}
else
{
	$counter=0;
}
if($reportresult!=""&&$reportresult!=0)
{
$reportdata = mysql_fetch_array($reportresult);
}
return $reportdata;
}
function getProgress($aid,$start_date,$end_date)
{
$reportquery ="SELECT sum(ppqty* `iunitpkr`) as pkrProgAmount, sum(ppqty* `iunitfcurrency`) as usdProgAmount, ifcrate FROM `progress` WHERE aid=".$aid." AND `progress_date` BETWEEN '".$start_date."'AND '".$end_date."'";
$reportresult = mysql_query($reportquery);
$counter=mysql_num_rows($reportresult);
$reportdata = mysql_fetch_array($reportresult);
return $reportdata;
}
function getProgressDetail($aid,$rid,$start_date,$end_date)
{
$reportquery ="SELECT rid,sum(ppqty* `iunitpkr`) as pkrProgAmount, sum(ppqty* `iunitfcurrency`) as usdProgAmount, ifcrate 
FROM `progress` WHERE aid=".$aid." AND rid=".$rid." AND `progress_date` BETWEEN '".$start_date."'AND '".$end_date."'";
$reportresult = mysql_query($reportquery);
if($reportresult!=""&&$reportresult!=0)
{
$counter=mysql_num_rows($reportresult);
}
else
{
	$counter=0;}
if($reportresult!=""&&$reportresult!=0)
{
$reportdata = mysql_fetch_array($reportresult);
}
return $reportdata;
}

function CheckResources($aid)
{
$reportquery ="SELECT * from `p007_vo2_sch_res_assign` WHERE aid=".$aid;
$reportresult = mysql_query($reportquery);
if($reportresult!=0)
{
$counter=mysql_num_rows($reportresult);
}
else
{
	$counter=0;
}
//$reportdata = mysql_fetch_array($reportresult);
return $counter;
}
	?>