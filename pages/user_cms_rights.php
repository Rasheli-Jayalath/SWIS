<?php
$user_cd = $_GET['user_cd'];
$objAdminUserN = new AdminUser;
$objAdminUserN->setProperty("user_cd", $user_cd);
$objAdminUserN->lstAdminUser();
$rows_c = $objAdminUserN->dbFetchArray();
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['add']){
	$user_cd = $_POST['user_cd'];
	$cms_id = $_POST['cms_id'];
	if(!empty($_POST['cms_id']))
				{
					foreach($_POST['cms_id'] as $val)
					{
					 $cms_right_id = $objAdminUser->genCode("rs_tbl_cms_rights", "cms_right_id");
					$objAdminUser->setProperty("cms_right_id", $cms_right_id);
					$objAdminUser->setProperty("user_cd", $user_cd);
					$objAdminUser->setProperty("cms_id", $val);
					$objAdminUser->actCMSUser("I");
					}
					
					$objCommon->setMessage('User\'s rights added successfully.', 'Info');
					redirect('./?p=user_cms_rights&user_cd='.$user_cd);
				}
					
	      if(empty($_POST['dcms_id']))
			{
			$objCommon->setMessage('No right has been selected ', 'Info');
			}
	

	}
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['del']){
$user_cd = $_POST['user_cd'];
$cms_id = $_POST['dcms_id'];
if(!empty($_POST['dcms_id']))
			{
				foreach($_POST['dcms_id'] as $val)
				{
				
				$objAdminUser->setProperty("user_cd", $user_cd);
				$objAdminUser->setProperty("cms_id", $val);
				$objAdminUser->actCMSUser("D");
				}
				$objCommon->setMessage('User\'s rights Deleted successfully.', 'Error');
				redirect('./?p=user_cms_rights&user_cd='.$user_cd);
			}
				
			if(empty($_POST['dcms_id']))
			{
			$objCommon->setMessage('No right has been selected ', 'Update');
			}


}
if($_GET['mode'] == 'Delete')
{
	$user_cd = $_GET['user_cd'];
	
	$objAdminUser->setProperty("user_cd", $user_cd);
	$objAdminUser->actAdminUser('D');
	$objCommon->setMessage('User\'s account deleted successfully.', 'Error');
	redirect('./?p=user_mgmt');
	
}
if($_GET['mode'] == 'Suspend'){

	$user_cd = $_GET['user_cd'];
	$objAdminUser->setProperty("user_cd", $user_cd);
	$objAdminUser->setProperty("is_active", "0");
	if($objAdminUser->actAdminUser("U")){
		$objAdminUserN = new AdminUser;
		$objAdminUserN->setProperty("user_cd", $user_cd);
		$objAdminUserN->lstAdminUser();
		$rows_c = $objAdminUserN->dbFetchArray();
		
		# Send mail to customer
		$content 		= $objTemplate->getTemplate('account_suspend','EN');
		$sender_name 	= $content['sender_name'];
		$sender_email 	= $content['sender_email'];
		$subject 		= $content['template_subject'];
		$content 		= $content['template_detail'];
		
		$content		= str_replace("[USER_NAME]", $rows_c['fullname'], $content);
		$content		= str_replace("[REASON]", '', $content);
		$content		= str_replace("[SITENAME]", SITE_NAME, $content);
		$content		= str_replace("[SITE_NAME]", SITE_NAME, $content);
		$content		= str_replace("[SENDER_NAME]", $sender_name, $content);
		
		$body 			= file_get_contents(TEMPLATE_URL . "template.php");
		$body			= str_replace("[BODY]", $content, $body);
		
		$objMail		= new Mail;
		$objMail->IsHTML(true);
		$objMail->setSender($sender_email, $sender_name);
		$objMail->AddEmbeddedImage(TEMPLATE_PATH . "agro_email.jpg", 1, 'agro_email.jpg');
		$objMail->setSubject($subject);
		$objMail->setReciever($rows_c['email'], $rows_c['fullname']);
		$objMail->setBody($body);
		//$objMail->Send();
	
		$objCommon->setMessage('User\'s account suspended successfully.', 'Error');
		redirect('./?p=user_mgmt');
	}
}

if($_GET['mode'] == 'Activate'){
	$user_cd = $_GET['user_cd'];
	$newpwd = $objCommon->genPassword();
	$objAdminUser->setProperty("user_cd", $user_cd);
	$objAdminUser->setProperty("password", md5($newpwd));
	$objAdminUser->setProperty("is_active", "1");
	if($objAdminUser->actAdminUser("U")){
		$objAdminUserN = new AdminUser;
		$objAdminUserN->setProperty("user_cd", $user_cd);
		$objAdminUserN->lstAdminUser();
		$rows_c = $objAdminUserN->dbFetchArray();
		
		# Send mail to customer
		$content 		= $objTemplate->getTemplate('account_activate','EN');
		$sender_name 	= $content['sender_name'];
		$sender_email 	= $content['sender_email'];
		$subject 		= $content['template_subject'];
		$content 		= $content['template_detail'];
		
		$content		= str_replace("[USER_NAME]", $rows_c['fullname'], $content);
		$content		= str_replace("[EMAIL_ADD]", $rows_c['email'], $content);
		$content		= str_replace("[PASSWORD]", $newpwd, $content);
		$content		= str_replace("[SITE_NAME]", SITE_NAME, $content);
		$content		= str_replace("[SENDER_NAME]", $sender_name, $content);
		
		$body 			= file_get_contents(TEMPLATE_URL . "template.php");
		$body			= str_replace("[BODY]", $content, $body);
		
		$objMail		= new Mail;
		$objMail->IsHTML(true);
		$objMail->setSender($sender_email, $sender_name);
		$objMail->AddEmbeddedImage(TEMPLATE_PATH . "agro_email.jpg", 1, 'agro_email.jpg');
		$objMail->setSubject($subject);
		$objMail->setReciever($rows_c['email'], $rows_c['fullname']);
		$objMail->setBody($body);
		//$objMail->Send();
		
		
		$objCommon->setMessage('User\'s account activated successfully.', 'Info');
		redirect('./?p=user_mgmt');
	}
}

if(!empty($_GET['user_name'])){
	$user_name = urldecode($_GET['user_name']);
	$objAdminUser->setProperty("user_name", strtolower($user_name));
}
?>
<script type="text/javascript">
function doFilter(frm){
	var qString = '';
	if(frm.user_name.value != ""){
		qString += '&user_name=' + escape(frm.user_name.value);
	}
	document.location = '?p=user_mgmt' + qString;
}
</script>

<div id="wrapperPRight">
<form name="prd_frm" id="prd_frm" method="post" action="">
		<div id="pageContentName"><?php echo "Rights Management For ".$rows_c ["fullname"];?></div>
	<div id="pageContentRight" style="width:550px">
	<?php 
		$check=0;
		$objMenuM=new Menu();
		$objMenuN=new Menu();
		$Sql="Select cms_id from rs_tbl_cms_rights where user_cd=".$_GET["user_cd"];
		$res=$objMenuM->dbQuery($Sql);
		$check=$objMenuM->totalRecords();
		$objMenu->resetProperty();
		$objMenu->setProperty("parent_cd", "0");
    	$objProduct->lstCMS();
		//echo $objProduct->getSQL();
	?>
		<br style="clear:right"/>
		<div style="float:right; padding-right:40px">
		<input type="submit" name="add" id="add" value="<?php echo "Add Rights ";?>" class="SubmitButton"/>&nbsp;
			<?php if(isset($check)&&$check!=0)
				{?>
				<input type="submit" name="del" id="del" value="<?php echo "Remove Rights";?>" class="SubmitButton" />
				<?php }?>			
		</div>		
	</div>
		
		<div class="clear"></div>
			
		<?php echo $objCommon->displayMessage();?>
		
		<input type="hidden" id="user_cd" name="user_cd" 
		value="<?php echo $_GET['user_cd'];?>"/>
		<div id="tableContainer" style="width:800px; margin-left:150px">
		<?php
		
	if($objProduct->totalRecords() >= 1){
		# Print parent menus
		while($rows_p = $objProduct->dbFetchArray(1)){
		if($check>=1)
		{
		$Sql2="Select cms_id from rs_tbl_cms_rights where user_cd=".$_GET["user_cd"]." And cms_id=".$rows_p["cms_id"];
		$res2=$objMenuN->dbQuery($Sql2);
		$check2=$objMenuN->totalRecords();
		}
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			?>
			<!-- Start Your Php Code her For Display Record's -->
			
		<div style="float:left">
				<div class="imgbutton" style="min-height:45px;float:left" >
					<ul >
					<li ><a href="<?php echo $rows_p['menu_link'];?>" <?php if(isset($check2)&&$check2!=0)
				{?> style="background-color:#FFF4CC" <?php }?>>
					<?php echo $rows_p['detail'];?>
					
					</a></li>	
				</ul>
				</div> <br/>  <!--#E4EDF5 #A2BFD9 #FFF4CC-->
		  <div style="padding-right:55px;float:left">
				<?php if(isset($check2)&&$check2!=0)
				{?>
				
				<input type="checkbox"  id="dcms_id[]" 
				name="dcms_id[]" 
				value="<?php echo $rows_p['cms_id'];?>" 
				 />
				
				<?php }
				else{?>
				<input type="checkbox"  id="cms_id[]" 
				name="cms_id[]" 
				value="<?php echo $rows_p['cms_id'];?>" 
				 />
				
				 <?php }?>
		  </div>
		  </div>
			<?php
			
		}
    }
	else{
	?>
  <div align="center" style="padding:5px 5px 5px 5px"> <?php echo "No Record Found";?></div>
   
    <?php
	}
	?>
		</div>	
	
	<div class="clear"></div>

  </form>
	 
</div>
	