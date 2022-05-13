<div>
<?php
 $dcode=$componentid;
 $tcode=$subcomponentid;
 $vcode=$activityid;
 

if($dcode!="" && $tcode!="" && $vcode!="")
{
 $behavid=$behavid;


$tabletitle = "Water Supply Scheme";

    $iCount = 0;
   $SQL = "Select sno, wssname, exeagency, exeagencyval, omagency, omagencyval, status, statusval, reason, reasonval from gisdatabase.p2005wss where dcode = '".$dcode."' and tcode = '".$tcode."' and vcode = '".$vcode."' group by giscode";
  $reportresult= mysql_query($SQL);
  if($reportresult!=0)
				{
				$iCount=mysql_num_rows($reportresult);
				}
  
    ?>
	<br/>
	
    <table cellspacing="0" cellpadding="0" border="1px"  align="center" >
	
      <tr  >
        <th colspan="5"  align="center"  width="700"><?php echo $tabletitle; ?> </th> 
      </tr>
      <tr class="colheader"  >
        <td class="colheader"  >Name</td>
        <td class="colheader"  >Executing Agency</td>
        <td class="colheader"  >Operating Agency</td>
        <td class="colheader"   >Status</td>
        <td class="colheader" >Remarks</td>
      </tr>
<?php while($reportdata = mysql_fetch_array($reportresult)) { ?>
      <tr>
        <td   align="left" class="colheaderleft"  ><a href="wss.php?giscode=<?=$giscode."-".$reportdata['sno']; ?>" target="_blank" class="colheaderleft">
		<?=$reportdata['wssname']; ?></a></td>
        <td  align="center"><?=$reportdata['exeagencyval']; ?></td>
        <td  align="center"><?= $reportdata['omagencyval']; ?></td>
        <td align="center"><?= $reportdata['statusval']; ?></td>
        <td align="center"><?= $reportdata['reasonval'];?></td>
      </tr>
<?php } ?>
    </table>
<br/>

<!--<style>
#tabs {
  overflow: auto;
  width: 100%;
  list-style: none;
  margin: 0;
  padding: 0;
}

#tabs li {
    margin: 0;
    padding: 0;
    float: left;
}

#tabs a {
    box-shadow: -4px 0 0 rgba(0, 0, 0, .2);
    background: #ad1c1c;
    background: linear-gradient(220deg, transparent 10px, blue 10px);
    text-shadow: 0 1px 0 rgba(0,0,0,.5);
    color: #fff;
    float: left;
    font: bold 12px/35px 'Lucida sans', Arial, Helvetica;
    height: 35px;
    padding: 0 30px;
    text-decoration: none;
}

#tabs a:hover {
    background: #c93434;
    background: linear-gradient(220deg, transparent 10px, #c93434 10px);     
}

#tabs a:focus {
    outline: 0;
}

#tabs #current a {
    background: #fff;
    background: linear-gradient(220deg, transparent 10px, #fff 10px);
    text-shadow: none;    
    color: #333;
}

#content {
    background-color: #fff;
    background-image:         linear-gradient(top, #fff, #ddd);
    border-radius: 0 2px 2px 2px;
    box-shadow: 0 2px 2px #000, 0 -1px 0 #fff inset;
    padding: 30px;
}

/* Remove the rule below if you want the content to be "organic" */
#content div {
    height: 220px; 
}
</style>-->


<!--
<ul id="tabs">
    <li><a href="#" title="tab1">One</a></li>
    <li><a href="#" title="tab2">Two</a></li>
    <li><a href="#" title="tab3">Three</a></li>
    <li><a href="#" title="tab4">Four</a></li> 
	  
</ul>-->

<div id="content"> 

    <!--<div id="tab1">One - content</div>
    <div id="tab2">Two - content</div>
    <div id="tab3">Three - content</div>
    <div id="tab4">Four - content</div>
</div>-->


 <?php
 
    /* Demographic Information - Players
    epadmale
    epadfemale
    epchmale
    epchfemale
    */
	
    $iCount = 0;
    $SQL = "Select sum(epadmale) as admales, sum(epadfemale) as adfemales, sum(epchmale) as chmales, sum(epchfemale) as chfemales from gisdatabase.p2004vp where dcode = '".$dcode."' and tcode = '".$tcode."' and vcode = '".$vcode."' group by giscode";
     $reportresult= mysql_query($SQL);
    $iCount=mysql_num_rows($reportresult);
    if($iCount>0) {
	while($reportdata = mysql_fetch_array($reportresult)) {
        $adultmales		=$reportdata['admales'];
        $adultfemales	= $reportdata['adfemales'];
       	$childmales		=$reportdata['chmales'];
        $childfemales	= $reportdata['chfemales'];
		$giscodee	= $reportdata['giscode'];
		}
    }
	
    ?>
	
	 <script type="text/javascript">
    $(function () {
	
	
        $('#Demographic').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
             credits: {
                enabled: false
            },
            title: {
                text: 'Demographic Mix'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> <br/> <b></b> {point.y:1f}' 
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>:  {point.percentage:.1f} % [{point.y:1f}] '
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Population Mix:',
                data: [
                    ['Adult Males',       <?php echo $adultmales;?>],
                    ['Adult Females',   <?php echo $adultfemales;?>],
                    ['Child Males',   <?php echo $childmales;?>],
                    ['Child Females',   <?php echo $childfemales;?>],
                ]
            }]
        });
    });
        
    </script>
	
	<div id="Demographic" style="margin: 0 auto; width:600px;"></div>
	<div align="right" ><a  href="javascript:void(null);" onClick="doToggle('ord_<?php echo $giscodee;?>');" title="detail">Detail</a></div>
	<br/>
    <div id="ord_<?php echo $giscodee;?>" style="display:none;">
   <table cellspacing="0" cellpadding="0" border="1px"  width="650" align="center">
 
    <tr  >
        <th colspan="6" align="center">Demographic Information</th>
      </tr>
      <tr  >
        <td  align="center" class="colheader">Description</td>
        <td  align="center" class="colheader">Male</td>
        <td  align="center" class="colheader">Female</td>
        <td  align="center" class="colheader">Total</td>
        <td  align="center" class="colheader">% of Male</td>
        <td  align="center" class="colheader">% of Female</td>
      </tr>
      <tr>
        <td  align="left" class="colheaderleft" s>Adult</td>
        <td   align="right"><?=number_format($adultmales,0); ?></td>
        <td  align="right"><?=number_format($adultfemales,0); ?></td>
        <td  align="right"><?=number_format(($adultmales + $adultfemales),0); ?></td>
        <td   align="right"><?=($adultmales + $adultfemales) > 0 ? number_format(($adultmales/($adultmales + $adultfemales)*100),2) : "0.00" ; ?></td>
        <td  align="right"><?=($adultmales + $adultfemales) > 0 ? number_format(($adultfemales/($adultmales + $adultfemales)*100),2) : "0,00" ; ?></td>
      </tr>
      <tr>
        <td  align="left" class="colheaderleft" >Children up to 10 years</td>
        <td   align="right"><?=number_format($childmales,0); ?></td>
        <td   align="right"><?=number_format($childfemales,0); ?></td>
        <td  align="right"><?=number_format(($childmales + $childfemales),0); ?></td>
        <td   align="right"><?=($childmales + $childfemales) > 0 ? number_format(($childmales/($childmales + $childfemales)*100),2) : "0.00" ; ?></td>
        <td  align="right"><?=($childmales + $childfemales) > 0 ? number_format(($childfemales/($childmales + $childfemales)*100),2) : "0.00" ; ?></td>
      </tr>
      <tr s>
        <td align="left" class="colheaderleft">Total</td>
        <td  align="right"><?=number_format(($adultmales + $childmales),0); ?></td>
        <td   align="right"><?=number_format(($adultfemales + $childfemales),0); ?></td>
        <td  align="right"><?=number_format(($adultmales + $adultfemales + $childmales + $childfemales),0); ?></td>
        <td width="83" align="right"><?=($adultmales + $adultfemales + $childmales + $childfemales) > 0 ? number_format((($adultmales + $childmales) / ($adultmales + $adultfemales + $childmales + $childfemales)*100),2) : "0.00" ; ?></td>
        <td width="83" align="right"><?=($adultmales + $adultfemales + $childmales + $childfemales) > 0 ? number_format((($adultfemales + $childfemales) /($adultmales + $adultfemales + $childmales + $childfemales)*100),2) : "0.00" ; ?></td>
      </tr>
    </table>
	</div>
	
	

<?php
$iCount = 0;
$SQL1 = "Select sum(qread) as quran, sum(prlevel) as primarylevel, sum(matlevel) as matric, sum(intlevel) as intermediate, sum(gralevel) as graduate, sum(malevel) as masterslevel, sum(dipcer) as diploma, sum(skilled) as skilled, sum(other) as other from gisdatabase.p2004vp where dcode = '".$dcode."' and tcode = '".$tcode."' and vcode = '".$vcode."' group by giscode";

$reportresult1= mysql_query($SQL1);
    $iCount=mysql_num_rows($reportresult1);
    if($iCount>0) {
	while($reportdata1 = mysql_fetch_array($reportresult1)) {
        $quran		=$reportdata1['quran'];
        $primarylevel	= $reportdata1['primarylevel'];
        $matric		=$reportdata1['matric'];
        $intermediate	= $reportdata1['intermediate'];
		$graduate		=$reportdata1['graduate'];
        $masterslevel	= $reportdata1['masterslevel'];
        $diploma		=$reportdata1['diploma'];
        $skilled	= $reportdata1['skilled'];
		$other	= $reportdata1['other'];
		$giscodee	= $reportdata1['giscode'];
			$total			= $quran + $primary + $matric + $intermediate + $graduate + $masters + $diploma + $skilled + $other + 0;

		}
    }



?>	
 <script type="text/javascript">
    $(function () {
        $('#educationlevel').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
             credits: {
                enabled: false
            },
            title: {
                text: 'Education Level'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> <br/> <b></b> {point.y:1f}' 
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>:  {point.percentage:.1f} % [{point.y:1f}] '
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Education Level:',
                data: [
                    ['Quran Read',       <?php echo $quran;?>],
                    ['Primary Level',   <?php echo $primarylevel;?>],
                    ['Matric Level',   <?php echo $matric;?>],
                    ['Intermediate Level',   <?php echo $intermediate;?>],
                    ['Graduation Level',   <?php echo $graduate;?>],				
                    ['Masters Level',       <?php echo $masterslevel;?>],
                    ['Diploma/Certificate',   <?php echo $diploma;?>],
                    ['Skilled',   <?php echo $skilled;?>],
                    ['Other',   <?php echo $other;?>],
                ]
            }]
        });
    });
        
    </script>
    <div id="educationlevel" style="margin: 0 auto; width:600px;"></div>
	<div align="right" ><a  href="javascript:void(null);" onClick="doToggle('edu_<?php echo $giscodee;?>');" title="detail">Detail</a></div>
	<br/>
    <div id="edu_<?php echo $giscodee;?>" style="display:none;">
	<table cellspacing="0" cellpadding="0" border="1px"  align="center" >
    <tr >
    <th colspan="3" width="500" align="center">Education Level</th>
  </tr>
    <tr class="colheader" >
    <td class="colheader" align="center">Level</td>
    <td class="colheader" align="center">Total No.</td>
    <td class="colheader" align="center">%</td>
  </tr>
  <tr>
    <td align="left" class="colheaderleft" s>Quran Read</td>
    <td  align="right"><?=number_format($quran,0); ?></td>
    <td   align="right"><?=($total > 0 ? number_format($quran/$total*100,2) : '0.00'); ?></td>
  </tr>
  <tr>
    <td  align="left" class="colheaderleft" s>Primary</td>
    <td  align="right"><?=number_format($primary,0); ?></td>
    <td  align="right"><?=($total > 0 ? number_format($primary/$total*100,2) : '0.00'); ?></td>
  </tr>
  <tr>
    <td  align="left" class="colheaderleft" s>Matric</td>
    <td  align="right"><?=number_format($matric,0); ?></td>
    <td  align="right"><?=($total > 0 ? number_format($matric/$total*100,2) : '0.00'); ?></td>
  </tr>
  <tr>
    <td  align="left" class="colheaderleft" s>Inter</td>
    <td  align="right"><?=number_format($intermediate,0); ?></td>
    <td  align="right"><?=($total > 0 ? number_format($intermediate/$total*100,2) : '0.00'); ?></td>
  </tr>
  <tr>
    <td  align="left" class="colheaderleft" s>Graduation</td>
    <td  align="right"><?=number_format($graduate,0); ?></td>
    <td   align="right"><?=($total > 0 ? number_format($graduate/$total*100,2) : '0.00'); ?></td>
  </tr>
  <tr>
    <td  align="left" class="colheaderleft" s>MA/MSc.</td>
    <td  align="right"><?=number_format($masters,0); ?></td>
    <td  align="right"><?=($total > 0 ? number_format($masters/$total*100,2) : '0.00'); ?></td>
  </tr>
  <tr>
    <td  align="left" class="colheaderleft" s>Diploma/Ceritificate</td>
    <td  align="right"><?=number_format($diploma,0); ?></td>
    <td  align="right"><?=($total > 0 ? number_format($diploma/$total*100,2) : '0.00'); ?></td>
  </tr>
  <tr>
    <td  align="left" class="colheaderleft" s>Skilled</td>
    <td  align="right"><?=number_format($skilled,0); ?></td>
    <td  align="right"><?=($total > 0 ? number_format($skilled/$total*100,2) : '0.00'); ?></td>
  </tr>
  <tr>
    <td  align="left" class="colheaderleft" s>Other</td>
    <td  align="right"><?=number_format($other,0); ?></td>
    <td  align="right"><?=($total > 0 ? number_format($other/$total*100,2) : '0.00'); ?></td>
  </tr>
    <tr >
    <td class="colheaderleft" >Total</td>
    <td  align="right"><?=number_format($total,0); ?></td>
    <td  align="right"><?=($total > 0 ? number_format($total/$total*100,2) : '0.00'); ?></td>
  </tr>
</table>

</div>
</div>
<?php
}
?>   
</div>
