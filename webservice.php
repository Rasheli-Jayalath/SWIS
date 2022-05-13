<?php 
require_once("config/config.php");
/*echo  $dcode = $_GET['dcode'];
echo  $tcode = $_GET['tcode'] ;*/

$giscode = $_REQUEST['giscode'];

$dcode=trim(substr($giscode,0,2));
$tcode=trim(substr($giscode,2,2));
$vcode=trim(substr($giscode,4,15));
$objDb  = new Database( );
$iCount=0;
if(!empty($dcode) && !empty($tcode) && !empty($vcode)){

$sql="select iddistrict,idtehsil,idvillage,epadmale, epadfemale,epchmale,epchfemale,giscode from gisdatabase.p2004vp where dcode='".$dcode."' and tcode='".$tcode."' and vcode='".$vcode."'";
$qur=mysql_query($sql);
$result =array();
while($r = mysql_fetch_array($qur)){
extract($r);
$result[] = array("idvillage" => $idvillage, "idtehsil" => $idtehsil, 'iddistrict' => $iddistrict,"epadmale" => $epadmale, "epadfemale" => $epadfemale, 'epchmale' => $epchmale,"epchfemale" => $epchfemale, 'giscode' => $giscode); 

}
$json =  $result;
 }

else if(!empty($dcode) && !empty($tcode) && empty($vcode))
{
$sql="select iddistrict,idtehsil,idvillage,epadmale, epadfemale,epchmale,epchfemale,giscode from gisdatabase.p2004vp where dcode='".$dcode."' and tcode='".$tcode."'";
$qur=mysql_query($sql);
$result =array();
while($r = mysql_fetch_array($qur)){
extract($r);
$result[] = array("idvillage" => $idvillage, "idtehsil" => $idtehsil, 'iddistrict' => $iddistrict,"epadmale" => $epadmale, "epadfemale" => $epadfemale, 'epchmale' => $epchmale,"epchfemale" => $epchfemale, 'giscode' => $giscode); 

}
$json = $result;
 }

else if(!empty($dcode) && empty($tcode) && empty($vcode))
{
$sql="select iddistrict,idtehsil,idvillage,epadmale, epadfemale,epchmale,epchfemale,giscode from gisdatabase.p2004vp where dcode='".$dcode."'";
$qur=mysql_query($sql);
$result =array();
while($r = mysql_fetch_array($qur)){
extract($r);
$result[] = array("idvillage" => $idvillage, "idtehsil" => $idtehsil, 'iddistrict' => $iddistrict,"epadmale" => $epadmale, "epadfemale" => $epadfemale, 'epchmale' => $epchmale,"epchfemale" => $epchfemale, 'giscode' => $giscode); 

}
$json = $result;
 }


else{
 
 $json = array("msg" => "User ID not define");
 }
 
 /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
 ?>