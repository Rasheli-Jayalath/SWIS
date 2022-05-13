<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.css" rel="stylesheet" media="screen">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.js"></script>

<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<!--<style type="text/css">
.ui-tabs .ui-tabs-hide {
     position: absolute;
     top: -10000px;
     display: block !important;
}           
 </style>-->
</head>

<body>

<script type="text/javascript">
var series1 = [1,2,3,2,3,4];

var options =
{
chart: {
type: "line"
},
series: [
{data:series1}
]
}

$(function() {$('#graph').highcharts(options)})

</script>
<script type="text/javascript">
var series2 = [4,5,6,7,8];

var options =
{
chart: {
type: "line"
},
series: [
{data:series2}
]
}

$(function() {$('#graph2').highcharts(options)})

</script>

<div class="container-fluid">
<div class="row">
<ul class="nav nav-pills nav-stacked col-md-2">
<li><a href="#a" data-toggle="pill">aa</a></li>
<li><a href="#b" data-toggle="pill">bb</a></li>
</ul>


<div class="tab-content col-md-10">
<div class="tab-pane" id="a">
<div class="row">
<p>a</p>
<div id="graph" style="height: 400px; min-width: 310px"></div>
</div>
</div>

<div class="tab-pane" id="b">
<div class="row">
<p>b</p>
<div id="graph2" style="height: 400px; min-width: 310px"></div>
</div>
</div>
</div>
</div>
</div>

</body>
</html>