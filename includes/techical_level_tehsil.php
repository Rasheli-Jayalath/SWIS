<?php
$dcode = $componentid;
$tcode = $subcomponentid;
$wsssno = $vcode;
$behavid = $behavid;
 //echo $_CONFIG['site_url']."kml/Village_dist.png";

if ($tcode == "01") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
} else if ($tcode == "02") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
} else if ($tcode == "03") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
} else if ($tcode == "04") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
} else if ($tcode == "05") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
} else if ($tcode == "06") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
}else if ($tcode == "07") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
} else if ($tcode == "08") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
} else if ($tcode == "09") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
} else if ($tcode == "10") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
} else if ($tcode == "11") {
	$query1 = "SELECT * from p2003village  where dcode=" . $dcode . " and tcode=" . $tcode . " limit 1";
	$res = mysql_query($query1);
}

$rowws = mysql_num_rows($res);
$obj1 = mysql_fetch_array($res);

$lat = $obj1['y'];
$lng = $obj1['x'];

?>


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
	var villagepVisible = true;

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
	function completeInit1() {

		// Hide non-placemark layer(s)
		parser.hideDocument(parser.docs[0]);
		villagepVisible = false;
		

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


		// for villages
		$("#villageptoggle").on("click", function(e) {

			if (villagepVisible) {
				parser.hideDocument(parser.docs[0]);
				villagepVisible = false;
			} else {
				parser.showDocument(parser.docs[0]);
				villagepVisible = true;
			}

		});
		// for rising main

		


		/*$("#recenter").on("click", function(e) {
		var latlng = new google.maps.LatLng(30.19436440247, 73.57216027448);
 	 	mapInstance.setCenter(latlng);		
	});*/

		$("#controls").show();
	}

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
			zoom: 10,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.SATELLITE,
			mapTypeControl: true,
		};
		mapInstance = new google.maps.Map(document.getElementById("map"), mapOptions);

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
		google.maps.event.addListener(parser, 'parsed', completeInit1);
		var tcode = "<?php echo $tcode ?>";
		if (tcode == 01) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/BAGALKOT.kml']);
		}
		else if (tcode == 02) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/BELGAUM.kml']);
		}
		else if (tcode == 03) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/BIJAPUR.kml']);
		}
		else if (tcode == 04) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/CHIKKAMANGLURU.kml']);
		}
		else if (tcode == 05) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/CHITRADURGA.kml']);
		}
		else if (tcode == 06) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/HASSAN.kml']);
		}
		else if (tcode == 07) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/HAWERI.kml']);
		}
		else if (tcode == 08) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/KOPPAL.kml']);
		}
		else if (tcode == 09) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/MANDYA.kml']);
		}
		else if (tcode == 10) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/MYSORE.kml']);
		}
		else if (tcode == 11) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/RAMANAGARA.kml']);
		}

		const legend = document.getElementById("legend");
		const div = document.createElement("div");
		div.innerHTML = '<input type="checkbox" id="villageptoggle" checked="checked" /><label for="villageptoggle">&nbsp;&nbsp;Villages: <img src="<?php echo $_CONFIG['site_url']; ?>kml/Village_dist.png" alt=" Villages" /></label>';
		legend.appendChild(div);

		mapInstance.controls[google.maps.ControlPosition.LEFT_CENTER].push(legend);

	});
</script>



<?php
$result_dis = mysql_query("SELECT name FROM p2001district where code=" . $dcode);
$data_dis = mysql_fetch_array($result_dis);
$result_th = mysql_query("SELECT tehsil FROM p2002tehsil where code=" . $tcode);
$data_th = mysql_fetch_array($result_th);
?>

<section class="mb-4">
	<div class="container-fluid" style="padding-top: 0px !important;">
		<div class="card">
			<div class="card-body">
				<div class="d-flex">
					<p class="d-flex flex-row">
						<span class="text-bold text-lg"><?= $data_dis['name'];  ?> &raquo; <?= $data_th['tehsil']; ?></span>
					</p>
				</div>
				<div id="map"></div>
				<div id="legend">
					<h5>Legends</h5>
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
								<input class="form-control" type="number" id="mapdistance" value="50000" />
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


		<div class=" card-deck">
			<div class="card bg-light">
				<div class="card-header border-0">
					<h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Work Progress as Chart</h3>
				</div>
				<div class="card-body">
					<div class="d-flex">
						<div class="col-md-4">
							<figure class="highcharts-figure">
								<div id="ddpr"></div>
							</figure>
						</div>
						<div class="col-md-4">
							<figure class="highcharts-figure">
								<div id="fdpr"></div>
							</figure>
						</div>
						<div class="col-md-4">
							<figure class="highcharts-figure">
								<div id="boqdpr"></div>
							</figure>
						</div>
					</div>
				</div>
			</div>
			
		</div>

	</div>
</section>

<div id="mainTable" style="margin-left:55px; width:89%">
	<?php
	$result_dpr = mysql_query("SELECT * FROM tbl_dpr where dcode=" . $dcode . " and tcode=" . $tcode);
	while ($data_dpr = mysql_fetch_array($result_dpr)) {
		$result_abc = mysql_query("select tehsil from p2002tehsil where code=" . $tcode);
		$data_abc = mysql_fetch_array($result_abc);
		if ($data_dpr['milestone'] == "Draft DPR") {
			$remain_d = 100 - $data_dpr['percent_completed'];
	?>
			<script>
				Highcharts.setOptions({
					colors: ['#01BAF2', '#C0C0C0']
				});
				Highcharts.chart('ddpr', {
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie'
					},
					exporting: {
						enabled: false
					},
					title: {
						text: '<?php echo $data_dpr['milestone']; ?>'
					},
					subtitle: {
						text: '<b><?php echo number_format($data_dpr["percent_completed"], 1); ?>%</b>',
						align: 'center',
						verticalAlign: 'middle',
					},
					legend: {
						enabled: true,
						useHTML: true,
						labelFormatter: function() {
							if (this.name == "Remaining") {
								return '<div><span>Total Villages:</span><span>' +
									<?php echo $data_dpr["total_villages"] ?> +
									'</span></div > ';
							}
							if (this.name == "Completed") {
								return '<div><span>Completed:</span><span>' +
									<?php echo $data_dpr["completed"] ?> + '</span></div>';
							}
						}
					},
					tooltip: {
						valueSuffix: '%'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
					series: [{
						name: 'Draft DPR',
						colorByPoint: true,
						innerSize: '70%',
						data: [{
							name: 'Completed',
							// color: '#01BAF2',
							y: <?php echo number_format($data_dpr["percent_completed"], 1); ?>,
						}, {
							//

							name: 'Remaining',
							//color: '#FAA74B',
							y: <?php echo number_format($remain_d, 1); ?>
						}]
					}]
				});
			</script>
		<?php
		} else if ($data_dpr['milestone'] == "Final DPR") {
			$remain_f = 100 - $data_dpr['percent_completed'];
		?>
			<script>
				Highcharts.setOptions({
					colors: ['#01BAF2', '#C0C0C0']
				});
				Highcharts.chart('fdpr', {
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie'
					},
					exporting: {
						enabled: false
					},
					title: {
						text: '<?php echo $data_dpr['milestone']; ?>'
					},
					subtitle: {
						text: '<b><?php echo number_format($data_dpr["percent_completed"], 1); ?>%</b>',
						align: 'center',
						verticalAlign: 'middle',
					},
					legend: {
						enabled: true,
						useHTML: true,
						labelFormatter: function() {
							if (this.name == "Remaining") {
								return '<div><span>Total Villages:</span><span>' +
									<?php echo $data_dpr["total_villages"] ?> +
									'</span></div > ';
							}
							if (this.name == "Completed") {
								return '<div><span>Completed:</span><span>' +
									<?php echo $data_dpr["completed"] ?> + '</span></div>';
							}
						}
					},
					tooltip: {
						valueSuffix: '%'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
					series: [{
						name: 'Final DPR',
						colorByPoint: true,
						innerSize: '70%',
						data: [{
							name: 'Completed',
							// color: '#01BAF2',
							y: <?php echo number_format($data_dpr["percent_completed"], 1); ?>,
						}, {
							//

							name: 'Remaining',
							//color: '#FAA74B',
							y: <?php echo number_format($remain_f, 1); ?>
						}]
					}]
				});
			</script>
		<?php
		} else if ($data_dpr['milestone'] == "TENDER & BOQ") {
			$remain_boq = 100 - $data_dpr['percent_completed'];
		?>
			<script>
				Highcharts.setOptions({
					colors: ['#01BAF2', '#C0C0C0']
				});
				Highcharts.chart('boqdpr', {
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie'
					},
					exporting: {
						enabled: false
					},
					title: {
						text: '<?php echo $data_dpr['milestone']; ?>'
					},
					subtitle: {
						text: '<b><?php echo number_format($data_dpr["percent_completed"], 1); ?>%</b>',
						lign: 'center',
						verticalAlign: 'middle',
					},
					legend: {
						enabled: true,
						useHTML: true,
						labelFormatter: function() {
							if (this.name == "Remaining") {
								return '<div><span>Total Villages:</span><span>' +
									<?php echo $data_dpr["total_villages"] ?> +
									'</span></div > ';
							}
							if (this.name == "Completed") {
								return '<div><span>Completed:</span><span>' +
									<?php echo $data_dpr["completed"] ?> + '</span></div>';
							}
						}
					},
					tooltip: {
						valueSuffix: '%'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
					series: [{
						name: 'TENDER & BOQ',
						colorByPoint: true,
						innerSize: '70%',
						data: [{
							name: 'Completed',
							// color: '#01BAF2',
							y: <?php echo number_format($data_dpr["percent_completed"], 1); ?>,
						}, {
							//

							name: 'Remaining',
							//color: '#FAA74B',
							y: <?php echo number_format($remain_boq, 1); ?>
						}]
					}]
				});
			</script>
	<?php
		}
	}
	?>

	<div align="right" style="margin-top:10px"><a href="javascript:void(null);" onClick="doToggle('dpr_detail');" title="detail">Detail</a></div>

	<div id="dpr_detail" style="display:none">
		<table cellspacing="0" cellpadding="0" border="1px" align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; margin-top:20px; width:100%">

			<tr style="font-family:Verdana, Geneva, sans-serif; font-size:15px; font-weight:bold; background-color: #339; color:white">
				<td colspan="5" width="810" align="center" height="30px">Work Progress</td>
			</tr>
			<tr style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color: #C8C8C8; height:23px">
				<td width="250" align="center">DPR Level</td>
				<td width="130" align="center">District</td>
				<td width="130" align="center">Total Villages</td>
				<td width="130" align="center">Completed</td>
				<td width="130" align="center">% Completed</td>

			</tr>
			<?php
			$result_dpr = mysql_query("SELECT * FROM tbl_dpr where dcode=" . $dcode . " and tcode=" . $tcode);
			while ($data_dpr = mysql_fetch_array($result_dpr)) {
				$result_abc = mysql_query("select tehsil from p2002tehsil where code=" . $tcode);
				$data_abc = mysql_fetch_array($result_abc)
			?>
				<tr>

					<td width="130" height="30px" align="center"><a href="javascript:void(null);" onClick="doToggle1('fun_1');" title="functional" style="text-decoration:none; color:black"><?= $data_dpr['milestone'] ?></a></td>
					<td width="130" height="30px" align="center"><a href="javascript:void(null);" onClick="doToggle1('nfun_1');" title="nonfunctional" style="text-decoration:none; color:black"><?= $data_abc['tehsil'] ?></a></td>
					<td width="130" height="30px" align="center"><a href="javascript:void(null);" onClick="doToggle1('aban_1');" title="abandoned" style="text-decoration:none; color:black"><?= $data_dpr['total_villages'] ?></a></td>
					<td width="130" height="30px" align="center"><a href="javascript:void(null);" onClick="doToggle1('aban_1');" title="abandoned" style="text-decoration:none; color:black"><?= $data_dpr['completed'] ?></a></td>
					<td width="130" height="30px" align="center"><a href="javascript:void(null);" onClick="doToggle1('aban_1');" title="abandoned" style="text-decoration:none; color:black"><?= $data_dpr['percent_completed'] ?></a></td>

				</tr>


				<?php /*?><div id="container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<?php */ ?>
			<?php
			}
			?>


		</table>
	</div>
</div>