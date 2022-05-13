<?php
$mode	= "I";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$flag 				= true;
	$current_password 	= trim($_POST['current_password']);
	$npassword 			= trim($_POST['npassword']);
	$cpassword 			= trim($_POST['c_password']);

	if (empty($current_password)) {
		$flag 	= false;
		$objCommon->setMessage(CHANGEPWD_FLD_MSG_CURPWD, 'Error');
	}
	if (empty($npassword)) {
		$flag 	= false;
		$objCommon->setMessage(CHANGEPWD_FLD_MSG_NEWPWD, 'Error');
	}
	if (empty($cpassword)) {
		$flag 	= false;
		$objCommon->setMessage(CHANGEPWD_FLD_MSG_CNEWPWD, 'Error');
	}
	if ($npassword != $cpassword) {
		$flag 	= false;
		$objCommon->setMessage(CHANGEPWD_FLD_MSG_DOESTMATCH, 'Error');
	}
	$objAdminUser->setProperty("user_name", $objUser->user_name);
	$objAdminUser->setProperty("passwd", $current_password);
	$objAdminUser->lstAdminUser();
	if ($objAdminUser->totalRecords() == 0) {
		$flag 	= false;
		$objCommon->setMessage(CHANGEPWD_FLD_MSG_OLDPWDNOTMATCH, 'Error');
	}
	if ($flag != false) {
		$user_cd = $_POST['user_cd'];
		$objAdminUser->resetProperty();
		$objAdminUser->setProperty("user_cd", $user_cd);
		$objAdminUser->setProperty("username", $objAdminUser->username);
		$objAdminUser->setProperty("passwd", $npassword);
		if ($objAdminUser->changePassword()) {
			$objCommon->setMessage('Password changed successfully.', 'Info');
			redirect('./?p=change_password');
		}
	}
	extract($_POST);
} else {
	$user_cd	= $objAdminUser->user_cd;
	$objAdminUser->setProperty("user_cd", $user_cd);
	$objAdminUser->lstAdminUser();
	$data = $objAdminUser->dbFetchArray(1);
	$mode	= "U";
	extract($data);
}
?>
<script language="javascript" type="text/javascript">
	function frmValidate(frm) {
		var msg = "<?php echo _JS_FORM_ERROR; ?>\r\n-----------------------------------------";
		var flag = true;
		if (frm.current_password.value == "") {
			msg = msg + "\r\n<?php echo CHANGEPWD_FLD_MSG_CURPWD; ?>";
			flag = false;
		}
		if (frm.npassword.value == "") {
			msg = msg + "\r\n<?php echo CHANGEPWD_FLD_MSG_NEWPWD; ?>";
			flag = false;
		}
		if (frm.c_password.value == "") {
			msg = msg + "\r\n<?php echo CHANGEPWD_FLD_MSG_CNEWPWD; ?>";
			flag = false;
		}
		if (frm.npassword.value != frm.c_password.value) {
			msg = msg + "\r\n<?php echo CHANGEPWD_FLD_MSG_DOESTMATCH; ?>";
			flag = false;
		}
		if (flag == false) {
			alert(msg);
			return false;
		}
	}
</script>

<section>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card">
					<a href="https://source.unsplash.com/vDQ-e3RtaoE" class="progressive replace">
						<img class="preview card-img-top" src="./images/tiny.jpg" alt="Card image cap">
					</a>
					<div class="card-body">
						<h5 class="card-title"><strong><?php echo CHANGEPWD_UPDATE_BRD; ?></strong></h5></br></br>
						<h6 class="card-subtitle mb-2 text-muted"><?php echo _NOTE; ?></h6>
					</div>
					<?php echo $objCommon->displayMessage(); ?>

					<form name="frmProfile" id="frmProfile" action="" method="post" onsubmit="return frmValidate(this);" class="form-horizontal">
						<input type="hidden" name="user_cd" id="user_cd" value="<?php echo $user_cd; ?>" />
						<div class="form-group row">
							<label for="first_name" class="col-sm-6 col-form-label"><?php echo CHANGEPWD_FLD_CPWD ?><span style="color:#FF0000;">*</span></label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="current_password" id="current_password" value="" size="50" required />
							</div>
						</div>
						<div class="form-group row">
							<label for="last_name" class="col-sm-6 col-form-label"><?php echo CHANGEPWD_FLD_NPWD ?><span style="color:#FF0000;">*</span></label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="npassword" id="npassword" value="" size="50" required />
							</div>
						</div>
						<div class="form-group row">
							<label for="user_name" class="col-sm-6 col-form-label"><?php echo CHANGEPWD_FLD_CNPWD ?><span style="color:#FF0000;">*</span></label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="c_password" id="c_password" required value="" size="50" />
							</div>
						</div>
						<div class="card-footer">
							<input type="submit" class="btn btn-primary float-right" value="Save" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>