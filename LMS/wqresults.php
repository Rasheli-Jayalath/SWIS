
<style>

  th {
  border-top: 1px solid #dddddd;
  border-bottom: 1px solid #dddddd;
  border-right: 1px solid #dddddd;
}
 
th:first-child {
  border-left: 1px solid #dddddd;
}

 .redClass{
    background: :red;
 }   
/* Popup box BEGIN */
.table-responsive
{
  overflow-y:scroll!important;
  overflow-x:hidden!important; 
}
.box-body{
    min-height:500px!important;
}
.hover_bkgr_fricc{
    background:rgba(0,0,0,.4);
    cursor:pointer;
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
}
.hover_bkgr_fricc .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc > div {
    background-color: #fff;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 551px;
    min-height: 100px;
    vertical-align: middle;
    width: 60%;
    position: relative;
    border-radius: 8px;
    padding: 15px 5%;
}
.hover_bkgr_fricc1{
    background:rgba(0,0,0,.4);
    cursor:pointer;
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
}
.hover_bkgr_fricc1 .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc1 > div {
    background-color: #fff;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 551px;
    min-height: 100px;
    vertical-align: middle;
    width: 60%;
    position: relative;
    border-radius: 8px;
    padding: 15px 5%;
}
.popupCloseButton {
    background-color: #fff;
    border: 3px solid #999;
    border-radius: 50px;
    cursor: pointer;
    display: inline-block;
    font-family: arial;
    font-weight: bold;
    position: absolute;
    top: 3px;
    right: 3px;
    font-size: 25px;
    line-height: 30px;
    width: 30px;
    height: 30px;
    text-align: center;
}
.popupCloseButton:hover {
    background-color: #ccc;
}
.trigger_popup_fricc {
    cursor: pointer;
    font-size: 20px;
   /* margin: 20px;*/
    display: inline-block;
    font-weight: bold;
}
/* Popup box BEGIN */
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 9px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 0px 0px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}


  
  /* provide some minimal visual accomodation for IE8 and below */
  .TFtable tr{
    background: #b8d1f3;
  }
  /*  Define the background color for all the ODD background rows  */
  .TFtable tr:nth-child(odd){ 
    background: #f9f9f9;;
  }
  /*  Define the background color for all the EVEN background rows  */
  .TFtable tr:nth-child(even){
    background: #fff;
  }
  /*
  thead, th {
    border: 1px solid #ddd;
  }
  */
  .filterButton{
    top: -6px;
  }
</style>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="S80t8AENGAd2a5DUxNnIqs7EkkkPwZUSwx6RUTUM">

  <title>SWIS | Dashboard | Routine Water Quality Results</title>

  <!-- Tell the browser to be responsive to screen width -->
  <link rel='shortcut icon' type='image/x-icon' href="https://wqdash.wbphed.gov.in/phed/img/phed.ico" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link href="https://wqdash.wbphed.gov.in/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
  <!-- Font Awesome -->
  <link href="https://wqdash.wbphed.gov.in/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
  <!-- Ionicons -->
  <link href="https://wqdash.wbphed.gov.in/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" >
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 
  <!-- Theme style -->
  
  <link href="https://wqdash.wbphed.gov.in/css/AdminLTE.min.css" rel="stylesheet" type="text/css" >
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link href="https://wqdash.wbphed.gov.in/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" >
  <!-- Morris chart -->
 
  <link href="https://wqdash.wbphed.gov.in/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css" >
  <!-- jvectormap -->
  <link href="https://wqdash.wbphed.gov.in/bower_components/jvectormap/jquery-jvectormap.css" rel="stylesheet" type="text/css" >
  <!-- Date Picker -->
  <link href="https://wqdash.wbphed.gov.in/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" >
  <!-- Daterange picker -->
  <link href="https://wqdash.wbphed.gov.in/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" >
  <!-- bootstrap wysihtml5 - text editor -->
  
  <link href="https://wqdash.wbphed.gov.in/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" >
  <link href="https://wqdash.wbphed.gov.in/phed/css/custom.css" rel="stylesheet" type="text/css" >

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
.imgDesign 
{
  width: 2em;
    height: 2em;
    background-color: white;
    box-shadow: 2px 2px 50px rgba(0, 0, 0, 0.2);
    transition: transform 0.5s;
    -webkit-transition: transform 0.5s;
    -moz-transition: transform 0.5s;
    -o-transition: transform 0.5s;
}

 table.dataTable.display tbody tr.odd {
    background-color: #e6f2fd;
}
table.dataTable.display tbody tr.odd>.sorting_1, table.dataTable.order-column.stripe tbody tr.odd>.sorting_1 {
    background-color: #e6f2fd;
}
.trigger_popup_fricc
{ border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
 }

 .trigger_popup_fricc:hover {
  transform: scaleX(-1);
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  
}

  #ui-datepicker-div{
    z-index: 9999999!important;
  }
  .control-sidebar.control-sidebar-open, .control-sidebar.control-sidebar-open+.control-sidebar-bg {
    right: 0;
    width:auto;
}
.control-sidebar-subheading {
   
    font-size: 12px!important;
}
.form-group1 {
    margin-bottom: 10px!important;
}
.form-control1 {
    height: 22px!important;
    padding: 2px 8px!important;
    font-size: 13px!important;
} 

.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  height: 350px!important;
}

 


/*.ui-datepicker
{
  position: relative !important;
  top: -10% !important;
}*/
</style>   

</head>
<body style="background-color:#000">
<div class="wrapper">

   <header class="main-header" style="color:white; font-size:24px" >

    <!-- Logo -->
     <a href="/" class="logo" style="padding:0 0 0 0 !important; color:white; font-size: 13px; font-weight: bold;" >
          Water Quality Management System
      <span class="logo-mini"></span>
      
   <!--  <span class="logo-lg" style="color:">
        <img src="images/smec.png" class="user-image" alt="User Image" width="229" height="49" style="float:left;">
      </span>-->
    </a>
   
 
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
    <!--  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>-->

      <div class="navbar-custom-menu">
        
        <ul class="navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
                     <li class="dropdown user user-menu" style="padding-top: 3px">
           <!-- <form name="form1" method="post" action="https://sso.wbphed.gov.in/sso-auth">
              <input type="hidden" name="ApplicationId" value="f6a977f1-907d-48f8-ad49-33946dcf73e4">
              <input type="hidden" name="ApplicationSecret" value="VEaVvSTrIFG/gPHYsXFQ2zkR3s65eyhkY61oV+OIZuGjWoKK0341ihGhiDcFxtqa6qj5Zlw5oUulG/0qH1grLg==">
              <a href="javascript:;" title="Use official id for login">
               <button class="btn btn-success"  onclick="document.forms['form1'].submit()">Login</button>
              </a>
            </form>-->
            </li>
                      </ul>
             
       
      </div>
    </nav>
  </header>
   <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar" >
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar" >
                <!-- Sidebar user panel -->
                
              <ul class="sidebar-menu" data-widget="tree" >
                <li>
      <a href="index.php" style="color:white">
      <i class="fa fa-calendar" style="color:white"></i>
      <span style="color:white">Water Quality Dashboard</span>
      </a>
   </li>
   <li>
      <a href="wqresults.php" style="color:white">
      <i class="fa fa-calendar" style="color:white"></i>
      <span style="color:white">Water Quality Results</span>
      </a>
   </li>
   
   <!--<li class="treeview">
      <a href="#">
      <i class="fa fa-bar-chart-o" style="color:white"></i>
      <span style="color:white">Reports</span>
      <i class="fa pull-right fa-angle-down" style="color:white"></i>
      </a>
      <ul class="treeview-menu" style="display: none;">
         <li>
            <a href="https://wqdash.wbphed.gov.in/wq-report" style="margin-left:10%">
            <i class="fa fa-bars"></i> <span>WQ Reports</span>
            </a>
         </li>
        
      </ul>
   </li>-->

   <!--li>
      <a href="https://wqdash.wbphed.gov.in/our-voluntary-facilitators">
          <i class="fa fa-group"></i>
          <span>Our Voluntary Facilitators</span>
      </a>
      </li--> 
   <li>
     
   </li>

   



   
   

      
   
   
   
   

  
    

    
       

   


    

   



   
    
   <!--- <li class="">
      <a href="https://wqdash.wbphed.gov.in">
        <i class="fa fa-dashboard"></i>  <span>Dashboard</span> 
      </a>
      </li>--->
   </ul>
</li>
</ul>


            </section>
            <!-- /.sidebar -->
        </aside>

  <style type="text/css">
   .main-header .navbar-custom-menu, .main-header .navbar-right
    {
    float: right;
    margin-right: 28px;
    }

    .navbar-nav>.user-menu .user-image {
    float: left;
    width: 45px !important;
    height: 45px !important;
    border-radius: 50%;
    margin-right: 10px;
    margin-top: 0px !important;
}
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     
     <section class="content-header">
      <div class="row">

        <div class="col-lg-3 col-md-3 col-xs-8">
        <b><i class="fa fa-bars" aria-hidden="true"></i> 
                    Water Quality Results
        
        <small></small></b> 
         
        </div>  
        <div class="col-lg-9 col-md-9 col-xs-4">
            <div class="row">

                  <div class="col-lg-6 col-md-6 hidden-xs">
                   
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-12 filterButton">
                     <div class="col-lg-6 col-md-6 hidden-xs">
<!-- Trigger the modal with a button -->
<!--<button type="button" class="btn btn-success dropdown-toggle" data-toggle="modal" data-target="#myModal"><i class="fa fa-bars" aria-hidden="true"></i>Column Settings</button>
-->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <form action="" name="frmColumnSetting" id="frmColumnSetting" method="POST">
       <input type="hidden" name="_token" value="S80t8AENGAd2a5DUxNnIqs7EkkkPwZUSwx6RUTUM">    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Column Settings</h4>
      </div>
      <div class="modal-body">
       
      <div class="container">
        <div class="row">
          <div class="col-2 col-md-2 col-sm-6">
            <p style="cursor: pointer;" id="all_p" class="all_p">
                        <input type="checkbox" name="All_settings" id="All" value="1" class="chk Other_group all_group all_p" checked>&nbsp;<b>All</b>
            </p>
            <p id="Hierarchy_col" style="color:#00a65a; font-size:14px; margin:0;cursor: pointer;">
              



               <b><u>Hierarchy (All)</u></b></p>
                     <p id="district_p" class="district_p" style="cursor: pointer;">
                        <input type="checkbox" name="district_settings" data-column="8" class="chk hierarchyChk Hierarchy_group District_group district_p" value="1" checked>&nbsp;District</p>
                     <p id="block_p" class="block_p" style="cursor: pointer;">
                        <input type="checkbox" name="block_settings" data-column="9" class="chk hierarchyChk Hierarchy_group block_group block_p" value="1" checked >&nbsp;Block</p>
                     <p id="panchayat_p" class="panchayat_p" style="cursor: pointer;">
                        <input type="checkbox" name="panchayat_settings" data-column="10" class="chk hierarchyChk Hierarchy_group panchayat_group panchayat_p" value="1" checked>&nbsp;Panchayat</p>

                     <p id="village_p" class="village_p" style="cursor: pointer;">
                        <input type="checkbox" name="village_settings" data-column="11" class="chk hierarchyChk Hierarchy_group village_group village_p" value="1" checked>&nbsp;Village</p>


                     <p id="habitation_p" class="habitation_p" style="cursor: pointer;">
                        <input type="checkbox" name="habitation_settings" data-column="12" class="chk hierarchyChk Hierarchy_group habitation_group habitation_p" value="1" checked>&nbsp;Habitation</p>
                     
                     <p id="general_col" style="cursor: pointer;"><b style="color:#00a65a; font-size:14px; cursor: pointer;"><u>General (All)</u></b></p>
                     
                     <p id="specialdrive_p" class="specialdrive_p" style="cursor: pointer;">
                        <input type="checkbox" name="specialdrive_settings" value="1" data-column="5" class="chk generalChk general_group specialdrive_group specialdrive_p" checked>&nbsp;Special Drive</p>
                     <p id="nameofLaboratory_p" class="nameofLaboratory_p" style="cursor: pointer;">
                        <input type="checkbox" name="nameofLaboratory_settings" value="1" data-column="19" class="chk generalChk general_group nameofLaboratory_group nameofLaboratory_p"  checked>&nbsp;Name of Laboratory</p>


                     <p id="sampleId_p" class="sampleId_p" style="cursor: pointer;">
                        <input type="checkbox" name="sampleId_settings" value="1" data-column="20" class="chk generalChk general_group sampleId_group sampleId_p" checked>&nbsp;Sample Id</p>


                     <p id="sanitarySurveyScore_p" class="sanitarySurveyScore_p" style="cursor: pointer;">
                        <input type="checkbox" name="sanitarySurveyScore_settings" value="1" data-column="51" class="sanitarySurveyScore_p chk generalChk general_group sanitarySurveyScore_group" checked>&nbsp;Sanitary Survey Score</p>


                     <p id="picturePlate_p" class="picturePlate_p" style="cursor: pointer;">
                        <input type="checkbox" name="picturePlate_settings" value="1" data-column="53" class="picturePlate_p chk generalChk general_group picturePlate_group"  checked>&nbsp;Picture plate</p>


                    <p id="sanitarySurveyCategory_p" class="sanitarySurveyCategory_p" style="cursor: pointer;">
                     <input type="checkbox" name="sanitarySurveyCategory_settings" value="1" data-column="52" class="sanitarySurveyCategory_p chk generalChk general_group sanitarySurveyCategory_group" checked>&nbsp;Sanitary Survey Risk Category</p>

                    <p id="date_p" class="date_p" style="cursor: pointer;">
                     <input type="checkbox" name="date_settings" value="1" data-column="1" class="chk generalChk general_group date_group date_p"  >&nbsp;Date</p>
         
          </div>
          <div class="col-2 col-md-2 col-sm-6">
                     <p id="Parameters_col" style="color:#00a65a; font-size:14px; margin:0;cursor: pointer;"><b><u>Parameters (All) </u></b></p>
                     <p style="cursor: pointer;" id="pH_p" class="pH_p">
                        <input type="checkbox" name="pH_settings" value="1" data-column="28" class="chk parameterChk Parameters_group pH_group pH_p" checked>&nbsp;pH</p>
                     <p style="cursor: pointer;" id="TDS_p" class="TDS_p">
                        <input type="checkbox" name="TDS_settings" value="1" data-column="26" class="chk parameterChk Parameters_group TDS_group TDS_p" checked>&nbsp;Total Dissolved Solids</p>
                     <p style="cursor: pointer;" id="condunctivity_p" class="condunctivity_p">
                        <input type="checkbox" name="condunctivity_settings" data-column="24" class="chk parameterChk Parameters_group condunctivity_group condunctivity_p" value="1" checked>&nbsp;Conductivity</p>
                     <p style="cursor: pointer;" id="temp_p" class="temp_p">
                        <input type="checkbox" name="temp_settings" value="1" data-column="22" class="chk parameterChk Parameters_group temp_group temp_p" checked>&nbsp;Temperature</p>
                     <p style="cursor: pointer;" id="turbidity_p" class="turbidity_p">
                        <input type="checkbox" name="turbidity_settings" value="1" data-column="32" class="chk parameterChk Parameters_group turbidity_group turbidity_p" checked>&nbsp;Turbidity</p>
                     <p style="cursor: pointer;"  id="residualChlorine_p" class="residualChlorine_p">
                        <input type="checkbox" name="residualChlorine_settings" value="1" data-column="30" class="chk parameterChk Parameters_group residualChlorine_group residualChlorine_p" checked>&nbsp;Free Residual Chlorine</p>

                     <p style="cursor: pointer;" id="alkalinity_p" class="alkalinity_p">
                        <input type="checkbox" name="alkalinity_settings" value="1" data-column="34" class="chk parameterChk Parameters_group alkalinity_group alkalinity_p" checked>&nbsp;Alkalinity</p>
                     <p style="cursor: pointer;" id="flouride_p" class="flouride_p">
                        <input type="checkbox" name="flouride_settings" value="1" data-column="36" class="chk parameterChk Parameters_group flouride_group flouride_p" checked>&nbsp;Fluoride</p>
                     <p style="cursor: pointer;" id="chloride_p" class="chloride_p">
                        <input type="checkbox" name="chloride_settings" value="1" data-column="38" class="chk parameterChk Parameters_group chloride_group chloride_p" checked>&nbsp;Chloride</p>
                     <p style="cursor: pointer;" id="iron_p" class="iron_p">
                        <input type="checkbox" name="iron_settings" value="1" data-column="40" class="chk parameterChk Parameters_group iron_group iron_p" checked>&nbsp;Iron</p>
                     <p style="cursor: pointer;" id="manganese_p" class="manganese_p">
                        <input type="checkbox" name="manganese_settings" value="1" data-column="42" class="chk parameterChk Parameters_group manganese_group manganese_p" checked>&nbsp;Manganese</p>
                     <p style="cursor: pointer;" id="hardness_p" class="hardness_p">
                        <input type="checkbox" name="hardness_settings" value="1" data-column="44" class="chk parameterChk Parameters_group hardness_group hardness_p" >&nbsp;Total Hardness</p>
                     <p style="cursor: pointer;" id="arsenic_p" class="arsenic_p">
                        <input type="checkbox" name="arsenic_settings" value="1" data-column="46" class="chk parameterChk  Parameters_group arsenic_group arsenic_p" checked>&nbsp;Total Arsenic</p>
                     <p style="cursor: pointer;" id="ecoli_p" class="bact_p">
                        <input type="checkbox" name="ecoli_settings" value="1" data-column="49" class="chk parameterChk  Parameters_group bact_group ecoli_settings bact_p" checked>&nbsp;<i style="font-size: 15px;font-weight: bold;">E. coli</i></p>
                     

                     <!--p style="cursor: pointer;" id="thermotolerantColiform_p" class="bact_p">
                        <input type="checkbox" name="thermotolerantColiform_settings" value="1" data-column="50" class="chk parameterChk  Parameters_group bact_group" >&nbsp;Thermotolerant Coliform</p>-->

                     <p style="cursor: pointer;" id="totalColiform_p" class="bact_p">
                        <input type="checkbox" value="1" name="totalColiform_settings" data-column="48" class="chk parameterChk Parameters_group bact_group totalColiform_p" checked>&nbsp;Total Coliform</p>
          </div>
          

         <div class="col-2 col-md-2 col-sm-6">
                     <p id="Methods_col" style="color:#00a65a; font-size:14px; margin:0; cursor: pointer;"><b><u>Methods </u></b></p>
                     <p style="cursor: pointer;" id="pHMethod_p" class="pH_p">
                        <input type="checkbox" name="pHMethod_settings" value="1" data-column="27" class="chk Methods_group pH_group" >&nbsp;pH Method </p>
                     <p  style="cursor: pointer;" id="TDSMethod_p" class="TDS_p">
                        <input type="checkbox" name="TDSMethod_settings" value="1" data-column="25" class="chk Methods_group TDS_group" >&nbsp;Total Dissolved Solids Method</p>
                     <p style="cursor: pointer;" id="condunctivityMethod_p" class="condunctivity_p">
                        <input type="checkbox" name="condunctivityMethod_settings" value="1" data-column="23" class="chk Methods_group condunctivity_group" >&nbsp;Conductivity Method </p>
                     
                     <p style="cursor: pointer;" id="tempMethod_p" class="temp_p">
                        <input type="checkbox" name="tempMethod_settings" value="1" data-column="21" class="chk Methods_group temp_group" >&nbsp;Temperature Method  </p>
                     
                     <p style="cursor: pointer;" id="turbidityMethod" class="turbidity_p">
                        <input type="checkbox" name="turbidityMethod_settings" value="1" data-column="31" class="chk Methods_group turbidity_group" >&nbsp;Turbidity Method</p>
                     
                     <p style="cursor: pointer;" id="residualChlorineMethod" class="residualChlorine_p">
                        <input type="checkbox" name="residualChlorineMethod_settings" value="1" data-column="29" class="chk Methods_group residualChlorine_group" >&nbsp;Free Residual Chlorine Method</p>
                     
                     <p style="cursor: pointer;" id="alkalinityMethod_p" class="alkalinity_p">
                        <input type="checkbox" name="alkalinityMethod_settings" value="1" data-column="33" class="chk Methods_group alkalinity_group" >&nbsp;Alkalinity Method </p>
                     
                     <p style="cursor: pointer;" id="flourideMethod_p" class="flouride_p">
                        <input type="checkbox" name="flourideMethod_settings" value="1" data-column="35" class="chk Methods_group flouride_group" >&nbsp;Fluoride Method </p>
                     
                     <p style="cursor: pointer;" id="chlorideMethod_p" class="chloride_p">
                        <input type="checkbox" name="chlorideMethod_settings" value="1" data-column="37" class="chk Methods_group chloride_group" >&nbsp;Chloride Method </p>
                     
                     <p style="cursor: pointer;" id="ironMethod_p" class="iron_p">
                        <input type="checkbox" name="ironMethod_settings" value="1" data-column="39" class="chk Methods_group iron_group" >&nbsp;Total Iron Method</p>
                     
                     <p style="cursor: pointer;" id="manganeseMethod_p" class="manganese_p">
                        <input type="checkbox" name="manganeseMethod_settings" value="1" data-column="41" class="chk Methods_group manganese_group" >&nbsp;Manganese Method</p>
                     
                     <p style="cursor: pointer;" id="hardnessMethod_p" class="hardness_p">
                        <input type="checkbox" name="hardnessMethod_settings" value="1" data-column="43" class="chk Methods_group hardness_group" >&nbsp;Total Hardness Method</p>
                     
                     <p style="cursor: pointer;" id="arsenicMethod_p" class="arsenic_p">
                        <input type="checkbox" name="arsenicMethod_settings" value="1" data-column="45" class="chk Methods_group arsenic_group" >&nbsp;Total Arsenic Method</p>
                     
                     <p style="cursor: pointer;" id="BacteriologicalMethod_p" class="bact_p">
                        <input type="checkbox" name="BacteriologicalMethod_settings" value="1" data-column="47" class="chk Methods_group bact_group" >&nbsp;Bacteriological Method</p>
          </div>

          <div class="col-2 col-md-2 col-sm-6">
                     <p id="Source_col" style="color:#00a65a; font-size:14px; margin:0; cursor: pointer;"><b><u>Source (All) </u></b></p>
                     <p style="cursor: pointer;" id="locality_p" class="locality_p">
                        <input type="checkbox" name="locality_settings" value="1" data-column="6" class="chk sourceChk Source_group locality_group locality_p" checked>&nbsp;Locality </p>
                     <p style="cursor: pointer;" id="newLocation_p" class="newLocation_p">
                        <input type="checkbox" name="newLocation_settings" value="1" data-column="13" class="chk sourceChk Source_group newLocation_group newLocation_p" checked>&nbsp;New Location</p>
                     <p style="cursor: pointer;" id="locationdescription_p" class="locationdescription_p">
                        <input type="checkbox" name="locationdescription_settings" value="1" data-column="14" class="chk sourceChk Source_group locationdescription_group locationdescription_p" checked>&nbsp;Location Description</p>
                     <p style="cursor: pointer;" id="latitude_p" class="latitude_p">
                        <input type="checkbox" name="latitude" value="1" data-column="17" class="chk sourceChk Source_group latitude_group latitude_p" checked>&nbsp;Latitude</p>
                     <p style="cursor: pointer;" id="longitude_p" class="longitude_p">
                        <input type="checkbox" name="longitude_settings" value="1" data-column="18" class="chk sourceChk Source_group longitude_group longitude_p" checked>&nbsp;Longitude</p>
                     <p style="cursor: pointer;" id="sourcecategory_p" class="sourcecategory_p">

                        <input type="checkbox" name="sourcecategory_settings" value="1" data-column="15" class="chk sourceChk Source_group sourcecategory_group sourcecategory_p" checked>&nbsp;Source Category</p>


                     <p style="cursor: pointer;" id="sourcephoto_p" class="sourcephoto_p">
                        <input type="checkbox" name="sourcephoto_settings" value="1" data-column="16" class="chk sourceChk Source_group sourcephoto_group sourcephoto_p" checked>&nbsp;Source Photo</p>
                     <p style="cursor: pointer;" id="sourcesite_p" class="sourcesite_p">
                        <input type="checkbox" name="sourcesite_settings" value="1" data-column="2" class="chk sourceChk Source_group sourcesite_group sourcesite_p" checked>&nbsp;Source Site</p>
                     <p style="cursor: pointer;" id="source_type_p" class="source_type_p">
                        <input type="checkbox" name="source_type_settings" value="1" data-column="7" class="chk sourceChk Source_group source_type_group source_type_p" checked>&nbsp;Source Type</p>
                    
                     <p style="cursor: pointer;" id="pipe_water_source_type_p" class="pipe_water_source_type_p">
                        <input type="checkbox" name="pipe_water_source_type" value="1" data-column="7" class="chk sourceChk Source_group pipe_water_source_type_group pipe_water_source_type_p" checked>&nbsp;PWSS Source Type</p>
                           
                     <p style="cursor: pointer;" id="saCode_p" class="saCode_p">
                        <input type="checkbox" name="saCode_settings" value="1" data-column="3" class="chk generalChk Source_group saCode_group saCode_p" checked>&nbsp;School/Anganwadi Code</p>
                     <p style="cursor: pointer;" id="saName_p" class="saName_p">
                        <input type="checkbox" name="saName_settings" value="1" data-column="4" class="chk generalChk Source_group saName_group saName_p"  checked>&nbsp;School/Anganwadi Name</p>
                  
                     
          </div>
        </div> <!--<div class="row">-->
      </div> <!--<div class="container">-->
       
      </div> <!--<div class="modal-body">-->
      <div class="modal-footer">
        
        <input type="submit" class="btn btn-success" name="columnSettings" id="columnSettings" value="Save and display" style="color:black">
      </div>
    </div> <!--<div class="modal-content">-->
   </form>
  </div>
  
</div>
   
</div>

<div class="col-lg-6 col-md-6 col-xs-12">
   <div class="btn-group"> 
    <!--  <button class="btn btn-success" data-toggle="control-sidebar">
      <i class="fa fa-gears"></i> &nbsp;Filter
      </button> --> 
   </div>
</div>


                 
                
                  </div> 
            </div>
      </div>
            
            
        </div>
      
    </section>


    <section class="content content-without-top-padding">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box" >
                               
                                
                                
                                

                                <div class="box-body table-responsive">

                          <table id="post" class="display nowrap dataTable no-footer cell-border"  cellspacing="0" style="font-size:12px!important; width:100%;text-align: center;">
                                        <thead align="center">
                                            <tr>
                                                <th  data-orderable="false" data-columnCount="0">Sl. No.</th>
												
                                                <th data-orderable="false" data-columnCount="6">Locality</th>
                                                
                                                <th data-orderable="false" data-columnCount="8">District</th> 
                                                <th data-orderable="false" data-columnCount="9">Block</th>
                                                <th data-orderable="false" data-columnCount="10">Panchayat</th>
                                                <th data-orderable="false" data-columnCount="11">Village</th>
                                                <th data-orderable="false" data-columnCount="12">Habitation</th>
                                               
                                                <th data-orderable="false" data-columnCount="14">Location Description</th>                                                
                                                <th data-orderable="false" data-columnCount="15">Source Type</th>
                                                <th data-orderable="false" data-columnCount="16">Source Photo</th>
                                                <th data-orderable="false" data-columnCount="17">Latitude</th>
                                                <th data-orderable="false" data-columnCount="18">Longitude</th>
                                                <th data-orderable="false" data-columnCount="19">Name Of Laboratory</th>
                                                <th data-orderable="false" data-columnCount="20">Sample Id</th>
                                                <th data-orderable="false" data-columnCount="22">Temperature<br>(°C)</th>
                                                <th data-orderable="false" data-columnCount="24">Conductivity<br> (µS/cm)</th>
                                                <th data-orderable="false" data-columnCount="26">Total Dissolved Solids<br>(mg/l)</th>
                                                <th data-orderable="false" data-columnCount="28">pH Value</th>
                                                <th data-orderable="false" data-columnCount="30">Free Residual <br />Chlorine (mg/l)</th>
                                                 <th data-orderable="false" data-columnCount="32">Turbidity<br> (NTU)</th>
                                                <th data-orderable="false" data-columnCount="34">Alkalinity<br> (mg/l)</th>
                                                <th data-orderable="false" data-columnCount="36">Fluoride<br> (mg/l)</th>
                                                <th data-orderable="false" data-columnCount="38">Chloride<br> (mg/l)</th>
                                                <th data-orderable="false" data-columnCount="40">Total Iron<br> (mg/l)</th>
                                                <th data-orderable="false" data-columnCount="42">Manganese<br> (mg/l)</th>
                                                <th data-orderable="false" data-columnCount="46">Total Arsenic<br> (mg/l)</th>
                                                 <th data-orderable="false" data-columnCount="51">Sanitary<br>Survey<br>Score</th>
                                                <th data-orderable="false" data-columnCount="52">Sanitary<br>Survey<br>Risk<br>Category</th>
                                                <th data-orderable="false" data-columnCount="53">Picture of Plate</th>
                                                                                                                                                      
                                               <!-- <th data-orderable="false">Id</th>-->

                                            </tr>
                                        </thead>
                                        <tbody >
                                            
                                            <tr style="" >
                                            
                                            <td style=" text-align:center;" data-columnCount="-1">1</td>
                                            
                                                                                        
                                            
                                                
                                                                                                                                        
                                                  

                                               <td data-columnCount="6" align="center">RURAL</td>
                                            
                                               
                                            
                                                                                         
                                              <td data-columnCount="8" data-dist-code="345">PURBA MEDINIPUR</td>
                                                                                        
                                              
                                                <td data-columnCount="9" data-dist-block-code="2477">POTASHPUR - I</td>
                                                                                        
                                                

                                                <td data-columnCount="10" data-dist-pan-code="2">AMARSHI-II</td>
                                                                                         

                                                <td data-columnCount="11" data-vill-code="345050">TALADIHA</td>
                                                                                        
                                                

                                                <td data-columnCount="12" data-hab-code="1">TALADIHA</td>
                                            

                                                

                                             
                                                                                        
                                                                                            <td data-columnCount="14" data-parrent-code="5dcbaa7fae9c902fed59687b">
                                                    N.H. AJIT BHANJA                                                        
                                                    </td>
                                            
                                                                                        
                                                <td data-columnCount="15">TUBE WELL ORDINARY</td>
                                            
                                                                                                                                    
                                                
                                                                                      
                                                  <td data-columnCount="16" align="center" id="trigger_popup_fricc">

<!--id="five"-->
   <img  src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_source_new_20210303_083847_752939918.png" class="trigger_popup_fricc imgDesign button" dat="22.1013396:-:87.5970724:-::-:NO" width="40" Height="30">


</td>
                                                                                            
                                                
                                            
                                                <td data-columnCount="17" align="center">22.1013396</td>
                                                                                        
                                                
                                                <td data-columnCount="18" align="center">87.5970724</td>
                                                                                        
                                                                                            <td data-columnCount="19" data-LabCode="LB00000096">GRAM MANGAL SUB-DISTRICT LABORATORY</td>
                                                                                        
                                                
                                                <td data-columnCount="20" align="center">962397</td>
                                                
    <td data-columnCount="22" align="center">28</td>

   
    <td data-columnCount="24" align="center">
        566                                                
   </td>
  
                                            
<td style="color: !important;" data-columnCount="26" align="center">
334                                                
</td>

    
    <td style="color:;" data-columnCount="28" align="center">
7.11                                                                                             
    </td>
    
                                            
<td style="color:red !important;" data-columnCount="30" align="center"></td>
    

    
<td style="color: !important;" data-columnCount="32" align="center">1.65</td>
    
                                            
    <td style="color: !important;" data-columnCount="34" align="center"></td>

  
    <td style="color: !important;" data-columnCount="36" align="center">
    </td>

    <td style="color: !important;" data-columnCount="38" align="center">34.03</td>
    


        <td style="color: !important;" data-columnCount="40" align="center">0.05</td>

 
    <td style="color: !important;" data-columnCount="42" align="center">0</td>
                                              


 

    <td style="color: !important;" data-columnCount="46" align="center"></td>





   
     <td data-columnCount="51" align="center" >7</td>
    <td data-columnCount="52" align="center" >HIGH RISK</td>

        <td data-columnCount="53" align="center"><img src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_test_20210304_110449_4695855267042215736.png" class="trigger_popup_fricc imgDesign" dat="22.1013396:-:87.5970724:-::-:NO" width="40" Height="30"></td>
                                                  
    <!--<td>604073e14f085b7b576da52f</td>-->

</tr>
                                            
                                          
                                            <tr style="" >
                                            
                                            <td style=" text-align:center;" data-columnCount="-1">2</td>
                                            
                                                                                        
                                           
                                                                                                                                        <

                                               <td data-columnCount="6" align="center">RURAL</td>
                                            
                                               
                                          
                                                                                         
                                              <td data-columnCount="8" data-dist-code="345">PURBA MEDINIPUR</td>
                                                                                        
                                              
                                                <td data-columnCount="9" data-dist-block-code="2478">POTASHPUR - II</td>
                                                                                        
                                                

                                                <td data-columnCount="10" data-dist-pan-code="4">PANCHET</td>
                                                                                         

                                                <td data-columnCount="11" data-vill-code="345090">KALYANPUR</td>
                                                                                        
                                                

                                                <td data-columnCount="12" data-hab-code="1">KALYANPUR</td>
                                            

                                                

                                             
                                                                                        
                                                                                            <td data-columnCount="14" data-parrent-code="5dcbae93ae9c904a920419ea">
                                                    N.H. KANU DAS                                                        
                                                    </td>
                                            
                                                                                        
                                                <td data-columnCount="15">TUBE WELL MARK II</td>
                                            
                                                                                                                                    
                                              <td data-columnCount="16" align="center" id="trigger_popup_fricc">

<!--id="five"-->
   <img  src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_source_new_20210303_074149_179681972.png" class="trigger_popup_fricc imgDesign button" dat="21.9413269:-:87.5401541:-:N.H. KANU DAS:-:YES" width="40" Height="30">


</td>
                                                                                            
                                                
                                            
                                                <td data-columnCount="17" align="center">21.9413269</td>
                                                                                        
                                                
                                                <td data-columnCount="18" align="center">87.5401541</td>
                                                                                        
                                                                                            <td data-columnCount="19" data-LabCode="LB00000096">GRAM MANGAL SUB-DISTRICT LABORATORY</td>
                                                                                        
                                                
                                                <td data-columnCount="20" align="center">962408</td>
                                                
    <td data-columnCount="22" align="center">27.4</td>

   
    <td data-columnCount="24" align="center">
        396                                                
   </td>
  
                                            
<td style="color: !important;" data-columnCount="26" align="center">
234                                                
</td>

    
    <td style="color:;" data-columnCount="28" align="center">
7.11                                                                                             
    </td>
    
                                            
<td style="color:red !important;" data-columnCount="30" align="center"></td>
    

    
<td style="color: !important;" data-columnCount="32" align="center">1.64</td>
    
                                            
    <td style="color: !important;" data-columnCount="34" align="center"></td>

  
    <td style="color: !important;" data-columnCount="36" align="center">
    </td>

    <td style="color: !important;" data-columnCount="38" align="center">17.02</td>
    


        <td style="color: !important;" data-columnCount="40" align="center">0.05</td>

 
    <td style="color: !important;" data-columnCount="42" align="center">0</td>
                                              


 

    <td style="color: !important;" data-columnCount="46" align="center"></td>





    
     <td data-columnCount="51" align="center" >0</td>
    <td data-columnCount="52" align="center" >LOW RISK</td>

        <td data-columnCount="53" align="center"><img src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_test_20210304_110055_3244696297825052540.png" class="trigger_popup_fricc imgDesign" dat="21.9413269:-:87.5401541:-:N.H. KANU DAS:-:YES" width="40" Height="30"></td>
                                                  
    <!--<td>604073e04f085b7b576da529</td>-->

</tr>
                                            
                                          
                                            <tr style="" >
                                            
                                            <td style=" text-align:center;" data-columnCount="-1">3</td>
                                            
                                                                                        
                                            
                                                
                                                                                                                                        
                                                  

                                               <td data-columnCount="6" align="center">RURAL</td>
                                            
                                               
                                             
                                                                                         
                                              <td data-columnCount="8" data-dist-code="335">PURBA BARDDHAMAN</td>
                                                                                        
                                              
                                                <td data-columnCount="9" data-dist-block-code="2284">PURBASTHALI - II</td>
                                                                                        
                                                

                                                <td data-columnCount="10" data-dist-pan-code="4">MAJIDA</td>
                                                                                         

                                                <td data-columnCount="11" data-vill-code="319553">MAJIDA</td>
                                                                                        
                                                

                                                <td data-columnCount="12" data-hab-code="3">PURBA TAMAGHATA</td>
                                            

                                                

                                           
                                                                                        
                                                                                            <td data-columnCount="14" data-parrent-code="5dcbed2bae9c904a91341df4">
                                                    MASJID                                                        
                                                    </td>
                                            
                                                                                        
                                                <td data-columnCount="15">TUBE WELL MARK II</td>
                                            
                                                                                                                                    
                                             
                                            
                                            
                                            
                                            
                                            
                                            
                                                                                      
                                                  <td data-columnCount="16" align="center" id="trigger_popup_fricc">

<!--id="five"-->
   <img  src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_source_new_20210303_094509_492090853.png" class="trigger_popup_fricc imgDesign button" dat="23.5356639:-:88.3468717:-::-:NO" width="40" Height="30">


</td>
                                                                                            
                                                
                                            
                                                <td data-columnCount="17" align="center">23.5356639</td>
                                                                                        
                                                
                                                <td data-columnCount="18" align="center">88.3468717</td>
                                                                                        
                                                                                            <td data-columnCount="19" data-LabCode="LB00000151">PARULIA SUB-DISTRICT LABORATORY</td>
                                                                                        
                                                
                                                <td data-columnCount="20" align="center">1511511</td>
                                                
    <td data-columnCount="22" align="center"></td>

   
    <td data-columnCount="24" align="center">
                                                        
   </td>
  
                                            
<td style="color: !important;" data-columnCount="26" align="center">
                                                
</td>

    
    <td style="color:;" data-columnCount="28" align="center">
7.11                                                                                             
    </td>
    
                                            
<td style="color:red !important;" data-columnCount="30" align="center"></td>
    

    
<td style="color: !important;" data-columnCount="32" align="center"></td>
    
                                            
    <td style="color: !important;" data-columnCount="34" align="center"></td>

  
    <td style="color: !important;" data-columnCount="36" align="center">
    </td>

    <td style="color: !important;" data-columnCount="38" align="center"></td>
    


        <td style="color:red !important;" data-columnCount="40" align="center">3.38</td>

 
    <td style="color: !important;" data-columnCount="42" align="center"></td>
                                              


 

    <td style="color:red !important;" data-columnCount="46" align="center">0.016</td>





   
     <td data-columnCount="51" align="center" >2</td>
    <td data-columnCount="52" align="center" >LOW RISK</td>

        <td data-columnCount="53" align="center"><img src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_test_20210304_103559_627191552778247589.png" class="trigger_popup_fricc imgDesign" dat="23.5356639:-:88.3468717:-::-:NO" width="40" Height="30"></td>
                                                  
    <!--<td>60406cda213ba040e3072c0c</td>-->

</tr>
                                            
                                          
                                            <tr style="" >
                                            
                                            <td style=" text-align:center;" data-columnCount="-1">4</td>
                                            
                                                                                        
                                            
                                               
                                                                                                                                       

                                               <td data-columnCount="6" align="center">RURAL</td>
                                            
                                               
                                             
                                                                                         
                                              <td data-columnCount="8" data-dist-code="329">COOCH BEHAR</td>
                                                                                        
                                              
                                                <td data-columnCount="9" data-dist-block-code="2180">MEKLIGANJ</td>
                                                                                        
                                                

                                                <td data-columnCount="10" data-dist-pan-code="6">NIZTARAF</td>
                                                                                         

                                                <td data-columnCount="11" data-vill-code="307834">MEKLIGANJ (P)</td>
                                                                                        
                                                

                                                <td data-columnCount="12" data-hab-code="3">DAS PARA</td>
                                            

                                                

                                             
                                                                                        
                                                                                            <td data-columnCount="14" data-parrent-code="5dd27c1fae9c9053a53cb3d1">
                                                    NH OF SUBAL DAS                                                        
                                                    </td>
                                            
                                                                                        
                                                <td data-columnCount="15">TUBE WELL ORDINARY</td>
                                            
                                                                                                                                    
                                             <td data-columnCount="16" align="center" id="trigger_popup_fricc">

<!--id="one"-->
   <img  src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_source_new_20210303_143903_1308471059.png" class="trigger_popup_fricc imgDesign button" dat="26.3433002:-:88.908019:-:NH OF SUBAL DAS:-:YES" width="40" Height="30">


</td>
                                                                                            
                                                
                                            
                                                <td data-columnCount="17" align="center">26.3433002</td>
                                                                                        
                                                
                                                <td data-columnCount="18" align="center">88.908019</td>
                                                                                        
                                                                                            <td data-columnCount="19" data-LabCode="LB00000160">MEKLIGANJ MUNICIPALITY SUB-DISTRICT LABORATORY</td>
                                                                                        
                                                
                                                <td data-columnCount="20" align="center">1601704</td>
                                                
    <td data-columnCount="22" align="center"></td>

   
    <td data-columnCount="24" align="center">
                                                        
   </td>
  
                                            
<td style="color: !important;" data-columnCount="26" align="center">
                                                
</td>

    
    <td style="color:;" data-columnCount="28" align="center">
7.11                                                                                             
    </td>
    
                                            
<td style="color:red !important;" data-columnCount="30" align="center"></td>
    

    
<td style="color: !important;" data-columnCount="32" align="center">4.8</td>
    
                                            
    <td style="color: !important;" data-columnCount="34" align="center"></td>

  
    <td style="color: !important;" data-columnCount="36" align="center">
    </td>

    <td style="color: !important;" data-columnCount="38" align="center"></td>
    


        <td style="color:red !important;" data-columnCount="40" align="center">3.89</td>

 
    <td style="color: !important;" data-columnCount="42" align="center"></td>
                                              


 

    <td style="color: !important;" data-columnCount="46" align="center"></td><td data-columnCount="51" align="center" >2</td>
    <td data-columnCount="52" align="center" >LOW RISK</td>

        <td data-columnCount="53" align="center"><img src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_test_20210304_075440_615868865.png" class="trigger_popup_fricc imgDesign" dat="26.3433002:-:88.908019:-:NH OF SUBAL DAS:-:YES" width="40" Height="30"></td>
                                                  
    <!--<td>60404631ecc42259e1439d87</td>-->

</tr>
                                            
                                          
                                            <tr style="" >
                                            
                                            <td style=" text-align:center;" data-columnCount="-1">5</td>
                                            
                                                                                        
                                            
                                          
                                                  

                                               <td data-columnCount="6" align="center">RURAL</td>
                                            
                                               
                                            
                                                                                         
                                              <td data-columnCount="8" data-dist-code="337">NORTH 24 PARGANAS</td>
                                                                                        
                                              
                                                <td data-columnCount="9" data-dist-block-code="2327">DEGANGA</td>
                                                                                        
                                                

                                                <td data-columnCount="10" data-dist-pan-code="8">DEGANGA-II</td>
                                                                                         

                                                <td data-columnCount="11" data-vill-code="323376">BAJITPUR</td>
                                                                                        
                                                

                                                <td data-columnCount="12" data-hab-code="3">UTTAR PARA</td>
                                            

                                                

                                             
                                                                                        
                                                                                            <td data-columnCount="14" data-parrent-code="5dd3907cae9c9071b04f3191">
                                                    N.H QUAZI ANIS ULLAH                                                        
                                                    </td>
                                            
                                                                                        
                                                <td data-columnCount="15">TUBE WELL ORDINARY</td>
                                            
                                                                                                                                    
                                              <td data-columnCount="16" align="center" id="trigger_popup_fricc">

<!--id="one"-->
   <img  src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_source_new_20210303_111053_8390913388103938121.png" class="trigger_popup_fricc imgDesign button" dat="22.670639:-:88.6477568:-:N.H QUAZI ANIS ULLAH:-:YES" width="40" Height="30">


</td>
                                                                                            
                                                
                                            
                                                <td data-columnCount="17" align="center">22.670639</td>
                                                                                        
                                                
                                                <td data-columnCount="18" align="center">88.6477568</td>
                                                                                        
                                                                                            <td data-columnCount="19" data-LabCode="LB00000191">HAROA SUB-DISTRICT LABORATORY</td>
                                                                                        
                                                
                                                <td data-columnCount="20" align="center">1910786</td>
                                                
    <td data-columnCount="22" align="center">26</td>

   
    <td data-columnCount="24" align="center">
        644                                                
   </td>
  
                                            
<td style="color: !important;" data-columnCount="26" align="center">
380                                                
</td>

    
    <td style="color:;" data-columnCount="28" align="center">
7.1                                                                                             
    </td>
    
                                            
<td style="color:red !important;" data-columnCount="30" align="center"></td>
    

    
<td style="color: !important;" data-columnCount="32" align="center">4.51</td>
    
                                            
    <td style="color: !important;" data-columnCount="34" align="center"></td>

  
    <td style="color: !important;" data-columnCount="36" align="center">
    </td>

    <td style="color: !important;" data-columnCount="38" align="center"></td>
    


        <td style="color:red !important;" data-columnCount="40" align="center">1.68</td>

 
    <td style="color: !important;" data-columnCount="42" align="center"></td>
                                              


 

    <td style="color:red !important;" data-columnCount="46" align="center">0.022</td>





  
     <td data-columnCount="51" align="center" >2</td>
    <td data-columnCount="52" align="center" >LOW RISK</td>

        <td data-columnCount="53" align="center"><img src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_test_20210305_114138_-818599496.png" class="trigger_popup_fricc imgDesign" dat="22.670639:-:88.6477568:-:N.H QUAZI ANIS ULLAH:-:YES" width="40" Height="30"></td>
                                                  
    <!--<td>604b1c04458cd150952d87ee</td>-->

</tr>
                                            
                                          
                                            <tr style="" >
                                            
                                            <td style=" text-align:center;" data-columnCount="-1">6</td>
                                            
                                                                                        
                                           
                                                                                                                                        

                                               <td data-columnCount="6" align="center">RURAL</td>
                                            
                                               
                                            
                                                                                         
                                              <td data-columnCount="8" data-dist-code="339">BANKURA</td>
                                                                                        
                                              
                                                <td data-columnCount="9" data-dist-block-code="2363">BARJORA</td>
                                                                                        
                                                

                                                <td data-columnCount="10" data-dist-pan-code="4">CHHANDAR</td>
                                                                                         

                                                <td data-columnCount="11" data-vill-code="327310">CHHANDAR</td>
                                                                                        
                                                

                                                <td data-columnCount="12" data-hab-code="1">CHHANDAR</td>
                                            

                                                

                                              
                                                                                        
                                                                                            <td data-columnCount="14" data-parrent-code="5dcab327ae9c9006b46ab977">
                                                    NEAR THE HOUSE OF GITA KALINDI                                                        
                                                    </td>
                                            
                                                                                        
                                                <td data-columnCount="15">TUBE WELL ORDINARY</td>
                                            
                                                                                                                                    
                                              <td data-columnCount="16" align="center" id="trigger_popup_fricc">

<!--id="one"-->
   <img  src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_source_new_20210303_064738_2393457130475880001.png" class="trigger_popup_fricc imgDesign button" dat="23.3029833:-:87.2525466:-::-:NO" width="40" Height="30">


</td>
                                                                                            
                                                
                                            
                                                <td data-columnCount="17" align="center">23.3029833</td>
                                                                                        
                                                
                                                <td data-columnCount="18" align="center">87.2525466</td>
                                                                                        
                                                                                            <td data-columnCount="19" data-LabCode="LB00000001">BANKURA DISTRICT LABORATORY</td>
                                                                                        
                                                
                                                <td data-columnCount="20" align="center">11987</td>
                                                
    <td data-columnCount="22" align="center">22</td>

   
    <td data-columnCount="24" align="center">
                                                        
   </td>
  
                                            
<td style="color: !important;" data-columnCount="26" align="center">
                                                
</td>

    
    <td style="color:;" data-columnCount="28" align="center">
7.1                                                                                             
    </td>
    
                                            
<td style="color:red !important;" data-columnCount="30" align="center"></td>
    

    
<td style="color: !important;" data-columnCount="32" align="center">1.03</td>
    
                                            
    <td style="color: !important;" data-columnCount="34" align="center"></td>

  
    <td style="color: !important;" data-columnCount="36" align="center">
0.13    </td>

    <td style="color: !important;" data-columnCount="38" align="center"></td>
    


        <td style="color: !important;" data-columnCount="40" align="center">0.82</td>

 
    <td style="color: !important;" data-columnCount="42" align="center"></td>
                                              


 

    <td style="color: !important;" data-columnCount="46" align="center"></td>





    
     <td data-columnCount="51" align="center" >3</td>
    <td data-columnCount="52" align="center" >LOW RISK</td>

        <td data-columnCount="53" align="center"><img src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_test_20210309_131246_5622559341667089527.png" class="trigger_popup_fricc imgDesign" dat="23.3029833:-:87.2525466:-::-:NO" width="40" Height="30"></td>
                                                  
    <!--<td>60472b19966d89158e404b3d</td>-->

</tr>
                                            
                                          
                                            <tr style="" >
                                            
                                            <td style=" text-align:center;" data-columnCount="-1">7</td>
                                            
                                                                                        
                                      
                                                                                                                                       
                                               <td data-columnCount="6" align="center">RURAL</td>
                                            
                                               
                                            
                                                                                         
                                              <td data-columnCount="8" data-dist-code="339">BANKURA</td>
                                                                                        
                                              
                                                <td data-columnCount="9" data-dist-block-code="2363">BARJORA</td>
                                                                                        
                                                

                                                <td data-columnCount="10" data-dist-pan-code="4">CHHANDAR</td>
                                                                                         

                                                <td data-columnCount="11" data-vill-code="327310">CHHANDAR</td>
                                                                                        
                                                

                                                <td data-columnCount="12" data-hab-code="1">CHHANDAR</td>
                                            

                                                

                                            
                                                                                        
                                                                                            <td data-columnCount="14" data-parrent-code="5dcbad5eae9c902fef59f471">
                                                    BESIDE OF ASHOK BORDDAN                                                        
                                                    </td>
                                            
                                                                                        
                                                <td data-columnCount="15">TUBE WELL ORDINARY</td>
                                             <td data-columnCount="16" align="center" id="trigger_popup_fricc">

<!--id="two"-->
   <img  src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_source_new_20210303_073323_9210137066564626966.png" class="trigger_popup_fricc imgDesign button" dat="23.3047982:-:87.2519008:-::-:NO" width="40" Height="30">


</td>
                                                                                            
                                                
                                            
                                                <td data-columnCount="17" align="center">23.3047982</td>
                                                                                        
                                                
                                                <td data-columnCount="18" align="center">87.2519008</td>
                                                                                        
                                                                                            <td data-columnCount="19" data-LabCode="LB00000001">BANKURA DISTRICT LABORATORY</td>
                                                                                        
                                                
                                                <td data-columnCount="20" align="center">11991</td>
                                                
    <td data-columnCount="22" align="center">22</td>

   
    <td data-columnCount="24" align="center">
                                                        
   </td>
  
                                            
<td style="color: !important;" data-columnCount="26" align="center">
                                                
</td>

    
    <td style="color:;" data-columnCount="28" align="center">
7.1                                                                                             
    </td>
    
                                            
<td style="color:red !important;" data-columnCount="30" align="center"></td>
    

    
<td style="color:red !important;" data-columnCount="32" align="center">7.87</td>
    
                                            
    <td style="color: !important;" data-columnCount="34" align="center"></td>

  
    <td style="color: !important;" data-columnCount="36" align="center">
0.09    </td>

    <td style="color: !important;" data-columnCount="38" align="center"></td>
    


        <td style="color:red !important;" data-columnCount="40" align="center">5.02</td>

 
    <td style="color: !important;" data-columnCount="42" align="center"></td>
                                              


 

    <td style="color: !important;" data-columnCount="46" align="center"></td>





  
     <td data-columnCount="51" align="center" >3</td>
    <td data-columnCount="52" align="center" >LOW RISK</td>

        <td data-columnCount="53" align="center"><img src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_test_20210309_131130_4248374291768489136.png" class="trigger_popup_fricc imgDesign" dat="23.3047982:-:87.2519008:-::-:NO" width="40" Height="30"></td>
                                                  
    <!--<td>60472b19966d89158e404b33</td>-->

</tr>
                                            
                                          

                                            <tr style="" >
                                            
                                            <td style=" text-align:center;" data-columnCount="-1">8</td>
                                            
                                                                                        
                                            
                                               

                                               <td data-columnCount="6" align="center">RURAL</td>
                                            
                                               
                                            
                                                                                         
                                              <td data-columnCount="8" data-dist-code="339">BANKURA</td>
                                                                                        
                                              
                                                <td data-columnCount="9" data-dist-block-code="2363">BARJORA</td>
                                                                                        
                                                

                                                <td data-columnCount="10" data-dist-pan-code="4">CHHANDAR</td>
                                                                                         

                                                <td data-columnCount="11" data-vill-code="327310">CHHANDAR</td>
                                                                                        
                                                

                                                <td data-columnCount="12" data-hab-code="1">CHHANDAR</td>
                                            

                                                

                                             
                                                                                        
                                                                                            <td data-columnCount="14" data-parrent-code="5f5f45f1ae9c90132367a0b6">
                                                    PANCHAYAT OFFICE                                                        
                                                    </td>
                                            
                                                                                        
                                                <td data-columnCount="15">TUBE WELL ORDINARY</td>
                                            
                                                                                                                                    
                                             
                                            
                                            
                                            
                                            
                                            
                                            
                                                                                      
                                                  <td data-columnCount="16" align="center" id="trigger_popup_fricc">

<!--id="two"-->
   <img  src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_source_new_20210303_102147_6178365437307876485.png" class="trigger_popup_fricc imgDesign button" dat="23.3078496:-:87.2516923:-::-:NO" width="40" Height="30">


</td>
                                                                                            
                                                
                                            
                                                <td data-columnCount="17" align="center">23.3078496</td>
                                                                                        
                                                
                                                <td data-columnCount="18" align="center">87.2516923</td>
                                                                                        
                                                                                            <td data-columnCount="19" data-LabCode="LB00000001">BANKURA DISTRICT LABORATORY</td>
                                                                                        
                                                
                                                <td data-columnCount="20" align="center">11998</td>
                                                
    <td data-columnCount="22" align="center">22</td>

   
    <td data-columnCount="24" align="center">
                                                        
   </td>
  
                                            
<td style="color: !important;" data-columnCount="26" align="center">
                                                
</td>

    
    <td style="color:;" data-columnCount="28" align="center">
7.1                                                                                             
    </td>
    
                                            
<td style="color:red !important;" data-columnCount="30" align="center"></td>
    

    
<td style="color: !important;" data-columnCount="32" align="center">0.23</td>
    
                                            
    <td style="color: !important;" data-columnCount="34" align="center"></td>

  
    <td style="color: !important;" data-columnCount="36" align="center">
0.068    </td>

    <td style="color: !important;" data-columnCount="38" align="center"></td>
    


        <td style="color:red !important;" data-columnCount="40" align="center">1.54</td>

 
    <td style="color: !important;" data-columnCount="42" align="center"></td>
                                              


 

    <td style="color: !important;" data-columnCount="46" align="center"></td>





    
     <td data-columnCount="51" align="center" >0</td>
    <td data-columnCount="52" align="center" >LOW RISK</td>

        <td data-columnCount="53" align="center"><img src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_test_20210309_130844_6160679352660790746.png" class="trigger_popup_fricc imgDesign" dat="23.3078496:-:87.2516923:-::-:NO" width="40" Height="30"></td>
                                                  
    <!--<td>60472b13966d89158e404b0f</td>-->

</tr>
                                            
                                          
                                            <tr style="" >
                                            
                                            <td style=" text-align:center;" data-columnCount="-1">9</td>
                                            
                                                                                        
                                            
                                             
                                                                                                                                       
                                               <td data-columnCount="6" align="center">RURAL</td>
                                            
                                               
                                            
                                                                                         
                                              <td data-columnCount="8" data-dist-code="339">BANKURA</td>
                                                                                        
                                              
                                                <td data-columnCount="9" data-dist-block-code="2363">BARJORA</td>
                                                                                        
                                                

                                                <td data-columnCount="10" data-dist-pan-code="4">CHHANDAR</td>
                                                                                         

                                                <td data-columnCount="11" data-vill-code="327310">CHHANDAR</td>
                                                                                        
                                                

                                                <td data-columnCount="12" data-hab-code="1">CHHANDAR</td>
                                            

                                                

                                            
                                                                                        
                                                                                            <td data-columnCount="14" data-parrent-code="5dd29226ae9c9053a53d167a">
                                                    NEAR MMC(CLUB)                                                        
                                                    </td>
                                            
                                                                                        
                                                <td data-columnCount="15">TUBE WELL ORDINARY</td>
                                            
                                                                                                                                    
                                           <td data-columnCount="16" align="center" id="trigger_popup_fricc">

<!--id="two"-->
   <img  src="https://sunanda-images.s3.ap-south-1.amazonaws.com/School/img_source_new_20210303_112237_3227614757191174941.png" class="trigger_popup_fricc imgDesign button" dat="23.308403:-:87.2473156:-:NEAR MMC(CLUB):-:YES" width="40" Height="30">


</td>
                                                                                            
                                                
                                            
                                                <td data-columnCount="17" align="center">23.308403</td>
                                                                                        
                                                
                                                <td data-columnCount="18" align="center">87.2473156</td>
                                                                                        
                                                                                            <td data-columnCount="19" data-LabCode="LB00000001">BANKURA DISTRICT LABORATORY</td>
                                                                                        
                                                
                                                <td data-columnCount="20" align="center">12004</td>
                                                
    <td data-columnCount="22" align="center">22</td>

   
    <td data-columnCount="24" align="center">
                                                        
   </td>
  
                                            
<td style="color: !important;" data-columnCount="26" align="center">
                                                
</td>

    
    <td style="color:;" data-columnCount="28" align="center">
7.1                                                                                             
    </td>
    
                                            
<td style="color:red !important;" data-columnCount="30" align="center"></td>
    

    
<td style="color: !important;" data-columnCount="32" align="center">1.04</td>
    
                                            
    <td style="color: !important;" data-columnCount="34" align="center"></td>

  
    <td style="color: !important;" data-columnCount="36" align="center">
0.04    </td>

    <td style="color: !important;" data-columnCount="38" align="center"></td>
    


        <td style="color:red !important;" data-columnCount="40" align="center">2.4</td>

 
    <td style="color: !important;" data-columnCount="42" align="center"></td>
                                              


 

    <td style="color: !important;" data-columnCount="46" align="center"></td>


     <td data-columnCount="51" align="center" >0</td>
    <td data-columnCount="52" align="center" >LOW RISK</td>

        <td data-columnCount="53" align="center"><img src="https://sunanda-images.s3.ap-south-1.amazonaws.com/School/img_test_20210309_130624_7536882753534792036.png" class="trigger_popup_fricc imgDesign" dat="23.308403:-:87.2473156:-:NEAR MMC(CLUB):-:YES" width="40" Height="30"></td>
                                                  
    <!--<td>60472b12966d89158e404b0b</td>-->

</tr>
                                            
                                          
                                            
                                            
                                            
                                       </tbody>
                                     
                                    </table>          
                                 
                                    
                                 
                                        
                                   
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                            
                        </div>
                    </div>

                </section>

      <!-- /.row (main row) -->
 

<div class="hover_bkgr_fricc">
    <span class="helper"></span>
    <div>
        <div class="popupCloseButton">X</div>
        <p><img src="" style="width:95%;height:60%" ></p>

    </div>
</div>




    </section>

    <!--Read more modal start-->
<div id="morePlatePicModal" class="modal" data-easein="expandIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                      <!--Modal content comes here from ajax-->
        </div>
    </div>
</div>
<!--Read more modal end-->

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      
    </div>
    <strong>Powered By Smec
  </footer>  <aside class="control-sidebar control-sidebar-dark " >
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
     
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
       
      <form action="" name="frm1" id="frm1" method="POST">
             <input type="hidden" name="_token" value="S80t8AENGAd2a5DUxNnIqs7EkkkPwZUSwx6RUTUM">      <div class="tab-pane1">
        <div>
          <h4>Water Quality Filters </h4>

                
          <div class="form-group1">
              <label class="control-sidebar-subheading">
                Lab Type
              </label>

                  
              <select id="labtype" name="labtype" class="form-control">

                  <option value="ALL" >ALL</option>
                  
                  <option value='OMAS' >ONSITE MOBILE ANALYSIS SYSTEM</option>

                  <option value='LAB'  >WATER TESTING LABORATORIES</option>
                  
                  <option value="BCC"  >BCC Data</option>
                   <option value="MOBILE LABORATORY VAN"  >MOBILE LABORATORY VAN</option>
              </select>

                          </div>
           <div class="form-group1">
              <label class="control-sidebar-subheading">
                District
              </label>
              <select class="form-control" name="dist_code" id="dist_code">
                <option value="0" >ALL</option>
                                <option value="641" >ALIPURDUAR</option>
                                <option value="339" >BANKURA</option>
                                <option value="334" >BIRBHUM</option>
                                <option value="329" >COOCH BEHAR</option>
                                <option value="331" >DAKSHIN DINAJPUR</option>
                                <option value="327" >DARJEELING</option>
                                <option value="338" >HOOGHLY</option>
                                <option value="341" >HOWRAH</option>
                                <option value="328" >JALPAIGURI</option>
                                <option value="643" >JHARGRAM</option>
                                <option value="642" >KALIMPONG</option>
                                <option value="332" >MALDAH</option>
                                <option value="333" >MURSHIDABAD</option>
                                <option value="336" >NADIA</option>
                                <option value="337" >NORTH 24 PARGANAS</option>
                                <option value="644" >PASCHIM BARDDHAMAN</option>
                                <option value="344" >PASCHIM MEDINIPUR</option>
                                <option value="335" >PURBA BARDDHAMAN</option>
                                <option value="345" >PURBA MEDINIPUR</option>
                                <option value="340" >PURULIA</option>
                                <option value="343" >SOUTH 24 PARGANAS</option>
                                <option value="330" >UTTAR DINAJPUR</option>
                                
              </select>
            </div>

              
           
             <div class="form-group1"  id="blockl" >
              <label class="control-sidebar-subheading">
               Block               </label>
              <select class="form-control" id="block_drp" name="block_drp" >
                <option value="0">ALL</option>
                              </select>
            </div>
           
             <div class="form-group1" id="panchayat" >
              <label class="control-sidebar-subheading">
               Panchayat               </label>
              <select class="form-control" name="pan" id="pan" >
                <option value="0">ALL</option>
                              </select>
            </div>

             <div class="form-group1" id="lab_sel" name="lab_sel" >
              <label class="control-sidebar-subheading">
                Laboratory Name
              </label>
              <select class="form-control" name="lab" id="lab">
                <option value="0">ALL</option>
                                <option value="LB00000091" >ABASH SARADAMOYEE UNNAYAN PARISHAD SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000097" >ABHYUDAYA HALDIA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000157" >AHMEDPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000042" >AIKATAN DEVOLOPMENT SOCIETY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000165" >ALGARAH SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000132" >ALIPURDUAR DISTRICT LABORATORY</option>
                                <option value="LB00000058" >AMARTYA RURAL WELFARE &amp; RESEARCH CENTRE SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000216" >AMTALA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000071" >AMTALA VILLAGE ORGANISATION SOCIETY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000064" >ANANDANIKETAN SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000150" >ANUKHAL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000154" >ASANSOL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000023" >ASESH ROY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000190" >BAGDA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000203" >BAGMUNDI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000183" >BAGULA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000017" >BAHARAMPUR MECHANICAL DIVISION SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000214" >BAKKHALI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000031" >BALARAMPUR WATER TREATMENT PLANT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000121" >BALICHAK SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000118" >BALUPUR WATER TREATMENT PLANT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000001" >BANKURA DISTRICT LABORATORY</option>
                                <option value="LB00000079" >BARA ANDULIA MAHILA SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000207" >BARABAZAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000003" >BARDHAMAN DISTRICT LABORATORY</option>
                                <option value="LB00000034" >BARUIPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000210" >BASANTI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000192" >BASIRHAT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000125" >BELDA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000090" >BELDA SURYAPRABHA GUCHCHHA SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000123" >BELPAHARI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000220" >BHIKNI NISCHINTAPUR SUB DISTRICT LABORATORY</option>
                                <option value="LB00000080" >BINOY BADAL DINESH CLUB SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000005" >BIRBHUM DISTRICT LABORATORY</option>
                                <option value="LB00000136" >BISHNUPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000087" >BITHARI DISHA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000188" >BODAI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000006" >BOLPUR MECHANICAL DIVISION SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000145" >BONNABAGRAM SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000052" >BOYS RECREATION CLUB SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000039" >BRAJARAJPUR TENTULIA MAHILA &amp; SISHU KALYAN SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000213" >BUITA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000172" >BULBUL CHANDI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000029" >BUNDWAN SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000120" >C.K.ROAD SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000209" >CANNING SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000134" >CHALSA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000170" >CHANCHOL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000168" >CHANDANNAGAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000194" >CHANDPARA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000126" >CHANDRAKONA MUNICIPAL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000201" >CHELIYAMA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000040" >CHHOTO SARENGA CO-OPERATIVE LABOUR CONTRACT &amp; CONSTRUCTION SOCIETY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000104" >CO-ORDINATION LIA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000067" >COMMUNITY POLYTECHNIC CELL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000069" >COMMUNITY POLYTECHNIQUE CELL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000026" >CONTAI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000007" >COOCHBIHAR DISTRICT LABORATORY</option>
                                <option value="LB00000008" >DAKSHIN DINAJPUR DISTRICT LABORATORY</option>
                                <option value="LB00000035" >DAKSHIN ROYPUR WTP SITE</option>
                                <option value="LB00000128" >DANTAN SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000015" >DARIAPUR WATER TREATMENT PLANT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000009" >DARJEELING DISTRICT LABORATORY</option>
                                <option value="LB00000133" >DHUPGURI MUNICIPAL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000212" >DIAMOND HARBOUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000043" >DR. CHATTERJEES VILLAGE WELFAIR SOCIETY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000205" >DUBRA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000197" >ERASHAL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000075" >FARAKKA BLOCK BIDI SHRAMIK KALYAN SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000081" >FORUM OF SCIENTISTS ENGINEERS AND TECHNOLOGISTS (FOSET) SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000173" >GAGTAI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000062" >GANDALPARA NABIN PRAGATI SEVA SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000138" >GANGAJAL GHATI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000149" >GANGANANDAPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000131" >GARHBETA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000171" >GAZOLE SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000130" >GHATAL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000122" >GIDHNI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000217" >GOALPOKHAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000193" >GOKHNA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000152" >GOPALPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000124" >GOPIBALLAVPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000096" >GRAM MANGAL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000182" >HABIBPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000189" >HABRA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000200" >HALDIA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000159" >HALDIBARI MUNICIPALITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000076" >HARANAGAR SAMABAY KRISHI UNNAYAN SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000178" >HARIHARPARA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000072" >HARIPUR DR. AMBEDKAR JANA SEVA MISSION SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000191" >HAROA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000038" >HIJALDAHA VIVEKANANDA SEVA SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000011" >HOOGHLY DISTRICT LABORATORY</option>
                                <option value="LB00000012" >HOWRAH DISTRICT LABORATORY</option>
                                <option value="LB00000176" >ISLAMPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000218" >ITAHAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000105" >JABALA AGRANI TARUN CLUB SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000177" >JALANGI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000013" >JALPAIGURI DISTRICT LABORATORY</option>
                                <option value="LB00000061" >JANGIPARA RURAL SOCIETY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000018" >JANGIPUR WATER TREATMENT PLANT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000032" >JHALDA AUG WATER TREATMENT PLANT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000092" >JHARGRAM MAHAKUMA JANASIKSHA PARASAR SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000174" >JOYKRISHNAPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000206" >JOYPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000107" >KAKDWIP SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000004" >KALYANESWARI WATER TREATMENT PLANT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000167" >KAMARPUKUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000049" >KANACHI KHADI BHANDAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000094" >KANGSABATI GUCCHA SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000108" >KENSILY AZAD SPORTING CLUB SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000129" >KESHIARY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000025" >KHARAGPUR WATER TREATMENT PLANT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000048" >KHOYRASOLE SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000198" >KOLAGHAT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000184" >KRISHNAGANJ SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000185" >KRISHNANAGAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000219" >KUDI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000162" >KUSHMANDI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000175" >LALBAGH SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000127" >LALGARGH SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000153" >LAUDAHA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000101" >LOKAJAGARAN RKMLP GRAM UNNAYAN KENDRA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000019" >MAHYAMPUR WATER TREATMENT PLANT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000014" >MALDA DISTRICT LABORATORY</option>
                                <option value="LB00000037" >MALLABHUM MAHILA KALYAN SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000022" >MANGAL PANDEY WATER TREATMENT PLANT DISTRICT LABORATORY</option>
                                <option value="LB00000155" >MAYURESWAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000024" >MEDNIPUR DISTRICT LABORATORY</option>
                                <option value="LB00000160" >MEKLIGANJ MUNICIPALITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000055" >MOLLADIGHI RURAL DEVELOPMENT SOCIETY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000196" >MOYNA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000002" >MUKUTMANIPUR WATER TREATMENT PLANT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000158" >MURARAI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000016" >MURSHIDABAD DISTRICT LABORATORY</option>
                                <option value="LB00000020" >NADIA DISTRICT LABORATORY</option>
                                <option value="LB00000078" >NADIA ZILLA GANATANTRIK MAHILA HRINDAN SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000010" >NEORAKHOLA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000117" >NETAJI MAHAVIDALAYA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000053" >NISHIGANJ CLUB SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000021" >NORTH 24 PARAGANAS DISTRICT LABORATORY</option>
                                <option value="LB00000140" >ONDA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000057" >PANCHAVATI GREEN TECH RESEARCH SOCIETY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000151" >PARULIA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000056" >PASCHIM BANGA VIGYAN MANCHA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000156" >PATELNAGAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000086" >PATHER PANCHALI SEVA SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000163" >PATIRAM SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000135" >PATRASAYAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000113" >PRASHIKA RURAL DEVOLOPMENT ORGANIZATION SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000027" >PURBA MEDINIPUR DISTRICT LABORATORY</option>
                                <option value="LB00000102" >PURULIA DISTRICT AGRAGAMI MAHILA O SISHU MANGAL SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000028" >PURULIA DISTRICT LABORATORY</option>
                                <option value="LB00000208" >RAGHUNATHPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000030" >RAGHUNATHPUR WATER TREATMENT PLANT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000211" >RAIDIGHI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000141" >RAIPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000065" >RAJGANJ WELFARE ORGANIZATION SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000111" >RAMAKRISHNA MISSION LOKA SIKSHA PARISHAD(MATHURAPUR) SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000215" >RAMGANGA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000110" >RAMKRISHANA MISSION LOKE SIKSHA PARISHAD (RKMLSP)(NARENDRAPUR) SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000199" >RAMNAGAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000051" >RAMPURHAT PARIBESH PARISEVA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000063" >RANAPARA GRAM BIKASH KENDRA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000179" >REJINAGAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000074" >RURAL NATIONAL CLUB SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000093" >SABANG PALLI MANGAL GUCHCHHA SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000112" >SAGAR MANGAL SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000180" >SAGARDIGHI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000089" >SAHID KHUDIRAM SEVA SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000146" >SAKTIGARH SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000181" >SALAR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000142" >SALTORA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000115" >SAMUKTALA SUB DISTRICT LABORATORY</option>
                                <option value="LB00000139" >SANADANDHA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000148" >SANKARI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000068" >SANSKRITY -O- SAMAJ UNNAYAN PARISAD SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000204" >SANTURI SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000137" >SARBERIA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000088" >SARBIK GRAM VIKAS KENDRA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000084" >SARBIK VIVEKANANDA GRAM SEVA SANSTHA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000059" >SARVIK VIVEKANANDA GRAM SEVA SANSTHA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000147" >SATGACHIA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000144" >SEHERA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000166" >SERAMPORE SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000195" >SERKHANCHAK SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000070" >SEVABRATA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000045" >SHASTRI SMRITY SANGAHA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000046" >SIDHU KANU GRAM UNNYAN SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000044" >SIKSHA NIKETAN SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000169" >SILAMPUR SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000164" >SINDHAP SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000202" >SIRKABAD SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000103" >SISTER NIVEDITA OLDAGE HOME SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000161" >SITALKUCHI SUB DISTRICT LABORATORY</option>
                                <option value="LB00000041" >SONAMUKHI BIKALPA UNAYAN SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000033" >SOUTH 24 PARAGANAS DISTRICT LABORATORY</option>
                                <option value="LB00000106" >SOUTHERN HEALTH IMPROVEMENT SOCIETY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000098" >SRI RAMAKRISHNA GUCCHA SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000143" >TALDANGRA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000095" >TAMRALIPTA GUCHCHHA SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000060" >TARAKNATH MATENITY &amp; CHILD WELFARE ORGANISATION SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000054" >TATERKUTHI NETAJI SANGHA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000186" >TEHATTA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000050" >TUBGRAM GRAMAK UNNAYAN SAMITY SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000036" >UTTAR DINAJPUR DISTRICT LABORATORY</option>
                                <option value="LB00000099" >VIVEKANANDA KALYAN PARISHAD SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000100" >VIVEKANANDA YUVA PARISHAD SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000082" >WBCADC DEGANGA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000116" >WBCADC FALAKATA SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000114" >WBCADC KALIAGANG SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000077" >WBCADC RANAGHAT SUB-DISTRICT LABORATORY</option>
                                <option value="LB00000085" >YOUTH DEVOLPMENT CENTRE SUB-DISTRICT LABORATORY</option>
                              </select>
            </div>




             <div class="form-group1" id="village" style="">
              <label class="control-sidebar-subheading">
               Village
              </label>
              <select class="form-control" name="vil" id="vil">
                <option value="0">ALL</option>
                              </select>
            </div>

             <div class="form-group1">
              <label class="control-sidebar-subheading">
               Source Type
              </label>
                             <select id="SourceType" name="SourceType" class="form-control">
                                    <option value="0" selected="">ALL</option>
                                    <option value="Dug Well" >DUG WELL</option>
                                    <option value="Piped Water Supply" >PIPED WATER SUPPLY</option>
                                    <option value="Spring" >SPRING</option>
                                    <option value="TUBE WELL MARK II" >TUBE WELL MARK II</option>
                                    <option value="TUBE WELL ORDINARY" >TUBE WELL ORDINARY</option>
                                    <option value="WATER TREATMENT UNIT/FILTER" >WATER TREATMENT UNIT/FILTER</option>
                                </select>
                            </div>

                        <div class="form-group1">
              <label class="control-sidebar-subheading">
               Source Site
              </label>

                            <select id="SourceSite" name="SourceSite" class="form-control">
                
                <option value="0" selected="">ALL</option>
                <option value="HABITATION" >HABITATION</option>
                <option value="HEALTH CENTRE" >HEALTH CARE FACILITY</option>
                <option value="ANGANWADI" >ANGANWADI</option>
                <option value="SCHOOL" >SCHOOL</option>
                <option value="OTHERS"  >OTHERS</option>
                              
              </select>
                          </div>
            
            <div class="form-group1">
              <label class="control-sidebar-subheading">
               Special Drive
              </label>
              <select id="name_of_special_drive" name="name_of_special_drive" class="form-control">
                                 
                    <option value="0" selected="">ALL</option>
                    <option value="ARSENIC" >ARSENIC</option>
                    <option value="ARSENIC TREND STATION" >ARSENIC TREND STATION</option>
                    <option value="IDCF" >IDCF</option>
                    <option value="IEC ACTIVITIES" >IEC ACTIVITIES</option>
                    <option value="JE/AES ROSTER" >JE/AES ROSTER</option>

                    <!--  <option value="MOBILE LABORATORY VAN" >MOBILE LABORATORY VAN</option>-->

                  <option value="'RESIDUAL CHLORINE" >FREE RESIDUAL CHLORINE</option>


                  <option value="ROSTER" >ROSTER</option>
                   <option value="100 DAYS CAMPAIGN – TEST" >100 DAYS CAMPAIGN – TEST</option>

                  <option value="OTHERS" >OTHERS</option>

                  
              </select>
            </div>
            
            

            <div  id="daterange" style="display:none; margin: -10px 0px 50px 0px;">

            <label class="control-sidebar-subheading">
                     Date Range
                    </label>
                <div class="col-lg-5 col-md-5 col-xs-12 px-md-5">
                  
                    <input placeholder="dd-mm-YYYY" autocomplete="off" type="text" id="start_date1" name="start_date1" value=""  class="form-control date-picker">
                </div>
                <div class="col-lg-1 col-md-1 col-xs-12 px-md-5">
                  To
                </div>

                <div class="col-lg-5 col-md-5 col-xs-12 px-md-5">
                  
                   <input placeholder="dd-mm-YYYY" autocomplete="off" type="text" id="end_date1" name="end_date1" value=""  class="form-control date-picker">
                </div>
             </div>
           

            <div id="err" style="color:#FF0000;padding-bottom:5px;"></div>
            <div class="form-group1" >
              <select name="dttime" id="dttime" class="form-control">              
              
                <option value="L7"  >Last 7 days</option>
                <option value="L15" >Last 15 days</option>
                <option value="CM" >Last 30 days</option>
                <option value="L3M"  >Last 90 days</option>
                <option value="L6M" selected  >Last 180 days</option>

                <option value="" disabled=""  >Financial year wise download option</option>
                <option value="2022"  >2021-2022</option>

                <option value="2021"  >2020-2021</option>

                <option value="2020"  >2019-2020</option>
                
                  <option value="2019"  >2018-2019</option>
                <option value="2018"  >2017-2018</option>
                <option value="2017"  >2016-2017</option>
                <option value="2016"  >2015-2016</option>
                <option value="2015"  >2014-2015</option>


                <option value="C"  >Custom Date Range</option>


                
              </select>
              
            </div>  
                                    
             
                <input type="submit" class="btn btn-success" name="tabular" id="tabular" value="Tabular" style="color:black" >
                                  <input type="submit" class="btn btn-success" name="summary" id="summary" value="Summary" style="color:black" >
                                
                  
                                          <input type="submit" class="btn btn-success" name="graphical" id="graphical" value="Graphical" style="color:black">
                    
                
                
               
                    <input type="submit" class="btn btn-success" name="csv1" id="csv1" value="Download Excel" style="color:black" >
               
                
                          



        </div>
      </div>
    </form>
      
    </div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  
</div>
<!-- ./wrapper -->
<div id="img-modal-container">
    <div class="img-modal-background">
      <div class="imgmodal">
       <!-- <h2>I'm a Modal</h2>-->
        <div>
        <div class="popupCloseButton">X</div>
        <p><img src="https://sunanda-images.s3.ap-south-1.amazonaws.com/Routine/img_source_20200726_104256_1262164835.png" style="width:95%;height:60%"></p>

    </div>
        <svg class="modal-svg" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none">
        <rect x="0" y="0" fill="none" width="226" height="162" rx="3" ry="3"></rect>
        </svg>
      </div>
    </div>
</div>
<!--<div class="content">
<h1>Modal Animations</h1>
<div class="buttons">
<div id="one" class="button">Unfolding</div>
<div id="two" class="button">Revealing</div>
<div id="three" class="button">Uncovering</div>
<div id="four" class="button">Blow Up</div><br>
<div id="five" class="button">Meep Meep</div>
<div id="six" class="button">Sketch</div>
<div id="seven" class="button">Bond</div>
</div>
</div>-->
<!-- jQuery 3 -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->

<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/raphael/raphael.min.js"></script>

<!-- Sparkline -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<script type="text/javascript" src="https://wqdash.wbphed.gov.in/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/moment/min/moment.min.js"></script>

<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/dist/js/adminlte.min.js"></script>
<!-- AdminLTE App -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/dist/js/demo.js"></script>
<script type="text/javascript" src="https://wqdash.wbphed.gov.in/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>



<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://wqdash.wbphed.gov.in/phed/js/custom.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="//code.highcharts.com/highcharts.js"></script>
<script src="//code.highcharts.com/modules/exporting.js"></script>

<style>
* {
  box-sizing: border-box;
}

html, body {
  min-height: 100%;
  height: 100%;
 /* background-image: url(http://theartmad.com/wp-content/uploads/Dark-Grey-Texture-Wallpaper-5.jpg);*/
  background-size: cover;
  background-position: top center;
  font-family: helvetica neue, helvetica, arial, sans-serif;
  font-weight: 200;
}
html.img-modal-active, body.img-modal-active {
  overflow: hidden;
}

#img-modal-container {
  position: fixed;
  display: table;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  transform: scale(0);
  z-index: 1;
}
#img-modal-container.one {
  transform: scaleY(0.01) scaleX(0);
  animation: unfoldIn 1s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.one .img-modal-background .imgmodal {
  transform: scale(0);
  animation: zoomIn 0.5s 0.8s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.one.out {
  transform: scale(1);
  animation: unfoldOut 1s 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.one.out .img-modal-background .imgmodal {
  animation: zoomOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.two {
  transform: scale(1);
}
#img-modal-container.two .img-modal-background {
  background: rgba(0, 0, 0, 0);
  animation: fadeIn 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.two .img-modal-background .imgmodal {
  opacity: 0;
  animation: scaleUp 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.two + .content {
  animation: scaleBack 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.two.out {
  animation: quickScaleDown 0s .5s linear forwards;
}
#img-modal-container.two.out .img-modal-background {
  animation: fadeOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.two.out .img-modal-background .imgmodal {
  animation: scaleDown 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.two.out + .content {
  animation: scaleForward 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.three {
  z-index: 0;
  transform: scale(1);
}
#img-modal-container.three .img-modal-background {
  background: rgba(0, 0, 0, 0.6);
}
#img-modal-container.three .img-modal-background .imgmodal {
  animation: moveUp 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.three + .content {
  z-index: 1;
  animation: slideUpLarge 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.three.out .img-modal-background .imgmodal {
  animation: moveDown 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.three.out + .content {
  animation: slideDownLarge 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.four {
  z-index: 0;
  transform: scale(1);
}
#img-modal-container.four .img-modal-background {
  background: rgba(0, 0, 0, 0.7);
}
#img-modal-container.four .img-modal-background .imgmodal {
  animation: blowUpModal 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.four + .content {
  z-index: 1;
  animation: blowUpContent 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.four.out .img-modal-background .imgmodal {
  animation: blowUpModalTwo 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.four.out + .content {
  animation: blowUpContentTwo 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.five {
  transform: scale(1);
}
#img-modal-container.five .img-modal-background {
  background: rgba(0, 0, 0, 0);
  animation: fadeIn 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.five .img-modal-background .imgmodal {
  transform: translateX(-1500px);
  animation: roadRunnerIn 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.five.out {
  animation: quickScaleDown 0s .5s linear forwards;
}
#img-modal-container.five.out .img-modal-background {
  animation: fadeOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.five.out .img-modal-background .imgmodal {
  animation: roadRunnerOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.six {
  transform: scale(1);
}
#img-modal-container.six .img-modal-background {
  background: rgba(0, 0, 0, 0);
  animation: fadeIn 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.six .img-modal-background .imgmodal {
  background-color: transparent;
  animation: modalFadeIn 0.5s 0.8s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.six .img-modal-background .imgmodal h2, #img-modal-container.six .img-modal-background .imgmodal p {
  opacity: 0;
  position: relative;
  animation: modalContentFadeIn 0.5s 1s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.six .img-modal-background .imgmodal .modal-svg rect {
  animation: sketchIn 0.5s 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.six.out {
  animation: quickScaleDown 0s .5s linear forwards;
}
#img-modal-container.six.out .img-modal-background {
  animation: fadeOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.six.out .img-modal-background .imgmodal {
  animation: modalFadeOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.six.out .img-modal-background .imgmodal h2, #img-modal-container.six.out .img-modal-background .imgmodal p {
  animation: modalContentFadeOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.six.out .img-modal-background .imgmodal .modal-svg rect {
  animation: sketchOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.seven {
  transform: scale(1);
}
#img-modal-container.seven .img-modal-background {
  background: rgba(0, 0, 0, 0);
  animation: fadeIn 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.seven .img-modal-background .imgmodal {
  height: 75px;
  width: 75px;
  border-radius: 75px;
  overflow: hidden;
  animation: bondJamesBond 1.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.seven .img-modal-background .imgmodal h2, #img-modal-container.seven .img-modal-background .imgmodal p {
  opacity: 0;
  position: relative;
  animation: modalContentFadeIn .5s 1.4s linear forwards;
}
#img-modal-container.seven.out {
  animation: slowFade .5s 1.5s linear forwards;
}
#img-modal-container.seven.out .img-modal-background {
  background-color: rgba(0, 0, 0, 0.7);
  animation: fadeToRed 2s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.seven.out .img-modal-background .imgmodal {
  border-radius: 3px;
  height: 162px;
  width: 227px;
  animation: killShot 1s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container.seven.out .img-modal-background .imgmodal h2, #img-modal-container.seven.out .img-modal-background .imgmodal p {
  animation: modalContentFadeOut 0.5s 0.5 cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#img-modal-container .img-modal-background {
  display: table-cell;
  background: rgba(0, 0, 0, 0.8);
  text-align: center;
  vertical-align: middle;
}
#img-modal-container .img-modal-background .imgmodal {
  background: white;
  padding: 50px;
  display: inline-block;
  border-radius: 3px;
  font-weight: 300;
  position: relative;
}
#img-modal-container .img-modal-background .imgmodal h2 {
  font-size: 25px;
  line-height: 25px;
  margin-bottom: 15px;
}
#img-modal-container .img-modal-background .imgmodal p {
  font-size: 18px;
  line-height: 22px;
}
#img-modal-container .img-modal-background .imgmodal .modal-svg {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  border-radius: 3px;
}
#img-modal-container .img-modal-background .imgmodal .modal-svg rect {
  stroke: #fff;
  stroke-width: 2px;
  stroke-dasharray: 778;
  stroke-dashoffset: 778;
}

.content {
  min-height: 100%;
  height: 100%;
  background: white;
  position: relative;
  z-index: 0;
}
.content h1 {
  padding: 75px 0 30px 0;
  text-align: center;
  font-size: 30px;
  line-height: 30px;
}
.content .buttons {
  max-width: 800px;
  margin: 0 auto;
  padding: 0;
  text-align: center;
}
.content .buttons .button {
  display: inline-block;
  text-align: center;
  padding: 10px 15px;
  margin: 10px;
  background: red;
  font-size: 18px;
  background-color: #efefef;
  border-radius: 3px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
  cursor: pointer;
}
.content .buttons .button:hover {
  color: white;
  background: #009bd5;
}

@keyframes  unfoldIn {
  0% {
    transform: scaleY(0.005) scaleX(0);
  }
  50% {
    transform: scaleY(0.005) scaleX(1);
  }
  100% {
    transform: scaleY(1) scaleX(1);
  }
}
@keyframes  unfoldOut {
  0% {
    transform: scaleY(1) scaleX(1);
  }
  50% {
    transform: scaleY(0.005) scaleX(1);
  }
  100% {
    transform: scaleY(0.005) scaleX(0);
  }
}
@keyframes  zoomIn {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes  zoomOut {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes  fadeIn {
  0% {
    background: rgba(0, 0, 0, 0);
  }
  100% {
    background: rgba(0, 0, 0, 0.7);
  }
}
@keyframes  fadeOut {
  0% {
    background: rgba(0, 0, 0, 0.7);
  }
  100% {
    background: rgba(0, 0, 0, 0);
  }
}
@keyframes  scaleUp {
  0% {
    transform: scale(0.8) translateY(1000px);
    opacity: 0;
  }
  100% {
    transform: scale(1) translateY(0px);
    opacity: 1;
  }
}
@keyframes  scaleDown {
  0% {
    transform: scale(1) translateY(0px);
    opacity: 1;
  }
  100% {
    transform: scale(0.8) translateY(1000px);
    opacity: 0;
  }
}
@keyframes  scaleBack {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0.85);
  }
}
@keyframes  scaleForward {
  0% {
    transform: scale(0.85);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes  quickScaleDown {
  0% {
    transform: scale(1);
  }
  99.9% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes  slideUpLarge {
  0% {
    transform: translateY(0%);
  }
  100% {
    transform: translateY(-100%);
  }
}
@keyframes  slideDownLarge {
  0% {
    transform: translateY(-100%);
  }
  100% {
    transform: translateY(0%);
  }
}
@keyframes  moveUp {
  0% {
    transform: translateY(150px);
  }
  100% {
    transform: translateY(0);
  }
}
@keyframes  moveDown {
  0% {
    transform: translateY(0px);
  }
  100% {
    transform: translateY(150px);
  }
}
@keyframes  blowUpContent {
  0% {
    transform: scale(1);
    opacity: 1;
  }
  99.9% {
    transform: scale(2);
    opacity: 0;
  }
  100% {
    transform: scale(0);
  }
}
@keyframes  blowUpContentTwo {
  0% {
    transform: scale(2);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
@keyframes  blowUpModal {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes  blowUpModalTwo {
  0% {
    transform: scale(1);
    opacity: 1;
  }
  100% {
    transform: scale(0);
    opacity: 0;
  }
}
@keyframes  roadRunnerIn {
  0% {
    transform: translateX(-1500px) skewX(30deg) scaleX(1.3);
  }
  70% {
    transform: translateX(30px) skewX(0deg) scaleX(0.9);
  }
  100% {
    transform: translateX(0px) skewX(0deg) scaleX(1);
  }
}
@keyframes  roadRunnerOut {
  0% {
    transform: translateX(0px) skewX(0deg) scaleX(1);
  }
  30% {
    transform: translateX(-30px) skewX(-5deg) scaleX(0.9);
  }
  100% {
    transform: translateX(1500px) skewX(30deg) scaleX(1.3);
  }
}
@keyframes  sketchIn {
  0% {
    stroke-dashoffset: 778;
  }
  100% {
    stroke-dashoffset: 0;
  }
}
@keyframes  sketchOut {
  0% {
    stroke-dashoffset: 0;
  }
  100% {
    stroke-dashoffset: 778;
  }
}
@keyframes  modalFadeIn {
  0% {
    background-color: transparent;
  }
  100% {
    background-color: white;
  }
}
@keyframes  modalFadeOut {
  0% {
    background-color: white;
  }
  100% {
    background-color: transparent;
  }
}
@keyframes  modalContentFadeIn {
  0% {
    opacity: 0;
    top: -20px;
  }
  100% {
    opacity: 1;
    top: 0;
  }
}
@keyframes  modalContentFadeOut {
  0% {
    opacity: 1;
    top: 0px;
  }
  100% {
    opacity: 0;
    top: -20px;
  }
}
@keyframes  bondJamesBond {
  0% {
    transform: translateX(1000px);
  }
  80% {
    transform: translateX(0px);
    border-radius: 75px;
    height: 75px;
    width: 75px;
  }
  90% {
    border-radius: 3px;
    height: 182px;
    width: 247px;
  }
  100% {
    border-radius: 3px;
    height: 162px;
    width: 227px;
  }
}
@keyframes  killShot {
  0% {
    transform: translateY(0) rotate(0deg);
    opacity: 1;
  }
  100% {
    transform: translateY(300px) rotate(45deg);
    opacity: 0;
  }
}
@keyframes  fadeToRed {
  0% {
    background-color: rgba(0, 0, 0, 0.6);
  }
  100% {
    background-color: rgba(255, 0, 0, 0.8);
  }
}
@keyframes  slowFade {
  0% {
    opacity: 1;
  }
  99.9% {
    opacity: 0;
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
</style>
<script id="rendered-js">
$('.button').click(function () 
{
  var buttonId = $(this).attr('id');
 // $('#img-modal-container').removeAttr('class').addClass(buttonId);
  //$('body').addClass('img-modal-active');
  //$('#trigger_popup_fricc img').attr("src",this.src);
});

$('#img-modal-container').click(function () {
  $(this).addClass('out');
  $('body').removeClass('img-modal-active');
});
//# sourceURL=pen.js
    </script>
<script> 
 $(document).ready(function(){ 
 
     $('#dist_code').change(function(){
          var dist_code = $(this).val();
          $('#block_drp').html('<option value="0">ALL</option>');
          $('#pan').html('<option value="0">ALL</option>');
          $('#lab').html('<option value="0">ALL</option>');
          $('#vil').html('<option value="0">ALL</option>');       
          $.ajax({
                      type: 'GET',
                      url: "https://wqdash.wbphed.gov.in/source/getOnlyBlock/"+dist_code, 
                      success: function(result)
                      {    
                                $("#block_drp").html(result);
                           
                      }
                  });

            $.ajax({
                      type: 'GET',
                      url: "https://wqdash.wbphed.gov.in/source/getOnlyLab/"+dist_code, 
                      success: function(result)
                      {
                           // console.log(result);
                            $("#lab_sel").html('');
                            $("#lab_sel").html(result);

                            
                      }
                  });
    });


    $('#block_drp').change(function(){
           //alert('panch');
            var block_code = $(this).val();
            var dit_code = $('#dist_code').val();
            var code_str = block_code+'_'+dit_code;   

           
            $.ajax({
                      type: 'GET',
                      url: "https://wqdash.wbphed.gov.in/source/getPanWithLab/"+code_str,
                      success: function(result)
                      {console.log(result);
                        
                        var resultValue = result.split('&#&#');
                        $('#lab').html(resultValue[0]);
                        $('#pan').html(resultValue[1]); 
                        
                      }
                  });

            console.log();
          });

     $('#pan').change(function(){
            //alert('panch');
            var pan_code = $(this).val();
            var block_code = $('#block_drp').val();
            var dit_code = $('#dist_code').val();
            $('#lab').html('<option value="0">ALL</option>'); 
            if(block_code==undefined)
            {
                block_code = $('#block_drp').val();
            }

            var code_str = pan_code+'_'+block_code+'_'+dit_code;    
           
            
            $.ajax({
                      type: 'GET',
                      url: "https://wqdash.wbphed.gov.in/source/getOnlyVillageAndLab/"+code_str,
                      success: function(result)
                      {
                       
                        var resultValue = result.split('&#&#');
                        $('#lab').html(resultValue[0]);
                        $('#vil').html(resultValue[1]);

                      }
                  });
            console.log();
          });


});



  $("#tabular").click(function(){
        //alert('tabular');
        if($('#WQResultsRosterTestResultPage').val()=="WQResultsRosterTestResult")
        {
          $('#frm1').attr("action", "https://wqdash.wbphed.gov.in/WQResultsRosterTestResult");
        }
        else
        {
                      $('#frm1').attr("action", "https://wqdash.wbphed.gov.in/WQResults");
            
        }
        
        //$("#frm1").
        //return false;
        document.frm1.submit();
  });
 
  $("#summary").click(function(){  
       //alert('summary');      
       
           $('#frm1').attr("action", "https://wqdash.wbphed.gov.in/wq-results-summary");
            document.frm1.submit();
  });
 
 $("#csv1").click(function()
 {
        $('#frm1').attr("action", "https://wqdash.wbphed.gov.in/routine-save");
            document.frm1.submit();
 });
   





    </script>
  <script type="text/javascript">

    function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  }
    
    $(document).ready(function(){
            // $("#dttime").val("L6M");

       
      $("#close").click(function(){
        //alert('aaaa');
        $("#myDropdown").hide();
        //document.getElementById("myDropdown").classList.add("show");
      });

      $(document).on("click", "#edt", function () {
       var id = $(this).data('id');
       var ph = $(this).data('ph_value');
       console.log(ph);
       $("#mpn_value").val( $(this).data('mpn_value') );
       $("#ph_value").val( $(this).data('ph_value') );
       $("#tds_value").val( $(this).data('tds_value') );
       $("#conductivity_value").val( $(this).data('conductivity_value') );
       $("#temp_value").val( $(this).data('temp_value') );
       $("#turbidity_value").val( $(this).data('turbidity_value') );
       $("#residual_chlorine_value").val( $(this).data('residual_chlorine_value') );
       $("#total_alkalinity_value").val( $(this).data('total_alkalinity_value') );
       $("#fluoride_value").val( $(this).data('fluoride_value') );
       $("#nitrate_value").val( $(this).data('nitrate_value') );
       $("#iron_value").val( $(this).data('iron_value') );
       $("#manganese_value").val( $(this).data('manganese_value') );
       $("#total_hardness_value").val( $(this).data('total_hardness_value') );
       $("#arsenic_value").val( $(this).data('arsenic_value') );
       $("#chloride_value").val( $(this).data('chloride_value') );
        var u ='/rtn/update/'+id;
        var url = "https://wqdash.wbphed.gov.in/rtn/update/"+id;

       $("#editUserform").attr('action', url );
   });
       var editor;
       if($(window).width()>800)
          {
            var tb = $('#post').DataTable({
                    
                    "dom": "frtip",
                    "scrollX": true,
                    "bProcessing": true,
                    "paging":false,
                    "searching": false,
                     "language": {
                                  "emptyTable": "Please use filter."
                                 }
                   
                  });

          


          }else{
            var tb = $('#post').DataTable({
                    
                    "scrollX": false,
                    "scrollY": true,
                    "stateDuration": -1,
                    
                    "paging":false,
                    "searching": false,
                    "responsive":true,
                     "language": {
                                  "emptyTable": "Please use filter."
                                 }
                  });
          }
        //tb.column( 11 ).visible( false );  
       $('#post tbody').on( 'click', 'tr', function () {

          $(this).toggleClass('selected');
      } );  
         
       $('#rpt').DataTable({
                    "scrollX": true,
                    "bProcessing": true,
                    "paging":false,
                    "responsive":true,
                    "autoWidth": false,
                     "language": {
                                  "emptyTable": "Please use filter."
                                 }
                  });
                   
       $('#hab').DataTable({
                    "scrollX": true,
                    "bProcessing": true,
                    "paging":true,
                    "responsive":true,
                    "autoWidth": false,
                     "language": {
                                  "emptyTable": "Please use filter."
                                 }
                  }); 
       

//================================ js for column settings ================================

   $(document).ready(function() {
    $("#Hierarchy_col").click(function() {
      //alert('Hierarchy_group');
        var checkBoxes = $("input.Hierarchy_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });
    $("#general_col").click(function() {
      
        var checkBoxes = $("input.general_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    
    $("#Parameters_col").click(function() {
        var checkBoxes = $("input.Parameters_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        var checkBoxes = $("input.Methods_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $("#Methods_col").click(function() {
        var checkBoxes = $("input.Methods_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        var checkBoxes = $("input.Parameters_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });
    $("#Source_col").click(function() {
        var checkBoxes = $("input.Source_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $("#Other_col").click(function() {
        var checkBoxes = $("input.chk");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".district_p").click(function() {
        var checkBoxes = $("input.district_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".block_p").click(function() {
        var checkBoxes = $("input.block_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });


    $(".panchayat_p").click(function() {
        var checkBoxes = $("input.panchayat_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".village_p").click(function() {
        var checkBoxes = $("input.village_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".habitation_p").click(function() {
        var checkBoxes = $("input.habitation_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".specialdrive_p").click(function() {
        var checkBoxes = $("input.specialdrive_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".nameofLaboratory_p").click(function() {
        var checkBoxes = $("input.nameofLaboratory_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".sampleId_p").click(function() {
        var checkBoxes = $("input.sampleId_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".sanitarySurveyScore_p").click(function() {
        var checkBoxes = $("input.sanitarySurveyScore_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".picturePlate_p").click(function() {
        var checkBoxes = $("input.picturePlate_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".sanitarySurveyCategory_p").click(function() {
        var checkBoxes = $("input.sanitarySurveyCategory_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".date_p").click(function() {
        var checkBoxes = $("input.date_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".pH_p").click(function() {
        var checkBoxes = $("input.pH_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".TDS_p").click(function() {
        var checkBoxes = $("input.TDS_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".condunctivity_p").click(function() {
        var checkBoxes = $("input.condunctivity_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".temp_p").click(function() {
        var checkBoxes = $("input.temp_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".turbidity_p").click(function() {
        var checkBoxes = $("input.turbidity_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".residualChlorine_p").click(function() {
        var checkBoxes = $("input.residualChlorine_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".alkalinity_p").click(function() {
        var checkBoxes = $("input.alkalinity_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".flouride_p").click(function() {
        var checkBoxes = $("input.flouride_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".chloride_p").click(function() {
        var checkBoxes = $("input.chloride_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".iron_p").click(function() {
        var checkBoxes = $("input.iron_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".manganese_p").click(function() {
        var checkBoxes = $("input.manganese_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".hardness_p").click(function() {
        var checkBoxes = $("input.hardness_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".arsenic_p").click(function() {
        var checkBoxes = $("input.arsenic_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".bact_p").click(function() {
      //alert('mrphpguru');
        var checkBoxes = $("input.bact_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".locality_p").click(function() {
        var checkBoxes = $("input.locality_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".newLocation_p").click(function() {
        var checkBoxes = $("input.newLocation_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".locationdescription_p").click(function() {
        var checkBoxes = $("input.locationdescription_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".latitude_p").click(function() {
        var checkBoxes = $("input.latitude_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".longitude_p").click(function() {
        var checkBoxes = $("input.longitude_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".sourcecategory_p").click(function() {
        var checkBoxes = $("input.sourcecategory_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".sourcephoto_p").click(function() {
        var checkBoxes = $("input.sourcephoto_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".sourcesite_p").click(function() {
        var checkBoxes = $("input.sourcesite_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".source_type_p").click(function() {
        var checkBoxes = $("input.source_type_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".pipe_water_source_type_p").click(function() {
        var checkBoxes = $("input.pipe_water_source_type_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".saCode_p").click(function() {
        var checkBoxes = $("input.saCode_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".saName_p").click(function() {
        var checkBoxes = $("input.saName_group");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    $(".all_p").click(function() {
        var checkBoxes = $("input.chk");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });

    

    
});

//============= End of the column settings js =================================


      $(".glry").click(function(){
       
        $("#main_img").attr("src",this.src);
      });

      $("#graphical").click(function(){
        //alert('adaad');
       
        if($('#dist_code').val()=="0" && $('#labtype').val()=="ALL" &&  $('#block_drp').val()=="0" && $('#block_drp').val()=="0" && $('#pan').val()=="0" && $('#parameter').val()=="0" )
          {
            if($('#dttime').val()=="0")
            {
             // alert(1);
              $('#frm1').attr("action", "https://wqdash.wbphed.gov.in/getFirstGraphical");
            }else{
             // alert(2);
              $('#frm1').attr("action", "https://wqdash.wbphed.gov.in/getFirstGraphical");
            }
          }else{
            
             $('#frm1').attr("action", "https://wqdash.wbphed.gov.in/routine/graphical");
          }
        //$("#frm1").
        document.frm1.submit();
      });
        
       

     

      

      
     
    });

    $(document).ready(function(){
       $('#dttime').change(function(){
              var val = $(this).val(); 

              if(val=="C")
              {
                $("#daterange").show();
              }else{
                $("#daterange").hide();
              }
              //console.log(val);

            }); 

    });
   

  </script>
           
   

        <script type="text/javascript">
        $(document).ready(function () {
          //alert($(window).width());
          //dtr-inline

           if($(window).width()>800)
          {
            var tbl =$('#antbl').dataTable({
                "searching": false,
                "paging":   false,
          }).api();
          }else{
          var tbl = $('#antbl').DataTable({
                 "searching": false,
                 "responsive":true,
                 "paging":   false,
          });
          }


     


          $(document).on("click", '.trigger_popup_fricc', function(event) { 
              //alert(this.src);

                    $('.hover_bkgr_fricc div p img').attr("src",this.src);
                    
                    $('.hover_bkgr_fricc').show();
               
              
          });
          $('.hover_bkgr_fricc').click(function(){
                    $('.hover_bkgr_fricc').hide();
               });
               $('.popupCloseButton').click(function(){
                    $('.hover_bkgr_fricc').hide();
                });
           $('.hover_bkgr_fricc1').click(function(){
                    $('.hover_bkgr_fricc1').hide();
               });
               $('.popupCloseButton').click(function(){
                    $('.hover_bkgr_fricc1').hide();
                });    

        });

          $( function() {
              var availableTags = [
                                 ];
            $( "#con_name" ).autocomplete({
              source: availableTags
            });

             $(".imgg").click(function(){
               // alert('sasasa');
             });
        });
</script>
  <script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
 /* $( function() {
    var dateToday = new Date();
    var mndate;

   /* $( "#start_date" ).datepicker({ dateFormat: 'dd-mm-yy', minDate: dateToday });
    $( "#end_date" ).datepicker({ dateFormat: 'dd-mm-yy', minDate: dateToday });
    $( "#start_date1" ).datepicker({ dateFormat: 'yy-mm-dd', onSelect: function() {
          $(this).change();
        } 
    });
    $('#start_date1').change(function(){
        mndate=$(this).val();
        //console.log(mndate);
    });
   
    $( "#end_date1" ).datepicker({ dateFormat: 'yy-mm-dd',minDate:mndate, maxDate: 365 });*/


  /*  $("#start_date1").datepicker({
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
    minDate: new Date('01-01-2015'),
    maxDate: 0,
    onSelect: function (dateStr) {
        var min = $(this).datepicker('getDate'); // Get selected date
        //$("#end_date1").datepicker('option', 'minDate', min || '0'); // Set other min, default to today
    },
    beforeShow: function (textbox, instance) {
        var txtBoxOffset = $(this).offset();
        var top = txtBoxOffset.top;
        var left = txtBoxOffset.left;
        var textBoxHeight = $(this).outerHeight();
        setTimeout(function () {
            instance.dpDiv.css({
               top: top-$("#ui-datepicker-div").outerHeight(),
               left: left
            });
        }, 0);
    }
});

$("#end_date1").datepicker({
  dateFormat: 'dd-mm-yy',
    minDate: 0,
    maxDate: 0,
    changeMonth: true,
    changeYear: true,
    onSelect: function (dateStr) {
        var max = $(this).datepicker('getDate'); // Get selected date
        $('#datepicker').datepicker('option', 'maxDate', max || '+1Y+6M'); // Set other max, default to +18 months
        var start = $("#start_date1").datepicker("getDate");
        var end = $("#end_date1").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24);
        
               if(Number(days)>365)
        {
          //alert('Date Range should be in between 365 days');
          $('#err').html('Date Range should be in between 365 days');
          $("#start_date1").val('');
          $("#end_date1").val('');

          return false;
        }
        
        //$("#TextBox3").val(days);
    },
    beforeShow: function (textbox, instance) {
        var txtBoxOffset = $(this).offset();
        var top = txtBoxOffset.top;
        var left = txtBoxOffset.left;
        var textBoxHeight = $(this).outerHeight();
        setTimeout(function () {
            instance.dpDiv.css({
               top: top-$("#ui-datepicker-div").outerHeight(),
               left: left
            });
        }, 0);
    }
});

} );*/

$( function() {

   $("#start_date1").datepicker({
   dateFormat: 'dd-mm-yy',
   changeMonth: true,
   changeYear: true,
   minDate: new Date(2014, 3, 1),
   maxDate: 0,
   onSelect: function (dateStr) {
     var min = $(this).datepicker('getDate'); // Get selected date
     $("#end_date1").datepicker('option', 'minDate', min || '0'); // Set other min, default to today
   },
   beforeShow: function (textbox, instance) {
     var txtBoxOffset = $(this).offset();
     var top = txtBoxOffset.top;
     var left = txtBoxOffset.left;
     var textBoxHeight = $(this).outerHeight();
     setTimeout(function () {
         instance.dpDiv.css({
            top: top-$("#ui-datepicker-div").outerHeight(),
            left: left
         });
     }, 0);
   }
   });
   
   $("#end_date1").datepicker({
   dateFormat: 'dd-mm-yy',
   changeMonth: true,
   changeYear: true,
   minDate: new Date(2014, 3, 1),
   maxDate:  0,
   onSelect: function (dateStr) {
     var max = $(this).datepicker('getDate'); // Get selected date
     $('#datepicker').datepicker('option', 'maxDate', max || '+1Y'); // Set other max, default to +18 months
     var start = $("#start_date1").datepicker("getDate");
     var end = $("#end_date1").datepicker("getDate");
     var days = (end - start) / (1000 * 60 * 60 * 24);
   
       },
   beforeShow: function (textbox, instance) {
     var txtBoxOffset = $(this).offset();
     var top = txtBoxOffset.top;
     var left = txtBoxOffset.left;
     var textBoxHeight = $(this).outerHeight();
     setTimeout(function () {
         instance.dpDiv.css({
            top: top-$("#ui-datepicker-div").outerHeight(),
            left: left
         });
     }, 0);
   }
   });
  });

  </script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      setTimeout(function(){ 
        

       
       },1000);
      

      $('#ps').show('slow');
      $('#ks').show('slow');
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['', 'Percentage',{ role: 'style' }],
          ['Safe', ,'blue'],
          ['Unsafe', ,'red']
        ]);

        var options = {
          title: 'Status (safe or unsafe among )',
          pieHole: 0.4,
          colors: ['blue','red'],
           
           animation:{
              startup:true,
              duration: 10000,
              easing: 'out'
          },
          is3D:true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_all'));

        google.visualization.events.addListener(chart, 'ready', function () {
        
       
      });

        chart.draw(data, options);
      }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart11);

      function drawChart11() {

        var data = google.visualization.arrayToDataTable([
          ['', 'Percentage',{ role: 'style' }],
          ['Safe', ,'blue'],
          ['Unsafe', ,'red']
        ]);

        var options = {
          title: 'Status (safe or unsafe among )',
          pieHole: 0.4,
          colors: ['blue','red'],
           
           animation:{
              startup:true,
              duration: 10000,
              easing: 'out'
          },
          is3D:true,
          sliceVisibilityThreshold: 0.0001,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart);
      function drawColChart() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['', '',{ role: 'style' }],
               ['Safe',,'blue'],
               ['Unsafe',,'red']
            ]);

            var options = {
              title: 'Status (safe or unsafe among Bacteriologial tested)',
               hAxis: {title: 'Number', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.BarChart(document.getElementById('container2'));
            chart.draw(data, options);
         }



     

         google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart32);
      function drawColChart32() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'Arsenic', { role: 'annotation'} ],
               ['2015',  10,10 ],
               ['2016',  15,15 ],
               ['2017',  10,10 ],
               ['2018',  10,10 ],
               ['2019',  10,10],
            ]);

            var options = {
              title: 'Status (Arsenic)',
               hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('grph_pie'));
            chart.draw(data, options);
         }



         google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart39);
      function drawColChart39() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'Sanitary Survey', { role: 'annotation'} ],
               ['2015',  9,9 ],
               ['2016',  0,0 ],
               ['2017',  0,0 ],
               ['2018',  4,4 ],
               ['2019',  6,6],
            ]);

            var options = {
              title: 'Status (Sanitary Survey)',
               hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('grph_sanitary'));
            chart.draw(data, options);
         }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart32);
      function drawColChart32() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Sanitary Survey', { role: 'annotation'} ],
               ['2015',  9,9 ],
               ['2016',  0,0 ],
               ['2017',  0,0 ],
               ['2018',  4,4 ],
               ['2019',  6,6],
            ]);

            var options = {
              title: 'Status (Sanitary Survey)',
               hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('grph_sanitary_pie'));
            chart.draw(data, options);
         }


          google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart3);
      function drawColChart3() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'Arsenic', { role: 'annotation'} ],
               ['2015',  10,10 ],
               ['2016',  15,15 ],
               ['2017',  10,10 ],
               ['2018',  10,10 ],
               ['2019',  10,10],
            ]);

            var options = {
              title: 'Status (Arsenic)',
               hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('grph'));
            chart.draw(data, options);
         }


         google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart2);
      function drawColChart2() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'Bacteriological', { role: 'annotation'} ],
               ['2015',  1,10 ],
               ['2016',  1,15 ],
               ['2017',  2,10 ],
               ['2018',  2.1,10 ],
               ['2019',  1.2,10],
            ]);

            var options = {
              title: 'Status (Bacteriological)',
               hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('grph_bacto'));
            chart.draw(data, options);
         }


          google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart22);
      function drawColChart22() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'Bacteriological', { role: 'annotation'} ],
               ['2015',  1,10 ],
               ['2016',  1,15 ],
               ['2017',  2,10 ],
               ['2018',  2.1,10 ],
               ['2019',  1.2,10],
            ]);

            var options = {
              title: 'Status (Bacteriological)',
               hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('grph_bacto_pie'));
            chart.draw(data, options);
         }





         google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart5);
      function drawColChart5() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'pH', { role: 'annotation'} ],
               ['2015',  766,10 ],
               ['2016',  750,15 ],
               ['2017',  560,10 ],
               ['2018',  619,10 ],
               ['2019',  565,10],
            ]);

            var options = {
              title: 'Status (pH)',
               hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('grph_ph'));
            chart.draw(data, options);
         }
         google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart55);
      function drawColChart55() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'pH', { role: 'annotation'} ],
               ['2015',  7.66,10 ],
               ['2016',  7.50,15 ],
               ['2017',  5.60,10 ],
               ['2018',  6.19,10 ],
               ['2019',  5.65,10],
            ]);

            var options = {
              title: 'Status (pH)',
               hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('grph_ph_pie'));
            chart.draw(data, options);
         }


         google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart6);
      function drawColChart6() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'TDS', { role: 'annotation'} ],
               ['2015',  766,10 ],
               ['2016',  750,15 ],
               ['2017',  560,10 ],
               ['2018',  619,10 ],
               ['2019',  565,10],
            ]);

            var options = {
              title: 'Status (TDS)',
               hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('grph_tds'));
            chart.draw(data, options);
         }

          google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawColChart6);
      function drawColChart6() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Year', 'TDS', { role: 'annotation'} ],
               ['2015',  766,10 ],
               ['2016',  750,15 ],
               ['2017',  560,10 ],
               ['2018',  619,10 ],
               ['2019',  565,10],
            ]);

            var options = {
              title: 'Status (TDS)',
               hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}},
                colors: ['blue','red'],
                is3D:true
          }; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('grph_tds_pie'));
            chart.draw(data, options);
         }
</script>

  <script type="text/javascript">
   
      function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

$(".table-responsive").on('click', function(e) {
  $('.control-sidebar').removeClass('control-sidebar-open');
  $('.control-sidebar').removeClass('control-sidebar-close');
});
$(".row").on('click', function(e) {
  $('.control-sidebar').removeClass('control-sidebar-open');
  $('.control-sidebar').removeClass('control-sidebar-close');
});
$(".navbar").on('click', function(e) {
  $('.control-sidebar').removeClass('control-sidebar-open');
  $('.control-sidebar').removeClass('control-sidebar-close');
});
$(".gear").on('click', function(e) {
  //alert('aaaaa');
  $('.control-sidebar').removeClass('control-sidebar-open');
  $('.control-sidebar').removeClass('control-sidebar-close');
});
</script>
<script>
//modal effect
$(".modal").each(function(l){$(this).on("show.bs.modal",function(l){var o=$(this).attr("data-easein");"shake"==o?$(".modal-dialog").velocity("callout."+o):"pulse"==o?$(".modal-dialog").velocity("callout."+o):"tada"==o?$(".modal-dialog").velocity("callout."+o):"flash"==o?$(".modal-dialog").velocity("callout."+o):"bounce"==o?$(".modal-dialog").velocity("callout."+o):"swing"==o?$(".modal-dialog").velocity("callout."+o):$(".modal-dialog").velocity("transition."+o)})});
 //view more plate pic
 $(document).on('click', '#viewMorePlatePic', function () {
    var rowId = $(this).data("id");
    //console.log(eventId);
    $("loader"+rowId).css("display", "block");
    $.ajax({
      type: "POST",
      url: "https://wqdash.wbphed.gov.in/routine-more-plate-pic",
      data: {
        _token:'S80t8AENGAd2a5DUxNnIqs7EkkkPwZUSwx6RUTUM',
        rowId:rowId
      },
      success: function(response)
      {
      $('.modal-content').html(response);
      // Display Modal
      $('#morePlatePicModal').modal('show'); 
      $("loader"+rowId).css("display", "none");
      }
    });
  })
 /*
 $('#exportSummary').click(function(){
    $('#frm1').submit();
 });
 */
</script>

</body>
</html>