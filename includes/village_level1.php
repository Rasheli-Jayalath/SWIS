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
                                <a class="btn btn-secondary" href="#edu">Education</a>
                                <a class="btn btn-secondary" href="#faci">Facilities</a>
                                <a class="btn btn-secondary" href="#des">Disease</a>
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
                        $SQL = "Select sum(epadmale) as admales, sum(epadfemale) as adfemales, sum(epchmale) as chmales, sum(epchfemale) as chfemales from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";
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
                                                <td>Children up to 10 years</td>
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
                                            name: 'Children up to 10 years',
                                            data: [<?php echo $childmales1; ?>, <?php echo $childfemales1; ?>]
                                        }]
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <div class="tabContent" id="edu">
                        <?php

                        $iCount = 0;
                        /*$SQL = "Select avg(qread) as quran, avg(prlevel) as primarylevel, avg(matlevel) as matric, avg(intlevel) as intermediate, avg(gralevel) as graduate, avg(malevel) as masterslevel, avg(dipcer) as diploma, avg(skilled) as skilled, avg(other) as other, count(giscode) as fcount from p2004vp where dcode=$dcode and tcode=$tcode";*/
                        $SQL = "Select AVG(CAST(qread AS UNSIGNED)) as quran, AVG(CAST(prlevel AS UNSIGNED)) as primarylevel, AVG(CAST(matlevel AS UNSIGNED)) as matric, AVG(CAST(intlevel AS UNSIGNED)) as intermediate, AVG(CAST(gralevel AS UNSIGNED)) as graduate, AVG(CAST(malevel AS UNSIGNED)) as masterslevel, AVG(CAST(dipcer AS UNSIGNED)) as diploma, AVG(CAST(skilled AS UNSIGNED)) as skilled,count(giscode) as fcount from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";
                        $reportresult = mysql_query($SQL);
                        $iCount = mysql_num_rows($reportresult);
                        if ($iCount > 0) {
                            while ($reportdata = mysql_fetch_array($reportresult)) {
                                $quran        = $reportdata['quran'];
                                $primary    = $reportdata['primarylevel'];
                                $matric        = $reportdata['matric'];
                                $intermediate    = $reportdata['intermediate'];
                                $graduate        = $reportdata['graduate'];
                                $masters    = $reportdata['masterslevel'];
                                $diploma        = $reportdata['diploma'];
                                $skilled    = $reportdata['skilled'];
                                $other    = $reportdata['other'];
                                $total    = 100;
                                $quran1 = number_format($quran, 0);
                                $primary1 = number_format($primary, 0);
                                $matric1 = number_format($matric, 0);
                                $intermediate1 = number_format($intermediate, 0);
                                $graduate1 = number_format($graduate, 0);
                                $masters1 = number_format($masters, 0);
                                $diploma1 = number_format($diploma, 0);
                                $skilled1 = number_format($skilled, 0);
                                // $total			= $quran + $primary + $matric + $intermediate + $graduate + $masters + $diploma + $skilled + $other + 0;
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
                                            <div id="educationlevel"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-scroll mr-1"></i>Education Level</h3>
                                </div>
                                <div class="card-body">
                                    <table id="edutab" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Level</th>
                                                <th>%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Quran Read</td>
                                                <td><?= number_format($quran, 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Primary</td>
                                                <td><?= number_format($primary, 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Matric</td>
                                                <td><?= number_format(($matric), 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Inter</td>
                                                <td><?= number_format($intermediate, 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Graduation</td>
                                                <td><?= number_format($graduate, 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td>MA/MSc.</td>
                                                <td><?= number_format(($masters), 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Diploma/Ceritificate</td>
                                                <td><?= number_format(($diploma), 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Skilled</td>
                                                <td><?= number_format(($skilled), 0); ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Level</th>
                                                <th>%</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(function() {
                                $('#educationlevel').highcharts({
                                    chart: {
                                        type: 'column',
                                        margin: [50, 50, 100, 80]
                                    },
                                    title: {
                                        text: 'Education Level'
                                    },
                                    xAxis: {
                                        categories: [
                                            'Quran Read',
                                            'Primary Level',
                                            'Matric Level',
                                            'Intermediate Level',
                                            'Graduation Level',
                                            'Masters Level',
                                            'Diploma/Certificate',
                                            'Skilled',
                                        ],
                                        labels: {
                                            rotation: -45,
                                            align: 'right',
                                            style: {
                                                fontSize: '13px',
                                                fontFamily: 'Verdana, sans-serif'
                                            }
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Percentage (%)'
                                        }
                                    },
                                    legend: {
                                        enabled: false
                                    },
                                    tooltip: {
                                        pointFormat: '<b>{point.y:.1f} %</b>',
                                    },
                                    series: [{
                                        name: 'Education Level',
                                        data: [<?php echo $quran1; ?>, <?php echo $primary1; ?>, <?php echo $matric1; ?>, <?php echo $intermediate1; ?>, <?php echo $graduate1; ?>, <?php echo $masters1; ?>, <?php echo $diploma1; ?>, <?php echo $skilled1; ?>],
                                        dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            x: 4,
                                            y: 10,
                                            style: {
                                                fontSize: '13px',
                                                textShadow: '0 0 3px black'
                                            }
                                        }
                                    }]
                                });
                            });
                        </script>
                    </div>
                    <div class="tabContent" id="faci">
                        <?php
                        /* Available Facilities - Players
                    $electricity
                    $gas
                    $wss
                    $tele
                    $sewe
                    $bhu
                    */

                        $iCount = 0;
                        $SQL = "Select sum(electricity) as electricity, sum(gas) as gas, sum(wss) as wss, sum(tele) as tele, sum(sewe) as sewe, sum(bhu) as bhu, count(giscode) as fcount from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";
                        $reportresult = mysql_query($SQL);
                        $iCount = mysql_num_rows($reportresult);
                        if ($iCount > 0) {
                            while ($reportdata = mysql_fetch_array($reportresult)) {

                                $electricity        = $reportdata['electricity'];
                                // $gas	= $reportdata['gas'];
                                $wss        = $reportdata['wss'];
                                $tele    = $reportdata['tele'];
                                $sewe    = $reportdata['sewe'];
                                $bhu        = $reportdata['bhu'];
                                $fcount    = $reportdata['fcount'];
                                //$fcount			= $electricity + $gas + $wss + $tele + $sewe + $bhu;
                                $electricity1 = number_format($electricity / $fcount * 100, 2);
                                $wss1 = number_format($wss / $fcount * 100, 2);
                                $tele1 = number_format($tele / $fcount * 100, 2);
                                $sewe1 = number_format($sewe / $fcount * 100, 2);
                                $bhu1 = number_format($bhu / $fcount * 100, 2);
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
                                            <div id="utilities"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-scroll mr-1"></i>Available Utilities (T. Nos. of Sample)</h3>
                                </div>
                                <div class="card-body">
                                    <table id="fasibb" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Utility</th>
                                                <th>Avalibility No.</th>
                                                <th>%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Electricity</td>
                                                <td><?= number_format($electricity, 0); ?></td>
                                                <td><?= $fcount > 0 ? number_format($electricity / $fcount * 100, 2) : "0.00"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Water supply</td>
                                                <td><?= number_format($wss, 0); ?></td>
                                                <td><?= $fcount > 0 ? number_format($wss / $fcount * 100, 2) : "0.00"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Telephone</td>
                                                <td><?= number_format($tele, 0); ?></td>
                                                <td><?= $fcount > 0 ? number_format($tele / $fcount * 100, 2) : "0.00"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>BHU</td>
                                                <td><?= number_format($bhu, 0); ?></td>
                                                <td><?= $fcount > 0 ? number_format($bhu / $fcount * 100, 2) : "0.00"; ?></td>
                                            </tr>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Utility</th>
                                                <th>Avalibility No.</th>
                                                <th>%</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(function() {
                                $('#utilities').highcharts({
                                    chart: {
                                        type: 'column',
                                        margin: [50, 50, 100, 80]
                                    },
                                    title: {
                                        text: 'Facilities'
                                    },
                                    xAxis: {
                                        categories: [
                                            'Electricity',
                                            'Water Supply',
                                            'Telephone',
                                            'Sanitation',
                                            'BHU',
                                        ],
                                        labels: {
                                            rotation: -45,
                                            align: 'right',
                                            style: {
                                                fontSize: '13px',
                                                fontFamily: 'Verdana, sans-serif'
                                            }
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Percentage (%)'
                                        }
                                    },
                                    legend: {
                                        enabled: false
                                    },
                                    tooltip: {
                                        pointFormat: '<b>{point.y:.1f} %</b>',
                                    },
                                    series: [{
                                        name: 'utilities',
                                        data: [<?php echo $electricity1; ?>, <?php echo $wss1; ?>, <?php echo $tele1; ?>, <?php echo $sewe1; ?>, <?php echo $bhu1; ?>],
                                        dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            x: 4,
                                            y: 10,
                                            style: {
                                                fontSize: '13px',
                                                fontFamily: 'Verdana, sans-serif',
                                                textShadow: '0 0 3px black'
                                            }
                                        }
                                    }]
                                });
                            });
                        </script>
                    </div>
                    <div class="tabContent" id="des">
                        <?php

                        $tabletitle = "Have any body in the village suffered from any disease from last six months due to poor quality of drinking water";

                        $iCount = 0;
                        $SQL = "Select sum(dissufyes) as dissufyes, count(dissufno) as dissufno, count(giscode) as fcount from p2004vp where dcode=$dcode and tcode=$tcode and vcode=$vcode";
                        $reportresult = mysql_query($SQL);
                        $iCount = mysql_num_rows($reportresult);
                        if ($iCount > 0) {
                            while ($reportdata = mysql_fetch_array($reportresult)) {
                                $dissufyes        = $reportdata['dissufyes'];
                                $dissufno    = $reportdata['dissufno'];
                                $fcount    = $dissufyes + $dissufno;
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
                                            <div id="dissuf"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-scroll mr-1"></i><?php echo $tabletitle; ?></h3>
                                </div>
                                <div class="card-body">
                                    <table id="desbb" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Option</th>
                                                <th>No.</th>
                                                <th>%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Yes</td>
                                                <td><?= $dissufyes; ?></td>
                                                <td><?= ($fcount > 0) ? number_format($dissufyes / $fcount * 100, 2)  : "0.00"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>No</td>
                                                <td><?= $dissufno; ?></td>
                                                <td><?= ($fcount > 0) ? number_format($dissufno / $fcount * 100, 2) : "0.00"; ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Option</th>
                                                <th>No.</th>
                                                <th>%</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(function() {
                                $('#dissuf').highcharts({
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false
                                    },
                                    credits: {
                                        enabled: false
                                    },
                                    title: {
                                        text: 'Water Diseases'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> <br/> <b></b> {point.y:1f}'
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                color: '#000000',
                                                connectorColor: '#000000',
                                                format: '<b>{point.name}</b>:  {point.percentage:.1f} % [{point.y:1f}] '
                                            }
                                        }
                                    },
                                    series: [{
                                        type: 'pie',
                                        name: 'Diseases:',
                                        data: [
                                            ['Yes', <?php echo $dissufyes; ?>],
                                            ['No', <?php echo $dissufno; ?>],
                                        ]
                                    }]
                                });
                            });
                        </script>
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