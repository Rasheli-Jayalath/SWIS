<?php
$dcode = $componentid;
$tcode = $subcomponentid;
$vcode = $activityid;
$vcode = $vcode;
$behavid = $behavid;
?>
<script>
	function check() {
		var check = document.getElementsByTagName('input');
		for (var i = 0; i < check.length; i++) {
			if (check[i].type == 'checkbox') {
				check[i].checked = true;
			}
		}


		<?php $kmlsql = "select * from kmls_add_village where vcode=" . $vcode;
		$kmlresult = mysql_query($kmlsql);
		while ($kmldata = mysql_fetch_array($kmlresult)) {
			$file_name = $kmldata['file_name'];
			$arr_file = explode(".", $file_name);
			$justname = $arr_file[0];

		?>

			var <?php echo $justname . "Visible"; ?> = true;

		<?php

		}
		?>

		<?php $kmlsqlp = "select * from kmls_add_village where vcode=" . $vcode;
		$kmlresultp = mysql_query($kmlsqlp);
		while ($kmldatap = mysql_fetch_array($kmlresultp)) {
			$file_name = $kmldatap['file_name'];
			$attribute_type = $kmldatap['attribute_type'];
			$kmlid = $kmldatap['kmlid'];
			$kkid = $kmlid - 1;
		?>
			parser.hideDocument(parser.docs[<?php echo $kkid; ?>]);
		<?php

		}
		?>

		<?php $kmlsql = "select * from kmls_add_village where vcode=" . $vcode;
		$kmlresult = mysql_query($kmlsql);
		while ($kmldata = mysql_fetch_array($kmlresult)) {
			$file_name = $kmldata['file_name'];
			$kmlid_1 = $kmldata['kmlid'];
			$kkidd = $kmlid_1 - 1;
			$arr_file = explode(".", $file_name);
			$justname = $arr_file[0];

		?>
			$("#<?php echo $justname . "toggle"; ?>").on("click", function(e) {
				if (<?php echo $justname . "Visible"; ?>) {
					parser.showDocument(parser.docs[<?php echo $kkidd; ?>]);
					<?php echo $justname . "Visible"; ?> = false;
				} else {
					parser.hideDocument(parser.docs[<?php echo $kkidd; ?>]);
					<?php echo $justname . "Visible"; ?> = true;
				}
			});

		<?php
		}
		?>
	}

	function uncheck() {
		var uncheck = document.getElementsByTagName('input');
		for (var i = 0; i < uncheck.length; i++) {
			if (uncheck[i].type == 'checkbox') {
				uncheck[i].checked = false;
			}
		}
		<?php $kmlsql = "select * from kmls_add_village where vcode=" . $vcode;
		$kmlresult = mysql_query($kmlsql);
		while ($kmldata = mysql_fetch_array($kmlresult)) {
			$file_name = $kmldata['file_name'];
			$arr_file = explode(".", $file_name);
			$justname = $arr_file[0];

		?>

			var <?php echo $justname . "Visible"; ?> = true;

		<?php

		}
		?>

		<?php $kmlsqlp = "select * from kmls_add_village where vcode=" . $vcode;
		$kmlresultp = mysql_query($kmlsqlp);
		while ($kmldatap = mysql_fetch_array($kmlresultp)) {
			$file_name = $kmldatap['file_name'];
			$attribute_type = $kmldatap['attribute_type'];
			$kmlid = $kmldatap['kmlid'];
			$kkid = $kmlid - 1;
		?>
			parser.showDocument(parser.docs[<?php echo $kkid; ?>]);
		<?php

		}
		?>

		<?php $kmlsql = "select * from kmls_add_village where vcode=" . $vcode;
		$kmlresult = mysql_query($kmlsql);
		while ($kmldata = mysql_fetch_array($kmlresult)) {
			$file_name = $kmldata['file_name'];
			$kmlid_1 = $kmldata['kmlid'];
			$kkidd = $kmlid_1 - 1;
			$arr_file = explode(".", $file_name);
			$justname = $arr_file[0];

		?>
			$("#<?php echo $justname . "toggle"; ?>").on("click", function(e) {
				if (<?php echo $justname . "Visible"; ?>) {
					parser.hideDocument(parser.docs[<?php echo $kkidd; ?>]);
					<?php echo $justname . "Visible"; ?> = false;
				} else {
					parser.showDocument(parser.docs[<?php echo $kkidd; ?>]);
					<?php echo $justname . "Visible"; ?> = true;
				}
			});

		<?php
		}
		?>
	}
</script>

<?php



$SQL1 = "Select * from p2005wss where dcode = " . $dcode . " and tcode=" . $tcode . " and vcode=" . $vcode;
$reportresult1 = mysql_query($SQL1);
$iCount1 = mysql_num_rows($reportresult1);

$result_dis = mysql_query("SELECT name FROM p2001district where code=" . $dcode);
$data_dis = mysql_fetch_array($result_dis);
$result_th = mysql_query("SELECT tehsil FROM p2002tehsil where code=" . $tcode);
$data_th = mysql_fetch_array($result_th);
$result_vi = "Select village FROM  p2003village where dcode = " . $dcode . " and tcode=" . $tcode . " and code=" . $vcode;
$result_vi2 = mysql_query($result_vi);
$data_vi = mysql_fetch_array($result_vi2);


?>
<?php
if ($iCount1 > 0) {
	$SQL2 = "Select * from p2003village where dcode = " . $dcode . " and tcode=" . $tcode . " and code=" . $vcode;
	$reportresult2 = mysql_query($SQL2);
	$reportdata2 = mysql_fetch_array($reportresult2);
	$lat = $reportdata2['y'];
	$lng = $reportdata2['x'];

?>
<script src="https://cdn.jsdelivr.net/npm/measuretool-googlemaps-v3/lib/MeasureTool.min.js"></script>
	<script type="text/javascript" src="./js_map/ProjectedOverlay.js"></script>
	<script type="text/javascript" src="./js_map/geoxml3.js"></script>
	<!--<script type="text/javascript" src="./js_map/map.js"></script>-->
	<script>
		//create empty temp array
		var markersArray = [];
		var circlesArray = [];
	</script>
	<script type="text/javascript">
		var mapInstance;
		var parser;
		var placemarkMetadata = [];
		var measureTool;



		<?php $kmlsql = "select * from kmls_add_village where vcode=" . $vcode;
		$kmlresult = mysql_query($kmlsql);
		while ($kmldata = mysql_fetch_array($kmlresult)) {
			$file_name = $kmldata['file_name'];
			$arr_file = explode(".", $file_name);
			$justname = $arr_file[0];

		?>

			var <?php echo $justname . "Visible"; ?> = true;

		<?php

		}
		?>



		/*var benchmarkVisible = true;
		var boringVisible = true;
		var buildingVisible = true;
		var villageVisible = true;
		var epoleVisible = true;
		var hpumpVisible = true;
		var hospitalVisible = true;
		var lpoleVisible = true;
		var masjidVisible = true;
		var ohwtVisible = true;
		var roadVisible = true;
		var schoolbVisible = true;
		var templeVisible = true;
		var transformerVisible = true;
		var wpnVisible = true;
		var wpndVisible = true;
		var wpnnVisible = true;
		var wtankVisible = true;
		var wellVisible = true;*/


		//var distVisible=true;



		//
		// Modified from php.js strcmp at http://phpjs.org/functions/strcmp
		// Requires b1 and b2 have name fields
		//
		function placemarkcmp(b1, b2) {
			return ((b1.name == b2.name) ? 0 : ((b1.name > b2.name) ? 1 : -1));
		}


		//
		// Triggered by our parsecomplete event
		//
		function customAfterParse(docSet) {
			// placemarks is the collection of Geoxml3 placemark instances
			// We're collecting document 0, which we know is the placemarks KML
			var placemarks = docSet[0].placemarks;

			var markerIndex, placemarkIndex, loopEnd;

			// Create array of placemark metadata objects, containing name and index into the Geoxml3 document array
			for (markerIdx = 0, loopEnd = placemarks.length; markerIdx < loopEnd; markerIdx++) {
				var currentMetadata = {};

				currentMetadata.name = placemarks[markerIdx].name;
				currentMetadata.index = markerIdx;
				placemarkMetadata.push(currentMetadata);
			}

			// Sort alphabetically by name
			placemarkMetadata.sort(placemarkcmp);

			// Add list items with an HTML id attribute  p##, where ## is the index of the marker we want to trigger
			for (placemarkIndex = 0, loopEnd = placemarkMetadata.length; placemarkIndex < loopEnd; placemarkIndex++) {
				$('#placemarkList').append('<li id="p' + placemarkMetadata[placemarkIndex].index + '">' + placemarkMetadata[placemarkIndex].name + '</li>');
			}
		}


		//
		// Triggered by the parsed event on our parser
		//
		function completeInit() {



			<?php $kmlsqlp = "select * from kmls_add_village where vcode=" . $vcode;
			$kmlresultp = mysql_query($kmlsqlp);
			while ($kmldatap = mysql_fetch_array($kmlresultp)) {
				$file_name = $kmldatap['file_name'];
				$attribute_type = $kmldatap['attribute_type'];
				$kmlid = $kmldatap['kmlid'];
				$kkid = $kmlid - 1;
			?>
				parser.hideDocument(parser.docs[<?php echo $kkid; ?>]);
			<?php

			}
			?>






			// Hide non-placemark layer(s)
			/*parser.hideDocument(parser.docs[0]);
			parser.hideDocument(parser.docs[1]);
			parser.hideDocument(parser.docs[2]);
			parser.hideDocument(parser.docs[3]);
			parser.hideDocument(parser.docs[4]);

			parser.hideDocument(parser.docs[5]);
			parser.hideDocument(parser.docs[6]);
			parser.hideDocument(parser.docs[7]);
			parser.hideDocument(parser.docs[8]);
			parser.hideDocument(parser.docs[9]);
			parser.hideDocument(parser.docs[10]);
			parser.hideDocument(parser.docs[11]);
			parser.hideDocument(parser.docs[12]);
			parser.hideDocument(parser.docs[13]);
			parser.hideDocument(parser.docs[14]);
			parser.hideDocument(parser.docs[15]);
			parser.hideDocument(parser.docs[16]);
			parser.hideDocument(parser.docs[17]);
			parser.hideDocument(parser.docs[18]);
*/



			<?php $kmlsqlt = "select * from kmls_add_village where vcode=" . $vcode;
			$kmlresultt = mysql_query($kmlsqlt);
			while ($kmldatat = mysql_fetch_array($kmlresultt)) {
				$file_namet = $kmldatat['file_name'];
				$attribute_typet = $kmldatat['attribute_type'];
				$arr_filet = explode(".", $file_namet);
				$justnamet = $arr_filet[0];

			?>
				<?php echo $justnamet . "Visible"; ?> = false;


			<?php

			}
			?>

			//parser.hideDocument(parser.docs[5]);
			/*benchmarkVisible = false;
			boringVisible = false;
			buildingVisible = false;
			villageVisible = false;
			epoleVisible = false;

			hpumpVisible = false;
			hospitalVisible = false;
			lpoleVisible = false;
			masjidVisible = false;
			ohwtVisible = false;

			roadVisible = false;
			schoolbVisible = false;
			templeVisible = false;
			transformerVisible = false;
			wpnVisible = false;

			wpndVisible = false;
			wpnnVisible = false;
			wtankVisible = false;
			wellVisible = false;*/







			//distVisible=false;

			// Add event handler for sidebar items
			// Because we're using jQuery 1.7.1, we use on.
			// If we were using previous versions, we'd use live
			$("#placemarkList li").on("click", function(e) {
				// Get the id value, strip off the leading p
				var id = $(this).attr("id");
				id = id.substr(1);

				// "Click" the marker
				google.maps.event.trigger(parser.docs[0].placemarks[id].marker, 'click');
			});

			// Add mouse events so users know when we're hovering on a sidebar elemnt
			$("#placemarkList li").on("mouseenter", function(e) {
				var textcolor = $(this).css("color");
				$(this).css({
					'cursor': 'pointer',
					'color': '#FFFFFF',
					'background-color': textcolor
				});
			}).on("mouseleave", function(e) {
				var backgroundcolor = $(this).css("background-color");
				$(this).css({
					'cursor': 'auto',
					'color': backgroundcolor,
					'background-color': 'transparent'
				});
			});

			// Highlight visible and invisible sidebar items
			// As user scrolls, the sidebar willreflect visible and invisible placemarks
			google.maps.event.addListener(mapInstance, 'click', function(e) {
				var distance = parseInt(document.getElementById('mapdistance').value);
				if (distance < 1) {
					alert('Your distance is too small');
				}

				//clear map
				/*removeMarkersAndCircles();
		  		//draw marker with circle
	    		placeMarker(e.latLng, mapInstance, distance);*/
				//write actual position into inputs
				writeLabels(e.latLng);


				currentBounds = mapInstance.getBounds();
				for (i = 0; i < parser.docs[0].placemarks.length; i++) {

					var myLi = $("#p" + i);

					if (currentBounds.contains(parser.docs[0].placemarks[i].marker.getPosition())) {
						myLi.css("color", "#000000");
					} else {
						myLi.css("color", "#CCCCCC");
					}
				}
			});


			//// for tehsil boundaries

			/*$("#placemarktoggle").on("click", function(e) {
			
				if (placemarksVisible) {
					parser.hideDocument(parser.docs[0]);
					placemarksVisible = false;
				} else {
					parser.showDocument(parser.docs[0]);
					placemarksVisible = true;
				}		
			});*/


			<?php $kmlsql = "select * from kmls_add_village where vcode=" . $vcode;
			$kmlresult = mysql_query($kmlsql);
			while ($kmldata = mysql_fetch_array($kmlresult)) {
				$file_name = $kmldata['file_name'];
				$kmlid_1 = $kmldata['kmlid'];
				$kkidd = $kmlid_1 - 1;
				$arr_file = explode(".", $file_name);
				$justname = $arr_file[0];

			?>
				$("#<?php echo $justname . "toggle"; ?>").on("click", function(e) {
					if (<?php echo $justname . "Visible"; ?>) {
						parser.hideDocument(parser.docs[<?php echo $kkidd; ?>]);
						<?php echo $justname . "Visible"; ?> = false;
					} else {
						parser.showDocument(parser.docs[<?php echo $kkidd; ?>]);
						<?php echo $justname . "Visible"; ?> = true;
					}
				});

			<?php
			}
			?>




			/*$("#benchmarktoggle").on("click", function(e) {

				if (benchmarkVisible) {
					parser.hideDocument(parser.docs[0]);
					benchmarkVisible = false;
				} else {
					parser.showDocument(parser.docs[0]);
					benchmarkVisible = true;
				}

			});



			$("#boringtoggle").on("click", function(e) {

				if (boringVisible) {
					parser.hideDocument(parser.docs[1]);
					boringVisible = false;
				} else {
					parser.showDocument(parser.docs[1]);
					boringVisible = true;
				}
			});

			// for rising main

			$("#buildingtoggle").on("click", function(e) {

				if (buildingVisible) {
					parser.hideDocument(parser.docs[2]);
					buildingVisible = false;
				} else {
					parser.showDocument(parser.docs[2]);
					buildingVisible = true;
				}
			});
			// for Source
			$("#villagetoggle").on("click", function(e) {

				if (villageVisible) {
					parser.hideDocument(parser.docs[3]);
					villageVisible = false;
				} else {
					parser.showDocument(parser.docs[3]);
					villageVisible = true;
				}
			});
			// for treatment
			$("#epoletoggle").on("click", function(e) {

				if (epoleVisible) {
					parser.hideDocument(parser.docs[4]);
					epoleVisible = false;
				} else {
					parser.showDocument(parser.docs[4]);
					epoleVisible = true;
				}
			});


			$("#hpumptoggle").on("click", function(e) {

				if (hpumpVisible) {
					parser.hideDocument(parser.docs[5]);
					hpumpVisible = false;
				} else {
					parser.showDocument(parser.docs[5]);
					hpumpVisible = true;
				}

			});


			// for reservoir
			$("#hospitaltoggle").on("click", function(e) {

				if (hospitalVisible) {
					parser.hideDocument(parser.docs[6]);
					hospitalVisible = false;
				} else {
					parser.showDocument(parser.docs[6]);
					hospitalVisible = true;
				}
			});

			// for rising main

			$("#lpoletoggle").on("click", function(e) {

				if (lpoleVisible) {
					parser.hideDocument(parser.docs[7]);
					lpoleVisible = false;
				} else {
					parser.showDocument(parser.docs[7]);
					lpoleVisible = true;
				}
			});
			// for Source
			$("#masjidtoggle").on("click", function(e) {

				if (masjidVisible) {
					parser.hideDocument(parser.docs[8]);
					masjidVisible = false;
				} else {
					parser.showDocument(parser.docs[8]);
					masjidVisible = true;
				}
			});
			// for treatment
			$("#ohwttoggle").on("click", function(e) {

				if (ohwtVisible) {
					parser.hideDocument(parser.docs[9]);
					ohwtVisible = false;
				} else {
					parser.showDocument(parser.docs[9]);
					ohwtVisible = true;
				}
			});





			// for reservoir
			$("#roadtoggle").on("click", function(e) {

				if (roadVisible) {
					parser.hideDocument(parser.docs[10]);
					roadVisible = false;
				} else {
					parser.showDocument(parser.docs[10]);
					roadVisible = true;
				}
			});

			// for rising main

			$("#schoolbtoggle").on("click", function(e) {

				if (schoolbVisible) {
					parser.hideDocument(parser.docs[11]);
					schoolbVisible = false;
				} else {
					parser.showDocument(parser.docs[11]);
					schoolbVisible = true;
				}
			});
			// for Source
			$("#templetoggle").on("click", function(e) {

				if (templeVisible) {
					parser.hideDocument(parser.docs[12]);
					templeVisible = false;
				} else {
					parser.showDocument(parser.docs[12]);
					templeVisible = true;
				}
			});
			// for treatment
			$("#transformertoggle").on("click", function(e) {

				if (transformerVisible) {
					parser.hideDocument(parser.docs[13]);
					transformerVisible = false;
				} else {
					parser.showDocument(parser.docs[13]);
					transformerVisible = true;
				}
			});


			$("#wpntoggle").on("click", function(e) {

				if (wpnVisible) {
					parser.hideDocument(parser.docs[14]);
					wpnVisible = false;
				} else {
					parser.showDocument(parser.docs[14]);
					wpnVisible = true;
				}

			});


			// for reservoir
			$("#wpndtoggle").on("click", function(e) {

				if (wpndVisible) {
					parser.hideDocument(parser.docs[15]);
					wpndVisible = false;
				} else {
					parser.showDocument(parser.docs[15]);
					wpndVisible = true;
				}
			});

			// for rising main

			$("#wpnntoggle").on("click", function(e) {

				if (wpnnVisible) {
					parser.hideDocument(parser.docs[16]);
					wpnnVisible = false;
				} else {
					parser.showDocument(parser.docs[16]);
					wpnnVisible = true;
				}
			});
			// for Source
			$("#wtanktoggle").on("click", function(e) {

				if (wtankVisible) {
					parser.hideDocument(parser.docs[17]);
					wtankVisible = false;
				} else {
					parser.showDocument(parser.docs[17]);
					wtankVisible = true;
				}
			});
			// for treatment
			$("#welltoggle").on("click", function(e) {

				if (wellVisible) {
					parser.hideDocument(parser.docs[18]);
					wellVisible = false;
				} else {
					parser.showDocument(parser.docs[18]);
					wellVisible = true;
				}
			});

*/



			// for Distributries
			/*$("#distributtoggle").on("click", function(e) {
				alert(distVisible);
				if (distVisible) {
					parser.hideDocument(parser.docs[5]);
					distVisible = false;
				} else {
					parser.showDocument(parser.docs[5]);
					distVisible = true;
				}		
			});*/



			/*$("#recenter").on("click", function(e) {
		var latlng = new google.maps.LatLng(30.19436440247, 73.57216027448);
 	 	mapInstance.setCenter(latlng);		
	});*/

			$("#controls").show();
		}
		//function to place marker into map
		function placeMarker(position, mapInstance, distance) {
			// Create marker 
			var marker = new google.maps.Marker({
				map: mapInstance,
				position: position,
				title: 'Center'
			});

			//center map after click
			/*var iscenteractive = document.getElementById("mapcenter").checked
			if( iscenteractive )
				map.setCenter(position);*/

			//add marker into temp array
			markersArray.push(marker);

			//Add circle overlay and bind to marker
			var circle = new google.maps.Circle({
				map: mapInstance,
				radius: distance,
				fillColor: '#AA0000'
			});
			circle.bindTo('center', marker, 'position');

			circlesArray.push(circle);
		}

		//remove all markers from map
		function removeMarkersAndCircles() {
			if (markersArray) {
				for (i = 0; i < markersArray.length; i++) {
					markersArray[i].setMap(null);
					circlesArray[i].setMap(null);
				}
				markersArray.length = 0;
				circlesArray.length = 0;
			}
		}

		//write labels into inputs
		function writeLabels(position) {
			document.getElementById('maplat').value = position.lat();
			document.getElementById('maplng').value = position.lng();
		}

		function AjaxObject() {
			if (window.ActiveXObject) // For IE
			{
				Ajax = new ActiveXObject("Microsoft.XMLHTTP");
			} else if (window.XMLHttpRequest) {
				Ajax = new XMLHttpRequest();
			} else
				alert("Your Browser Did Not Support AJAX");
			return Ajax;
		}
		//draw marker and circle by location
		function drawByLocation() {

			var distance = parseInt(document.getElementById('mapdistance').value);
			var dis_km1 = distance / 1000;
			if (distance < 1) {
				alert('Your distance is too small');
			}

			//get values from inputs
			var lat = document.getElementById('maplat').value;
			var lng = document.getElementById('maplng').value;


			Ajax = AjaxObject();
			if (Ajax) {
				url = "<?php echo SITE_URL; ?>buffer_list.php";

				formdata = "lati=" + lat + "&lngi=" + lng + "&dis_km=" + dis_km1;
				Ajax.open("POST", url);
				Ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				Ajax.onreadystatechange = outputdept;
				Ajax.send(formdata);
			} else {
				alert("Not Supported");
			}


			var position = new google.maps.LatLng(lat, lng);

			//create marker and circle
			removeMarkersAndCircles();
			placeMarker(position, mapInstance, distance);
			writeLabels(position);



		}

		function outputdept() {
			if (Ajax.readyState == 4) {
				document.getElementById("buffer_detail").innerHTML = Ajax.responseText;
			}
		}

		function bufferoff() {

			var distance = parseInt(document.getElementById('mapdistance').value);

			if (distance < 1) {
				alert('Your distance is too small');
			}

			//get values from inputs
			var lat = document.getElementById('maplat').value;
			var lng = document.getElementById('maplng').value;

			var position = new google.maps.LatLng(lat, lng);

			//create marker and circle
			removeMarkersAndCircles();
			/*placeMarker(position, mapInstance, distance);
			writeLabels(position);*/

		}


		$(document).ready(function() {
			var latlng = new google.maps.LatLng('<?php echo $lat  ?>', '<?php echo $lng  ?>');
			var mapOptions = {
				zoom: 16,
				center: latlng,
				mapTypeId: google.maps.MapTypeId.SATELLITE,
				mapTypeControl: true,
			};

			mapInstance = new google.maps.Map(document.getElementById("map"), mapOptions);
				measureTool = new MeasureTool(mapInstance, {
			unit: MeasureTool.UnitTypeId.IMPERIAL
		});


			// Create a new parser for all the KML
			// processStyles: true means we want the styling defined in KML to be what isrendered
			// singleInfoWindow: true means we only want 1 simultaneous info window open
			// zoom: false means we don't want torecenter/rezoom based on KML data
			// afterParse: customAfterparse is a method to add the sidebar once parsing is done
			//
			parser = new geoXML3.parser({
				map: mapInstance,
				processStyles: true,
				singleInfoWindow: true,
				zoom: false,
				afterParse: customAfterParse
			});

			// Add an event listen for the parsed event on the parser
			// Thisrequires a Geoxml3 with the patch defined in Issue 40
			// http://code.google.com/p/geoxml3/issues/detail?id=40
			// We need this event to know when Geoxml3 has compltely defined the coument arrays
			google.maps.event.addListener(parser, 'parsed', completeInit);
			var tcode = "<?php echo $tcode ?>";

			//if (tcode == 06) {
				<?php $kmlsql = "select * from kmls_add_village where vcode=" . $vcode;
				$kmlresult = mysql_query($kmlsql);
				$total = mysql_num_rows($kmlresult);
				$file_name_kml = "";
				$file_kml = "";
				$i = 0;
				while ($kmldata = mysql_fetch_array($kmlresult)) {
					$i = $i + 1;
					if ($i < $total) {
						$file_name_kml = "kml/" . $kmldata['file_name'];
						$file_kml .= "'$file_name_kml'" . ",";
					} else {
						$file_name_kml = "kml/" . $kmldata['file_name'];
						$file_kml .= "'$file_name_kml'";
					}

					$file_name = $kmldata['file_name'];
					$kmlid_1 = $kmldata['kid'];
					$kidd = $kmlid_1 - 1;
					$arr_file = explode(".", $file_name);
					$justname = $arr_file[0];
				}
				?>

				parser.parse([<?php echo $file_kml; ?>]);



			//}






			const legend = document.getElementById("legend");

			mapInstance.controls[google.maps.ControlPosition.LEFT_CENTER].push(legend);



		});
	</script>
	<?php
	/*if ($_GET['map_id'] == 1) {}
	if ($_GET['map_id'] == 2) {}
	if ($_GET['map_id'] == 3) {}
	if ($_GET['map_id'] == 4) {}*/
	?>


	<?php
	$iCount = 0;
	$SQL = "Select * from p2005wss where dcode = " . $dcode . " and tcode=" . $tcode . " and vcode=" . $vcode;
	$reportresult = mysql_query($SQL);
	$iCount = mysql_num_rows($reportresult);
	if ($iCount > 0) {
		while ($reportdata = mysql_fetch_array($reportresult)) {

			$sno		= $reportdata['sno'];
			$datadate	= $reportdata['datadate'];
			$databy		= $reportdata['databy'];
			$wssname	= $reportdata['wssname'];
			$condate		= $reportdata['condate'];
			$exeagencyval	= $reportdata['exeagencyval'];
			$omagencyval		= $reportdata['omagencyval'];
			$statusval	= $reportdata['statusval'];

			$reasonval		= $reportdata['reasonval'];
			$nohh	= $reportdata['nohh'];
			$contypedom		= $reportdata['contypedom'];
			$contypecom	= $reportdata['contypecom'];
			$condate		= $reportdata['condate'];
			$nocon	= $reportdata['nocon'];
			$wssourceval		= $reportdata['wssourceval'];
			$zoneval	= $reportdata['zoneval'];

			$dilmodval		= $reportdata['dilmodval'];
			$twdepth	= $reportdata['twdepth'];
			$wtable		= $reportdata['wtable'];
			$hpipe	= $reportdata['hpipe'];
			$bpipe		= $reportdata['bpipe'];
			$stainer	= $reportdata['stainer'];
			$q		= $reportdata['q'];
			$head	= $reportdata['head'];
			$bhp		= $reportdata['bhp'];
			$Dia	= $reportdata['Dia'];
			$srno		= $reportdata['srno'];
			$ework	= $reportdata['ework'];
			$mwork		= $reportdata['mwork'];
			$chlorination	= $reportdata['chlorination'];
			$moverval		= $reportdata['moverval'];
			$wstypesurfval	= $reportdata['wstypesurfval'];
			$wstypesurfdelval		= $reportdata['wstypesurfdelval'];
			$wstreatsurfval	= $reportdata['wstreatsurfval'];
			$rmainno		= $reportdata['rmainno'];
			$rmainmat	= $reportdata['rmainmat'];
			$rmdia		= $reportdata['rmdia'];
			$rmlength	= $reportdata['rmlength'];
			$novalve		= $reportdata['novalve'];

			$tankshape	= $reportdata['tankshape'];
			$tankcapacity		= $reportdata['tankcapacity'];
			$tankdim	= $reportdata['tankdim'];
			$tankheight		= $reportdata['tankheight'];
			$tankplumb	= $reportdata['tankplumb'];
			$wdnmat		= $reportdata['wdnmat'];
			$wdndia	= $reportdata['wdndia'];
			$wdnlength		= $reportdata['wdnlength'];
			$sketch	= $reportdata['sketch'];
			$remarks		= $reportdata['remarks'];
			$photolink1		= $reportdata['photolink1'];
			$photolink2		= $reportdata['photolink2'];
			$photolink3		= $reportdata['photolink3'];
			$photolink4		= $reportdata['photolink4'];
		}
	}
	?>

	<section class="mb-4">
		<div class="container-fluid" style="padding-top: 0px !important;">
			<div class="card">
				<div class="card-body">
					<div class="d-flex">
						<p class="d-flex flex-row">
							<span class="text-bold text-lg"><?= $data_dis['name'];  ?> &raquo; <?= $data_th['tehsil']; ?> &raquo; <?= $data_vi['village']; ?> </span>
						</p>
					</div>
					<div id="map"></div>
					<div id="legend" style="width:25%">
						<h5>Legends</h5>
						<div style="height:30px;">
							<input type="button" value="Check All" onclick="check();">
							<input type="button" value="Uncheck All" onclick="uncheck();">
						</div>
						</br>

						<div>

							<?php $kmlsql = "select * from kmls_add_village where vcode=" . $vcode;
							$kmlresult = mysql_query($kmlsql);
							$total = mysql_num_rows($kmlresult);

							$i = 0;
							$checked = "";
							while ($kmldata = mysql_fetch_array($kmlresult)) {
								$file_name = $kmldata['file_name'];
								$color_lp = "#" . $kmldata['color_lp'];
								//$color_poly="border-color:".$color_lp;
								$attribute_type = $kmldata['attribute_type'];
								$kkmlid_1 = $kmldata['kmlid'];
								$name = $kmldata['name'];

								$arr_file = explode(".", $file_name);
								$justname = $arr_file[0];
								if ($attribute_type == "point") {
									$checked = "checked";

									$image_name = "kml/" . $kmldata['image_name'];
									$image_name_point = "<img src=" . $_CONFIG['site_url'] . $image_name . " alt=" . $kmldata['image_name'] . " height='22px' width='22px' />";
								} else if ($attribute_type == "line") {

									$checked = 'checked="checked"';
									$image_name_point = '<span><svg style="margin-left:6px;" height="6" width="20">
  <line x1="0" y1="0" x2="10" y2="" style="stroke:' . $color_lp . '";stroke-width:10;" /></span>';
								} else if ($attribute_type == "polygon") {

									$checked = "checked";


									$image_name_point = '<span><svg style="margin-left:6px;" width="20" height="10">
<rect width="10" height="10" style=" fill:' . $color_lp . '";stroke-width:10;fill-opacity:0.1;stroke-opacity:0.9;stroke:' . $color_1p . '" />
</svg></span>';
								}

								$i = $i + 1;
								if ($i == 1) {
							?>
									<table align="center">
										<tr>

											<td width="18%">

												<input type="checkbox" id="<?php echo $justname . "toggle" ?>" <?php echo $checked; ?> />
												<label for="<?php echo $justname . "toggle" ?>"><?php echo $image_name_point; ?></label><?php echo $name; ?></td>
										<?php
									} else if ($i % 2 != 0 && $i != 1) {
										?>

											<td width="18%"><input type="checkbox" id="<?php echo $justname . "toggle" ?>" <?php echo $checked; ?> />
												<label for="<?php echo $justname . "toggle" ?>"><?php echo $image_name_point; ?></label><?php echo $name; ?></td>
										<?php
									} else if ($i % 2 == 0) {

										?>

											<td width="18%"><input type="checkbox" id="<?php echo $justname . "toggle" ?>" <?php echo $checked; ?> />
												<label for="<?php echo $justname . "toggle" ?>"><?php echo $image_name_point; ?></label><?php echo $name; ?></td>
										</tr>
								<?php
									}
								}
								?>





								<?php /*?><p><input type="checkbox" id="benchmarktoggle" checked="checked" /><label for="benchmarktoggle"> Bench Mark</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Bench_Mark.png" width="18px" height="18px" alt=" Bench Mark" /></p>
							<p><input type="checkbox" id="boringtoggle" checked="checked" /><label for="boringtoggle"> Boring</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Boring.png" width="18px" height="18px" alt=" Boring" /></p>
							<p><input type="checkbox" id="buildingtoggle" checked="checked" /><label for="buildingtoggle"> Building</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Building.png" alt=" Building" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="villagetoggle" checked="checked" /><label for="villagetoggle"> Village</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Dotihal.png" alt=" Dotihal" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="epoletoggle" checked="checked" /><label for="epoletoggle"> Electric Pole</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Electric_Pole.png" alt=" Electric Pole" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="hpumptoggle" checked="checked" /><label for="hpumptoggle"> Hand Pump</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Hand_Pump.png" alt=" Hand Pump" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="hospitaltoggle" checked="checked" /><label for="hospitaltoggle"> Hospital</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Hospital.png" alt=" Hospital" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="lpoletoggle" checked="checked" /><label for="lpoletoggle"> Light Pole</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Light_Pole.png" alt=" Light_Pole" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="masjidtoggle" checked="checked" /><label for="masjidtoggle"> Masjid</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Masjid.png" alt=" Masjid" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="ohwttoggle" checked="checked" /><label for="ohwttoggle"> Over Head Water Tank</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Over_Head_Water_Tank.png" alt=" Over_Head_Water_Tank" width="18px" height="18px" /></p>
						</div>
						<div style="float:left;">
							<p><input type="checkbox" id="roadtoggle" checked="checked" /><label for="roadtoggle"> Roads</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Roads.png" alt=" Roads" /></p>
							<p><input type="checkbox" id="schoolbtoggle" checked="checked" /><label for="schoolbtoggle">School Boundary</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/School_Boundary.png" alt=" School_Boundary" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="templetoggle" checked="checked" /><label for="templetoggle"> Temple</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Temple.png" alt=" Temple" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="transformertoggle" checked="checked" /><label for="transformertoggle"> Transformer</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Transformer.png" alt=" Transformer" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="wpntoggle" checked="checked" /><label for="wpntoggle"> Water Pipe Network</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Water_Pipe_Network.png" alt=" Water_Pipe_Network" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="wpnntoggle" checked="checked" /><label for="wpnntoggle"> Water Pipe Network Node</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Water_Pipe_Network_Node.png" alt=" Water_Pipe_Network_Node" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="wtanktoggle" checked="checked" /><label for="wtanktoggle"> Water Tank</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Water_Tank.png" alt=" Water_Tank" width="18px" height="18px" /></p>
							<p><input type="checkbox" id="welltoggle" checked="checked" /><label for="welltoggle"> Well</label>:<img src="<?php echo $_CONFIG['site_url']; ?>kml/Well.png" alt=" Well" width="18px" height="18px" /></p><?php */ ?>
									</table>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div id="wrapper_MemberLogin">
					<div class="container-fluid">
						<form class="form-inline">
							<div class="form-group mx-sm-3 mb-2">
								<p style="color: red">
									<b style="color: black"><?php echo "Buffer Info"; ?></b></br>Click on map</br>/write lat,lng
								</p>
							</div>
							<div class="form-group mx-sm-3 mb-2">
								<label for="mapdistance">Buffer(meters) </label>
								<input class="form-control" type="number" id="mapdistance" value="2000" />
							</div>
							<div class="form-group mx-sm-3 mb-2">
								<label for="maplat">Latitude </label>
								<input class="form-control" type="text" id="maplat" value="<?php if ($latbf != "") {
																								echo $latbf;
																							} else {
																								echo "15.796949689991587";
																							} ?>" />
							</div>
							<div class="form-group mx-sm-3 mb-2">
								<label for="maplng">Longitude </label>
								<input class="form-control" type="text" id="maplng" value="<?php if ($lngbf != "") {
																								echo $lngbf;
																							} else {
																								echo "76.22180943770587";
																							} ?>" />
							</div>
							<div class="form-group mx-sm-3 mb-2">
								<button type="submit" class="btn btn-success mx-sm-3" onclick="drawByLocation(); return false;">Draw Buffer</button>
								<button type="submit" class="btn btn-danger mx-sm-3" onclick="bufferoff(); return false;">Buffer Off</button>
							</div>
					</div>
					</form>
				</div>
			</div>
		</div>

		<div id="buffer_detail">

		</div>
        
 
<div class="fluid-container p-2">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
							<h3 class="card-title"><i class="fas fa-file-contract mr-1"></i>Documents</h3>
<div class="card-tools">
									<ul class="nav nav-pills ml-auto">
										<li class="nav-item">
											<a class="nav-link active" href="/SWIS/?p=add_report&unique_id=<?php echo $dcode.$tcode.$vcode ?>" target="popup"
                                            onclick="window.open('/SWIS/?p=add_report&unique_id=<?php echo $dcode.$tcode.$vcode ?>',
                                            'newwindow', 'width=1350,height=700'); return false;"><?php echo "ADD REPORT" ?></a>
										</li>
									</ul>
								</div>
                                </div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped display responsive nowrap" style="width:100%">
							<thead>
								<tr>
									<th>Name</th>
									<th><?php echo "Item Name"; ?></th>
									<th><?php echo "File Link"; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query4 = "SELECT * FROM tbl_dpr_village where dcode = '$dcode' AND tcode = '$tcode' AND vcode = '$vcode'";
								//echo $query4;
								$result4 = mysql_query($query4);
								mysql_num_rows($result4);
								if (mysql_num_rows($result4) > 0) {
									while ($row4 = mysql_fetch_assoc($result4)) {
								?>
														<tr>
															<td><?php echo $row4['image_name_eng']; ?></td>
															<td><?php echo $row4['item_name']; ?></td>
															<td><?php
															$file = $row4['item_name'];
											$extension = explode(".", $file);
											$extension[1];
											if ($extension[1] == "pdf" || $extension[1] == "xlsx" || $extension[1] == "csv" || $extension[1] == "xls") { ?>
													<ul class="list-unstyled" aria-label="<?php echo $type; ?>">
														<li>
															<a href="DPRS/<?php echo $file; ?>" target="_blank" class=" btn-link text-secondary"><i class="fas fa-fw fa-file-pdf"></i> <?php
																																															if ($file_name_eng == "" && $file_name_rus == "") {
																																																echo $file;
																																															} else {
																																																																																															//} ?></a>
														</li>
													</ul>
</td>
																<?php
																} 
																?>
														</tr>
								<?php
									}
								}
}s
								?>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div> 
 
 
 
        

		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><i class="fas fa-scroll mr-1"></i><?php echo "Summary of the Scheme" ?>
						</h3>
				</div>
				<div class="card-body">
                
                <?php
								$querys = "SELECT * FROM tbl_summary_village where dcode = '$dcode' AND tcode = '$tcode' AND vcode = '$vcode'";
								//echo $query4;
								$results = mysql_query($querys);
								
									$rows = mysql_fetch_assoc($results);
								?>
					<table  cellpadding="0" cellspacing="0"  align="center"  style="font-family:Verdana, Geneva, sans-serif; font-weight:bold; font-size:12px;  width:70%";  >
						
						<tr>							
							<td width="10%" height="35px"  style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold; background-color:#FFAE5E; border-bottom:1px thick" align="center">Sr. No.</td>	
                            <td width="30%"  style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold; background-color:#FFAE5E" align="center">Particulars</td>			<td   width="60%" style="font-family:Verdana, Geneva, sans-serif; font-weight:bold;font-size:16px;background-color:#FFAE5E" align="center">Initial Stage – 2020</td>
						</tr>
						<tr>
                        
                        <td width="10%" height="30px"  style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color: #FFF0F0" align="center">1</td>	
                            <td width="50%"  style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FFF0F0" align="left">Population</td>			<td   width="40%" style="font-family:Verdana, Geneva, sans-serif; font-weight:bold;font-size:12px;background-color:#FFF0F0" align="center"><?php echo $rows['population'];?></td>
                        
                        
							
						</tr>
                        <tr>
                        
                        <td width="10%" height="30px"  style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FFF" align="center">2</td>	
                            <td width="50%"  style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FFF" align="left">Total number of House holds </td>			<td   width="40%" style="font-family:Verdana, Geneva, sans-serif; font-weight:bold;font-size:12px;background-color:#FFF" align="center"><?php echo $rows['tot_hh'];?></td>
                        
                        
							
						</tr>
                        <tr>
                        
                        <td width="10%" height="30px"  style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FFF0F0" align="center">3</td>	
                            <td width="50%"  style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FFF0F0" align="left">Capital cost of project (Rs. In Lacs)</td>			<td   width="40%" style="font-family:Verdana, Geneva, sans-serif; font-weight:bold;font-size:12px;background-color:#FFF0F0" align="center"><?php echo $rows['cost_proj'];?></td>
                        
                        
							
						</tr>
                        <tr>
                        
                        <td width="10%" height="30px"  style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FFF" align="center">4</td>	
                            <td width="50%"  style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FFF" align="left">Per FHTC cost of project (305 HH)</td>			<td   width="40%" style="font-family:Verdana, Geneva, sans-serif; font-weight:bold;font-size:12px;background-color:#FFF" align="center"><?php echo $rows['per_hftc_cost'];?></td>
                        
                        
							
						</tr>
                        <tr>
                        
                        <td width="10%" height="30px"  style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FFF0F0" align="center">5</td>	
                            <td width="50%"  style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#FFF0F0" align="left">Annual Requirement of water (KL) (for 2020)</td>			<td   width="40%" style="font-family:Verdana, Geneva, sans-serif; font-weight:bold;font-size:12px;background-color:#FFF0F0" align="center"><?php echo $rows['req_water_kl'];?></td>
                        
                        
							
						</tr>
						

						
						
						
						
						
						
						
					
					</table>
                    
					
				<?php
			} else {
				?>
					<p style="font-weight:bold; margin-top:40px;margin-left:80px;"><?php echo "No water supply scheme exist" ?></p>
				<?php
			}
				?>
				</div>
			</div>
		</div>

		</div>
	</section>