<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$username 	= trim($_POST['username']);
	$passwd 	= trim($_POST['password']);
	//$user_type	= trim($_POST['user_type']);
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("username", LOGIN_FLD_VAL_USERNAME, "S");
	$objValidate->setCheckField("password", LOGIN_FLD_VAL_PASSWD, "S");
	$vResult = $objValidate->doValidate();

	if (!$vResult) {
		$objAdminUser->setProperty("username", $username);
		//		$objAdminUser->setProperty("passwd", md5($passwd));
		$objAdminUser->setProperty("passwd", $passwd);

		$objAdminUser->lstAdminUser();
		if ($objAdminUser->totalRecords() >= 1) {
			$objAdminUser->setProperty("user_type", $user_type);
			$objAdminUser->lstAdminUser();
			if ($objAdminUser->totalRecords() >= 1) {
				$rows = $objAdminUser->dbFetchArray(1);
				$fullname = $rows['first_name'] . " " . $rows['last_name'];
				$objAdminUser->setProperty("user_cd", $rows['user_cd']);
				$objAdminUser->setProperty("username", $rows['username']);
				$objAdminUser->setProperty("fullname_name", $fullname);
				$objAdminUser->setProperty("user_type", $rows['user_type']);
				$log_time = date('Y-m-d H:i:s');
				$objAdminUser->setProperty("logged_in_time", date('Y-m-d H:i:s'));
				$objAdminUser->setProperty("member_cd", $rows['member_cd']);
				$objAdminUser->setProperty("designation", $rows['designation']);
				$objAdminUser->setAdminLogin();
				/***** Log Entry *****/
				$log_desc 	= "User <strong>" . $fullname . "</strong> is login at." . $log_time;
				$log_module = "Login";
				$log_title 	= "User Login";
				doLog($log_module, $log_title, $log_desc, $rows['user_cd']);
				header("location: index.php");
			} else {
				$objCommon->setMessage("Invalid User Accesss Rights! Please try again", 'Error');
			}
		} else {
			$objCommon->setMessage(LOGIN_FLD_INVALID, 'Error');
		}
	}
}
?>

<link rel="stylesheet" type="text/css" href="css/util.css">
<link rel="stylesheet" type="text/css" href="css/main.css">

<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<div class="login100-form-title" style="background-image: url(https://source.unsplash.com/sZOWADU0jxU);">
				<span class="login100-form-title-1">
					SMEC Water Information Systems<br>(SWIS)
				</span>
			</div>

			<?php echo $objCommon->displayMessage(); ?>
			<form class="login100-form validate-form" method="post">
				<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
					<span class="label-input100">Username</span>
					<input name="username" type="text" id="username" value="<?php echo $_POST['username']; ?>" class="input100" placeholder="Enter Username" />
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
					<span class="label-input100">Password</span>
					<input name="password" id="password" type="password" class="input100" placeholder="Enter Password" />
					<span class="focus-input100"></span>
				</div>
				<input type="hidden" name="user_type" id="user_type" value="1">
				<div class="container-login100-form-btn">
					<button class="login100-form-btn"><?php echo LOGIN_BTN_LOGIN; ?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="js/main.js"></script>
</div>