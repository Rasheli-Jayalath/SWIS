<?php
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


?>

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

	function getManagementReport(activitytypeid, subcomponentid, componentid) {
		if (activitytypeid != 0) {
			var strURL = "findManagementReports.php?activitytype=" + activitytypeid + "&subcomponent=" + subcomponentid + "&componentid=" + componentid;
			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('result4').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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
	}

	function getEditProgress(subactivityid, activityid, activitytypeid, subcomponentid, componentid, projectid) {

		if (subactivityid != 0) {

			var strURL = "findEditProgress.php?subactivityid=" + subactivityid + "&activityid=" + activityid + "&activitytypeid=" + activitytypeid + "&subcomponentid=" + subcomponentid + "&componentid=" + componentid + "&projectid=" + projectid;

			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('result5').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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
	}

	function getDetailProgressReport(projectid, componentid) {
		if (componentid != 0) {
			var strURL = "findDetailProgressReports.php?projectid=" + projectid + "&componentid=" + componentid;
			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('result3').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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
	}

	function getProjectReport(projectid, componentid) {
		if (projectid != 0) {
			var strURL = "findProjectReports.php?projectid=" + projectid + "&componentid=" + componentid;
			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('result2').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP 1:\n" + req.statusText);
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
	}

	function getProgressReport(projectid, componentid) {
		if (componentid != 0) {
			var strURL = "findProgressReports.php?projectid=" + projectid + "&componentid=" + componentid;
			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('result3').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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
	}

	function getExceedActivity(activitytypeid, subcomponentid, activityid) {

		if (activitytypeid != 0) {
			var strURL = "findExceedActivity.php?activitytypeid=" + activitytypeid + "&subcomponentid=" + subcomponentid + "&activityid=" + activityid;


			var req = getXMLHTTP();
			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {

							document.getElementById('result9').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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

	function getIPCActivity(activitytypeid, subcomponentid, activityid, componentid) {

		if (activitytypeid != 0) {
			var strURL = "findIPCActivities.php?activitytypeid=" + activitytypeid + "&subcomponentid=" + subcomponentid + "&activityid=" + activityid + "&componentid=" + componentid;

			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {

							document.getElementById('result9').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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

	function getIPCSubcomponent(activitytypeid, subcomponentid, componentid) {

		if (activitytypeid != 0) {
			var strURL = "findIPCSubcomponent.php?activitytypeid=" + activitytypeid + "&subcomponentid=" + subcomponentid + "&componentid=" + componentid;

			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {

							document.getElementById('result10').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP 3:\n" + req.statusText);
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

	function getExceedSubComponent(activitytypeid, subcomponentid) {
		if (subcomponentid != 0) {
			var strURL = "findExceedSubComponent.php?activitytypeid=" + activitytypeid + "&subcomponentid=" + subcomponentid;

			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {

							document.getElementById('result10').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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
	}

	function getExceedComponent(projectid, componentid) {
		if (componentid != 0) {
			var strURL = "findExComponent.php?projectid=" + projectid + "&componentid=" + componentid;

			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('result3').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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

	function GetProgressQuantity(bid, activityid) {

		if (bid != 0) {
			var strURL = "findProgressQuantity.php?bid=" + bid + "&activityid=" + activityid;
			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('ProgressQunatity').innerHTML = req.responseText;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
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
</script>
<?php

$uploadPath = "./technical";
if (isset($_POST['Save'])) {

	$district_id = $_POST['componentid'];
	$tehsil_id = $_POST['subcomponentid'];
	$village_id = $_POST['activityid'];
	$photolink1 = rand(100, 1000) . "_" . $_FILES['flink1']['name'];
	$photolink2 = rand(100, 1000) . "_" . $_FILES['flink2']['name'];
	$photolink3 = rand(100, 1000) . "_" . $_FILES['flink3']['name'];
	$photolink4 = rand(100, 1000) . "_" . $_FILES['flink4']['name'];
	$photolink5 = rand(100, 1000) . "_" . $_FILES['flink5']['name'];
	$photolink6 = rand(100, 1000) . "_" . $_FILES['flink6']['name'];


	/////photolink1
	if ($_FILES['flink1']['name'] != "") {

		$sql = "SELECT * FROM p2005wss where dcode='$district_id' and tcode='$tehsil_id' and vcode='$village_id'";
		$result = mysql_query($sql);
		$res = mysql_fetch_array($result);
		@unlink("./technical/$res[photolink1]");
		$wssid = $res['sno'];
		if (is_uploaded_file($_FILES['flink1']['tmp_name'])) {
			move_uploaded_file($_FILES['flink1']['tmp_name'], "./technical/" . $photolink1);


			$sql2 = "UPDATE p2005wss SET photolink1 = '$photolink1' WHERE sno = '$wssid'";
			$result1 = mysql_query($sql2);


			/*header("location:?image_id=$immg_id & status=Banner Image uploaded successfully.");*/
		}
	}
	/////photolink2
	if ($_FILES['flink2']['name'] != "") {

		$sql = "SELECT * FROM p2005wss where dcode='$district_id' and tcode='$tehsil_id' and vcode='$village_id'";
		$result = mysql_query($sql);
		$res = mysql_fetch_array($result);
		@unlink("./technical/$res[photolink2]");
		$wssid = $res['sno'];
		if (is_uploaded_file($_FILES['flink2']['tmp_name'])) {
			move_uploaded_file($_FILES['flink2']['tmp_name'], "./technical/" . $photolink2);


			$sql2 = "UPDATE p2005wss SET photolink2 = '$photolink2' WHERE sno = '$wssid'";
			$result1 = mysql_query($sql2);


			/*header("location:?image_id=$immg_id & status=Banner Image uploaded successfully.");*/
		}
	}
	/////photolink2
	if ($_FILES['flink3']['name'] != "") {

		$sql = "SELECT * FROM p2005wss where dcode='$district_id' and tcode='$tehsil_id' and vcode='$village_id'";
		$result = mysql_query($sql);
		$res = mysql_fetch_array($result);
		@unlink("./technical/$res[photolink3]");
		$wssid = $res['sno'];
		if (is_uploaded_file($_FILES['flink3']['tmp_name'])) {
			move_uploaded_file($_FILES['flink3']['tmp_name'], "./technical/" . $photolink3);


			$sql2 = "UPDATE p2005wss SET photolink3 = '$photolink3' WHERE sno = '$wssid'";
			$result1 = mysql_query($sql2);


			/*header("location:?image_id=$immg_id & status=Banner Image uploaded successfully.");*/
		}
	}

	/////photolink2
	if ($_FILES['flink4']['name'] != "") {

		$sql = "SELECT * FROM p2005wss where dcode='$district_id' and tcode='$tehsil_id' and vcode='$village_id'";
		$result = mysql_query($sql);
		$res = mysql_fetch_array($result);
		@unlink("./technical/$res[photolink4]");
		$wssid = $res['sno'];
		if (is_uploaded_file($_FILES['flink4']['tmp_name'])) {
			move_uploaded_file($_FILES['flink4']['tmp_name'], "./technical/" . $photolink4);


			$sql2 = "UPDATE p2005wss SET photolink4 = '$photolink4' WHERE sno = '$wssid'";
			$result1 = mysql_query($sql2);


			/*header("location:?image_id=$immg_id & status=Banner Image uploaded successfully.");*/
		}
	}
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
			<div class="col-md-6">
				<div class="card" id="tableContainer">
					<a href="https://source.unsplash.com/vDQ-e3RtaoE/" class="progressive replace">
						<img class="preview card-img-top" src="./images/tiny.jpg" alt="Card image cap">
					</a>
					<div class="card-body">
						<h5 class="card-title"><strong><?php echo UPLOAD_IMAGES_BRD; ?></strong></h5></br></br>
						<h6 class="card-subtitle mb-2 text-muted"><?php echo _NOTE; ?></h6>
					</div>
					<?php echo $objCommon->displayMessage(); ?>
					<form action="" method="post" name="boqlevel" id="boqlevel" enctype="multipart/form-data" onsubmit="return frmValidate1(this);" class="form-horizontal">
						<div class="form-group row">
							<label for="first_name" class="col-sm-3 col-form-label">District</label>
							<div class="col-sm-9" id="componentdiv">
								<select class="custom-select d-block w-100" name="componentid" id="componentid" onchange="getsubcomponent(this.value)" required>
									<option value="0">Select District...</option>
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
						</div>
						<div class="form-group row">
							<label for="last_name" class="col-sm-3 col-form-label">Tehsil</label>
							<div class="col-sm-9" id="subcomponentdiv">
								<?php
								if ($subcomponentflag != 1 && $componentid == 0) {
								?>
									<select class="custom-select d-block w-100" name="subcomponentid" id="subcomponentid" disabled="disabled">
										<option>Select Tehsil...</option>
									</select>
								<?php
								} else {
								?>
									<select class="custom-select d-block w-100" name="subcomponentid" id="subcomponentid" onchange="getactivity(this.value)">
										<option value="0">Select Tehsil...</option>
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
						</div>
						<div class="form-group row">
							<label for="user_name" class="col-sm-3 col-form-label">Village</label>
							<div class="col-sm-9" id="activitydiv">
								<?php
								if ($activityflag != 1 && $subcomponentid == 0) {
								?>
									<select class="custom-select d-block w-100" name="activityid" id="activityid" disabled="disabled">
										<option>Select Village...</option>
									</select>
								<?php
								} else {
								?>
									<select class="custom-select d-block w-100" name="activityid" id="activityid" onchange="getsubactivity(this.value)">
										<option value="0">Select Village...</option>
										<?php

										$aquery = "SELECT b.village as village,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.tcode=
" . $subcomponentid . " Order by code ASC";
										$aresult = mysql_query($aquery);
										while ($adata = mysql_fetch_array($aresult)) {

										?>
											<option value="<?php echo $adata['code']; ?>" <?php if ($activityid == $adata['code']) {
																								echo ' selected="selected"';
																							} ?>><?php echo $adata['code'] . " - " . $adata['village']; ?></option>
										<?php
										}
										?>
									</select>
								<?php
								}
								?>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">photolink1</label>
							<div class="col-sm-9">
								<input type="file" class="form-control-file" name="flink1">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">photolink2</label>
							<div class="col-sm-9">
								<input type="file" class="form-control-file" name="flink2">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">photolink3</label>
							<div class="col-sm-9">
								<input type="file" class="form-control-file" name="flink3">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">photolink4</label>
							<div class="col-sm-9">
								<input type="file" class="form-control-file" name="flink4">
							</div>
						</div>
						<div class="card-footer">
							<input type="submit" class="btn btn-primary float-right" value="Save" id="Save" name="Save" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>