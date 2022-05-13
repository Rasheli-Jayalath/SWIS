<?php
$user_cd	= $objAdminUser->user_cd;
$objAdminUser->setProperty("user_cd", $user_cd);
$objAdminUser->lstAdminUser();
$data = $objAdminUser->dbFetchArray(1);
$mode	= "U";
extract($data);
?>

<section>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card">
					<a href="https://source.unsplash.com/vDQ-e3RtaoE" class="progressive replace">
						<img class="preview card-img-top" src="./images/tiny.jpg" alt="Card image cap">
					</a>
					<div class="card-body">
						<h5 class="card-title"> <strong>My Profile</strong></h5>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><strong><?php echo USER_FLD_FULLNAME; ?>:</strong> <?php echo $first_name . " " . $middle_name . " " . $last_name; ?></li>
						<li class="list-group-item"><strong><?php echo USER_FLD_EMAIL; ?>:</strong> <?php echo $email; ?></li>
						<li class="list-group-item"><strong><?php echo USER_FLD_PHONE; ?>:</strong> <?php echo $phone; ?></li>
						<li class="list-group-item"><strong><?php echo USER_FLD_DESIGNATION; ?>:</strong> <?php echo $designation; ?></li>
						<li class="list-group-item"><strong><?php echo "Role"; ?>:</strong> <?php
																							if ($user_type == 1)
																								echo "Super Admin";
																							else
																								echo "User"; ?></li>
					</ul>
					<div class="card-footer">
						<a href="./?p=update_profile&user_cd=<?php echo $objAdminUser->user_cd; ?>" class="btn btn-primary"><?php echo USER_BTN_UPDATE; ?></a>
						<a href="./?p=change_password" class="btn btn-danger">Change Password</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>