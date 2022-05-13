<?php

if ($activityflag == 1) {

    if ($behavid == 0 || $behavid == 1) {
        $dcode = $componentid;
        $tcode = $subcomponentid;
        $vcode = $activityid;
        $behavid = $behavid;
        $result_dis = mysql_query("SELECT name FROM p2001district where code=" . $dcode);
        $data_dis = mysql_fetch_array($result_dis);
        $result_th = mysql_query("SELECT tehsil FROM p2002tehsil where code=" . $tcode);
        $data_th = mysql_fetch_array($result_th);
        $result_vi = "Select village FROM  p2003village where dcode = " . $dcode . " and tcode=" . $tcode . " and code=" . $vcode;
        $result_vi2 = mysql_query($result_vi);
        $data_vi = mysql_fetch_array($result_vi2);
?>
        <script type="text/javascript">
            //Sample code written by August Li
            var icon = new google.maps.MarkerImage("<?php echo $_CONFIG["site_url"] ?>" + "images/blue.png",
                new google.maps.Size(32, 32), new google.maps.Point(0, 0),
                new google.maps.Point(16, 32));
            var center = null;
            var map = null;
            var currentPopup;
            var bounds = new google.maps.LatLngBounds();

            function addMarker(lat, lng, info) {
                var pt = new google.maps.LatLng(lat, lng);
                bounds.extend(pt);
                var marker = new google.maps.Marker({
                    position: pt,
                    icon: icon,
                    map: map
                });
                var popup = new google.maps.InfoWindow({
                    content: info,
                    maxWidth: 300
                });
                popup.open(map, marker);
                /* google.maps.event.addListener(marker, "click", function() {
                 if (currentPopup != null) {
                 currentPopup.close();
                 currentPopup = null;
                 }
                 popup.open(map, marker);
                 currentPopup = popup;
                 });
                 google.maps.event.addListener(popup, "closeclick", function() {
                 map.panTo(center);
                 currentPopup = null;
                 });*/
            }

            function initMap() {

                map = new google.maps.Map(document.getElementById("map"), {
                    center: new google.maps.LatLng(0, 0),

                    mapTypeId: google.maps.MapTypeId.SATELLITE,
                    panControl: true,
                    zoomControl: true,
                    mapTypeControl: true,
                    scaleControl: true,
                    streetViewControl: true,
                    overviewMapControl: true,
                    rotateControl: true,

                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.HORIZONTEL_BAR
                    },
                    navigationControl: true,
                    navigationControlOptions: {
                        style: google.maps.NavigationControlStyle.SMALL
                    }
                });

                <?php
                $query = mysql_query("SELECT * FROM p2003village where dcode=$componentid and tcode=$subcomponentid and code=$activityid");
                while ($row = mysql_fetch_array($query)) {
                    $name = $row['village'];
                    $lat = $row['y'];
                    $lon = $row['x'];
                    //$desc="jgdfhgjd";
                    echo ("addMarker($lat, $lon,'<b>$name</b>');\n");
                } ?>
                //center = bounds.getCenter();
                //map.fitBounds(bounds);
                map.setCenter(bounds.getCenter());

                map.setZoom(18);
            }

            google.maps.event.addDomListener(window, 'load', initMap);
            //window.onload = initMap;
        </script>
        <?php
        if ($_GET['map_id'] == 1) {
        ?>
            <script type="text/javascript">
                //Sample code written by August Li
                var icon = new google.maps.MarkerImage("<?php echo $_CONFIG["site_url"] ?>" + "images/blue.png",
                    new google.maps.Size(32, 32), new google.maps.Point(0, 0),
                    new google.maps.Point(16, 32));
                var center = null;
                var map = null;
                var currentPopup;
                var bounds = new google.maps.LatLngBounds();

                function addMarker(lat, lng, info) {
                    var pt = new google.maps.LatLng(lat, lng);
                    bounds.extend(pt);
                    var marker = new google.maps.Marker({
                        position: pt,
                        icon: icon,
                        map: map
                    });
                    var popup = new google.maps.InfoWindow({
                        content: info,
                        maxWidth: 300
                    });
                    popup.open(map, marker);
                    /* google.maps.event.addListener(marker, "click", function() {
                     if (currentPopup != null) {
                     currentPopup.close();
                     currentPopup = null;
                     }
                     popup.open(map, marker);
                     currentPopup = popup;
                     });
                     google.maps.event.addListener(popup, "closeclick", function() {
                     map.panTo(center);
                     currentPopup = null;
                     });*/
                }

                function initMap() {

                    map = new google.maps.Map(document.getElementById("map"), {
                        center: new google.maps.LatLng(0, 0),

                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        panControl: true,
                        zoomControl: true,
                        mapTypeControl: false,
                        scaleControl: true,
                        streetViewControl: true,
                        overviewMapControl: true,
                        rotateControl: true,

                        mapTypeControlOptions: {

                            style: google.maps.MapTypeControlStyle.HORIZONTEL_BAR
                        },
                        navigationControl: true,
                        navigationControlOptions: {
                            style: google.maps.NavigationControlStyle.SMALL
                        }
                    });

                    <
                    ?
                    $query = mysql_query("SELECT * FROM p2003village where dcode=$componentid and tcode=$subcomponentid and code=$activityid");
                    while ($row = mysql_fetch_array($query)) {
                        $name = $row['village'];
                        $lat = $row['y'];
                        $lon = $row['x'];
                        //$desc="jgdfhgjd";
                        echo("addMarker($lat, $lon,'<b>$name</b>');\n");
                    } ?
                    >
                    //center = bounds.getCenter();
                    //map.fitBounds(bounds);
                    map.setCenter(bounds.getCenter());

                    map.setZoom(15);

                }

                google.maps.event.addDomListener(window, 'load', initMap);
                //window.onload = initMap;
            </script>
        <?php
        }
        ?>
        <?php
        if ($_GET['map_id'] == 2) {
        ?>
            <script type="text/javascript">
                //Sample code written by August Li
                var icon = new google.maps.MarkerImage("<?php echo $_CONFIG["site_url"] ?>" + "images/blue.png",
                    new google.maps.Size(32, 32), new google.maps.Point(0, 0),
                    new google.maps.Point(16, 32));
                var center = null;
                var map = null;
                var currentPopup;
                var bounds = new google.maps.LatLngBounds();

                function addMarker(lat, lng, info) {
                    var pt = new google.maps.LatLng(lat, lng);
                    bounds.extend(pt);
                    var marker = new google.maps.Marker({
                        position: pt,
                        icon: icon,
                        map: map
                    });
                    var popup = new google.maps.InfoWindow({
                        content: info,
                        maxWidth: 300
                    });
                    popup.open(map, marker);
                    /* google.maps.event.addListener(marker, "click", function() {
                     if (currentPopup != null) {
                     currentPopup.close();
                     currentPopup = null;
                     }
                     popup.open(map, marker);
                     currentPopup = popup;
                     });
                     google.maps.event.addListener(popup, "closeclick", function() {
                     map.panTo(center);
                     currentPopup = null;
                     });*/
                }

                function initMap() {

                    map = new google.maps.Map(document.getElementById("map"), {
                        center: new google.maps.LatLng(0, 0),

                        mapTypeId: google.maps.MapTypeId.HYBRID,
                        panControl: true,
                        zoomControl: true,
                        scaleControl: true,
                        streetViewControl: true,
                        overviewMapControl: true,
                        rotateControl: true,

                        mapTypeControlOptions: {

                            style: google.maps.MapTypeControlStyle.HORIZONTEL_BAR
                        },
                        navigationControl: true,
                        navigationControlOptions: {
                            style: google.maps.NavigationControlStyle.SMALL
                        }
                    });

                    <
                    ?
                    $query = mysql_query("SELECT * FROM p2003village where dcode=$componentid and tcode=$subcomponentid and code=$activityid");
                    while ($row = mysql_fetch_array($query)) {
                        $name = $row['village'];
                        $lat = $row['y'];
                        $lon = $row['x'];
                        //$desc="jgdfhgjd";
                        echo("addMarker($lat, $lon,'<b>$name</b>');\n");
                    } ?
                    >
                    //center = bounds.getCenter();
                    //map.fitBounds(bounds);
                    map.setCenter(bounds.getCenter());

                    map.setZoom(15);

                }

                google.maps.event.addDomListener(window, 'load', initMap);
                //window.onload = initMap;
            </script>
        <?php
        }
        ?>
        <?php
        if ($_GET['map_id'] == 3) {
        ?>
            <script type="text/javascript">
                //Sample code written by August Li
                var icon = new google.maps.MarkerImage("<?php echo $_CONFIG["site_url"] ?>" + "images/blue.png",
                    new google.maps.Size(32, 32), new google.maps.Point(0, 0),
                    new google.maps.Point(16, 32));
                var center = null;
                var map = null;
                var currentPopup;
                var bounds = new google.maps.LatLngBounds();

                function addMarker(lat, lng, info) {
                    var pt = new google.maps.LatLng(lat, lng);
                    bounds.extend(pt);
                    var marker = new google.maps.Marker({
                        position: pt,
                        icon: icon,
                        map: map
                    });
                    var popup = new google.maps.InfoWindow({
                        content: info,
                        maxWidth: 300
                    });
                    popup.open(map, marker);
                    /* google.maps.event.addListener(marker, "click", function() {
                     if (currentPopup != null) {
                     currentPopup.close();
                     currentPopup = null;
                     }
                     popup.open(map, marker);
                     currentPopup = popup;
                     });
                     google.maps.event.addListener(popup, "closeclick", function() {
                     map.panTo(center);
                     currentPopup = null;
                     });*/
                }

                function initMap() {

                    map = new google.maps.Map(document.getElementById("map"), {
                        center: new google.maps.LatLng(0, 0),

                        mapTypeId: google.maps.MapTypeId.SATELLITE,
                        panControl: true,
                        zoomControl: true,
                        mapTypeControl: false,
                        scaleControl: true,
                        streetViewControl: true,
                        overviewMapControl: true,
                        rotateControl: true,

                        mapTypeControlOptions: {

                            style: google.maps.MapTypeControlStyle.HORIZONTEL_BAR
                        },
                        navigationControl: true,
                        navigationControlOptions: {
                            style: google.maps.NavigationControlStyle.SMALL
                        }
                    });

                    <
                    ?
                    $query = mysql_query("SELECT * FROM p2003village where dcode=$componentid and tcode=$subcomponentid and code=$activityid");
                    while ($row = mysql_fetch_array($query)) {
                        $name = $row['village'];
                        $lat = $row['y'];
                        $lon = $row['x'];
                        //$desc="jgdfhgjd";
                        echo("addMarker($lat, $lon,'<b>$name</b>');\n");
                    } ?
                    >
                    //center = bounds.getCenter();
                    //map.fitBounds(bounds);
                    map.setCenter(bounds.getCenter());

                    map.setZoom(15);

                }

                google.maps.event.addDomListener(window, 'load', initMap);
                //window.onload = initMap;
            </script>
        <?php
        }
        ?>
        <?php
        if ($_GET['map_id'] == 4) {
        ?>
            <script type="text/javascript">
                //Sample code written by August Li
                var icon = new google.maps.MarkerImage("<?php echo $_CONFIG["site_url"] ?>" + "images/blue.png",
                    new google.maps.Size(32, 32), new google.maps.Point(0, 0),
                    new google.maps.Point(16, 32));
                var center = null;
                var map = null;
                var currentPopup;
                var bounds = new google.maps.LatLngBounds();

                function addMarker(lat, lng, info) {
                    var pt = new google.maps.LatLng(lat, lng);
                    bounds.extend(pt);
                    var marker = new google.maps.Marker({
                        position: pt,
                        icon: icon,
                        map: map
                    });
                    var popup = new google.maps.InfoWindow({
                        content: info,
                        maxWidth: 300
                    });
                    popup.open(map, marker);
                    /* google.maps.event.addListener(marker, "click", function() {
                     if (currentPopup != null) {
                     currentPopup.close();
                     currentPopup = null;
                     }
                     popup.open(map, marker);
                     currentPopup = popup;
                     });
                     google.maps.event.addListener(popup, "closeclick", function() {
                     map.panTo(center);
                     currentPopup = null;
                     });*/
                }

                function initMap() {

                    map = new google.maps.Map(document.getElementById("map"), {
                        center: new google.maps.LatLng(0, 0),

                        mapTypeId: google.maps.MapTypeId.TERRAIN,
                        panControl: true,
                        zoomControl: true,
                        mapTypeControl: false,
                        scaleControl: true,
                        streetViewControl: true,
                        overviewMapControl: true,
                        rotateControl: true,

                        mapTypeControlOptions: {

                            style: google.maps.MapTypeControlStyle.HORIZONTEL_BAR
                        },
                        navigationControl: true,
                        navigationControlOptions: {
                            style: google.maps.NavigationControlStyle.SMALL
                        }
                    });

                    <
                    ?
                    $query = mysql_query("SELECT * FROM p2003village where dcode=$componentid and tcode=$subcomponentid and code=$activityid");
                    while ($row = mysql_fetch_array($query)) {
                        $name = $row['village'];
                        $lat = $row['y'];
                        $lon = $row['x'];
                        //$desc="jgdfhgjd";
                        echo("addMarker($lat, $lon,'<b>$name</b>');\n");
                    } ?
                    >
                    //center = bounds.getCenter();
                    //map.fitBounds(bounds);
                    map.setCenter(bounds.getCenter());

                    map.setZoom(15);

                }

                google.maps.event.addDomListener(window, 'load', initMap);
                //window.onload = initMap;
            </script>
        <?php
        }

        $SQL5 = "Select * from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";
        $reportresult5 = mysql_query($SQL5);
        $iCount5 = mysql_num_rows($reportresult5);
        if ($iCount5 > 0) {
        ?>

            <section class="mb-4">
                <div class="container-fluid" style="padding-top: 0px !important;">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-row">
                                    <span class="text-bold text-lg"><?= $data_dis['name'];  ?> &raquo; <?= $data_th['tehsil']; ?> &raquo; <?= $data_vi['village']; ?></span>
                                </p>
                            </div>
                            <div id="map"></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="btn-group btn-group-sm" role="group" id="tabs_ns">
                                <a class="btn btn-secondary" href="#demo">Demographic</a>
                                <a class="btn btn-secondary" href="#hpop">Historic Population</a>
                                <a class="btn btn-secondary" href="#ppop">Projected Population</a>
                                <a class="btn btn-secondary" href="#edu">Education</a>
                                <a class="btn btn-secondary" href="#wforce">Work Force</a>
                                
                                <!-- <a class="btn btn-secondary" href="#sdw">Drinking Water</a>
                            <a class="btn btn-secondary" href="#ensureimprovws1">Improved WScheme</a>
                            <a class="btn btn-secondary" href="#srcnondrink1">Source Non DWater</a>
                            <a class="btn btn-secondary" href="#hhawareyes1">Awareness</a> -->
                            </div>
                        </div>
                    </div>

                    <div class="tabContent" id="demo">
                        <?php

                        $iCount = 0;
						
						$SQL = "Select sum(tot_m) as admales, sum(tot_f) as adfemales, sum(m_06) as chmales, sum(f_06) as chfemales from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";
						
						
                      /*  $SQL = "Select sum(epadmale) as admales, sum(epadfemale) as adfemales, sum(epchmale) as chmales, sum(epchfemale) as chfemales from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";*/
                        $reportresult = mysql_query($SQL);
                        $iCount = mysql_num_rows($reportresult);
                        if ($iCount > 0) {
                            while ($reportdata = mysql_fetch_array($reportresult)) {
                                $adultmales        = $reportdata['admales'];
                                $adultfemales    = $reportdata['adfemales'];
                                $childmales        = $reportdata['chmales'];
                                $childfemales    = $reportdata['chfemales'];

                                $adultmales1 = number_format(($adultmales / ($adultmales + $adultfemales) * 100), 2);
                                $adultfemales1 = number_format(($adultfemales / ($adultmales + $adultfemales) * 100), 2);

                                $childmales1 = number_format(($childmales / ($childmales + $childfemales) * 100), 2);
                                $childfemales1 = number_format(($childfemales / ($childmales + $childfemales) * 100), 2);
                            }
                        }
                        ?>
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Data on Bar Chart</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <figure class="highcharts-figure">
                                            <div id="Demographic"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-scroll mr-1"></i>Demographic Information</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Total</th>
                                                <th>% of Male</th>
                                                <th>% of Female</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Adult</td>
                                                <td><?= number_format($adultmales, 0); ?></td>
                                                <td><?= number_format($adultfemales, 0); ?></td>
                                                <td><?= number_format(($adultmales + $adultfemales), 0); ?></td>
                                                <td><?= ($adultmales + $adultfemales) > 0 ? number_format(($adultmales / ($adultmales + $adultfemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($adultmales + $adultfemales) > 0 ? number_format(($adultfemales / ($adultmales + $adultfemales) * 100), 2) : "0,00"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Children up to 6 years</td>
                                                <td><?= number_format($childmales, 0); ?></td>
                                                <td><?= number_format($childfemales, 0); ?></td>
                                                <td><?= number_format(($childmales + $childfemales), 0); ?></td>
                                                <td><?= ($childmales + $childfemales) > 0 ? number_format(($childmales / ($childmales + $childfemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($childmales + $childfemales) > 0 ? number_format(($childfemales / ($childmales + $childfemales) * 100), 2) : "0.00"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td><?= number_format(($adultmales + $childmales), 0); ?></td>
                                                <td><?= number_format(($adultfemales + $childfemales), 0); ?></td>
                                                <td><?= number_format(($adultmales + $adultfemales + $childmales + $childfemales), 0); ?></td>
                                                <td><?= ($adultmales + $adultfemales + $childmales + $childfemales) > 0 ? number_format((($adultmales + $childmales) / ($adultmales + $adultfemales + $childmales + $childfemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($adultmales + $adultfemales + $childmales + $childfemales) > 0 ? number_format((($adultfemales + $childfemales) / ($adultmales + $adultfemales + $childmales + $childfemales) * 100), 2) : "0.00"; ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Description</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Total</th>
                                                <th>% of Male</th>
                                                <th>% of Female</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function() {
                                    $('#Demographic').highcharts({
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            text: 'Demographic Mix'
                                        },
                                        xAxis: {
                                            categories: ['Male', 'Female']
                                        },
                                        yAxis: {
                                            min: 0,
                                            title: {
                                                text: 'Percentage (%)'
                                            }
                                        },
                                        credits: {
                                            enabled: false
                                        },
                                        tooltip: {
                                            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>',
                                        },
                                        series: [{
                                            name: 'Adult',
                                            data: [<?php echo $adultmales1; ?>, <?php echo $adultfemales1; ?>]
                                        }, {
                                            name: 'Children up to 6 years',
                                            data: [<?php echo $childmales1; ?>, <?php echo $childfemales1; ?>]
                                        }]
                                    });
                                });
                            </script>
                        </div>
                    </div>
                  <div class="tabContent" id="hpop">
                        <?php

                        $iCount_h = 0;
						
						$SQL_h = "Select sum(pop_1971) as pop_1971, sum(pop_1981) as pop_1981, sum(pop_1991) as pop_1991, sum(pop_2001) as pop_2001,sum(pop_2011) as pop_2011 from p2004vp_population where dcode=$dcode and tcode=$tcode and vcode=$vcode";
						
						
                      /*  $SQL = "Select sum(epadmale) as admales, sum(epadfemale) as adfemales, sum(epchmale) as chmales, sum(epchfemale) as chfemales from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";*/
                        $reportresult_h = mysql_query($SQL_h);
                        $iCount_h = mysql_num_rows($reportresult_h);
                        if ($iCount_h > 0) {
                            while ($reportdata_h = mysql_fetch_array($reportresult_h)) {
                                $pop_1971        = $reportdata_h['pop_1971'];
                                $pop_1981    = $reportdata_h['pop_1981'];
                                $pop_1991        = $reportdata_h['pop_1991'];
                                $pop_2001    = $reportdata_h['pop_2001'];
								
								
								$pop_2011        = $reportdata_h['pop_2011'];
                               

								
								
                            }
                        }
                        ?> 
                    
                    <div class="card-deck">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Data on Bar Chart</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <figure class="highcharts-figure">
                                            <div id="hpopulation"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-scroll mr-1"></i>Historic Population</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>1971</th>
                                                <th>1981</th>
                                                <th>1991</th>
                                                <th>2001</th>
                                                <th>2011</th>
                                                
                                                
                                                <!--<th>% of Male</th>
                                                <th>% of Female</th>-->
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Population</td>
                                                 <td><?= $pop_1971; ?></td>
                                                <td><?= $pop_1981; ?></td>
                                                <td><?= $pop_1991; ?></td>
                                                <td><?= $pop_2001; ?></td>
                                                <td><?= $pop_2011;?></td>                                           
                                                 
                                                
                                                                                             
                                            </tr>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Description</th>
                                                <th>1971</th>
                                                <th>1981</th>
                                                <th>1991</th>
                                                <th>2001</th>
                                                <th>2011</th>
                                                
                                                
                                                <!--<th>% of Male</th>
                                                <th>% of Female</th>-->
                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function() {
                                    $('#hpopulation').highcharts({
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            text: 'Historic Population'
                                        },
                                        xAxis: {
                                            categories: ['1971', '1981','1991', '2001','2011']
                                        },
                                        yAxis: {
                                            min: 0,
                                            title: {
                                                text: 'Population'
                                            }
                                        },
                                        credits: {
                                            enabled: false
                                        },
                                        tooltip: {
                                            pointFormat: '{series.name}: <b>{point.y}</b>',
                                        },
                                        series: [{
                                            name: 'Population',
                                            data: [<?php echo $pop_1971; ?>,<?php echo $pop_1981; ?>,<?php echo $pop_1991; ?>,<?php echo $pop_2001; ?>,<?php echo $pop_2011; ?>]
                                        }]
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    
                    <div class="tabContent" id="ppop">
                        <?php

                        $iCount_p = 0;
						
					$SQL_p = "Select sum(pop_2020) as pop_2020,sum(pop_2035) as pop_2035, sum(pop_2050) as pop_2050 from p2004vp_population where dcode=$dcode and tcode=$tcode and vcode=$vcode";
						
						
                      /*  $SQL = "Select sum(epadmale) as admales, sum(epadfemale) as adfemales, sum(epchmale) as chmales, sum(epchfemale) as chfemales from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";*/
                        $reportresult_p = mysql_query($SQL_p);
                        $iCount_p = mysql_num_rows($reportresult_p);
                        if ($iCount_p > 0) {
                            while ($reportdata_p = mysql_fetch_array($reportresult_p)) {
								$pop_2020       = $reportdata_p['pop_2020'];
                                $pop_2035        = $reportdata_p['pop_2035'];
                                $pop_2050    = $reportdata_p['pop_2050'];
                               

								
								
                            }
                        }
                        ?> 
                    
                    <div class="card-deck">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Data on Bar Chart</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <figure class="highcharts-figure">
                                            <div id="ppopulation"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-scroll mr-1"></i>Projected Population</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>2020</th>
                                                <th>2035</th>
                                                <th>2050</th>
                                                
                                                                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Population</td>
                                                <td><?= $pop_2020; ?></td>
                                                 <td><?= $pop_2035; ?></td>
                                                <td><?= $pop_2050; ?></td>
                                                                                         
                                                 
                                                
                                                                                             
                                            </tr>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Description</th>
                                                <th>2020</th>
                                                <th>2035</th>
                                                <th>2050</th>
                                                
                                                
                                                
                                                <!--<th>% of Male</th>
                                                <th>% of Female</th>-->
                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function() {
                                    $('#ppopulation').highcharts({
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            text: 'Projected Population'
                                        },
                                        xAxis: {
                                            categories: ['2020','2035', '2050']
                                        },
                                        yAxis: {
                                            min: 0,
                                            title: {
                                                text: 'Population'
                                            }
                                        },
                                        credits: {
                                            enabled: false
                                        },
                                        tooltip: {
                                            pointFormat: '{series.name}:<b>{point.y}</b>',
                                        },
                                        series: [{
                                            name: 'Population',
                                            data: [<?php echo $pop_2020; ?>,<?php echo $pop_2035; ?>,<?php echo $pop_2050; ?>]
                                        }]
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    <div class="tabContent" id="edu">
                        <?php

                        $iCount = 0;
						
						$SQL = "Select sum(m_lit) as litmales, sum(f_lit) as litfemales, sum(m_ill) as illmales, sum(f_ill) as illfemales from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";
						
						
                      /*  $SQL = "Select sum(epadmale) as admales, sum(epadfemale) as adfemales, sum(epchmale) as chmales, sum(epchfemale) as chfemales from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";*/
                        $reportresult = mysql_query($SQL);
                        $iCount = mysql_num_rows($reportresult);
                        if ($iCount > 0) {
                            while ($reportdata = mysql_fetch_array($reportresult)) {
                                $litmales        = $reportdata['litmales'];
                                $litfemales    = $reportdata['litfemales'];
                                $illmales        = $reportdata['illmales'];
                                $illfemales    = $reportdata['illfemales'];

                                $litmales1 = number_format(($litmales / ($litmales + $litfemales) * 100), 2);
                                $litfemales1 = number_format(($litfemales / ($litmales + $litfemales) * 100), 2);

                                $illmales1 = number_format(($illmales / ($illmales + $illfemales) * 100), 2);
                                $illfemales1 = number_format(($illfemales / ($illmales + $illfemales) * 100), 2);
                            }
                        }
                        ?>
                        
                                            <div class="card-deck">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Data on Bar Chart</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <figure class="highcharts-figure">
                                            <div id="Education"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-scroll mr-1"></i>Literacy Information</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Total</th>
                                                <th>% of Male</th>
                                                <th>% of Female</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Literacy</td>
                                                <td><?= number_format($litmales, 0); ?></td>
                                                <td><?= number_format($litfemales, 0); ?></td>
                                                <td><?= number_format(($litmales + $litfemales), 0); ?></td>
                                                <td><?= ($litmales + $litfemales) > 0 ? number_format(($litmales / ($litmales + $litfemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($litmales + $litfemales) > 0 ? number_format(($litfemales / ($litmales + $litfemales) * 100), 2) : "0,00"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Illiteracy</td>
                                                <td><?= number_format($illmales, 0); ?></td>
                                                <td><?= number_format($illfemales, 0); ?></td>
                                                <td><?= number_format(($illmales + $illfemales), 0); ?></td>
                                                <td><?= ($illdmales + $illfemales) > 0 ? number_format(($illmales / ($illmales + $illfemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($illmales + $illfemales) > 0 ? number_format(($illfemales / ($illmales + $illfemales) * 100), 2) : "0.00"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td><?= number_format(($litmales + $illmales), 0); ?></td>
                                                <td><?= number_format(($litfemales + $illfemales), 0); ?></td>
                                                <td><?= number_format(($litmales + $litfemales + $illmales + $illfemales), 0); ?></td>
                                                <td><?= ($litmales + $litfemales + $illmales + $illfemales) > 0 ? number_format((($litmales + $illmales) / ($litmales + $litfemales + $illmales + $illfemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($litmales + $litfemales + $illmales + $illfemales) > 0 ? number_format((($litfemales + $illfemales) / ($litmales + $litfemales + $illmales + $illfemales) * 100), 2) : "0.00"; ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Description</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Total</th>
                                                <th>% of Male</th>
                                                <th>% of Female</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function() {
                                    $('#Education').highcharts({
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            text: 'Literacy Information'
                                        },
                                        xAxis: {
                                            categories: ['Male', 'Female']
                                        },
                                        yAxis: {
                                            min: 0,
                                            title: {
                                                text: 'Percentage (%)'
                                            }
                                        },
                                        credits: {
                                            enabled: false
                                        },
                                        tooltip: {
                                            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>',
                                        },
                                        series: [{
                                            name: 'Literacy',
                                            data: [<?php echo $litmales1; ?>, <?php echo $litfemales1; ?>]
                                        }, {
                                            name: 'Illiteracy',
                                            data: [<?php echo $illmales1; ?>, <?php echo $illfemales1; ?>]
                                        }]
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    
                    <div class="tabContent" id="wforce">
                        <?php

                        $iCount = 0;
						
						$SQL = "Select sum(mainwork_m) as mainwork_m, sum(mainwork_f) as mainwork_f, sum(main_cl_m) as main_cl_m, sum(main_cl_f) as main_cl_f,sum(main_al_m) as main_al_m, sum(main_al_f) as main_al_f, sum(main_hh_m) as main_hh_m, sum(main_hh_f) as main_hh_f, sum(main_ot_m) as main_ot_m, sum(main_ot_f) as main_ot_f, sum(margwork_m) as margwork_m, sum(margwork_f) as margwork_f from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";
						
						
                      /*  $SQL = "Select sum(epadmale) as admales, sum(epadfemale) as adfemales, sum(epchmale) as chmales, sum(epchfemale) as chfemales from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";*/
                        $reportresult = mysql_query($SQL);
                        $iCount = mysql_num_rows($reportresult);
                        if ($iCount > 0) {
                            while ($reportdata = mysql_fetch_array($reportresult)) {
                                $mwmales        = $reportdata['mainwork_m'];
                                $mwfemales    = $reportdata['mainwork_f'];
                                $mcmales        = $reportdata['main_cl_m'];
                                $mcfemales    = $reportdata['main_cl_f'];
								
								
								$mamales        = $reportdata['main_al_m'];
                                $mafemales    = $reportdata['main_al_f'];
                                $mhmales        = $reportdata['main_hh_m'];
                                $mhfemales    = $reportdata['main_hh_f'];
								
								$momales        = $reportdata['main_ot_m'];
                                $mofemales    = $reportdata['main_ot_f'];
                                $mgmales        = $reportdata['margwork_m'];
                                $mgfemales    = $reportdata['margwork_f'];

                                $mwmales1 = number_format(($mwmales / ($mwmales + $mwfemales) * 100), 2);
                                $mwfemales1 = number_format(($mwfemales / ($mwmales + $mwfemales) * 100), 2);

                                $mcmales1 = number_format(($mcmales / ($mcmales + $mcfemales) * 100), 2);
                                $mcfemales1 = number_format(($mcfemales / ($mcmales + $mcfemales) * 100), 2);
								
								//al
								 $mamales1 = number_format(($mamales / ($mamales + $mafemales) * 100), 2);
                                $mafemales1 = number_format(($mafemales / ($mamales + $mafemales) * 100), 2);
								//hh
                                $mhmales1 = number_format(($mhmales / ($mhmales + $mhfemales) * 100), 2);
                                $mhfemales1 = number_format(($mhfemales / ($mhmales + $mhfemales) * 100), 2);
								//ot
								$momales1 = number_format(($momales / ($momales + $mofemales) * 100), 2);
                                $mofemales1 = number_format(($mofemales / ($momales + $mofemales) * 100), 2);
								
								//margwork
								$mgmales1 = number_format(($mgmales / ($mgmales + $mgfemales) * 100), 2);
                                $mgfemales1 = number_format(($mgfemales / ($mgmales + $mgfemales) * 100), 2);
								
								
                            }
                        }
                        ?>
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Data on Bar Chart</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <figure class="highcharts-figure">
                                            <div id="Workforce"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-scroll mr-1"></i>Workforce Information</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>MainWork</th>
                                                <th>MainCL</th>
                                                <th>MainAL</th>
                                                <th>MainHH</th>
                                                <th>MainOT</th>
                                                <th>MargWork</th>
                                                
                                                <!--<th>% of Male</th>
                                                <th>% of Female</th>-->
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>% of Male</td>
                                                 <td><?= ($mwmales + $mwfemales) > 0 ? number_format(($mwmales / ($mwmales + $mwfemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($mcmales + $mcfemales) > 0 ? number_format(($mcmales / ($mcmales + $mcfemales) * 100), 2) : "0,00"; ?></td>
                                                <td><?= ($mamales + $mafemales) > 0 ? number_format(($mamales / ($mamales + $mafemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($mhmales + $mhfemales) > 0 ? number_format(($mhmales / ($mhmales + $mhfemales) * 100), 2) : "0,00"; ?></td>
                                                <td><?= ($momales + $mofemales) > 0 ? number_format(($momales / ($momales + $mofemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($mgmales + $mgfemales) > 0 ? number_format(($mgmales / ($mgmales + $mgfemales) * 100), 2) : "0,00"; ?></td>
                                                 
                                                 
                                                
                                                                                             
                                            </tr>
                                            <tr>
                                                <td>% of Female</td>
                                               
                                                <td><?= ($mwmales + $mwfemales) > 0 ? number_format(($mwfemales / ($mwmales + $mwfemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($mcmales + $mcfemales) > 0 ? number_format(($mcfemales / ($mcmales + $mcfemales) * 100), 2) : "0,00"; ?></td>
                                                <td><?= ($mamales + $mafemales) > 0 ? number_format(($mafemales / ($mamales + $mafemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($mhmales + $mhfemales) > 0 ? number_format(($mhfemales / ($mhmales + $mhfemales) * 100), 2) : "0,00"; ?></td>
                                                <td><?= ($momales + $mofemales) > 0 ? number_format(($mofemales / ($momales + $mofemales) * 100), 2) : "0.00"; ?></td>
                                                <td><?= ($mgmales + $mgfemales) > 0 ? number_format(($mgfemales / ($mgmales + $mgfemales) * 100), 2) : "0,00"; ?></td>
                                               
                                                
                                            </tr>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Description</th>
                                                <th>MainWork</th>
                                                <th>MainCL</th>
                                               <th>MainAL</th>
                                                <th>MainHH</th>
                                                <th>MainOT</th>
                                                <th>MargWork</th>
                                              
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function() {
                                    $('#Workforce').highcharts({
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            text: 'Work Force'
                                        },
                                        xAxis: {
                                            categories: ['MainWork', 'MainCL','MainAL', 'MainHH','MainOT', 'MargWork']
                                        },
                                        yAxis: {
                                            min: 0,
                                            title: {
                                                text: 'Percentage (%)'
                                            }
                                        },
                                        credits: {
                                            enabled: false
                                        },
                                        tooltip: {
                                            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>',
                                        },
                                        series: [{
                                            name: 'Male',
                                            data: [<?php echo $mwmales1; ?>, <?php echo $mcmales1; ?>,<?php echo $mamales1; ?>, <?php echo $mhmales1; ?>,<?php echo $momales1; ?>, <?php echo $mgmales1; ?>]
                                        }, {
                                            name: 'Female',
                                            data: [<?php echo $mwfemales1; ?>, <?php echo $mcfemales1; ?>,<?php echo $mafemales1; ?>, <?php echo $mhfemales1; ?>,<?php echo $mofemales1; ?>, <?php echo $mgfemales1; ?>]
                                        }]
                                    });
                                });
                            </script>
                        </div>
                    </div>
               
                    
                </div>
            </section>


        <?php
        } else {
        ?>
            <p style="font-weight:bold; margin-top:40px;margin-left:80px;"><?php echo "Social Data not Found" ?></p>
<?php
        }
    }
    if ($behavid == 3) {
        include("techical_level_village.php");
    }
} ?>