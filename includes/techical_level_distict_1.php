<?php
$dcode = $componentid;

$behavid = $behavid;

if ($dcode == 01) {
	$query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=" . $dcode . " limit 1";
	$res = mysql_query($query1);
} else if ($dcode == 02) {
	$query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=" . $dcode . " limit 1";
	$res = mysql_query($query1);
} else if ($dcode == 03) {
	$query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=" . $dcode . " limit 1";
	$res = mysql_query($query1);
} else if ($dcode == 04) {
	$query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=" . $dcode . " limit 1";
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
	var polygonsVisible = true;
	var risingVisible = true;
	var reservoirVisible = true;
	var sourceVisible = true;
	var treatmentVisible = true;
	var distVisible = true;



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
		parser.hideDocument(parser.docs[1]);
		parser.hideDocument(parser.docs[2]);
		parser.hideDocument(parser.docs[3]);
		parser.hideDocument(parser.docs[4]);
		parser.hideDocument(parser.docs[5]);
		polygonsVisible = false;
		//placemarksVisible = false;
		risingVisible = false;
		reservoirVisible = false;
		sourceVisible = false;
		treatmentVisible = false;
		distVisible = false;

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
		$("#polygontoggle").on("click", function(e) {

			if (polygonsVisible) {
				parser.hideDocument(parser.docs[0]);
				polygonsVisible = false;
			} else {
				parser.showDocument(parser.docs[0]);
				polygonsVisible = true;
			}

		});
		// for rising main

		$("#risingtoggle").on("click", function(e) {

			if (risingVisible) {
				parser.hideDocument(parser.docs[1]);
				risingVisible = false;
			} else {
				parser.showDocument(parser.docs[1]);
				risingVisible = true;
			}
		});

		// for reservoir
		$("#reservoirtoggle").on("click", function(e) {

			if (reservoirVisible) {
				parser.hideDocument(parser.docs[2]);
				reservoirVisible = false;
			} else {
				parser.showDocument(parser.docs[2]);
				reservoirVisible = true;
			}
		});
		// for Source
		$("#sourcetoggle").on("click", function(e) {

			if (sourceVisible) {
				parser.hideDocument(parser.docs[3]);
				sourceVisible = false;
			} else {
				parser.showDocument(parser.docs[3]);
				sourceVisible = true;
			}
		});
		// for treatment
		$("#treatmenttoggle").on("click", function(e) {

			if (treatmentVisible) {
				parser.hideDocument(parser.docs[4]);
				treatmentVisible = false;
			} else {
				parser.showDocument(parser.docs[4]);
				treatmentVisible = true;
			}
		});
		// for Distributries
		$("#disttoggle").on("click", function(e) {
			alert(distVisible);
			if (distVisible) {
				parser.hideDocument(parser.docs[5]);
				distVisible = false;
			} else {
				parser.showDocument(parser.docs[5]);
				distVisible = true;
			}
		});



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
			zoom: 16,
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
		var dcode = "<?php echo $dcode ?>";

		if (dcode == 01) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/Villages_d01.kml', 'kml/Rising_Main_d01.kml', 'kml/Reservoir_d01.kml', 'kml/Source_d01.kml', 'kml/Treatment_Facility_d01.kml', 'kml/distributries.kml', 'kml/roads.kml', 'kml/railway.kml', 'kml/canal_main.kml']);
		} else if (dcode == 02) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/Villages_d02.kml', 'kml/Rising_Main_d02.kml', 'kml/Reservoir_d02.kml', 'kml/Source_d02.kml', 'kml/Treatment_Facility_d02.kml', 'kml/distributries.kml', 'kml/roads.kml', 'kml/railway.kml', 'kml/canal_main.kml']);
		} else if (dcode == 03) {

			parser.parse(['kml/Villages_d03.kml', 'kml/Rising_Main_d03.kml', 'kml/Reservoir_d03.kml', 'kml/Source_d03.kml', 'kml/Treatment_Facility_d03.kml', 'kml/distributries.kml', 'kml/roads.kml', 'kml/railway.kml', 'kml/canal_main.kml']);

		} else if (dcode == 04) {
			//google.maps.event.addListener(parser, 'parsed', completeInit);
			parser.parse(['kml/Villages_d04.kml', 'kml/Rising_Main_d04.kml', 'kml/Reservoir_d04.kml', 'kml/Source_d04.kml', 'kml/Treatment_Facility_d04.kml', 'kml/distributries.kml', 'kml/roads.kml', 'kml/railway.kml', 'kml/canal_main.kml']);
		}
	});
</script>

<?php
if ($_GET['map_id'] == 1) {
?>
	<script type="text/javascript">
		var mapInstance;
		var parser;
		var placemarkMetadata = [];
		var polygonsVisible = true;
		var risingVisible = true;
		var reservoirVisible = true;
		var sourceVisible = true;
		var treatmentVisible = true;
		var distVisible = true;



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
			parser.hideDocument(parser.docs[1]);
			parser.hideDocument(parser.docs[2]);
			parser.hideDocument(parser.docs[3]);
			parser.hideDocument(parser.docs[4]);
			parser.hideDocument(parser.docs[5]);
			polygonsVisible = false;
			//placemarksVisible = false;
			risingVisible = false;
			reservoirVisible = false;
			sourceVisible = false;
			treatmentVisible = false;
			distVisible = false;

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
			$("#polygontoggle").on("click", function(e) {

				if (polygonsVisible) {
					parser.hideDocument(parser.docs[0]);
					polygonsVisible = false;
				} else {
					parser.showDocument(parser.docs[0]);
					polygonsVisible = true;
				}

			});
			// for rising main

			$("#risingtoggle").on("click", function(e) {

				if (risingVisible) {
					parser.hideDocument(parser.docs[1]);
					risingVisible = false;
				} else {
					parser.showDocument(parser.docs[1]);
					risingVisible = true;
				}
			});

			// for reservoir
			$("#reservoirtoggle").on("click", function(e) {

				if (reservoirVisible) {
					parser.hideDocument(parser.docs[2]);
					reservoirVisible = false;
				} else {
					parser.showDocument(parser.docs[2]);
					reservoirVisible = true;
				}
			});
			// for Source
			$("#sourcetoggle").on("click", function(e) {

				if (sourceVisible) {
					parser.hideDocument(parser.docs[3]);
					sourceVisible = false;
				} else {
					parser.showDocument(parser.docs[3]);
					sourceVisible = true;
				}
			});
			// for treatment
			$("#treatmenttoggle").on("click", function(e) {

				if (treatmentVisible) {
					parser.hideDocument(parser.docs[4]);
					treatmentVisible = false;
				} else {
					parser.showDocument(parser.docs[4]);
					treatmentVisible = true;
				}
			});
			// for Distributries
			$("#disttoggle").on("click", function(e) {
				alert(distVisible);
				if (distVisible) {
					parser.hideDocument(parser.docs[5]);
					distVisible = false;
				} else {
					parser.showDocument(parser.docs[5]);
					distVisible = true;
				}
			});



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
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				/*mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DEFAULT
				}*/
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
			var dcode = "<?php echo $dcode ?>";

			if (dcode == 01) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d01.kml', 'kml/Rising_Main_d01.kml', 'kml/Reservoir_d01.kml', 'kml/Source_d01.kml', 'kml/Treatment_Facility_d01.kml']);
			} else if (dcode == 02) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d02.kml', 'kml/Rising_Main_d02.kml', 'kml/Reservoir_d02.kml', 'kml/Source_d02.kml', 'kml/Treatment_Facility_d02.kml']);
			} else if (dcode == 03) {

				parser.parse(['kml/Villages_d03.kml', 'kml/Rising_Main_d03.kml', 'kml/Reservoir_d03.kml', 'kml/Source_d03.kml', 'kml/Treatment_Facility_d03.kml', 'kml/Distributries.kml']);

			} else if (dcode == 04) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d04.kml', 'kml/Rising_Main_d04.kml', 'kml/Reservoir_d04.kml', 'kml/Source_d04.kml', 'kml/Treatment_Facility_d04.kml', 'kml/Distributries.kml']);
			}
		});
	</script>

<?php
}
if ($_GET['map_id'] == 2) {
?>
	<script type="text/javascript">
		var mapInstance;
		var parser;
		var placemarkMetadata = [];
		var polygonsVisible = true;
		var risingVisible = true;
		var reservoirVisible = true;
		var sourceVisible = true;
		var treatmentVisible = true;
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
			parser.hideDocument(parser.docs[1]);
			parser.hideDocument(parser.docs[2]);
			parser.hideDocument(parser.docs[3]);
			parser.hideDocument(parser.docs[4]);
			//parser.hideDocument(parser.docs[5]);
			polygonsVisible = false;
			//placemarksVisible = false;
			risingVisible = false;
			reservoirVisible = false;
			sourceVisible = false;
			treatmentVisible = false;
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


			// for villages
			$("#polygontoggle").on("click", function(e) {

				if (polygonsVisible) {
					parser.hideDocument(parser.docs[0]);
					polygonsVisible = false;
				} else {
					parser.showDocument(parser.docs[0]);
					polygonsVisible = true;
				}

			});
			// for rising main

			$("#risingtoggle").on("click", function(e) {

				if (risingVisible) {
					parser.hideDocument(parser.docs[1]);
					risingVisible = false;
				} else {
					parser.showDocument(parser.docs[1]);
					risingVisible = true;
				}
			});

			// for reservoir
			$("#reservoirtoggle").on("click", function(e) {

				if (reservoirVisible) {
					parser.hideDocument(parser.docs[2]);
					reservoirVisible = false;
				} else {
					parser.showDocument(parser.docs[2]);
					reservoirVisible = true;
				}
			});
			// for Source
			$("#sourcetoggle").on("click", function(e) {

				if (sourceVisible) {
					parser.hideDocument(parser.docs[3]);
					sourceVisible = false;
				} else {
					parser.showDocument(parser.docs[3]);
					sourceVisible = true;
				}
			});
			// for treatment
			$("#treatmenttoggle").on("click", function(e) {

				if (treatmentVisible) {
					parser.hideDocument(parser.docs[4]);
					treatmentVisible = false;
				} else {
					parser.showDocument(parser.docs[4]);
					treatmentVisible = true;
				}
			});
			// for Distributries
			/*$("#disttoggle").on("click", function(e) {
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
				mapTypeId: google.maps.MapTypeId.HYBRID,
				/*mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DEFAULT
				}*/
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
			var dcode = "<?php echo $dcode ?>";

			if (dcode == 01) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d01.kml', 'kml/Rising_Main_d01.kml', 'kml/Reservoir_d01.kml', 'kml/Source_d01.kml', 'kml/Treatment_Facility_d01.kml']);
			} else if (dcode == 02) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d02.kml', 'kml/Rising_Main_d02.kml', 'kml/Reservoir_d02.kml', 'kml/Source_d02.kml', 'kml/Treatment_Facility_d02.kml']);
			} else if (dcode == 03) {

				parser.parse(['kml/Villages_d03.kml', 'kml/Rising_Main_d03.kml', 'kml/Reservoir_d03.kml', 'kml/Source_d03.kml', 'kml/Treatment_Facility_d03.kml']);

			} else if (dcode == 04) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d04.kml', 'kml/Rising_Main_d04.kml', 'kml/Reservoir_d04.kml', 'kml/Source_d04.kml', 'kml/Treatment_Facility_d04.kml']);
			}
		});
	</script>
<?php
}
if ($_GET['map_id'] == 3) {
?>
	<script type="text/javascript">
		var mapInstance;
		var parser;
		var placemarkMetadata = [];
		var polygonsVisible = true;
		var risingVisible = true;
		var reservoirVisible = true;
		var sourceVisible = true;
		var treatmentVisible = true;
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
			parser.hideDocument(parser.docs[1]);
			parser.hideDocument(parser.docs[2]);
			parser.hideDocument(parser.docs[3]);
			parser.hideDocument(parser.docs[4]);
			//parser.hideDocument(parser.docs[5]);
			polygonsVisible = false;
			//placemarksVisible = false;
			risingVisible = false;
			reservoirVisible = false;
			sourceVisible = false;
			treatmentVisible = false;
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


			// for villages
			$("#polygontoggle").on("click", function(e) {

				if (polygonsVisible) {
					parser.hideDocument(parser.docs[0]);
					polygonsVisible = false;
				} else {
					parser.showDocument(parser.docs[0]);
					polygonsVisible = true;
				}

			});
			// for rising main

			$("#risingtoggle").on("click", function(e) {

				if (risingVisible) {
					parser.hideDocument(parser.docs[1]);
					risingVisible = false;
				} else {
					parser.showDocument(parser.docs[1]);
					risingVisible = true;
				}
			});

			// for reservoir
			$("#reservoirtoggle").on("click", function(e) {

				if (reservoirVisible) {
					parser.hideDocument(parser.docs[2]);
					reservoirVisible = false;
				} else {
					parser.showDocument(parser.docs[2]);
					reservoirVisible = true;
				}
			});
			// for Source
			$("#sourcetoggle").on("click", function(e) {

				if (sourceVisible) {
					parser.hideDocument(parser.docs[3]);
					sourceVisible = false;
				} else {
					parser.showDocument(parser.docs[3]);
					sourceVisible = true;
				}
			});
			// for treatment
			$("#treatmenttoggle").on("click", function(e) {

				if (treatmentVisible) {
					parser.hideDocument(parser.docs[4]);
					treatmentVisible = false;
				} else {
					parser.showDocument(parser.docs[4]);
					treatmentVisible = true;
				}
			});
			// for Distributries
			/*$("#disttoggle").on("click", function(e) {
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
				/*mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DEFAULT
				}*/
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
			var dcode = "<?php echo $dcode ?>";

			if (dcode == 01) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d01.kml', 'kml/Rising_Main_d01.kml', 'kml/Reservoir_d01.kml', 'kml/Source_d01.kml', 'kml/Treatment_Facility_d01.kml']);
			} else if (dcode == 02) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d02.kml', 'kml/Rising_Main_d02.kml', 'kml/Reservoir_d02.kml', 'kml/Source_d02.kml', 'kml/Treatment_Facility_d02.kml']);
			} else if (dcode == 03) {

				parser.parse(['kml/Villages_d03.kml', 'kml/Rising_Main_d03.kml', 'kml/Reservoir_d03.kml', 'kml/Source_d03.kml', 'kml/Treatment_Facility_d03.kml']);

			} else if (dcode == 04) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d04.kml', 'kml/Rising_Main_d04.kml', 'kml/Reservoir_d04.kml', 'kml/Source_d04.kml', 'kml/Treatment_Facility_d04.kml']);
			}
		});
	</script>
<?php
}
if ($_GET['map_id'] == 4) {
?>
	<script type="text/javascript">
		var mapInstance;
		var parser;
		var placemarkMetadata = [];
		var polygonsVisible = true;
		var risingVisible = true;
		var reservoirVisible = true;
		var sourceVisible = true;
		var treatmentVisible = true;
		var distVisible = true;
		var pointVisible = true;



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
			parser.hideDocument(parser.docs[1]);
			parser.hideDocument(parser.docs[2]);
			parser.hideDocument(parser.docs[3]);
			parser.hideDocument(parser.docs[4]);
			parser.hideDocument(parser.docs[5]);
			parser.hideDocument(parser.docs[6]);
			polygonsVisible = false;
			//placemarksVisible = false;
			risingVisible = false;
			reservoirVisible = false;
			sourceVisible = false;
			treatmentVisible = false;
			distVisible = false;
			pointVisible = false;

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
			$("#polygontoggle").on("click", function(e) {

				if (polygonsVisible) {
					parser.hideDocument(parser.docs[0]);
					polygonsVisible = false;
				} else {
					parser.showDocument(parser.docs[0]);
					polygonsVisible = true;
				}

			});
			// for rising main

			$("#risingtoggle").on("click", function(e) {

				if (risingVisible) {
					parser.hideDocument(parser.docs[1]);
					risingVisible = false;
				} else {
					parser.showDocument(parser.docs[1]);
					risingVisible = true;
				}
			});

			// for reservoir
			$("#reservoirtoggle").on("click", function(e) {

				if (reservoirVisible) {
					parser.hideDocument(parser.docs[2]);
					reservoirVisible = false;
				} else {
					parser.showDocument(parser.docs[2]);
					reservoirVisible = true;
				}
			});
			// for Source
			$("#sourcetoggle").on("click", function(e) {

				if (sourceVisible) {
					parser.hideDocument(parser.docs[3]);
					sourceVisible = false;
				} else {
					parser.showDocument(parser.docs[3]);
					sourceVisible = true;
				}
			});
			// for treatment
			$("#treatmenttoggle").on("click", function(e) {

				if (treatmentVisible) {
					parser.hideDocument(parser.docs[4]);
					treatmentVisible = false;
				} else {
					parser.showDocument(parser.docs[4]);
					treatmentVisible = true;
				}
			});
			// for Distributries
			$("#disttoggle").on("click", function(e) {
				//alert(distVisible);
				if (distVisible) {
					parser.hideDocument(parser.docs[5]);
					distVisible = false;
				} else {
					parser.showDocument(parser.docs[5]);
					distVisible = true;
				}
			});

			// for Point
			$("#pointtoggle").on("click", function(e) {
				//alert(pointVisible);
				if (pointVisible) {
					parser.hideDocument(parser.docs[6]);
					pointVisible = false;
				} else {
					parser.showDocument(parser.docs[6]);
					pointVisible = true;
				}
			});




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
				mapTypeId: google.maps.MapTypeId.TERRAIN,
				/*mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DEFAULT
				}*/
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
			var dcode = "<?php echo $dcode ?>";

			if (dcode == 01) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d01.kml', 'kml/Rising_Main_d01.kml', 'kml/Reservoir_d01.kml', 'kml/Source_d01.kml', 'kml/Treatment_Facility_d01.kml', 'kml/distributries.kml', 'kml/point.kml']);
			} else if (dcode == 02) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d02.kml', 'kml/Rising_Main_d02.kml', 'kml/Reservoir_d02.kml', 'kml/Source_d02.kml', 'kml/Treatment_Facility_d02.kml', 'kml/distributries.kml', 'kml/point.kml']);
			} else if (dcode == 03) {

				parser.parse(['kml/Villages_d03.kml', 'kml/Rising_Main_d03.kml', 'kml/Reservoir_d03.kml', 'kml/Source_d03.kml', 'kml/Treatment_Facility_d03.kml', 'kml/distributries.kml', 'kml/point.kml']);

			} else if (dcode == 04) {
				//google.maps.event.addListener(parser, 'parsed', completeInit);
				parser.parse(['kml/Villages_d04.kml', 'kml/Rising_Main_d04.kml', 'kml/Reservoir_d04.kml', 'kml/Source_d04.kml', 'kml/Treatment_Facility_d04.kml', 'kml/distributries.kml', 'kml/point.kml']);
			}
		});
	</script>
<?php
}
?>

<?php
$result_dis = mysql_query("SELECT name FROM p2001district where code=" . $dcode);
$data_dis = mysql_fetch_array($result_dis);
?>

<section class="mb-4">
	<div class="container-fluid" style="padding-top: 0px !important;">
		<div class="card">
			<div class="card-body">
				<div class="d-flex">
					<p class="d-flex flex-row">
						<span class="text-bold text-lg"><?= $data_dis['name'];  ?></span>
					</p>
				</div>
				<div id="map"></div>
			</div>
		</div>

		<div class="card-deck">
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
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><i class="fas fa-scroll mr-1"></i>Status of Water Supply Schemes</h3>
				</div>


				<?php
				$result_fun = mysql_query("SELECT COUNT(*) as total_f FROM p2005wss where status=1 and dcode=" . $dcode);
				$data_fun = mysql_fetch_array($result_fun);
				$result_nfun = mysql_query("SELECT COUNT(*) as total_nf FROM p2005wss where status=2 and dcode=" . $dcode);
				$data_nfun = mysql_fetch_array($result_nfun);
				$result_aban = mysql_query("SELECT COUNT(*) as total_ab FROM p2005wss where status=3 and dcode=" . $dcode);
				$data_aban = mysql_fetch_array($result_aban);

				?>

				<div class="card-body">
					<table id="statusWater" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Functional</th>
								<th>Non-Functional</th>
								<th>Abandoned</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><a class="btn btn-info btn-xs" href="javascript:void(null);" onClick="doToggle1('fun_1');" title="functional"><?= $data_fun['total_f'] ?></a></td>
								<td><a class="btn btn-info btn-xs" href="javascript:void(null);" onClick="doToggle1('nfun_1');" title="nonfunctional"><?= $data_nfun['total_nf'] ?></a></td>
								<td><a class="btn btn-info btn-xs" href="javascript:void(null);" onClick="doToggle1('aban_1');" title="abandoned"><?= $data_aban['total_ab'] ?></a></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th>Functional</th>
								<th>Non-Functional</th>
								<th>Abandoned</th>
							</tr>
						</tfoot>
					</table>

					<?php
					$iCount = 0;
					/* $SQL = "Select sno, dcode,tcode,vcode, wssname, exeagency, exeagencyval, omagency, omagencyval, status, statusval, reason, reasonval from p2005wss where dcode=".$dcode." and status=1";*/
					$SQL = "SELECT b.sno as sno,b.wssname as wssname, b.exeagency as exeagency,b.dcode as dcode,b.tcode as tcode,b.vcode as vcode,b.exeagencyval as exeagencyval,b.omagency as omagency,b.omagencyval as omagencyval,b.status as status,b.statusval as statusval,b.reason as reason,b.reasonval as reasonval from p2003village a inner join p2005wss b on (a.giscode=b.giscode) where b.dcode=" . $dcode . " and status=1";
					$res_sql = mysql_query($SQL);
					$iCount = mysql_num_rows($res_sql);
					?>

					<table id="fun_1" class="table table-bordered table-striped" style="display:none;">

						<thead>
							<tr>
								<th>Name</th>
								<th>Executing Agency</th>
								<th>Operating Agency</th>
								<th>Status</th>
								<th>Remarks</th>
							</tr>
						</thead>
						<tbody>
							<?php while ($ress = mysql_fetch_array($res_sql)) {
							?>
								<tr>
									<td>
										<a href="qrdash-home.php?behavid=<?php echo $behavid ?>&componentid=<?php echo $ress['dcode'] ?>&subcomponentid=<?php echo $ress['tcode'] ?>&activityid=<?php echo $ress['vcode'] ?>" target="_blank"><?php echo $ress['wssname'] ?></a>
									</td>
									<td><?= $ress['exeagencyval'] ?></td>
									<td><?= $ress['omagencyval'] ?></td>
									<td><?= $ress['statusval'] ?></td>
									<td><?= $ress['reasonval'] ?></td>
								</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Name</th>
								<th>Executing Agency</th>
								<th>Operating Agency</th>
								<th>Status</th>
								<th>Remarks</th>
							</tr>
						</tfoot>
					</table>

					<?php
					$iCount = 0;
					$SQL = "SELECT b.sno as sno,b.wssname as wssname, b.exeagency as exeagency,b.dcode as dcode,b.tcode as tcode,b.vcode as vcode,b.exeagencyval as exeagencyval,b.omagency as omagency,b.omagencyval as omagencyval,b.status as status,b.statusval as statusval,b.reason as reason,b.reasonval as reasonval from p2003village a inner join p2005wss b on (a.giscode=b.giscode) where b.dcode=" . $dcode . " and status=2";
					$res_sql = mysql_query($SQL);
					$iCount = mysql_num_rows($res_sql);
					?>

					<table id="nfun_1" class="table table-bordered table-striped" style="display:none;">

						<thead>
							<tr>
								<th>Name</th>
								<th>Executing Agency</th>
								<th>Operating Agency</th>
								<th>Status</th>
								<th>Remarks</th>
							</tr>
						</thead>
						<tbody>
							<?php while ($ress = mysql_fetch_array($res_sql)) {
							?>
								<tr>
									<td>
										<a href="qrdash-home.php?behavid=<?php echo $behavid ?>&componentid=<?php echo $ress['dcode'] ?>&subcomponentid=<?php echo $ress['tcode'] ?>&activityid=<?php echo $ress['vcode'] ?>" target="_blank">
											<? echo $ress['wssname']?></a>
									</td>
									<td><?= $ress['exeagencyval'] ?></td>
									<td><?= $ress['omagencyval'] ?></td>
									<td><?= $ress['statusval'] ?></td>
									<td><?= $ress['reasonval'] ?></td>
								</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Name</th>
								<th>Executing Agency</th>
								<th>Operating Agency</th>
								<th>Status</th>
								<th>Remarks</th>
							</tr>
						</tfoot>
					</table>

					<?php
					$iCount = 0;
					$SQL = "SELECT b.sno as sno,b.wssname as wssname, b.exeagency as exeagency,b.dcode as dcode,b.tcode as tcode,b.vcode as vcode,b.exeagencyval as exeagencyval,b.omagency as omagency,b.omagencyval as omagencyval,b.status as status,b.statusval as statusval,b.reason as reason,b.reasonval as reasonval from p2003village a inner join p2005wss b on (a.giscode=b.giscode) where b.dcode=" . $dcode . " and status=3";
					$res_sql = mysql_query($SQL);
					$iCount = mysql_num_rows($res_sql);
					?>

					<table id="aban_1" class="table table-bordered table-striped" style="display:none;">

						<thead>
							<tr>
								<th>Name</th>
								<th>Executing Agency</th>
								<th>Operating Agency</th>
								<th>Status</th>
								<th>Remarks</th>
							</tr>
						</thead>
						<tbody>
							<?php while ($ress = mysql_fetch_array($res_sql)) {
							?>
								<tr>
									<td>
										<a href="qrdash-home.php?behavid=<?php echo $behavid ?>&componentid=<?php echo $ress['dcode'] ?>&subcomponentid=<?php echo $ress['tcode'] ?>&activityid=<?php echo $ress['vcode'] ?>" target="_blank">
											<? echo $ress['wssname']?></a>
									</td>
									<td><?= $ress['exeagencyval'] ?></td>
									<td><?= $ress['omagencyval'] ?></td>
									<td><?= $ress['statusval'] ?></td>
									<td><?= $ress['reasonval'] ?></td>
								</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Name</th>
								<th>Executing Agency</th>
								<th>Operating Agency</th>
								<th>Status</th>
								<th>Remarks</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>

	</div>
</section>


<?php
$result_dpr = "SELECT milestone,sum(total_villages) as total_villages, sum(completed) as completed, sum(percent_completed) as percent_completed FROM tbl_dpr where dcode=" . $dcode . " group by milestone";
$query_dpr = mysql_query($result_dpr);
while ($data_dpr = mysql_fetch_array($query_dpr)) {

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
					name: 'Composition',
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
					name: 'Composition',
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
						if (this.name == "Other gases") {
							return '<div><span>Total Villages:</span><span>' +
								<?php echo $data_dpr["total_villages"] ?> +
								'</span></div > ';
						}
						if (this.name == "Nitrogen") {
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
					name: 'Composition',
					colorByPoint: true,
					innerSize: '70%',
					data: [{
						name: 'Nitrogen',
						// color: '#01BAF2',
						y: <?php echo number_format($data_dpr["percent_completed"], 1); ?>,
					}, {
						//

						name: 'Other gases',
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

			<td width="130" align="center">District</td>
			<td width="130" align="center">Total Villages</td>
			<td width="130" align="center">Completed</td>
			<td width="130" align="center">% Completed</td>

		</tr>
		<?php
		$result_dpr = mysql_query("SELECT milestone, dcode FROM tbl_dpr where dcode=" . $dcode . " group by milestone");
		while ($data_dpr = mysql_fetch_array($result_dpr)) {
			$milestone = $data_dpr['milestone'];
			$dcod = $data_dpr['dcode'];
		?>
			<tr>

				<td colspan="4" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold; background-color: #E8D0D0; height:23px; text-align:center"><?php echo $milestone; ?></td>
			</tr>
			<?php
			$result_abc1 = "select * from tbl_dpr where milestone='$milestone' and dcode=$dcod";
			$result_abc1_1 = mysql_query($result_abc1);
			while ($data_abc2 = mysql_fetch_array($result_abc1_1)) {
				$tid = $data_abc2['tcode'];
				$result_abc = mysql_query("select tehsil from p2002tehsil where code=" . $tid);
				$data_abc = mysql_fetch_array($result_abc)
			?>
				<tr>


					<td width="130" height="30px" align="center"><a href="javascript:void(null);" onClick="doToggle1('nfun_1');" title="nonfunctional" style="text-decoration:none; color:black"><?= $data_abc['tehsil'] ?></a></td>
					<td width="130" height="30px" align="center"><a href="javascript:void(null);" onClick="doToggle1('aban_1');" title="abandoned" style="text-decoration:none; color:black"><?= $data_abc2['total_villages'] ?></a></td>
					<td width="130" height="30px" align="center"><a href="javascript:void(null);" onClick="doToggle1('aban_1');" title="abandoned" style="text-decoration:none; color:black"><?= $data_abc2['completed'] ?></a></td>
					<td width="130" height="30px" align="center"><a href="javascript:void(null);" onClick="doToggle1('aban_1');" title="abandoned" style="text-decoration:none; color:black"><?= $data_abc2['percent_completed'] ?></a></td>

				</tr>
		<?php
			}
		}
		?>


	</table>
</div>

</div>