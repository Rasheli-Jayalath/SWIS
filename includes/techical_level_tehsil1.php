<?php
 $dcode=$componentid;
 $tcode=$subcomponentid;
  $wsssno=$vcode;
 $behavid=$behavid;
 
if($tcode==01)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==02)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==03)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==04)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==05)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==06)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==07)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==08)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==09)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==10)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==11)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
	else if($tcode==12)
	{
	 $query1 = "SELECT b.village as village,b.x as x, b.y as y,b.dcode as dcode,b.tcode as tcode,b.code as code from p2005wss a inner join p2003village b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode. " limit 1";
$res = mysql_query($query1);
	}
$rowws=mysql_num_rows($res);
$obj1 = mysql_fetch_array($res);

    $lat = $obj1['y'];  
    $lng = $obj1['x']; 
	
	/*else if($tcode==01)
	{
	 $lat = "29.858245312";  
    $lng = "73.2314715483"; 
	}
	else if($tcode==02)
	{
	 $lat = "29.63911281";  
    $lng = "72.91705415"; 
	}
	else if($tcode==03)
	{
	 $lat = "29.16317164";  
    $lng = "72.96106972"; 
	}*/
 /*if ($tcode==05)
 {*/
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="./js_map/ProjectedOverlay.js"></script>
<script type="text/javascript" src="./js_map/geoxml3.js"></script>
<!--<script type="text/javascript" src="./js_map/map.js"></script>-->
<script type="text/javascript">
var mapInstance;
var parser;
var placemarkMetadata = [];    
var placemarksVisible = true;
var polygonsVisible   = true;
var risingVisible   = true;
var wsschemeVisible=true;
var distriVisible=true;


//
// Modified from php.js strcmp at http://phpjs.org/functions/strcmp
// Requires b1 and b2 have name fields
//
function placemarkcmp (b1, b2) {
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

	// Hide non-placemark layer(s)
	parser.hideDocument(parser.docs[0]);
	parser.hideDocument(parser.docs[1]);
	parser.hideDocument(parser.docs[2]);
	parser.hideDocument(parser.docs[3]);
	parser.hideDocument(parser.docs[4]);
	polygonsVisible = false;
	placemarksVisible = false;
	risingVisible=false;
	reservoirVisible = false;
	sourceVisible = false;

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
			$(this).css({ 'cursor' : 'pointer', 'color' : '#FFFFFF', 'background-color' : textcolor });
		}).on("mouseleave", function(e) {
			var backgroundcolor = $(this).css("background-color");
			$(this).css({ 'cursor' : 'auto', 'color' : backgroundcolor, 'background-color' : 'transparent' });
		});

	// Highlight visible and invisible sidebar items
	// As user scrolls, the sidebar willreflect visible and invisible placemarks
	google.maps.event.addListener(mapInstance, 'bounds_changed', function() {
		currentBounds = mapInstance.getBounds();
		for (i = 0; i < parser.docs[0].placemarks.length; i++) {
		
			var myLi = $("#p" + i);
			
			if (currentBounds.contains(parser.docs[0].placemarks[i].marker.getPosition())) {
				myLi.css("color","#000000");
			} else {
				myLi.css("color","#CCCCCC");
			}
		}
	});
	//// for tehsil boundaries
	
	$("#placemarktoggle").on("click", function(e) {
	
		if (placemarksVisible) {
			parser.hideDocument(parser.docs[0]);
			placemarksVisible = false;
		} else {
			parser.showDocument(parser.docs[0]);
			placemarksVisible = true;
		}		
	});
	
	
	// for villages
	$("#polygontoggle").on("click", function(e) {
	
		if (polygonsVisible) {
			parser.hideDocument(parser.docs[1]);
			polygonsVisible = false;
		} else {
			parser.showDocument(parser.docs[1]);
			polygonsVisible = true;
		}
		
	});
	// for rising main
	
	$("#risingtoggle").on("click", function(e) {
		
		if (risingVisible) {
			parser.hideDocument(parser.docs[2]);
			risingVisible = false;
		} else {
			parser.showDocument(parser.docs[2]);
			risingVisible = true;
		}		
	});
	
	// for reservoir
	$("#reservoirtoggle").on("click", function(e) {
		
		if (reservoirVisible) {
			parser.hideDocument(parser.docs[3]);
			reservoirVisible = false;
		} else {
			parser.showDocument(parser.docs[3]);
			reservoirVisible = true;
		}		
	});
	// for Source
	$("#sourcetoggle").on("click", function(e) {
		
		if (sourceVisible) {
			parser.hideDocument(parser.docs[4]);
			sourceVisible = false;
		} else {
			parser.showDocument(parser.docs[4]);
			sourceVisible = true;
		}		
	});
		
	
	
	/*$("#recenter").on("click", function(e) {
		var latlng = new google.maps.LatLng(30.19436440247, 73.57216027448);
 	 	mapInstance.setCenter(latlng);		
	});*/
	
	$("#controls").show();
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
		}
	);

	// Add an event listen for the parsed event on the parser
	// Thisrequires a Geoxml3 with the patch defined in Issue 40
	// http://code.google.com/p/geoxml3/issues/detail?id=40
	// We need this event to know when Geoxml3 has compltely defined the coument arrays
	google.maps.event.addListener(parser, 'parsed', completeInit);
	var tcode="<?php echo $tcode?>";
	
	if(tcode==01)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_01.kml','kml/Villages_01.kml','kml/Rising_Main_01.kml','kml/Reservoir_01.kml','kml/Source_01.kml']);
}
else if(tcode==02)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_02.kml','kml/Villages_02.kml','kml/Rising_Main_02.kml','kml/Reservoir_02.kml','kml/Source_02.kml']);
}
else if(tcode==03)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_03.kml','kml/Villages_03.kml','kml/Rising_Main_03.kml','kml/Reservoir_03.kml','kml/Source_03.kml']);
}
else if(tcode==04)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_04.kml','kml/Villages_04.kml','kml/Rising_Main_04.kml','kml/Reservoir_04.kml','kml/Source_04.kml']);
}
else if(tcode==05)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);

	parser.parse(['kml/Tehsil_Minchinabad.kml','kml/Villages.kml','kml/Rising_Main.kml','kml/Reservoir.kml','kml/Source.kml']);
	
}
else if(tcode==06)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_02.kml','kml/Villages_02.kml','kml/Rising_Main_02.kml','kml/Reservoir_02.kml','kml/Source_02.kml']);
}
else if(tcode==07)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_03.kml','kml/Villages_03.kml','kml/Rising_Main_03.kml','kml/Reservoir_03.kml','kml/Source_03.kml']);
}
else if(tcode==08)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_04.kml','kml/Villages_04.kml','kml/Rising_Main_04.kml','kml/Reservoir_04.kml','kml/Source_04.kml']);
}
else if(tcode==09)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);

	parser.parse(['kml/Tehsil_Minchinabad.kml','kml/Villages.kml','kml/Rising_Main.kml','kml/Reservoir.kml','kml/Source.kml']);
	
}
else if(tcode==10)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_02.kml','kml/Villages_02.kml','kml/Rising_Main_02.kml','kml/Reservoir_02.kml','kml/Source_02.kml']);
}
else if(tcode==11)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_03.kml','kml/Villages_03.kml','kml/Rising_Main_03.kml','kml/Reservoir_03.kml','kml/Source_03.kml']);
}
else if(tcode==12)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Villages_12.kml','kml/Rising_Main_12.kml','kml/Reservoir_12.kml','kml/Source_12.kml']);
}
else if(tcode==13)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);

	parser.parse(['kml/Tehsil_Minchinabad.kml','kml/Villages.kml','kml/Rising_Main.kml','kml/Reservoir.kml','kml/Source.kml']);
	
}
});

</script>

<?php
if ($_GET['map_id']==1)
{
?>
<script type="text/javascript">
var mapInstance;
var parser;
var placemarkMetadata = [];    
var placemarksVisible = true;
var polygonsVisible   = true;
var risingVisible   = true;
var wsschemeVisible=true;
var distriVisible=true;


//
// Modified from php.js strcmp at http://phpjs.org/functions/strcmp
// Requires b1 and b2 have name fields
//
function placemarkcmp (b1, b2) {
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

	// Hide non-placemark layer(s)
	parser.hideDocument(parser.docs[0]);
	parser.hideDocument(parser.docs[1]);
	parser.hideDocument(parser.docs[2]);
	parser.hideDocument(parser.docs[3]);
	parser.hideDocument(parser.docs[4]);
	polygonsVisible = false;
	placemarksVisible = false;
	risingVisible=false;
	reservoirVisible = false;
	sourceVisible = false;

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
			$(this).css({ 'cursor' : 'pointer', 'color' : '#FFFFFF', 'background-color' : textcolor });
		}).on("mouseleave", function(e) {
			var backgroundcolor = $(this).css("background-color");
			$(this).css({ 'cursor' : 'auto', 'color' : backgroundcolor, 'background-color' : 'transparent' });
		});

	// Highlight visible and invisible sidebar items
	// As user scrolls, the sidebar willreflect visible and invisible placemarks
	google.maps.event.addListener(mapInstance, 'bounds_changed', function() {
		currentBounds = mapInstance.getBounds();
		for (i = 0; i < parser.docs[0].placemarks.length; i++) {
		
			var myLi = $("#p" + i);
			
			if (currentBounds.contains(parser.docs[0].placemarks[i].marker.getPosition())) {
				myLi.css("color","#000000");
			} else {
				myLi.css("color","#CCCCCC");
			}
		}
	});
	//// for tehsil boundaries
	
	$("#placemarktoggle").on("click", function(e) {
	
		if (placemarksVisible) {
			parser.hideDocument(parser.docs[0]);
			placemarksVisible = false;
		} else {
			parser.showDocument(parser.docs[0]);
			placemarksVisible = true;
		}		
	});
	
	
	// for villages
	$("#polygontoggle").on("click", function(e) {
	
		if (polygonsVisible) {
			parser.hideDocument(parser.docs[1]);
			polygonsVisible = false;
		} else {
			parser.showDocument(parser.docs[1]);
			polygonsVisible = true;
		}
		
	});
	// for rising main
	
	$("#risingtoggle").on("click", function(e) {
		
		if (risingVisible) {
			parser.hideDocument(parser.docs[2]);
			risingVisible = false;
		} else {
			parser.showDocument(parser.docs[2]);
			risingVisible = true;
		}		
	});
	
	// for reservoir
	$("#reservoirtoggle").on("click", function(e) {
		
		if (reservoirVisible) {
			parser.hideDocument(parser.docs[3]);
			reservoirVisible = false;
		} else {
			parser.showDocument(parser.docs[3]);
			reservoirVisible = true;
		}		
	});
	// for Source
	$("#sourcetoggle").on("click", function(e) {
		
		if (sourceVisible) {
			parser.hideDocument(parser.docs[4]);
			sourceVisible = false;
		} else {
			parser.showDocument(parser.docs[4]);
			sourceVisible = true;
		}		
	});
		
	
	
	/*$("#recenter").on("click", function(e) {
		var latlng = new google.maps.LatLng(30.19436440247, 73.57216027448);
 	 	mapInstance.setCenter(latlng);		
	});*/
	
	$("#controls").show();
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
		}
	);

	// Add an event listen for the parsed event on the parser
	// Thisrequires a Geoxml3 with the patch defined in Issue 40
	// http://code.google.com/p/geoxml3/issues/detail?id=40
	// We need this event to know when Geoxml3 has compltely defined the coument arrays
	google.maps.event.addListener(parser, 'parsed', completeInit);
	var tcode="<?php echo $tcode?>";
	
	if(tcode==01)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_01.kml','kml/Villages_01.kml','kml/Rising_Main_01.kml','kml/Reservoir_01.kml','kml/Source_01.kml']);
}
else if(tcode==02)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_02.kml','kml/Villages_02.kml','kml/Rising_Main_02.kml','kml/Reservoir_02.kml','kml/Source_02.kml']);
}
else if(tcode==03)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_03.kml','kml/Villages_03.kml','kml/Rising_Main_03.kml','kml/Reservoir_03.kml','kml/Source_03.kml']);
}
else if(tcode==04)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_04.kml','kml/Villages_04.kml','kml/Rising_Main_04.kml','kml/Reservoir_04.kml','kml/Source_04.kml']);
}
else if(tcode==05)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);

	parser.parse(['kml/Tehsil_Minchinabad.kml','kml/Villages.kml','kml/Rising_Main.kml','kml/Reservoir.kml','kml/Source.kml']);
	
}
});

</script>

<?php
}
if ($_GET['map_id']==2)
{
?>
<script type="text/javascript">
var mapInstance;
var parser;
var placemarkMetadata = [];    
var placemarksVisible = true;
var polygonsVisible   = true;
var risingVisible   = true;
var wsschemeVisible=true;
var distriVisible=true;


//
// Modified from php.js strcmp at http://phpjs.org/functions/strcmp
// Requires b1 and b2 have name fields
//
function placemarkcmp (b1, b2) {
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

	// Hide non-placemark layer(s)
	parser.hideDocument(parser.docs[0]);
	parser.hideDocument(parser.docs[1]);
	parser.hideDocument(parser.docs[2]);
	parser.hideDocument(parser.docs[3]);
	parser.hideDocument(parser.docs[4]);
	polygonsVisible = false;
	placemarksVisible = false;
	risingVisible=false;
	reservoirVisible = false;
	sourceVisible = false;

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
			$(this).css({ 'cursor' : 'pointer', 'color' : '#FFFFFF', 'background-color' : textcolor });
		}).on("mouseleave", function(e) {
			var backgroundcolor = $(this).css("background-color");
			$(this).css({ 'cursor' : 'auto', 'color' : backgroundcolor, 'background-color' : 'transparent' });
		});

	// Highlight visible and invisible sidebar items
	// As user scrolls, the sidebar willreflect visible and invisible placemarks
	google.maps.event.addListener(mapInstance, 'bounds_changed', function() {
		currentBounds = mapInstance.getBounds();
		for (i = 0; i < parser.docs[0].placemarks.length; i++) {
		
			var myLi = $("#p" + i);
			
			if (currentBounds.contains(parser.docs[0].placemarks[i].marker.getPosition())) {
				myLi.css("color","#000000");
			} else {
				myLi.css("color","#CCCCCC");
			}
		}
	});
	//// for tehsil boundaries
	
	$("#placemarktoggle").on("click", function(e) {
	
		if (placemarksVisible) {
			parser.hideDocument(parser.docs[0]);
			placemarksVisible = false;
		} else {
			parser.showDocument(parser.docs[0]);
			placemarksVisible = true;
		}		
	});
	
	
	// for villages
	$("#polygontoggle").on("click", function(e) {
	
		if (polygonsVisible) {
			parser.hideDocument(parser.docs[1]);
			polygonsVisible = false;
		} else {
			parser.showDocument(parser.docs[1]);
			polygonsVisible = true;
		}
		
	});
	// for rising main
	
	$("#risingtoggle").on("click", function(e) {
		
		if (risingVisible) {
			parser.hideDocument(parser.docs[2]);
			risingVisible = false;
		} else {
			parser.showDocument(parser.docs[2]);
			risingVisible = true;
		}		
	});
	
	// for reservoir
	$("#reservoirtoggle").on("click", function(e) {
		
		if (reservoirVisible) {
			parser.hideDocument(parser.docs[3]);
			reservoirVisible = false;
		} else {
			parser.showDocument(parser.docs[3]);
			reservoirVisible = true;
		}		
	});
	// for Source
	$("#sourcetoggle").on("click", function(e) {
		
		if (sourceVisible) {
			parser.hideDocument(parser.docs[4]);
			sourceVisible = false;
		} else {
			parser.showDocument(parser.docs[4]);
			sourceVisible = true;
		}		
	});
		
	
	
	/*$("#recenter").on("click", function(e) {
		var latlng = new google.maps.LatLng(30.19436440247, 73.57216027448);
 	 	mapInstance.setCenter(latlng);		
	});*/
	
	$("#controls").show();
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
		}
	);

	// Add an event listen for the parsed event on the parser
	// Thisrequires a Geoxml3 with the patch defined in Issue 40
	// http://code.google.com/p/geoxml3/issues/detail?id=40
	// We need this event to know when Geoxml3 has compltely defined the coument arrays
	google.maps.event.addListener(parser, 'parsed', completeInit);
	var tcode="<?php echo $tcode?>";
	
	if(tcode==01)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_01.kml','kml/Villages_01.kml','kml/Rising_Main_01.kml','kml/Reservoir_01.kml','kml/Source_01.kml']);
}
else if(tcode==02)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_02.kml','kml/Villages_02.kml','kml/Rising_Main_02.kml','kml/Reservoir_02.kml','kml/Source_02.kml']);
}
else if(tcode==03)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_03.kml','kml/Villages_03.kml','kml/Rising_Main_03.kml','kml/Reservoir_03.kml','kml/Source_03.kml']);
}
else if(tcode==04)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_04.kml','kml/Villages_04.kml','kml/Rising_Main_04.kml','kml/Reservoir_04.kml','kml/Source_04.kml']);
}
else if(tcode==05)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);

	parser.parse(['kml/Tehsil_Minchinabad.kml','kml/Villages.kml','kml/Rising_Main.kml','kml/Reservoir.kml','kml/Source.kml']);
	
}
});

</script>

<?php
}
if ($_GET['map_id']==3)
{
?>
<script type="text/javascript">
var mapInstance;
var parser;
var placemarkMetadata = [];    
var placemarksVisible = true;
var polygonsVisible   = true;
var risingVisible   = true;
var wsschemeVisible=true;
var distriVisible=true;


//
// Modified from php.js strcmp at http://phpjs.org/functions/strcmp
// Requires b1 and b2 have name fields
//
function placemarkcmp (b1, b2) {
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

	// Hide non-placemark layer(s)
	parser.hideDocument(parser.docs[0]);
	parser.hideDocument(parser.docs[1]);
	parser.hideDocument(parser.docs[2]);
	parser.hideDocument(parser.docs[3]);
	parser.hideDocument(parser.docs[4]);
	polygonsVisible = false;
	placemarksVisible = false;
	risingVisible=false;
	reservoirVisible = false;
	sourceVisible = false;

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
			$(this).css({ 'cursor' : 'pointer', 'color' : '#FFFFFF', 'background-color' : textcolor });
		}).on("mouseleave", function(e) {
			var backgroundcolor = $(this).css("background-color");
			$(this).css({ 'cursor' : 'auto', 'color' : backgroundcolor, 'background-color' : 'transparent' });
		});

	// Highlight visible and invisible sidebar items
	// As user scrolls, the sidebar willreflect visible and invisible placemarks
	google.maps.event.addListener(mapInstance, 'bounds_changed', function() {
		currentBounds = mapInstance.getBounds();
		for (i = 0; i < parser.docs[0].placemarks.length; i++) {
		
			var myLi = $("#p" + i);
			
			if (currentBounds.contains(parser.docs[0].placemarks[i].marker.getPosition())) {
				myLi.css("color","#000000");
			} else {
				myLi.css("color","#CCCCCC");
			}
		}
	});
	//// for tehsil boundaries
	
	$("#placemarktoggle").on("click", function(e) {
	
		if (placemarksVisible) {
			parser.hideDocument(parser.docs[0]);
			placemarksVisible = false;
		} else {
			parser.showDocument(parser.docs[0]);
			placemarksVisible = true;
		}		
	});
	
	
	// for villages
	$("#polygontoggle").on("click", function(e) {
	
		if (polygonsVisible) {
			parser.hideDocument(parser.docs[1]);
			polygonsVisible = false;
		} else {
			parser.showDocument(parser.docs[1]);
			polygonsVisible = true;
		}
		
	});
	// for rising main
	
	$("#risingtoggle").on("click", function(e) {
		
		if (risingVisible) {
			parser.hideDocument(parser.docs[2]);
			risingVisible = false;
		} else {
			parser.showDocument(parser.docs[2]);
			risingVisible = true;
		}		
	});
	
	// for reservoir
	$("#reservoirtoggle").on("click", function(e) {
		
		if (reservoirVisible) {
			parser.hideDocument(parser.docs[3]);
			reservoirVisible = false;
		} else {
			parser.showDocument(parser.docs[3]);
			reservoirVisible = true;
		}		
	});
	// for Source
	$("#sourcetoggle").on("click", function(e) {
		
		if (sourceVisible) {
			parser.hideDocument(parser.docs[4]);
			sourceVisible = false;
		} else {
			parser.showDocument(parser.docs[4]);
			sourceVisible = true;
		}		
	});
		
	
	
	/*$("#recenter").on("click", function(e) {
		var latlng = new google.maps.LatLng(30.19436440247, 73.57216027448);
 	 	mapInstance.setCenter(latlng);		
	});*/
	
	$("#controls").show();
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
		}
	);

	// Add an event listen for the parsed event on the parser
	// Thisrequires a Geoxml3 with the patch defined in Issue 40
	// http://code.google.com/p/geoxml3/issues/detail?id=40
	// We need this event to know when Geoxml3 has compltely defined the coument arrays
	google.maps.event.addListener(parser, 'parsed', completeInit);
	var tcode="<?php echo $tcode?>";
	
	if(tcode==01)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_01.kml','kml/Villages_01.kml','kml/Rising_Main_01.kml','kml/Reservoir_01.kml','kml/Source_01.kml']);
}
else if(tcode==02)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_02.kml','kml/Villages_02.kml','kml/Rising_Main_02.kml','kml/Reservoir_02.kml','kml/Source_02.kml']);
}
else if(tcode==03)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_03.kml','kml/Villages_03.kml','kml/Rising_Main_03.kml','kml/Reservoir_03.kml','kml/Source_03.kml']);
}
else if(tcode==04)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_04.kml','kml/Villages_04.kml','kml/Rising_Main_04.kml','kml/Reservoir_04.kml','kml/Source_04.kml']);
}
else if(tcode==05)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);

	parser.parse(['kml/Tehsil_Minchinabad.kml','kml/Villages.kml','kml/Rising_Main.kml','kml/Reservoir.kml','kml/Source.kml']);
	
}
});

</script>

<?php
}
if ($_GET['map_id']==4)
{
?>
<script type="text/javascript">
var mapInstance;
var parser;
var placemarkMetadata = [];    
var placemarksVisible = true;
var polygonsVisible   = true;
var risingVisible   = true;
var wsschemeVisible=true;
var distriVisible=true;


//
// Modified from php.js strcmp at http://phpjs.org/functions/strcmp
// Requires b1 and b2 have name fields
//
function placemarkcmp (b1, b2) {
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

	// Hide non-placemark layer(s)
	parser.hideDocument(parser.docs[0]);
	parser.hideDocument(parser.docs[1]);
	parser.hideDocument(parser.docs[2]);
	parser.hideDocument(parser.docs[3]);
	parser.hideDocument(parser.docs[4]);
	polygonsVisible = false;
	placemarksVisible = false;
	risingVisible=false;
	reservoirVisible = false;
	sourceVisible = false;

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
			$(this).css({ 'cursor' : 'pointer', 'color' : '#FFFFFF', 'background-color' : textcolor });
		}).on("mouseleave", function(e) {
			var backgroundcolor = $(this).css("background-color");
			$(this).css({ 'cursor' : 'auto', 'color' : backgroundcolor, 'background-color' : 'transparent' });
		});

	// Highlight visible and invisible sidebar items
	// As user scrolls, the sidebar willreflect visible and invisible placemarks
	google.maps.event.addListener(mapInstance, 'bounds_changed', function() {
		currentBounds = mapInstance.getBounds();
		for (i = 0; i < parser.docs[0].placemarks.length; i++) {
		
			var myLi = $("#p" + i);
			
			if (currentBounds.contains(parser.docs[0].placemarks[i].marker.getPosition())) {
				myLi.css("color","#000000");
			} else {
				myLi.css("color","#CCCCCC");
			}
		}
	});
	//// for tehsil boundaries
	
	$("#placemarktoggle").on("click", function(e) {
	
		if (placemarksVisible) {
			parser.hideDocument(parser.docs[0]);
			placemarksVisible = false;
		} else {
			parser.showDocument(parser.docs[0]);
			placemarksVisible = true;
		}		
	});
	
	
	// for villages
	$("#polygontoggle").on("click", function(e) {
	
		if (polygonsVisible) {
			parser.hideDocument(parser.docs[1]);
			polygonsVisible = false;
		} else {
			parser.showDocument(parser.docs[1]);
			polygonsVisible = true;
		}
		
	});
	// for rising main
	
	$("#risingtoggle").on("click", function(e) {
		
		if (risingVisible) {
			parser.hideDocument(parser.docs[2]);
			risingVisible = false;
		} else {
			parser.showDocument(parser.docs[2]);
			risingVisible = true;
		}		
	});
	
	// for reservoir
	$("#reservoirtoggle").on("click", function(e) {
		
		if (reservoirVisible) {
			parser.hideDocument(parser.docs[3]);
			reservoirVisible = false;
		} else {
			parser.showDocument(parser.docs[3]);
			reservoirVisible = true;
		}		
	});
	// for Source
	$("#sourcetoggle").on("click", function(e) {
		
		if (sourceVisible) {
			parser.hideDocument(parser.docs[4]);
			sourceVisible = false;
		} else {
			parser.showDocument(parser.docs[4]);
			sourceVisible = true;
		}		
	});
		
	
	
	/*$("#recenter").on("click", function(e) {
		var latlng = new google.maps.LatLng(30.19436440247, 73.57216027448);
 	 	mapInstance.setCenter(latlng);		
	});*/
	
	$("#controls").show();
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
		}
	);

	// Add an event listen for the parsed event on the parser
	// Thisrequires a Geoxml3 with the patch defined in Issue 40
	// http://code.google.com/p/geoxml3/issues/detail?id=40
	// We need this event to know when Geoxml3 has compltely defined the coument arrays
	google.maps.event.addListener(parser, 'parsed', completeInit);
	var tcode="<?php echo $tcode?>";
	
	if(tcode==01)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_01.kml','kml/Villages_01.kml','kml/Rising_Main_01.kml','kml/Reservoir_01.kml','kml/Source_01.kml']);
}
else if(tcode==02)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_02.kml','kml/Villages_02.kml','kml/Rising_Main_02.kml','kml/Reservoir_02.kml','kml/Source_02.kml']);
}
else if(tcode==03)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_03.kml','kml/Villages_03.kml','kml/Rising_Main_03.kml','kml/Reservoir_03.kml','kml/Source_03.kml']);
}
else if(tcode==04)
{
//google.maps.event.addListener(parser, 'parsed', completeInit);
parser.parse(['kml/Tehsil_04.kml','kml/Villages_04.kml','kml/Rising_Main_04.kml','kml/Reservoir_04.kml','kml/Source_04.kml']);
}
else if(tcode==05)
{

//google.maps.event.addListener(parser, 'parsed', completeInit);

	parser.parse(['kml/Tehsil_Minchinabad.kml','kml/Villages.kml','kml/Rising_Main.kml','kml/Reservoir.kml','kml/Source.kml']);
	
}
});

</script>
<?php
}
?>
<ul id="gmaps">
 <li ><a href="qrdash-home.php?map_id=1&behavid=<?php echo $behavid?>&componentid=<?php echo $componentid?>&subcomponentid=<?php echo $subcomponentid?>">Roadmap</a></li>
<li ><a href="qrdash-home.php?map_id=2&behavid=<?php echo $behavid?>&componentid=<?php echo $componentid?>&subcomponentid=<?php echo $subcomponentid?>">Hybrid</a></li><li>
<li><a href="qrdash-home.php?map_id=3&behavid=<?php echo $behavid?>&componentid=<?php echo $componentid?>&subcomponentid=<?php echo $subcomponentid?>"> Satellite</a></li>
<li><a href="qrdash-home.php?map_id=4&behavid=<?php echo $behavid?>&componentid=<?php echo $componentid?>&subcomponentid=<?php echo $subcomponentid?>"> Terrian</a></li>
</ul>
<div id="maincol">
			<div id="map"></div>
			<div id="controls">
				<form>
					<fieldset>
						<legend></legend>
						<br />
						<!--<input type="checkbox" id="placemarktoggle" checked="checked" /><label for="placemarktoggle">Tehsil</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
						<input type="checkbox" id="polygontoggle"  checked="checked" /><label for="polygontoggle">Villages</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
						<input type="checkbox" id="risingtoggle" checked="checked" /><label for="risingtoggle">Rising Main</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="reservoirtoggle" checked="checked" /><label for="reservoirtoggle">Reserviors</label>						   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
							<input type="checkbox" id="sourcetoggle" checked="checked" /><label for="sourcetoggle">Source</label>						   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
					</fieldset>
				</form>
			</div>
		</div>

<?php
//}
 $iCount = 0;
   /* $SQL = "Select sno, dcode,tcode,vcode, wssname, exeagency, exeagencyval, omagency, omagencyval, status, statusval, reason, reasonval from p2005wss where dcode=".$dcode." and tcode=".$tcode;*/
 
    $SQL = "SELECT b.sno as sno,b.wssname as wssname, b.exeagency as exeagency,b.dcode as dcode,b.tcode as tcode,b.vcode as vcode,b.exeagencyval as exeagencyval,b.omagency as omagency,b.omagencyval as omagencyval,b.status as status,b.statusval as statusval,b.reason as reason,b.reasonval as reasonval from p2003village a inner join p2005wss b on (a.giscode=b.giscode) where b.dcode=".$dcode." and b.tcode=".$tcode;
   $res_sql= mysql_query($SQL);
   $iCount = mysql_num_rows($res_sql);
    ?>
    <table cellspacing="0" cellpadding="0" border="1px"  align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; margin-top:20px;">
     
      <tr style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#0CF">
        <td colspan="5" width="810" align="center" height="30px">Water Supply Schemes</td>
      </tr>
      <tr style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; background-color:#85bc40; height:23px">
        <td width="250" align="center">Name</td>
        <td width="130" align="center">Executing Agency</td>
        <td width="130" align="center">Operating Agency</td>
        <td width="130" align="center">Status</td>
        <td width="170" align="center">Remarks</td>
      </tr>
<?php while($ress=mysql_fetch_array($res_sql))
{
?>
      <tr>
        <td width="250" align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold;height:23px; background-color:#85bc40;"><a href="qrdash-home.php?behavid=<?php echo $behavid ?>&componentid=<?php echo $ress['dcode'] ?>&subcomponentid=<?php echo $ress['tcode'] ?>&activityid=<?php echo $ress['vcode'] ?>" target="_blank" style="color:black; font-weight:normal"><? echo $ress['wssname']?></a></td>
        <td width="130" align="center"><?=$ress['exeagencyval']?></td>
        <td width="130" align="center"><?=$ress['omagencyval'] ?></td>
        <td width="130" align="center"><?=$ress['statusval'] ?></td>
        <td width="130" align="center"><?= $ress['reasonval']?></td>
      </tr>
<?php } ?>
    </table>
