<?php
 $incPage = $objCommon->getAdminPage(trim($_GET['p']));


?>


<!--# Main including page.-->
<?php if(isset($incPage)&&$incPage!="")
{

require_once("$incPage");
}
if(isset($incPage)&&$incPage=="index.php")
{

?>

<table width="90%"  align="center" border="0" >
<tr>
  <td height="40" align="left" style="color:#0E0989; font-size:21px" >&nbsp;</td>
  <td align="left" style="color:#0E0989; font-size:21px" >&nbsp;</td>
  <td align="left" style="color:#0E0989; font-size:21px" >&nbsp;</td>
  <td align="left" style="color:#0E0989; font-size:21px" >&nbsp;</td>
  <td align="left" style="color:#0E0989; font-size:21px" >&nbsp;</td>
</tr>
<tr>
     <td width="2%" height="40" align="left" style="color:#0E0989; font-size:21px" >&nbsp;</td>
     <td width="32%" align="left" style="color:#0E0989; font-size:21px" ><a href="./mosactlevel.php" target="_blank" ><img src="images/phy-fin-sys1.png" width="175" 
     height="175" alt="Physical/Financial Progress Monitoring system" 
onmouseover="this.src='images/phy-fin-sys1_over.png'" onmouseout="this.src='images/phy-fin-sys1.png'"/></a></td>
     <td width="34%" align="left" style="color:#0E0989; font-size:21px" >
     <?php if($objAdminUser->member_cd==13){?>
     <a href="#"><img src="images/onsite1.png" width="175" height="175" alt="On-Site Progress Monitoring System" onmouseover="this.src='images/onsite1_over.png'" onmouseout="this.src='images/onsite1.png'"/></a>
     <?php }else { ?>
     <a href="./mossite.php" target="_blank"><img src="images/onsite1.png" width="175" height="175" alt="On-Site Progress Monitoring System" onmouseover="this.src='images/onsite1_over.png'" onmouseout="this.src='images/onsite1.png'"/></a>
     <?php }?></td>
     <td width="28%" align="left" style="color:#0E0989; font-size:21px" >
      <?php if($objAdminUser->member_cd==13||$objAdminUser->member_cd==12){?>
	   <a href="#"><img src="images/water1.png" width="175" height="175" alt="water discharge Monitoring System" /></a>
	<?php }else { ?>
      <a href="./dischargedata_panel.php" target="_blank"><img src="images/water1.png" width="175" height="175" alt="water discharge Monitoring System" 
	onmouseover="this.src='images/water1_over.png'" onmouseout="this.src='images/water1.png'"/></a>
	<?php }?></td>
     <td width="4%" align="left" style="color:#0E0989; font-size:21px" >
     <?php if($objAdminUser->member_cd==13||$objAdminUser->member_cd==12){?>
	 <a href="#" ><img src="images/financial2.png" width="175" height="175" alt="FMIS"/></a>
	  <?php }else { ?>
     <a href="http://www.egcpakistan.com/lbdcip_fms" target="_blank"><img src="images/financial2.png" width="175" height="175" alt="FMIS" 
      onmouseover="this.src='images/financial2_over.png'" onmouseout="this.src='images/financial2.png'"/></a><?php }?>
      </td>
   </tr>   
   <tr>
     <td height="40" align="left" style="color:#0E0989; font-size:21px" >&nbsp;</td>
     <td align="left"  class="icon_text"  ><a href="./mosactlevel.php" target="_blank" style="color:#00A376;">Financial/Physical Progress Monitoring System</a></td>
     <td align="left" class="icon_text" ><?php 
	 if($objAdminUser->member_cd==13){?><a href="#" style="color:#D39F00;">On-Site Progress Monitoring System</a<?php }else { ?>
     <a href="./mossite.php" target="_blank" 
     style="color:#B70072;" >On-Site Progress Monitoring System</a>
     <?php } ?></td>
     <td align="left"  class="icon_text" ><?php 
	 if($objAdminUser->member_cd==13||$objAdminUser->member_cd==12){?><a href="#" style="color:#D39F00;"><?php }else { ?><a href="./dischargedata_panel.php" target="_blank" style="color:#D39F00;"><?php }?>Water Discharge Monitoring System</a></td>
     <td align="left"  class="icon_text"  ><?php if($objAdminUser->member_cd==13||$objAdminUser->member_cd==12){?><a href="#"  style="color:#263887;"><?php }else { ?>
     <a href="http://www.egcpakistan.com/lbdcip_fms" target="_blank" style="color:#263887;"><?php }?>Financial Management System</a></td>
   </tr>
   <tr>
     <td height="40" colspan="5" align="left" style="color:#0E0989; font-size:21px" >Welcome to LBDCIP - Lower Bari Doab Canal Improvement Project</td>
   </tr>
    <tr>
      <td height="31" colspan="5"><strong>Brief Introduction:</strong></td>
    </tr>
   <tr>
     <td height="99" colspan="5"  style="line-height:18px; text-align:justify"><p>
                                    The <b>Lower Bari Doab Canal (LBDC)</b> was built between 1913 and 1917 and is located between Lahore and Multan. The Balloki Barrage on the Ravi River diverts water into the LBDC head regulator and the Balloki-Sulemanki Link Canal. The LBDC main canal stretches over 200 km and supplies water to about 1,500 km of distributary and minor canals, which feed about 3,500 outlets to irrigate over 700,000 hectares. Approximately 275,000 farm families derive their livelihoods directly from crops grown in the LBDC command area including wheat, rice, maize, cotton, sugarcane, fodder, flowers, vegetables, and citrus and other orchard crops.</p>
                                  <p>The <b>Lower Bari Doab Canal Improvement Project (LBDCIP)</b> will help mitigate the risk of damage from floods to the Balloki Barrage and its associated infrastructure besides rehabilitation & upgrading the LBDC system which have several sections prone to breaching. This infrastructure Rehabilitation & Upgrading and development will:</p>
<ul>
<li>ensure that the water supply to the rehabilitated LBDC and the cropping areas supplied by the Balloki-Sulemanki Link Canal is secure,</li>
<li>pass moderate floods through a new spillway reducing the needs to breach upstream levies and inundate adjacent areas as is the current practice, and</li>
<li>construction of two bridges to allow traffic to pass during and following flood events.</li>
</ul>
                          		  <p>The project is funded by a loan from the Asian Development Bank (USD 217.8 million) and Government of the Punjab (USD 53.6 million). The loan (Loan No. 2299-PAK) was signed on 22 June 2007 and became effective on 24 August 2007. The loan closing date is 30 September 2013.
</p>
   </td>
   </tr>
   <tr><td colspan="5" align="center"><img src="images/map.jpg" /></td></tr>
</table>
<?php }?>