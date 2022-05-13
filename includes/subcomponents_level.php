<div id="result2">

<?php
if ($componentflag == 1 && $subcomponentid == 0 ) {
?>
<?php  			$code_str="";
				$latest_month=0;
				$sub_com_prog_p=0;
				$sub_com_prog=0;
				$latest_planned=0;
				$latest_achieved=0;
				$sub_com_prog_pi=0;
				$act_prog_str="";
				$pln_prog_str="";
				 $reportquery ="SELECT * FROM test1 where cid=".$componentid." Group by s_id order by cid, subcomponentsCode ASC";
				$reportresult = mysql_query($reportquery);
				if($reportresult!=0)
				{
				$num=mysql_num_rows($reportresult);
				}
				$ii=0;
				$sub_component_title="";
				$sum_sub_com_prog_pi=0;
				while ($reportdata = mysql_fetch_array($reportresult)) {
					$component_title=trim($reportdata['componenCode'])."-".trim($reportdata['componentDetail']);
					$ii++;
					 $code_str .="'".$reportdata['subcomponentsCode']."'";
					  //['Firefox',   45.0]
					$sub_com_prog_pi=getSubComponentCommProg($reportdata["s_id"]);
 					$sub_com_prog_pi=$sub_com_prog_pi*100;
					$sum_sub_com_prog_pi+=$sub_com_prog_pi;
					 $pie_data_str .="['".$reportdata['subcomponentsCode']."', ".$sub_com_prog_pi."]";
					 $sub_com_prog=getSubComponentCommProg($reportdata["s_id"]);
 					$sub_com_prog=$sub_com_prog*100;
					 $act_prog_str .= $sub_com_prog;
					$sub_com_prog_p=getSubComponentPlannedProg($reportdata["s_id"]);
 					$sub_com_prog_p=$sub_com_prog_p*100;
					 $pln_prog_str .=$sub_com_prog_p;
					 if($ii<$num)
					 {
					  $code_str .=" , ";
					  $act_prog_str .=" , ";
					  $pln_prog_str .=" , ";
					  $pie_data_str .=" , ";
					 }
				}
				$remaining_pie=100-$sum_sub_com_prog_pi;
				 $pie_data_str=$pie_data_str. ", ['Remaining', ".$remaining_pie. "]";
			/*	 echo "</br>".$code_str;
				 echo "</br>".$act_prog_str;
				 echo "</br>".$pln_prog_str;*/ ?>

        <script type="text/javascript">
$(function () {
        $('#container5').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $component_title;?>'
            },
            subtitle: {
                text: '<?php echo "Progress upto Quarter, Jan-Mar, 2015";?>'
            },
            xAxis: {
                categories: [
                    <?php echo $code_str;?>
                ]
            },
			 
            yAxis: {
                min: 0,
                title: {
                    text: 'Percentage (%)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
					 dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}%'
                        }
                }
            },
            series: [{
                name: 'Planned',
                data: [<?php echo $pln_prog_str;?>]
    
            }, {
                name: 'Actual',
                data: [<?php echo $act_prog_str;?>]
    
            }]
        });
    });
    

		</script>
        
        <script type="text/javascript">
$(function () {
    	
    	// Radialize the colors
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
		
		// Build the chart
        $('#container6').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '<?php echo $component_title;?>'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                         format: '{point.name}: {point.y:.2f}%'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Progress Achieved',
                data: [
                   <?php echo $pie_data_str;?>
                ]
            }]
        });
    });
    

		</script>
        <table width="90%"  align="center" border="0" style="margin:20px 40px 20px 40px">
   
    <tr>
      <td width="51%" height="31">&nbsp;</td>
      </tr>
   <tr>
     <td height="99"  style="line-height:18px; text-align:justify; vertical-align:top">
     <div id="container5" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
     </td>
     <td height="99"  style="line-height:18px; text-align:justify;vertical-align:top">
      <div id="container6" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
     </td>
   </tr>
   
</table>
<table  cellpadding="0px" cellspacing="0px"   width="93%" align="center"  id="tblList">

<tr  id="title">
<td colspan="18" align="center"><span class="white"><strong>Tarbela 4th Extension Hydropower Project (T4HP)</strong></span><a style="text-decoration:none; padding-left:600px; color:#fff" href="javascript:void(null);" onclick="window.open('print_component_report.php?cid=<?php echo $componentid;?>', 'INV','width=1200,height=550,scrollbars=yes');" ><img src="<?php echo IMAGES_URL;?>ico_print.gif" border="0" /><?php echo "Print";?></a></td>
</tr>
<tr>
  <th height="37">&nbsp;</th>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th colspan="3">Quarter 1 2015</th>
  <th colspan="3">Quarter 2 2015</th>
   <th colspan="3">Quarter 3 2015</th>
    <th colspan="3">Quarter 4 2015</th>
  </tr>
<tr id="tblHeading1">
<th width="34" height="37">#</th>
<th width="454"><div align="left">Indicators</div></th>
<th width="32">UOM</th>
<th width="64">Baseline</th>
<th width="67">% Weighted</th>
<th width="67">Achieved</th>
<th width="29">Jan</th>
<th width="28">Feb</th>
<th width="32">Mar</th>
<th width="31">Apr</th>
<th width="32">May</th>
<th width="28">Jun</th>
<th width="26">Jul</th>
<th width="31">Aug</th>
<th width="28">Sep</th>
<th width="28">OCT</th>
<th width="31">NOV</th>
<th width="29">DEC</th>
      <!--  <th width="110">Contract Amount</th> -->  
    </tr>
<?php 

$mob_weighted_progress=0;
$current=0;
$prev=0;
$current1=0;
$prev1=0;
$current2=0;
$prev2=0;
$latest_month=0;
$latest_achieved=0;
$sub_com_prog=0;
$sub_com_prog_p=0;
$reportquery ="SELECT * FROM test1 where cid=".$componentid." Group by s_id,aid order by cid, subcomponentsCode, milestoneCode, milestone_order ASC";
$i=0;
$reportresult = mysql_query($reportquery);
while ($reportdata = mysql_fetch_array($reportresult)) {
  $bgcolor = ($bgcolor == "#FFFFFF") ? "#EAF4FF" : "#FFFFFF";
  $current=$reportdata["cid"];
  $current1=$reportdata["s_id"];
  $current2=$reportdata["aid"];
if($prev!=$current)
{?>
<tr id="sub_title" bgcolor="#FFFFFF">
<td height="20" style="text-align:right;"><strong><?php echo $reportdata['componenCode']; ?></strong></td>
<td style="text-align:left;"><div align="left"><strong><?php echo $reportdata['componentDetail']; ?></strong></div></td>
<td style="text-align:left;"><?php echo "%";?></td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<!--<td style="text-align:left;"></td>-->
</tr>
<?php
}
?>
<?php $jan_mtargets=getMilestoneTargets(1,$reportdata['aid']);
									$feb_mtargets=getMilestoneTargets(2,$reportdata['aid']);
									$mar_mtargets=getMilestoneTargets(3,$reportdata['aid']);
									$apr_mtargets=getMilestoneTargets(4,$reportdata['aid']);
									$may_mtargets=getMilestoneTargets(5,$reportdata['aid']);
									$jun_mtargets=getMilestoneTargets(6,$reportdata['aid']);
									$jul_mtargets=getMilestoneTargets(7,$reportdata['aid']);
									$aug_mtargets=getMilestoneTargets(8,$reportdata['aid']);
									$sep_mtargets=getMilestoneTargets(9,$reportdata['aid']);
									$oct_mtargets=getMilestoneTargets(10,$reportdata['aid']);
									$nov_mtargets=getMilestoneTargets(11,$reportdata['aid']);
									$dec_mtargets=getMilestoneTargets(12,$reportdata['aid']);
// $total_targets=$jan_mtargets+$feb_mtargets+$mar_mtargets+$apr_mtargets+$may_mtargets+$jun_mtargets+$jul_mtargets+$aug_mtargets+$sep_mtargets+$oct_mtargets+$nov_mtargets+$dec_mtargets;
 $jan_machieve=getMilestoneAchieve(1,$reportdata['aid']);
									$feb_machieve=getMilestoneAchieve(2,$reportdata['aid']);
									$mar_machieve=getMilestoneAchieve(3,$reportdata['aid']);
									$apr_machieve=getMilestoneAchieve(4,$reportdata['aid']);
									$may_machieve=getMilestoneAchieve(5,$reportdata['aid']);
									$jun_machieve=getMilestoneAchieve(6,$reportdata['aid']);
									$jul_machieve=getMilestoneAchieve(7,$reportdata['aid']);
									$aug_machieve=getMilestoneAchieve(8,$reportdata['aid']);
									$sep_machieve=getMilestoneAchieve(9,$reportdata['aid']);
									$oct_machieve=getMilestoneAchieve(10,$reportdata['aid']);
									$nov_machieve=getMilestoneAchieve(11,$reportdata['aid']);
									$dec_machieve=getMilestoneAchieve(12,$reportdata['aid']);
 //$total_achieve=$jan_machieve+$feb_machieve+$mar_machieve+$apr_machieve+$may_machieve+$jun_machieve+$jul_machieve+$aug_machieve+$sep_machieve+$oct_machieve+$nov_machieve+$dec_machieve;
 //$grand_total_achieve+= $total_achieve;
 //$grand_total_target+= $total_targets;
$latest_month=getLatestMonth($reportdata['aid']);
  if($latest_month!=0)
  {
  $latest_achieved=getLatestMilestoneProgress($reportdata['aid'],$latest_month);
  }
if($latest_achieved!=0&&$reportdata['milestoneBaseline']!=0)
 {
	 $comm_progress+=($latest_achieved/$reportdata['milestoneBaseline']);
 $progress=($latest_achieved/$reportdata['milestoneBaseline'])*100*($reportdata['assig']/100);
 }
 else
 {
	 $progress=0;
	 }
	 $latest_achieved=0;
?>
<?php if($prev1!=$current1)
{?>
<tr style="background-color:<?php echo $bgcolor;?>;">
<td height="20" style="text-align:right;"><strong><?php echo $reportdata['subcomponentsCode']; ?></strong></td>
<td style="text-align:left;"><strong><?php echo $reportdata['subcomponentsDetail']; ?></strong></td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;"><?php 
 $sub_com_prog=getSubComponentCommProg($reportdata["s_id"]);
 $sub_com_prog_p=$sub_com_prog*100;
 echo number_format($sub_com_prog_p,2). "&nbsp;%";?></td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
</tr>
<?php
}
?>
<?php if($prev2!=$current2)
{
	?>
<tr   style="text-align:right;color:#009">
<td height="20" style="text-align:right;"><?php echo $reportdata['milestoneCode']; ?></td>
<td style="text-align:left;"><?php echo $reportdata['milestoneDetail']; ?></td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;"><?php echo number_format($reportdata['milestoneBaseline'],2); ?></td>
<td style="text-align:right;"><span style="text-align:right;"><?php echo number_format($reportdata['assig'])."&nbsp;%"; ?></span></td>
<td style="text-align:left;"><?php 
 
 echo number_format($progress,2). "&nbsp;%";?></td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">&nbsp;</td>
</tr>
<tr   style="text-align:right;color:#000">
<td height="20" style="text-align:right;">&nbsp;</td>
<td style="text-align:right;">Target:</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:left;">&nbsp;</td>
<td style="text-align:right;"><?php 
									echo number_format($jan_mtargets,0);?></td>
<td style="text-align:right;"><?php $feb_mtargets=getMilestoneTargets(2,$reportdata['aid']);
									echo number_format($feb_mtargets,0);?></td>
<td style="text-align:right;"><?php $mar_mtargets=getMilestoneTargets(3,$reportdata['aid']);
									echo number_format($mar_mtargets,0);?></td>
<td style="text-align:right;"><?php $apr_mtargets=getMilestoneTargets(4,$reportdata['aid']);
									echo number_format($apr_mtargets,0);?></td>
<td style="text-align:right;"><?php $may_mtargets=getMilestoneTargets(5,$reportdata['aid']);
									echo number_format($may_mtargets,0);?></td>
<td style="text-align:right;"><?php $jun_mtargets=getMilestoneTargets(6,$reportdata['aid']);
									echo number_format($jun_mtargets,0);?></td>
<td style="text-align:right;"><?php $jul_mtargets=getMilestoneTargets(7,$reportdata['aid']);
									echo number_format($jul_mtargets,0);?></td>
<td style="text-align:right;"><?php $aug_mtargets=getMilestoneTargets(8,$reportdata['aid']);
									echo number_format($aug_mtargets,0);?></td>
<td style="text-align:right;"><?php $sep_mtargets=getMilestoneTargets(9,$reportdata['aid']);
									echo number_format($sep_mtargets,0);?></td>
<td style="text-align:right;"><?php $oct_mtargets=getMilestoneTargets(10,$reportdata['aid']);
									echo number_format($oct_mtargets,0);?></td>
<td style="text-align:right;"><?php $nov_mtargets=getMilestoneTargets(11,$reportdata['aid']);
									echo number_format($nov_mtargets,0);?></td>
<td style="text-align:right;"><?php $dec_mtargets=getMilestoneTargets(12,$reportdata['aid']);
									echo number_format($dec_mtargets,0);?></td>
</tr>
<tr   style="text-align:right;color:#000">
    <td height="20" style="text-align:right;">&nbsp;</td>
    <td style="text-align:right;">Achieved:</td>
    <td style="text-align:left;">&nbsp;</td>
    <td style="text-align:left;">&nbsp;</td>
    <td style="text-align:left;">&nbsp;</td>
    <td style="text-align:left;">&nbsp;</td>
    <td style="text-align:right;"><?php $jan_machieve=getMilestoneAchieve(1,$reportdata['aid']);
									echo number_format($jan_machieve,0);?></td>
    <td style="text-align:right;"><?php $feb_machieve=getMilestoneAchieve(2,$reportdata['aid']);
									echo number_format($feb_machieve,0);?></td>
    <td style="text-align:right;"><?php $mar_machieve=getMilestoneAchieve(3,$reportdata['aid']);
									echo number_format($mar_machieve,0);?></td>
    <td style="text-align:right;"><?php $apr_machieve=getMilestoneAchieve(4,$reportdata['aid']);
									echo number_format($apr_machieve,0);?></td>
    <td style="text-align:right;"><?php $may_machieve=getMilestoneAchieve(5,$reportdata['aid']);
									echo number_format($may_machieve,0);?></td>
    <td style="text-align:right;"><?php $jun_machieve=getMilestoneAchieve(6,$reportdata['aid']);
									echo number_format($jun_machieve,0);?></td>
    <td style="text-align:right;"><?php $jul_machieve=getMilestoneAchieve(7,$reportdata['aid']);
									echo number_format($jul_machieve,0);?></td>
    <td style="text-align:right;"><?php $aug_machieve=getMilestoneAchieve(8,$reportdata['aid']);
									echo number_format($aug_machieve,0);?></td>
    <td style="text-align:right;"><?php $sep_machieve=getMilestoneAchieve(9,$reportdata['aid']);
									echo number_format($sep_machieve,0);?></td>
    <td style="text-align:right;"><?php $oct_machieve=getMilestoneAchieve(10,$reportdata['aid']);
									echo number_format($oct_machieve,0);?></td>
    <td style="text-align:right;"><?php $nov_machieve=getMilestoneAchieve(11,$reportdata['aid']);
									echo number_format($nov_machieve,0);?></td>
    <td style="text-align:right;"><?php $dec_machieve=getMilestoneAchieve(12,$reportdata['aid']);
									echo number_format($dec_machieve,0);?></td>
  </tr>
<?php
}
?>


<?php
$prev=$reportdata['cid'];
$prev1=$reportdata['s_id'];
$prev2=$reportdata['aid'];
}
?>
</table>

<?php
}
?>
</div>