<?php if( $activityid == 0 && $subactivityid == 0)
{?>
<table border="0" cellpadding="0px" cellspacing="0px" align="left" width="100%"  style="padding:0; margin:0;"> 
<tr> 
<td align="left" valign="top" width="50%" >
        
        <script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: '1-GROUTING'
            },
            subtitle: {
                text: '<?php echo "Daily Progress";?>'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: '% Done'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e. %b', this.x) +': '+ this.y +' %';
                }
            },
            
            series: [
			<?php  			$code_str="";
				
				$reportquery ="SELECT * FROM dpm_data where aid=1 order by  act_id ASC";
				$reportresult = mysql_query($reportquery);
				if($reportresult!=0)
				{
				$num=mysql_num_rows($reportresult);
				}
				$ii=0;
				$activity_title="";
				
				while ($reportdata = mysql_fetch_array($reportresult)) {
					$activity_title=trim($reportdata['acode'])."-".trim($reportdata['detail']);
					$ii++;
					
					// $code_str .="'".$reportdata['subcomponentsCode']."'";
					
					
				
			 ?> {
                name: '<?php echo trim(stripslashes($reportdata['sdetail'])).$ii;?>',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [
				<?php echo GetProgressDates($reportdata['aid'],$reportdata['sa_id']);?>
                    
                   
                ]
            }
			<?php  if($ii<$num)
					 {
					 echo $code_str =" , ";
					  
					 }?>
            <?php }?>]
        });
    });
    

		</script>
        <table width="90%"  align="right" border="0" style="margin:5px 10px 5px 10px">
   
   <tr>
     <td height="99"  style="line-height:18px; text-align:justify; vertical-align:top">
     <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
     </td>
     
   </tr>
   
</table></td>
</tr>
<tr> 
<td align="left" valign="top" width="50%" >
        
        <script type="text/javascript">
$(function () {
        $('#container2').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: '2-INTAKE EXCAVATION'
            },
            subtitle: {
                text: '<?php echo "Daily Progress";?>'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: '% Done'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e. %b', this.x) +': '+ this.y +' %';
                }
            },
            
            series: [
			<?php  			$code_str="";
				
				$reportquery ="SELECT * FROM dpm_data where aid=2 order by  act_id ASC";
				$reportresult = mysql_query($reportquery);
				if($reportresult!=0)
				{
				$num=mysql_num_rows($reportresult);
				}
				$ii=0;
				$activity_title="";
				
				while ($reportdata = mysql_fetch_array($reportresult)) {
					$activity_title=trim($reportdata['acode'])."-".trim($reportdata['detail']);
					$ii++;
					
					// $code_str .="'".$reportdata['subcomponentsCode']."'";
					
					
				
			 ?> {
                name: '<?php echo trim(stripslashes($reportdata['sdetail'])).$ii;?>',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [
				<?php echo GetProgressDates($reportdata['aid'],$reportdata['sa_id']);?>
                    
                   
                ]
            }
			<?php  if($ii<$num)
					 {
					 echo $code_str =" , ";
					  
					 }?>
            <?php }?>]
        });
    });
    

		</script>
        <table width="90%"  align="right" border="0" style="margin:5px 10px 5px 10px">
   
   <tr>
     <td height="99"  style="line-height:18px; text-align:justify; vertical-align:top">
     <div id="container2" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
     </td>
     
   </tr>
   
</table></td>
</tr>
<tr> 
<td align="left" valign="top" width="50%" >
        
        <script type="text/javascript">
$(function () {
        $('#container3').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: '3-POWERHOUSE'
            },
            subtitle: {
                text: '<?php echo "Daily Progress";?>'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: '% Done'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e. %b', this.x) +': '+ this.y +' %';
                }
            },
            
            series: [
			<?php  			$code_str="";
				
				$reportquery ="SELECT * FROM dpm_data where aid=3 order by  act_id ASC";
				$reportresult = mysql_query($reportquery);
				if($reportresult!=0)
				{
				$num=mysql_num_rows($reportresult);
				}
				$ii=0;
				$activity_title="";
				
				while ($reportdata = mysql_fetch_array($reportresult)) {
					$activity_title=trim($reportdata['acode'])."-".trim($reportdata['detail']);
					$ii++;
					
					// $code_str .="'".$reportdata['subcomponentsCode']."'";
					
					
				
			 ?> {
                name: '<?php echo trim(stripslashes($reportdata['sdetail'])).$ii;?>',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [
				<?php echo GetProgressDates($reportdata['aid'],$reportdata['sa_id']);?>
                    
                   
                ]
            }
			<?php  if($ii<$num)
					 {
					 echo $code_str =" , ";
					  
					 }?>
            <?php }?>]
        });
    });
    

		</script>
        <table width="90%"  align="right" border="0" style="margin:5px 10px 5px 10px">
   
   <tr>
     <td height="99"  style="line-height:18px; text-align:justify; vertical-align:top">
     <div id="container3" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
     </td>
     
   </tr>
   
</table></td>
</tr>
<tr> 
<td align="left" valign="top" width="50%" >
        
        <script type="text/javascript">
$(function () {
        $('#container4').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: '4-PRE-COFFERDAM REMOVAL'
            },
            subtitle: {
                text: '<?php echo "Daily Progress";?>'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: '% Done'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e. %b', this.x) +': '+ this.y +' %';
                }
            },
            
            series: [
			<?php  			$code_str="";
				
				$reportquery ="SELECT * FROM dpm_data where aid=4 order by  act_id ASC";
				$reportresult = mysql_query($reportquery);
				if($reportresult!=0)
				{
				$num=mysql_num_rows($reportresult);
				}
				$ii=0;
				$activity_title="";
				
				while ($reportdata = mysql_fetch_array($reportresult)) {
					$activity_title=trim($reportdata['acode'])."-".trim($reportdata['detail']);
					$ii++;
					
					// $code_str .="'".$reportdata['subcomponentsCode']."'";
					
					
				
			 ?> {
                name: '<?php echo trim(stripslashes($reportdata['sdetail'])).$ii;?>',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [
				<?php echo GetProgressDates($reportdata['aid'],$reportdata['sa_id']);?>
                    
                   
                ]
            }
			<?php  if($ii<$num)
					 {
					 echo $code_str =" , ";
					  
					 }?>
            <?php }?>]
        });
    });
    

		</script>
        <table width="90%"  align="right" border="0" style="margin:5px 10px 5px 10px">
   
   <tr>
     <td height="99"  style="line-height:18px; text-align:justify; vertical-align:top">
     <div id="container4" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
     </td>
     
   </tr>
   
</table></td>
</tr>
<tr> 
<td align="left" valign="top" width="50%" >
        
        <script type="text/javascript">
$(function () {
        $('#container5').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: '5-SWITCHYARD'
            },
            subtitle: {
                text: '<?php echo "Daily Progress";?>'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: '% Done'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e. %b', this.x) +': '+ this.y +' %';
                }
            },
            
            series: [
			<?php  			$code_str="";
				
				$reportquery ="SELECT * FROM dpm_data where aid=5 order by  act_id ASC";
				$reportresult = mysql_query($reportquery);
				if($reportresult!=0)
				{
				$num=mysql_num_rows($reportresult);
				}
				$ii=0;
				$activity_title="";
				
				while ($reportdata = mysql_fetch_array($reportresult)) {
					$activity_title=trim($reportdata['acode'])."-".trim($reportdata['detail']);
					$ii++;
					
					// $code_str .="'".$reportdata['subcomponentsCode']."'";
					
					
				
			 ?> {
                name: '<?php echo trim(stripslashes($reportdata['sdetail'])).$ii;?>',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [
				<?php echo GetProgressDates($reportdata['aid'],$reportdata['sa_id']);?>
                    
                   
                ]
            }
			<?php  if($ii<$num)
					 {
					 echo $code_str =" , ";
					  
					 }?>
            <?php }?>]
        });
    });
    

		</script>
        <table width="90%"  align="right" border="0" style="margin:5px 10px 5px 10px">
   
   <tr>
     <td height="99"  style="line-height:18px; text-align:justify; vertical-align:top">
     <div id="container5" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
     </td>
     
   </tr>
   
</table></td>
</tr>
<tr> 
<td align="left" valign="top" width="50%" >
        
        <script type="text/javascript">
$(function () {
        $('#container6').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: '6-SHAFT EXCAVATION and LINING'
            },
            subtitle: {
                text: '<?php echo "Daily Progress";?>'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: '% Done'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e. %b', this.x) +': '+ this.y +' %';
                }
            },
            
            series: [
			<?php  			$code_str="";
				
				$reportquery ="SELECT * FROM dpm_data where aid=6 order by  act_id ASC";
				$reportresult = mysql_query($reportquery);
				if($reportresult!=0)
				{
				$num=mysql_num_rows($reportresult);
				}
				$ii=0;
				$activity_title="";
				
				while ($reportdata = mysql_fetch_array($reportresult)) {
					$activity_title=trim($reportdata['acode'])."-".trim($reportdata['detail']);
					$ii++;
					
					// $code_str .="'".$reportdata['subcomponentsCode']."'";
					
					
				
			 ?> {
                name: '<?php echo trim(stripslashes($reportdata['sdetail'])).$ii;?>',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [
				<?php echo GetProgressDates($reportdata['aid'],$reportdata['sa_id']);?>
                    
                   
                ]
            }
			<?php  if($ii<$num)
					 {
					 echo $code_str =" , ";
					  
					 }?>
            <?php }?>]
        });
    });
    

		</script>
        <table width="90%"  align="right" border="0" style="margin:5px 10px 5px 10px">
   
   <tr>
     <td height="99"  style="line-height:18px; text-align:justify; vertical-align:top">
     <div id="container6" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
     </td>
     
   </tr>
   
</table></td>
</tr>
</table>
<?php }?>
