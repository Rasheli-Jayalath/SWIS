<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	 $username 	= trim($_POST['username']);
	 $passwd 	= trim($_POST['password']);
	$user_type	= trim($_POST['user_type']);
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("username", LOGIN_FLD_VAL_USERNAME, "S");
	$objValidate->setCheckField("password", LOGIN_FLD_VAL_PASSWD, "S");
	$vResult = $objValidate->doValidate();
	
	if(!$vResult){
		$objAdminUser->setProperty("username", $username);
//		$objAdminUser->setProperty("passwd", md5($passwd));
		$objAdminUser->setProperty("passwd", $passwd);
		$objAdminUser->setProperty("user_type", $user_type);
		$objAdminUser->lstAdminUser();
		
		if($objAdminUser->totalRecords() >= 1){
			$rows = $objAdminUser->dbFetchArray(1);
			$fullname = $rows['first_name'] . " " . $rows['last_name'];
			$objAdminUser->setProperty("user_cd", $rows['user_cd']);
			$objAdminUser->setProperty("username", $rows['username']);
			$objAdminUser->setProperty("fullname_name", $fullname);
			$objAdminUser->setProperty("user_type", $rows['user_type']);
			$objAdminUser->setProperty("logged_in_time", date('Y-m-d H:i:s'));
			$objAdminUser->setProperty("member_cd", $rows['member_cd']);
			$objAdminUser->setAdminLogin();
			if($rows['member_cd']==12)
			{
				header("location: mosactlevel.php");
			}
			else
			{
			if($rows['user_type']==1)
			header("location: mosactlevel.php");
			else
			header("location: mossite.php");
			}
		}
		else{
			$objCommon->setMessage(LOGIN_FLD_INVALID, 'Error');
		}
	}
}
?>

<script>
function frmValidate(frm){
	var msg = "<?php echo _JS_FORM_ERROR;?>\r\n-----------------------------------------";
	var flag = true;
	if(frm.username.value == ""){
		msg = msg + "\r\n<?php echo LOGIN_FLD_VAL_USERNAME;?>";
		flag = false;
	}
	if(frm.password.value == ""){
		msg = msg + "\r\n<?php echo LOGIN_FLD_VAL_PASSWD;?>";
		flag = false;
	}
	if(flag == false){
		alert(msg);
		return false;
	}
	
}
</script>
<script type="text/javascript">
function toggleDiv(divId) {
 /*  $("#"+divId).toggle();*/
   $("#"+divId).hide(800);
/*   $("p").hide("slow");*/

}
</script>

<div id="wrapper_MemberLogin" style="padding-bottom:50px">
	<h1 style="color:#666"><?php echo LOGIN_H1;?></h1>
	<div class="clear"></div>
	<div id="LoginBox" class="borderRound borderShadow">
		<!--<div id="useralert">Please Enter Correct User/Pass.</div>-->
		<?php echo $objCommon->displayMessage();?>      
	<form name="frmlogin" onsubmit="return frmValidate(this);" method="post" action="">
	  
	  	<div class="loginboxContainer borderRound borderShadow">
			<div id="username1">
			 <input name="username" type="text" id="username" value="<?php echo $_POST['username'];?>" class="userinbox"/>
			</div>
		</div>
		<div class="loginboxContainer borderRound borderShadow">
			<div id="userpass">
			 <input name="password" id="password" type="password" class="userinbox"/>
			</div>
		</div>	  
	  
	  	<div class="loginboxContainer borderRound borderShadow">
			<div id="usertype">
			  <input type="radio"  
			id="user_type" name="user_type" value="1" checked="checked"/>
			 SuperAdmin 
			 <input type="radio" 
			 id="user_type" name="user_type" value="2" />
			SubAdmin</div>
		</div>
		
	  <div id="userLogin"> <input type="submit" name="Submit" value="<?php echo LOGIN_BTN_LOGIN;?>" id="uLogin" />
	    
	  </div>
	 
	  <div class="clear"></div>	  
      </form>
	</div>
	 <!--<div id="forgotPass"><a href="./?forgot=forgot" id="forgotPass">Forgot Password?</a></div>-->
</div>
