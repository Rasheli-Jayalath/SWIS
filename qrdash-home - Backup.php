<?php
require_once("config/config.php");
$objCommon 		= new Common;
$objMenu 		= new Menu;
$objNews 		= new News;
$objContent 	= new Content;
$objTemplate 	= new Template;
$objMail 		= new Mail;
$objCustomer 	= new Customer;
$objCart 	= new Cart;
$objAdminUser 	= new AdminUser;
$objProduct 	= new Product;
$objValidate 	= new Validate;
$objOrder 		= new Order;
$objLog 		= new Log;
require_once('rs_lang.admin.php');
require_once('rs_lang.website.php');

if ($objAdminUser->is_login == false) {
	header("location: index.php");
}

$projectid = $_REQUEST['projectid'];
$msgFlag = false;
$graphflag = false;
$data = NULL;
$subactivityflag2 = 0;
if ($projectid == 0 || $projectid == '') {
	$projectflag = 0;
} else {
	$projectflag = 1;
}
$componentid = $_REQUEST['componentid'];
if ($componentid == 0 || $componentid == '') {
	$componentflag = 0;
} else {
	$componentflag = 1;
}
$activitytypeid = $_REQUEST['activitytypeid'];
if ($activitytypeid == 0 || $activitytypeid == '') {
	$activitytypeflag = 0;
} else {
	$activitytypeflag = 1;
}
$subcomponentid = $_REQUEST['subcomponentid'];
if ($subcomponentid == 0 || $subcomponentid == '') {
	$subcomponentflag = 0;
} else {
	$subcomponentflag = 1;
}
$activityid = $_REQUEST['activityid'];
if ($activityid == 0 || $activityid == '') {
	$activityflag = 0;
} else {
	$activityflag = 1;
}

$behavid = $_REQUEST['behavid'];
if ($behavid == 0 || $behavid == '') {
	$behavflag = 0;
} else {
	$behavflag = 1;
}
if ($componentid != "" && $subcomponentid != "" && $activityid != "") {
	$SQLbf = "Select * from p2003village where dcode = " . $componentid . " and tcode=" . $subcomponentid . " and code=" . $activityid;
	$reportresultbf = mysql_query($SQLbf);
	$reportdatabf = mysql_fetch_array($reportresultbf);
	$latbf = $reportdatabf['y'];
	$lngbf = $reportdatabf['x'];
}

function dateDiff($start, $end)
{
	$start_ts = strtotime($start);
	$end_ts = strtotime($end);
	$diff = $end_ts - $start_ts;
	return round($diff / 86400);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>SMEC Water Information System</title>
	<link rel="shortcut icon" href="favicon.ico">

	<script src="https://kit.fontawesome.com/93820ac793.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css" integrity="sha512-kb1CHTNhoLzinkElTgWn246D6pX22xj8jFNKsDmVwIQo+px7n1yjJUZraVuR/ou6Kmgea4vZXZeUDbqKtXkEMg==" crossorigin="anonymous" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/7.2.2/css/highcharts.min.css" integrity="sha512-7lULcnwV8rlyUF45JT6vYPmcYvzHUyJiGYQeFmi2GS7qkwTEUOBYcijQG4zthd87lhWcAuIwLRS0j6lN4dW+Nw==" crossorigin="anonymous" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/7.2.2/css/annotations/popup.min.css" integrity="sha512-qi+iE140TwOGnZwuphhwVT2jXN8+JyH2myMoIepHjCBMRwZ8v/HE/W5bUJJxXqrOLeF1rumEXPazdosnzWNQHg==" crossorigin="anonymous" />

	<link rel="stylesheet" href="css/theRoot.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/lozad.js/1.16.0/lozad.min.js" integrity="sha512-21jyjW5+RJGAZ563i/Ug7e0AUkY7QiZ53LA4DWE5eNu5hvjW6KUf9LqquJ/ziLKWhecyvvojG7StycLj7bT39Q==" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/7.2.2/highcharts.min.js" integrity="sha512-2mSNAS6lM/AHxLq62NDdj/POgxRMeuvP+5fwj00Sa1Al1+i6kAon7xpZcNGjuuRTam3IHZAV2/E7Tnvj4OnFuQ==" crossorigin="anonymous"></script>

	<script language="javascript" type="text/javascript">
		function getXMLHTTP() { //fuction to return the xml http object
			var xmlhttp;
			if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else { // code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			return xmlhttp;
		}

		function getcomponent(projectid) {

			if (projectid != 0) {
				var strURL = "findcomponent.php?project=" + projectid;
				var req = getXMLHTTP();

				if (req) {

					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							if (req.status == 200) {
								document.getElementById('componentdiv').innerHTML = req.responseText;
							} else {
								alert("There was a problem while using XMLHTTP COM:\n" + req.statusText);
							}
						}
					}
					req.open("GET", strURL, true);
					req.send(null);
				}
			} else {
				document.getElementById('componentid').value = 0;
				document.getElementById('componentid').disabled = true;
				document.getElementById('activitytypeid').value = 0;
				document.getElementById('activitytypeid').disabled = true;
				document.getElementById('subcomponentid').value = 0;
				document.getElementById('subcomponentid').disabled = true;
				document.getElementById('activityid').value = 0;
				document.getElementById('activityid').disabled = true;
				document.getElementById('subactivityid').value = 0;
				document.getElementById('subactivityid').disabled = true;
			}
			document.getElementById('componentid').value = 0;
			document.getElementById('componentid').disabled = true;
			document.getElementById('activitytypeid').value = 0;
			document.getElementById('activitytypeid').disabled = true;
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;
		}

		function getactivitytype(componentid) {
			if (componentid != 0) {
				var strURL = "findactivitytype.php?component=" + componentid;
				var req = getXMLHTTP();

				if (req) {

					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							if (req.status == 200) {
								document.getElementById('activitytypediv').innerHTML = req.responseText;
							} else {
								alert("There was a problem while using XMLHTTP:4\n " + req.statusText);
							}
						}
					}
					req.open("GET", strURL, true);
					req.send(null);
				}
			} else {
				document.getElementById('activitytypeid').value = 0;
				document.getElementById('activitytypeid').disabled = true;
				document.getElementById('subcomponentid').value = 0;
				document.getElementById('subcomponentid').disabled = true;
				document.getElementById('activityid').value = 0;
				document.getElementById('activityid').disabled = true;
				document.getElementById('subactivityid').value = 0;
				document.getElementById('subactivityid').disabled = true;
			}
			document.getElementById('activitytypeid').value = 0;
			document.getElementById('activitytypeid').disabled = true;
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;
		}

		function getsubcomponent(componentid) {

			if (componentid != 0) {
				var strURL = "findsubcomponent.php?component=" + componentid;
				var req = getXMLHTTP();

				if (req) {

					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							if (req.status == 200) {
								document.getElementById('subcomponentdiv').innerHTML = req.responseText;
							} else {
								alert("There was a problem while using XMLHTTP: 5\n" + req.statusText);
							}
						}
					}
					req.open("GET", strURL, true);
					req.send(null);
				}
			} else {

				document.getElementById('subcomponentid').value = 0;
				document.getElementById('subcomponentid').disabled = true;
				document.getElementById('activityid').value = 0;
				document.getElementById('activityid').disabled = true;
				document.getElementById('subactivityid').value = 0;
				document.getElementById('subactivityid').disabled = true;
			}
			document.getElementById('subcomponentid').value = 0;
			document.getElementById('subcomponentid').disabled = true;
			document.getElementById('activityid').value = 0;
			document.getElementById('activityid').disabled = true;
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;
		}

		function getactivity(subcomponentid) {

			if (subcomponentid != 0) {
				var strURL = "findactivity.php?subcomponent=" + subcomponentid;

				var req = getXMLHTTP();

				if (req) {

					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							if (req.status == 200) {
								document.getElementById('activitydiv').innerHTML = req.responseText;
							} else {
								alert("There was a problem while using XMLHTTP:6\n" + req.statusText);
							}
						}
					}
					req.open("GET", strURL, true);
					req.send(null);
				}
			} else {
				document.getElementById('activityid').value = 0;
				document.getElementById('activityid').disabled = true;
				document.getElementById('subactivityid').value = 0;
				document.getElementById('subactivityid').disabled = true;
			}
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;
		}

		function getactivitytech(subcomponentid) {

			if (subcomponentid != 0) {
				var strURL = "findactivitytechnical.php?subcomponent=" + subcomponentid;

				var req = getXMLHTTP();

				if (req) {

					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							if (req.status == 200) {
								document.getElementById('activitydiv').innerHTML = req.responseText;
							} else {
								alert("There was a problem while using XMLHTTP:6\n" + req.statusText);
							}
						}
					}
					req.open("GET", strURL, true);
					req.send(null);
				}
			} else {
				document.getElementById('activityidt').value = 0;
				document.getElementById('activityidt').disabled = true;
				document.getElementById('subactivityid').value = 0;
				document.getElementById('subactivityid').disabled = true;
			}
			document.getElementById('subactivityid').value = 0;
			document.getElementById('subactivityid').disabled = true;
		}

		function getsubactivity(activityid) {

			if (activityid != 0) {
				var strURL = "findsubactivity.php?activity=" + activityid;
				var req = getXMLHTTP();

				if (req) {

					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							if (req.status == 200) {
								document.getElementById('subactivitydiv').innerHTML = req.responseText;
							} else {
								alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
							}
						}
					}
					req.open("GET", strURL, true);
					req.send(null);
				}
			} else {
				document.getElementById('subactivityid').value = 0;
				document.getElementById('subactivityid').disabled = true;
			}
		}

		function getbehav(behavid) {
			if (behavid != 0) {
				var strURL = "findbehav.php?behav=" + behavid;
				var req = getXMLHTTP();

				if (req) {

					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							if (req.status == 200) {
								document.getElementById('behavdiv').innerHTML = req.responseText;
							} else {
								alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
							}
						}
					}
					req.open("GET", strURL, true);
					req.send(null);
				}
			}
		}

		function frmValidate(frm) {
			var flag = true;

			if (frm.bid.value == 0) {
				msg = "Progress month is required";
				flag = false;
			}
			if (flag == false) {
				alert(msg);
				return false;
			}
		}

		function frmValidate1(frm) {
			var flag = true;
			var msg = "";
			if (frm.projectid.value == "0") {
				msg = msg + "\r\n<?php echo "Please Select the Project"; ?>";

				flag = false;
			}
			if (flag == false) {
				alert(msg);
				return false;
			}
		}

		function doToggle(ele) {

			var obj = document.getElementById(ele);

			if (obj) {
				if (obj.style.display == "") {
					obj.style.display = "none";
				} else {
					obj.style.display = "";
				}
			}
		}

		function doToggle1(ele) {

			if (ele == "fun_1") {
				document.getElementById("fun_1").style.display = '';
				document.getElementById("nfun_1").style.display = 'none';
				document.getElementById("aban_1").style.display = 'none';

			} else if (ele == "nfun_1") {
				document.getElementById("fun_1").style.display = 'none';
				document.getElementById("nfun_1").style.display = '';
				document.getElementById("aban_1").style.display = 'none';
			} else if (ele == "aban_1") {
				document.getElementById("fun_1").style.display = 'none';
				document.getElementById("nfun_1").style.display = 'none';
				document.getElementById("aban_1").style.display = '';
			}
		}
	</script>


	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWFe6ijGINThkuKWZlI_UI-qxu88RxGQU&libraries=geometry"></script>

	<style type="text/css">
		div.tabContent.hide {
			display: none;
		}
	</style>

	<script type="text/javascript">
		//<![CDATA[

		var tabLinks = new Array();
		var contentDivs = new Array();

		function init() {

			// Grab the tab links and content divs from the page
			var tabListItems = document.getElementById('tabs_ns').childNodes;
			for (var i = 0; i < tabListItems.length; i++) {
				if (tabListItems[i].nodeName == "A") {
					var tabLink = tabListItems[i];
					var id = getHash(tabLink.getAttribute('href'));
					tabLinks[id] = tabLink;
					contentDivs[id] = document.getElementById(id);
				}
			}

			// Assign onclick events to the tab links, and
			// highlight the first tab
			var i = 0;

			for (var id in tabLinks) {
				tabLinks[id].onclick = showTab;
				tabLinks[id].onfocus = function() {
					this.blur()
				};
				if (i == 0) tabLinks[id].className = 'btn btn-secondary active';
				i++;
			}

			// Hide all content divs except the first
			var i = 0;

			for (var id in contentDivs) {
				if (i != 0) contentDivs[id].className = 'tabContent hide';
				i++;
			}
		}

		function showTab() {
			var selectedId = getHash(this.getAttribute('href'));


			// Highlight the selected tab, and dim all others.
			// Also show the selected content div, and hide all others.
			for (var id in contentDivs) {
				if (id == selectedId) {
					tabLinks[id].className = 'btn btn-secondary active';
					contentDivs[id].className = 'tabContent';
				} else {
					tabLinks[id].className = 'btn btn-secondary';
					contentDivs[id].className = 'tabContent hide';
				}
			}

			// Stop the browser following the link
			return false;
		}

		function getFirstChildWithTagName(element, tagName) {
			for (var i = 0; i < element.childNodes.length; i++) {
				if (element.childNodes[i].nodeName == tagName) return element.childNodes[i];
			}
		}

		function getHash(url) {

			var hashPos = url.lastIndexOf('#');


			return url.substring(hashPos + 1);
		}

		//]]>
	</script>

</head>

<body class="d-flex flex-column h-100" onload="init();">

	<?php
	if ($objAdminUser->is_login == true) {
		// include 'includes/header.php';
		include("includes/menu.php");
	}
	?>

	<section>
		<div class="container-fluid">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title"><i class="fas fa-plug mr-1"></i>Select from drop down to get more drill down data</h3>
				</div>
				<div class="card-body">
					<div id="wrapper_MemberLogin">
						<form action="qrdash-home.php" method="post" name="boqlevel" id="boqlevel" onsubmit="return frmValidate1(this);">
							<div class="row">
								<div id="projectdiv" class="col-md">
									<select class="form-control" name="projectid" id="projectid" onchange="getcomponent(this.value)">
										<!--<option value="0">Seclect Package..</option>-->
										<?php
										$pquery = "select * from p2000projectpkg";
										$presult = mysql_query($pquery);
										while ($pdata = mysql_fetch_array($presult)) {
										?>
											<option value="<?php echo $pdata['name']; ?>" selected="selected">
												<?php
												echo $pdata['name']; ?>
											</option>
										<?php
										}
										?>
									</select>
								</div>
								<div id="componentdiv" class="col-md">
									<select class="form-control" name="componentid" id="componentid" onchange="getsubcomponent(this.value)">
										<option value="0">Select Package...</option>
										<?php
										$cquery = "select * from  p2001district order by did";

										$cresult = mysql_query($cquery);
										while ($cdata = mysql_fetch_array($cresult)) {
										?>
											<option value="<?php echo $cdata['code']; ?>" <?php if ($componentid == $cdata['code']) {
																								echo ' selected="selected"';
																							} ?>><?php echo $cdata['code'] . " - " . $cdata['name']; ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div id="subcomponentdiv" class="col-md">
									<?php
									if ($subcomponentflag != 1 && $componentid == 0) {
									?>
										<select class="form-control" name="subcomponentid" id="subcomponentid" disabled="disabled">
											<option>Select District..</option>
										</select>
									<?php
									} else {
									?>
										<select class="form-control" name="subcomponentid" id="subcomponentid" onchange="getactivity(this.value)">
											<option value="0">Select District..</option>
											<?php
											$tquery = "select * from  p2002tehsil where dcode = " . $componentid . " order by code";
											$tresult = mysql_query($tquery);
											while ($tdata = mysql_fetch_array($tresult)) {
											?>
												<option value="<?php echo $tdata['code']; ?>" <?php if ($subcomponentid == $tdata['code']) {
																									echo ' selected="selected"';
																								} ?>><?php echo $tdata['code'] . " - " . $tdata['tehsil']; ?></option>
											<?php
											}
											?>
										</select>
									<?php
									}
									?>
								</div>
								<div id="activitydiv" class="col-md">
									<?php
									if ($activityflag != 1 && $subcomponentid == 0) {
									?>
										<select class="form-control" name="activityid" id="activityid" disabled="disabled">
											<option>Select Village...</option>
										</select>
									<?php
									} else {
									?>
										<select class="form-control" name="activityid" id="activityid" onchange="getsubactivity(this.value)">
											<option value="0">Select Village..</option>
											<?php
											$aquery = "SELECT b.village as village,b.code as code,b.tcode as tcode from p2004vp a inner join p2003village b on (a.giscode=b.giscode) where b.tcode=" . $subcomponentid . "
											UNION 
											SELECT b.village as village,b.code as code,b.tcode as tcode from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.tcode=" . $subcomponentid;
											$aresult = mysql_query($aquery);
											while ($adata = mysql_fetch_array($aresult)) {

												echo $v_code = $adata['code'];
												$t_code = $adata['tcode'];

												$aquery_s = "SELECT vcode,tcode from p2004vp where tcode=" . $t_code . " and vcode=" . $v_code;
												$aresult_s = mysql_query($aquery_s);
												$rows_s = mysql_num_rows($aresult_s);
												$adata_s = mysql_fetch_array($aresult_s);

												$aquery_t = "SELECT vcode from p2005wss where tcode=" . $t_code . " and vcode=" . $v_code;
												$aresult_t = mysql_query($aquery_t);
												$rows_t = mysql_num_rows($aresult_t);
												if ($rows_s == 1 && $rows_t == 1) {
											?>

												<?php
													$flag1 = 1;
													$v_name = $adata['code'] . " - " . $adata['village'];
												} else if ($rows_s == 1 && $rows_t == 0) {
												?>

												<?php
													$flag2 = 2;
													$v_name = $adata['code'] . " - " . $adata['village'];
												} else if ($rows_s == 0 && $rows_t == 1) {
												?>

												<?php
													$flag3 = 3;
													$v_name = $adata['code'] . " - " . $adata['village'];
												}
												?>

												<option value="<?php echo $adata['code'] ?>" <?php if ($flag1 == 1) {
																								?> class="red" <?php
																												$flag1 = "";
																											}
																											if ($flag2 == 2) {
																												?> class="green" <?php
																																	$flag2 = "";
																																}
																																if ($flag3 == 3) {
																																	?> class="blue" <?php
																																					$flag3 = "";
																																				} ?> <?php if ($activityid == $adata['code']) {
																																							echo ' selected="selected"';
																																						} ?>><?php echo $v_name; ?></option>
											<?php
											}
											?>
										</select>
									<?php
									}
									?>

								</div>
								<div id="behaviour" class="col-md">
									<select class="form-control" name="behavid" id="behavid" onchange="getbehav(this.value)">
										<option value="1" selected="selected">Social</option>
										<option value="3" <?php if ($_REQUEST['behavid'] == 3) {
																echo ' selected="selected"';
															} ?>>Technical</option>
										<option value="2" <?php if ($_REQUEST['behavid'] == 2) {
																echo ' selected="selected"';
															} ?>>Water Quality Maps</option>
									</select>
								</div>
								<!-- <div class="col-md">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												From
											</span>
										</div>
										<input type="text" id="from_date" class="form-control" autocomplete="false" readonly="readonly" name="from_date" value="<?php echo $from_date; ?>" />
										<div class="input-group-append">
											<div class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</div>
										</div>
									</div>
								</div> -->
								<!-- <div class="col-md">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												To
											</span>
										</div>
										<input type="text" id="to_date" class="form-control" autocomplete="false" readonly="readonly" name="to_date" value="<?php echo $to_date; ?>" />
										<div class="input-group-append">
											<div class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</div>
										</div>
									</div>
								</div> -->
								<!-- <div id="behaviour">
									<input type="hidden" id="behavid" name="behavid" value="1" />
								</div> -->
								<div class="col-md">
									<button id="uLogin2" type="submit" class="btn btn-info">Generate Report</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>


	<?php //include("includes/functions.php")
	?>
	<?php include("includes/social_default.php"); ?>
	<?php include("includes/district_level.php"); ?>
	<?php include("includes/tehsil_level.php"); ?>
	<?php include("includes/village_level.php"); ?>

	<?php include("includes/footer.php"); ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js" integrity="sha512-OQlawZneA7zzfI6B1n1tjUuo3C5mtYuAWpQdg+iI9mkDoo7iFzTqnQHf+K5ThOWNJ9AbXL4+ZDwH7ykySPQc+A==" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/7.2.2/modules/exporting.min.js" integrity="sha512-+ifUNtu91I2KHBcbq2INVbDiIW/UIHrcmI1XybF9YDpThWMZ+u4qX1mJnBoYYrCpnb1u5glS9j2RBPn0yvZtsw==" crossorigin="anonymous"></script>

	<script src="js/theRoot.js" type="module"></script>

	<script type="text/javascript">
		$(function() {
			$('table.bb').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true,
				"responsive": true,
			});

			$("#example1").DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true,
				"responsive": true,
			});
			$("#edutab").DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true,
				"responsive": true,
			});
			$("#fasibb").DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true,
				"responsive": true,
			});
			$("#desbb").DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true,
				"responsive": true,
			});
			$("table.tehsil").DataTable({
				"paging": false,
				"lengthChange": true,
				"searching": false,
				"ordering": false,
				"info": false,
				"autoWidth": true,
				"responsive": true,
			});
		});
	</script>

</body>

</html>