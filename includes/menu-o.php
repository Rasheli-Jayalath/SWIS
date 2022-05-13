<?php
$sCurPage = substr($_SERVER['PHP_SELF'], (strrpos($_SERVER['PHP_SELF'], "/") + 1));

$page = $_SERVER['REQUEST_URI'];
?>
<header>
	<div id="templatemo_header" class="top-head">
		<div class="row">
			<div class="col col-sm">
				<div id="templatemo_logo" class="head-logo">
					<a href="index.php" title="SWIS">
						<img src="images/SMEC.png" class="img-fluid" title="SWIS" />
					</a>
				</div>
			</div>
			<div class="col col-sm">
				<div class="head-text col col-sm">
					<h1 id="content-desktop">
						SMEC Water Information System
					</h1>
					<h1 id="content-mobile">
						SWIS
					</h1>
				</div>
			</div>
		</div>
		<div class="image-overlay"></div>
	</div>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="#"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?php print strcmp($page, "/SWIS/index.php") ? "no" : "active"; ?>">
					<a class="nav-link" href="./index.php">Home</a>
				</li>
				<li class="nav-item <?php print strcmp($page, "/SWIS/qrdash-home.php") ? "no" : "active"; ?>">
					<a class="nav-link" href="./qrdash-home.php">Data Query-Dashboard</a>
				</li>
				<?php if ($objAdminUser->user_type == 1 && $objAdminUser->member_cd == 0) { ?>
					<li class="nav-item <?php print strcmp($page, "/SWIS/?p=upload_images") ? "no" : "active"; ?>">
						<a class="nav-link" href="./?p=workp_dist">Work Progress</a>
					</li>
					<li class="nav-item <?php print strcmp($page, "/SWIS/?p=upload_images") ? "no" : "active"; ?>">
						<a class="nav-link" href="./?p=upload_images">Upload Images</a>
					</li>
					<li class="nav-item <?php print strcmp($page, "/SWIS/?p=upload_wqmaps") ? "no" : "active"; ?>">
						<a class="nav-link" href="./?p=upload_wqmaps">Upload Water Quality Maps</a>
					</li>
					<li class="nav-item <?php print strcmp($page, "/SWIS/?p=my_profile") ? "no" : "active"; ?>">
						<a class="nav-link" href="./?p=my_profile">Profile</a>
					</li>
				<?php } ?>
				<li class="nav-item <?php print strcmp($page, "/SWIS/?p=logout") ? "no" : "active"; ?>">
					<a class="nav-link" href="./?p=logout">Logout</a>
				</li>

			</ul>
		</div>
	</nav>
</header>