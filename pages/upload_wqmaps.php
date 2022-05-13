<?php
if ($objAdminUser->is_login == false) {
	header("location: index.php");
}


$uploadPath = "./WaterQualityMaps";
$projectid = $_REQUEST['projectid'];
$msgFlag = false;
$graphflag = false;
$data = NULL;
/*$subactivityflag2=0;
if($projectid == 0 || $projectid =='') {
	$projectflag=0;
} else {
	$projectflag=1;
}
 $componentid = $_REQUEST['componentid'];
if($componentid == 0 || $componentid =='') {
	$componentflag=0;
} else {
	$componentflag=1;
}
$activitytypeid = $_REQUEST['activitytypeid'];
if($activitytypeid == 0 || $activitytypeid =='') {
	$activitytypeflag=0;
} else {
	$activitytypeflag=1;
}
$subcomponentid = $_REQUEST['subcomponentid'];
if($subcomponentid == 0 || $subcomponentid =='') {
	$subcomponentflag=0;
} else {
	$subcomponentflag=1;
}
 $activityid = $_REQUEST['activityid'];
if($activityid == 0 || $activityid =='') {
	$activityflag=0;
} else {
	$activityflag=1;
}

 $behavid = $_REQUEST['behavid'];
if($behavid == 0 || $behavid =='') {
	$behavflag=0;
} else {
	$behavflag=1;
}*/

function getExtention($type)
{
	if ($type == "image/jpeg" || $type == "image/jpg" || $type == "image/pjpeg")
		return "jpg";
	elseif ($type == "image/png")
		return "png";
	elseif ($type == "image/gif")
		return "gif";
	elseif ($type == "image/mp4")
		return "mp4";
	elseif ($type == "image/jpeg")
		return "jpeg";
}
$editflag = 0;
if (isset($_REQUEST['wqid'])) {

	$wqid = $_REQUEST['wqid'];
	$pdSQL1 = "select * from p2006wqualitymaps where wqid = " . $wqid;
	$pdSQLResult1 = mysql_query($pdSQL1) or die(mysql_error());
	$pdData1 = mysql_fetch_array($pdSQLResult1);
	$componentid = $pdData1['dcode'];
	$subcomponentid = $pdData1['tcode'];
	$al_file = $pdData1['item_name'];

	$image_name = $pdData1['image_name'];

	$editflag = 1;
}


if (isset($_GET['mode']) && $_GET['mode'] == "delete") {
	$wqid = $_GET['wqid'];
	$pdSQL = "select * from p2006wqualitymaps where wqid = " . $wqid;
	$pdSQLResult = mysql_query($pdSQL);
	$sql_num = mysql_num_rows($pdSQLResult);
	$pdData = mysql_fetch_array($pdSQLResult);
	$wqid = $_REQUEST['wqid'];
	$old_al_file = $pdData["item_name"];
	if ($old_al_file) {
		if (isset($_FILES["al_file"]["name"]) && $_FILES["al_file"]["name"] != "") {
			@unlink($uploadPath . "/" . $old_al_file);
		}
	}
	$sdelete = "Delete from p2006wqualitymaps where wqid=" . $wqid;
	mysql_query($sdelete);
	if ($sdelete == TRUE) {
		$message =  "Record deleted successfully";
	} else {
		$message = mysql_error($db);
	}

	redirect('./?p=upload_wqmaps');
}



if (isset($_REQUEST['save'])) {
	$district_id = $_POST['componentid'];
	$tehsil_id = $_POST['subcomponentid'];
	$image_name = $_REQUEST['image_name'];

	if (isset($_FILES["al_file"]["name"]) && $_FILES["al_file"]["name"] != "") {
		$extension = getExtention($_FILES["al_file"]["type"]);
		$loadfile = rand(10, 100) . "_" . $tehsil_id . "_" . basename($_FILES["al_file"]["name"]);
		$file_name = $loadfile;

		if (
			($_FILES["al_file"]["type"] == "image/jpg") ||
			($_FILES["al_file"]["type"] == "image/jpeg") ||
			($_FILES["al_file"]["type"] == "image/gif") ||
			($_FILES["al_file"]["type"] == "image/png")
		) {
			$target_file = $file_name;
			$target = $uploadPath . "/" . $target_file;
			if (move_uploaded_file($_FILES['al_file']['tmp_name'], $target)) {

				$sql_query = "insert into p2006wqualitymaps (dcode,tcode,image_name,item_name) values(" . $district_id . "," . $tehsil_id . ",'" . $image_name . "', '" . $file_name . "')";
				$sql_pro = mysql_query($sql_query);
				if ($sql_pro == TRUE) {
					$message =  "New record added successfully";
				} else {
					$message = mysql_error($db);
				}
			}
		}
	}

	$image_name = '';
	$district_id = '';
	$tehsil_id = '';
	//header("Location: add_image.php?unique_id=$unique_id");

}

if (isset($_REQUEST['update'])) {
	$district_id = $_POST['componentid'];
	$tehsil_id = $_POST['subcomponentid'];
	$image_name = $_REQUEST['image_name'];

	$pdSQL = "select * from p2006wqualitymaps where wqid = " . $wqid . " and dcode=$district_id and tcode=$tehsil_id";
	$pdSQLResult = mysql_query($pdSQL);
	$sql_num = mysql_num_rows($pdSQLResult);
	$pdData = mysql_fetch_array($pdSQLResult);
	$wqid = $_REQUEST['wqid'];
	$old_al_file = $pdData["item_name"];
	if ($old_al_file) {
		if (isset($_FILES["al_file"]["name"]) && $_FILES["al_file"]["name"] != "") {
			@unlink($uploadPath . "/" . $old_al_file);
		}
	}

	if (isset($_FILES["al_file"]["name"]) && $_FILES["al_file"]["name"] != "") {
		$extension = getExtention($_FILES["al_file"]["type"]);
		$loadfile = rand(10, 100) . "_" . $tehsil_id . "_" . basename($_FILES["al_file"]["name"]);

		$file_name = $loadfile;

		if (
			($_FILES["al_file"]["type"] == "image/jpg") ||
			($_FILES["al_file"]["type"] == "image/jpeg") ||
			($_FILES["al_file"]["type"] == "image/gif") ||
			($_FILES["al_file"]["type"] == "image/png")
		) {
			$target_file = $file_name;
			$target = $uploadPath . "/" . $target_file;
			if (move_uploaded_file($_FILES['al_file']['tmp_name'], $target)) {

				$sql_pro = "UPDATE p2006wqualitymaps set dcode = " . $district_id . ", tcode = " . $tehsil_id . ", item_name = '" . $file_name . "', image_name = '" . $image_name . "' where wqid=" . $wqid;

				$sql_proresult = mysql_query($sql_pro) or die(mysql_error());


				if ($sql_proresult == TRUE) {
					$message =  "Record updated successfully";
				} else {
					$message = mysql_error($db);
				}
			}
		} else {
			echo "Invalid File Format";
		}
	} else {
		$sql_pro = "UPDATE p2006wqualitymaps set dcode = " . $district_id . ", tcode = " . $tehsil_id . ", image_name = '" . $image_name . "' where wqid=" . $wqid;
		$sql_proresult = mysql_query($sql_pro) or die(mysql_error());

		if ($sql_proresult == TRUE) {
			$message =  "Record updated successfully";
		} else {
			$message = mysql_error($db);
		}
	}
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
	<div class="fluid-container p-2">
		<div class="row">
			<div class="col-md-4">
				<div class="card" id="tableContainer">
					<a href="https://source.unsplash.com/vDQ-e3RtaoE/" class="progressive replace">
						<img class="preview card-img-top" src="./images/tiny.jpg" alt="Card image cap">
					</a>
					<div class="card-body">
						<h5 class="card-title"><strong><?php echo UPLOAD_IMGVID ?></strong></h5></br></br>
						<h6 class="card-subtitle mb-2 text-muted"><?php echo _NOTE; ?></h6>
					</div>
					<?php echo $objCommon->displayMessage(); ?>
					<?php if (!empty($message)) { ?>
						<div style="background:#c5f3c3; border:#bbe6ba 1px solid; padding:10px; border-radius:2px;"><?php echo $message; ?></div>
					<?php } ?>
					<form id="frm-image-upload" name='frm-image-upload' method="post" action="" enctype="multipart/form-data" onSubmit="return frmValidate(this);" class="form-horizontal">
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
							<label for="user_name" class="col-sm-3 col-form-label">Map Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="image_name" id="image_name" value="<?php echo $image_name; ?>" required />
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Upload File</label>
							<div class="col-sm-9">
								<input type="file" accept=".jpg, .jpeg, .png" class="form-control-file" name="al_file" id="al_file" value="<?php echo $al_file; ?>">
							</div>
						</div>

						<div class="card-footer">
							<?php if (isset($_REQUEST['wqid'])) {

							?>
								<input type="hidden" name="dwgid" id="dwgid" value="<?php echo $_REQUEST['wqid']; ?>" />
								<input type="submit" class="btn btn-primary float-right" name="update" id="btn-submit" value="Update" />
							<?php
							} else {
							?>
								<input type="submit" class="btn btn-primary float-right" name="save" id="btn-submit" value="Save" />
							<?php
							}
							?>
						</div>
					</form>
				</div>
			</div>

			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">List of All Water Quality Maps</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped display responsive nowrap" style="width:100%">
							<thead>
								<tr>
									<th>District</th>
									<th>Tehsil</th>
									<th>Map Name</th>
									<th>Image</th>
									<th><?php echo ACTION; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query4 = "SELECT * FROM p2006wqualitymaps group by dcode";
								//echo $query4;
								$result4 = mysql_query($query4);
								mysql_num_rows($result4);
								if (mysql_num_rows($result4) > 0) {
									while ($row4 = mysql_fetch_assoc($result4)) {
										$did = $row4['dcode'];
										$cquery = mysql_query("select * from  p2001district where code=$did");
										$cdata = mysql_fetch_array($cquery);
								?>
										<?php
										$queryt = "SELECT * FROM p2006wqualitymaps where dcode=$did group by tcode";
										//echo $query4;
										$resultt = mysql_query($queryt);
										mysql_num_rows($resultt);
										if (mysql_num_rows($resultt) > 0) {
											while ($rowt = mysql_fetch_assoc($resultt)) {
												$tid = $rowt['tcode'];
												$cquery1 = mysql_query("select * from  p2002tehsil where code=$tid");
												$cdata1 = mysql_fetch_array($cquery1);
										?>

												<?php
												$querytd = "SELECT * FROM p2006wqualitymaps where dcode=$did and tcode=$tid";
												//echo $query4;
												$resulttd = mysql_query($querytd);
												mysql_num_rows($resulttd);
												if (mysql_num_rows($resulttd) > 0) {
													while ($rowtd = mysql_fetch_assoc($resulttd)) {
												?>
														<tr>
															<td><?php echo $cdata['name']; ?></td>
															<td><?php echo $cdata1['tehsil']; ?></td>

															<td><?php echo $rowtd['image_name']; ?></td>
															<td>
																<img src="<?php echo SITE_URL; ?><?php echo $uploadPath ?>/<?php echo $rowtd['item_name']; ?>" width="60" />
															</td>
															<td>
																<a class="btn btn-info btn-md" href="./?p=upload_wqmaps&wqid=<?php echo $rowtd['wqid']; ?>" title="<?php echo EDIT; ?>"><i class="fas fa-pencil-alt">
																	</i>
																</a>
																|
																<a class="btn btn-danger btn-md" href="./?p=upload_wqmaps&mode=delete&wqid=<?php echo $rowtd['wqid']; ?>" onClick="return confirm('Are you sure you want to delete this map?');" title="<?php echo DELETE; ?>" name="delete"><i class="fas fa-trash">
																	</i>
																</a>
															</td>

														</tr>
								<?php
													}
												}
											}
										}
									}
								}
								?>
							</tbody>
							<tfoot>
								<tr>
									<th>District</th>
									<th>Tehsil</th>
									<th>Map Name</th>
									<th>Image</th>
									<th><?php echo ACTION; ?></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		var groupColumn = [0, 1];
		var table = $('#example1').DataTable({
			"columnDefs": [{
				"visible": false,
				"targets": groupColumn
			}],
			"responsive": true,
			"autoWidth": true,
			"drawCallback": function(settings) {
				var api = this.api();
				var rows = api.rows({
					page: 'current'
				}).nodes();
				var last = null;

				api.column(groupColumn[0], {
					page: 'current'
				}).data().each(function(group, i) {
					if (last !== group) {
						$(rows).eq(i).before(
							'<tr class="group" style="background-color:#9CF"><td colspan="100%">' + group + '</td></tr>'
						);
						last = group;
					}
				});
				api.column(groupColumn[1], {
					page: 'current'
				}).data().each(function(group, i) {
					if (last !== group) {
						$(rows).eq(i).before(
							'<tr class="group" style="background-color:#CCC"><td colspan="100%">' + group + '</td></tr>'
						);
						last = group;
					}
				});
			}
		});
	});
</script>