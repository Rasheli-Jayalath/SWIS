<link rel="stylesheet" 
          type="text/css" 
          href="lightbox2-2.11.3/dist/css/lightbox.min.css"> 
    <script src= 
"lightbox2-2.11.3/dist/js/lightbox-plus-jquery.min.js"> 
    </script> 
    <style> 
        body { 
            text-align: center; 
        } 
          
        h2 { 
            color: green; 
        } 
          
        .gallery { 
            margin: 10px 40px; 
			/*border:thin #999 solid;*/
						
			/*//border: thin #999 solid;*/
        } 
          
        .gallery img { 
            width: 165px; 
            height: 150px; 
            transition: 1s; 
            padding: 5px; 
        } 
          
        .gallery img:hover { 
            filter: drop-shadow(4px 4px 6px gray); 
            transform: scale(1.1); 
        } 
		.new_div li {
    list-style: outside none none;
}
    </style> 
<?php
$uploadPath = "./WaterQualityMaps";
//$dcode=$componentid;
/* $tcode=$subcomponentid;
  $wsssno=$vcode;*/
 $behavid=$behavid;
 $iCount = 0;
   $SQLp = "Select * from p2006wqualitymaps group by dcode";
   $res_sqlp= mysql_query($SQLp); 
   $iCountp = mysql_num_rows($res_sqlp);
    ?>

   
<?php while($ressp=mysql_fetch_array($res_sqlp))
{
	$dcode=$ressp['dcode'];
 $cqueryd = mysql_query("select * from  p2001district where code=$dcode");
	$cdatad = mysql_fetch_array($cqueryd);
	?>
	<div style="clear:both"></div>
	 <h2 align="left" style="margin-left:8px"><?php echo $cdatad['name']; ?></h2> 
  <?php  $SQL = "Select * from p2006wqualitymaps where dcode=".$dcode. " group by tcode";
   $res_sql= mysql_query($SQL); 
   $iCount = mysql_num_rows($res_sql);
    ?>

   
<?php while($ress=mysql_fetch_array($res_sql))
{
 $tcode=$ress["tcode"];
$SQL4 = "Select * from p2002tehsil where code=".$tcode;
   $res_sql4= mysql_query($SQL4);
   $ress4=mysql_fetch_array($res_sql4);
   
?>
<div style="clear:both"></div>
<h3 align="left" style="margin-left:10px"><?php echo $ress4['tehsil']; ?></h3>

 <?php  $SQLd = "Select * from p2006wqualitymaps where tcode=".$tcode;
   $res_sqld= mysql_query($SQLd); 
   $iCountd = mysql_num_rows($res_sqld);
    ?>

<ul>   
<?php while($ressd=mysql_fetch_array($res_sqld))
{
	?>
<div class="new_div">
			<li class="dfwp-item">
	<div  class="gallery" style="float:left;margin-right:0px;">

	   <a  href=" <?php echo SITE_URL;?><?php echo $uploadPath;?>/<?php echo $ressd['item_name']?>" data-lightbox="mygallery"  style="text-decoration:none" >
       
       
	<div style="border: thin #999 solid; padding: 3px;margin-bottom: 5px;">	
	<img src="<?php echo SITE_URL;?><?php echo $uploadPath;?>/<?php echo $ressd['item_name']?>"  border="0" width="150px" height="112px" title="<?php echo $ressd['image_name']?>"/>
    </div>
	 	</a>
        <div align="center" class="imageTitle" style="padding-top:5px; font-weight:bold">
   
		<?php if(strlen($ressd['image_name'])>15)
		{
		echo substr($ressd['image_name'],0,15)."...";
		}
		else
		{
		echo $ressd['image_name'];
		} ?>				     </div>
	</div>

	
	
	
	</li>
	</div>
    
    
    
    



				
    
<?php 
}
?>
</ul>
</div>
<?php
}

}?> 
    
