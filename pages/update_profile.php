<?php
$mode	= "I";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$flag 		= true;
	$first_name = trim($_POST['first_name']);
	$username = trim($_POST['username']);
	$last_name 	= trim($_POST['last_name']);
	$passwd 	= trim($_POST['passwd']);
	$email_old 	= trim($_POST['email_old']);
	$email 		= trim($_POST['email']);
	$designation = trim($_POST["designation"]);
	$phone 		= trim($_POST['phone']);
	$mode 		= trim($_POST['mode']);
	/*$designation= trim($_POST['designation']);*/
	if (isset($_POST['user_type']) && $_POST['user_type'] != "")
		$user_type = trim($_POST['user_type']);

	if (empty($first_name)) {
		$flag 	= false;
		$objCommon->setMessage(USER_FLD_MSG_FIRSTNAME, 'Error');
	}
	if (empty($last_name)) {
		$flag 	= false;
		$objCommon->setMessage(USER_FLD_MSG_LASTNAME, 'Error');
	}
	if (empty($email)) {
		$flag 	= false;
		$objCommon->setMessage(USER_FLD_MSG_EMAIL, 'Error');
	}
	if (!$objValidate->checkEmail($email)) {
		$flag 	= false;
		$objCommon->setMessage(USER_FLD_MSG_INVALID_EMAIL, 'Error');
	}
	# Check whether the email address is changed.
	if ($email_old != $email) {
		$objAdminUser->setProperty("email", $email);
		$objAdminUser->checkAdminEmailAddress();
		if ($objAdminUser->totalRecords() >= 1) {
			$flag 	= false;
			$objCommon->setMessage(USER_FLD_MSG_EXISTS_EMAIL, 'Error');
		}
	}
	if ($flag != false) {
		$user_cd = ($mode == "U") ? $_POST['user_cd'] :
			$objAdminUser->genCode("mis_tbl_users", "user_cd");

		$objAdminUser->resetProperty();
		$objAdminUser->setProperty("user_cd", $user_cd);
		$objAdminUser->setProperty("username", $username);
		$objAdminUser->setProperty("passwd", $passwd);
		$objAdminUser->setProperty("first_name", $first_name);
		/*$objAdminUser->setProperty("middle_name", $middle_name);*/
		$objAdminUser->setProperty("last_name", $last_name);
		$objAdminUser->setProperty("email", $email);
		$objAdminUser->setProperty("phone", $phone);
		$objAdminUser->setProperty("designation", $designation);
		$objAdminUser->setProperty("user_type", $user_type);
		if ($objAdminUser->actAdminUser($_POST['mode'])) {

			if ($mode == "U") {
				$objCommon->setMessage(USER_FLD_MSG_SUCCESSFUL_UPDATE, 'Update');
			} else {
				$objCommon->setMessage("New User added successfully", 'Info');
			}

			if ($objAdminUser->user_type == 1)
				redirect('./?p=my_profile');
			else
				redirect('./?p=my_profile');
		}
	}
	extract($_POST);
} else {
	if (isset($_GET['user_cd']) && !empty($_GET['user_cd'])) {
		$user_cd = $_GET['user_cd'];
		if (isset($user_cd) && !empty($user_cd)) {
			$objAdminUser->setProperty("user_cd", $user_cd);
			$objAdminUser->lstAdminUser();
			$data = $objAdminUser->dbFetchArray(1);
			$mode	= "U";
			extract($data);
		}
	}
}
?>
<script language="javascript" type="text/javascript">
	function frmValidate(frm) {
		var msg = "<?php echo _JS_FORM_ERROR; ?>\r\n-----------------------------------------";
		var flag = true;
		if (frm.first_name.value == "") {
			msg = msg + "\r\n<?php echo USER_FLD_MSG_FIRSTNAME; ?>";
			flag = false;
		}

		if (frm.email.value == "") {
			msg = msg + "\r\n<?php echo USER_FLD_MSG_EMAIL; ?>";
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
			<div class="col-md-6">
				<div class="card">
					<a href="https://source.unsplash.com/vDQ-e3RtaoE/" class="progressive replace">
						<img class="preview card-img-top" src="./images/tiny.jpg" alt="Card image cap">
					</a>
					<div class="card-body">
						<h5 class="card-title"><strong><?php echo ($mode == "U") ? USER_UPDATE_BRD : USER_ADD_BRD; ?></strong></h5></br></br>
						<h6 class="card-subtitle mb-2 text-muted"><?php echo _NOTE; ?></h6>
					</div>
					<?php echo $objCommon->displayMessage(); ?>
					<form name="frmProfile" id="frmProfile" action="" method="post" onsubmit="return frmValidate(this);" class="form-horizontal">
						<input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>" />
						<input type="hidden" name="user_cd" id="user_cd" value="<?php echo $user_cd; ?>" />
						<div class="form-group row">
							<label for="first_name" class="col-sm-3 col-form-label"><?php echo "First Name"; ?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name; ?>" size="50" required />
							</div>
						</div>
						<div class="form-group row">
							<label for="last_name" class="col-sm-3 col-form-label"><?php echo "Last Name"; ?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $last_name; ?>" size="50" required />
							</div>
						</div>
						<div class="form-group row">
							<label for="user_name" class="col-sm-3 col-form-label"><?php echo "User Name"; ?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="username" id="username" required value="<?php echo $username; ?>" size="50" <?php if (isset($_GET['user_cd'])) { ?> readonly="" <?php } ?> />
							</div>
						</div>

						<?php if ($mode != "U") { ?>
							<div class="form-group row">
								<label for="password" class="col-sm-3 col-form-label"><?php echo "Password"; ?></label>
								<div class="col-sm-9">
									<input type="password" class="form-control" name="passwd" id="passwd" required value="<?php echo $passwd; ?>" size="50" />
								</div>
							</div>
						<?php
						} else {
						?>
							<input type="hidden" class="form-control" name="passwd" id="passwd" value="<?php echo $passwd; ?>" size="50" />

						<?php
						}
						?>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label"><?php echo USER_FLD_EMAIL; ?></label>
							<div class="col-sm-9">
								<input type="hidden" name="email_old" id="email_old" value="<?php echo $email; ?>" />
								<input type="text" class="form-control" name="email" id="email" required value="<?php echo $email; ?>" <?php if (isset($_GET['user_cd'])) { ?> readonly="" <?php } ?> />
							</div>
						</div>
						<div class="form-group row">
							<label for="designation" class="col-sm-3 col-form-label"><?php echo "Designation"; ?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="designation" id="designation" value="<?php echo $designation; ?>" />
							</div>
						</div>
						<div class="form-group row">
							<label for="phone" class="col-sm-3 col-form-label"><?php echo USER_FLD_PHONE; ?></label>
							<div class="col-sm-9">
								<input type="tel" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>" />
							</div>
						</div>
						<?php if ($objAdminUser->user_type == 1 && $objAdminUser->member_cd == 0) { ?>
							<div class="form-group row">
								<label for="phone" class="col-sm-3 col-form-label"><?php echo USER_FLD_DESIGNATION; ?></label>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-sm-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" id="user_type" name="user_type" value="1" checked="checked" <label class="form-check-label" for="user_type">SuperAdmin</label>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-check">
												<input type="radio" class="form-check-input" id="user_type" name="user_type" value="2" <?php echo ($user_type == 2) ? 'checked="checked"' : ""; ?> />
												<label class="form-check-label" for="user_type">SubAdmin</label>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-check">
												<input type="radio" class="form-check-input" id="user_type" name="user_type" value="3" <?php echo ($user_type == 3) ? 'checked="checked"' : ""; ?> />
												<label class="form-check-label" for="user_type">User</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>
						<div class="card-footer">
							<input type="submit" class="btn btn-primary" value="<?php echo ($mode == "U") ? " Update " : " Save "; ?>" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>