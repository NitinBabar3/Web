<?php

include '../LI.BusinessManagement/EmployerManagement.php';
include '../LI.Entities/Employer.php';
include '../LI.BusinessManagement/JobManagement.php';
include '../LI.Entities/Job.php';
include '../Utilities/Utilities.php';
include '../LI.BusinessManagement/UserManagement.php';
include '../LI.Entities/UserAccount.php';
include '../LI.Entities/JobCard.php';
	$objUserManagement = new UserManagement();
	$objUser = new UserAccount();
	$objUser->Email = $_POST["Email"];
	$objUser->Password = $_POST["Password"];
	$objUser = $objUserManagement->ValidateUser($objUser);
	if ($objUser == "invalid"){
		echo "Sorry mate.. You Ain't allowed in here!";
		die;
	}
else{
	Utilities::RegisterSession($objUser);
	$userId = $_SESSION['letssession'][3];
$objEmployerManagement = new EmployerManagement();
 /*@var $objEmployer Employer */
   
$objEmployer = $objEmployerManagement->GetCompleteEmployerDetails($userId);
$objJobManagement = new JobManagement();
$objJobCardArray = $objJobManagement->GetAllJobsPostedByEmployerByEmployerId($objEmployer->ID);
}
?>

<!DOCTYPE html>
<!-- saved from url=(0050)http://wbpreview.com/previews/WB00958H8/index.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Lets Intern - Employer Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="HTML5 Admin Simplenso Template">
  <meta name="author" content="ahoekie">

  <!-- Bootstrap -->
  <link href="css/bootstrap.css" rel="stylesheet" id="main-theme-script">
  <link href="css/default.css" rel="stylesheet" id="theme-specific-script">
  <link href="css/bootstrap-responsive.css" rel="stylesheet">

  <!-- Full Calender -->
  <link rel="stylesheet" type="text/css" href="css/fullcalendar.css">

  <!-- Bootstrap Date Picker --> 
  <link href="css/datepicker.css" rel="stylesheet">
  
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="css/jquery.fileupload-ui.css">
  
  <!-- Bootstrap Image Gallery styles -->
  <link rel="stylesheet" href="css/bootstrap-image-gallery.min.css">
  
  <!-- Uniform -->
  <link rel="stylesheet" type="text/css" media="screen,projection" href="css/uniform.default.css">
  
  <!-- Chosen multiselect -->
  <link type="text/css" href="css/chosen.intenso.css" rel="stylesheet">   

  <!-- Simplenso -->
  <link href="css/simplenso.css" rel="stylesheet">
  
  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Le fav and touch icons -->
  <link rel="shortcut icon" href="images/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://wbpreview.com/previews/WB00958H8/images/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://wbpreview.com/previews/WB00958H8/images/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://wbpreview.com/previews/WB00958H8/images/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="http://wbpreview.com/previews/WB00958H8/images/ico/apple-touch-icon-57-precomposed.png">
<script type="text/javascript" src="scripts/countries_en.js"></script><link href="css/tooltip.css" rel="stylesheet" type="text/css">
<script src="chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/document_iterator.js"></script>
<script src="chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/find_proxy.js"></script>
<script src="chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/get_html_text.js"></script>
<script src="chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/global_constants.js"></script>
<script src="chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/name_injection_builder.js"></script>
<script src="chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/number_injection_builder.js"></script>
<script src="chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/string_finder.js"></script>
<script src="chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/change_sink.js"></script>
<meta name="document_iterator.js">
<meta name="find_proxy.js">
<meta name="get_html_text.js">
<meta name="global_constants.js">
<meta name="name_injection_builder.js">
<meta name="number_injection_builder.js">
<meta name="string_finder.js">
<meta name="change_sink.js">

</head>
<body id="dashboard">
<!-- Top navigation bar -->
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="#">LetsIntern</a>
      
      <div class="btn-group pull-right">
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
          <i class="icon-user"></i> <?echo $objEmployer->CompanyName;  ?>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Profile</a></li>
         <li><a href="#">Settings</a></li>
          <li class="divider"></li>
          <li><a href="login.html">Logout</a></li>
        </ul>
      </div>
      <div class="nav-collapse pull-right"><ul class="nav">      <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="label label-important">Action Items</span> <span class="label label-info">2</span>
                    <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                  <li><a href="#">Candidates Waiting for Response</a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#">Message from LetsIntern</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Older messages...</a></li>
              </ul>
          </li></ul>
</div>
      <div class="nav-collapse">
        <ul class="nav">
     
          <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      Account Type: <?echo $objEmployer->SubscriptionTypeId;?>
                      <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Upgrade to Premium</a></li>
                                      <li class="divider"></li>
                    <li><a href="#">Plans &amp; Pricing</a></li>
                    <li><a href="#">Why Upgrade?</a></li>

                </ul>
          </li>
          
          <li><a href="#">Help</a></li>  
          
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
<!-- Main Content Area | Side Nav | Content -->    
<div class="container-fluid">
  <div class="row-fluid">
    <!-- Side Navigation -->
    <div class="span2">
      <div class="member-box round-all"> 
        <?echo "<a><img src=\"images/$objEmployer->Logo\" class=\"member-box-avatar\"></a>";?>
        <span>
            <strong><?echo $objEmployer->CompanyName;?></strong><br>
            <a><?echo $objEmployer->CompanyTypeId;?></a><br>
            <span class="member-box-links"><a>Edit Profile</a></span>
        </span>
      </div>          
      <div class="sidebar-nav">
      	<div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list"> 
          <li class="nav-header">Main</li>        
          <li class="active"><a href="#"><i class="icon-home"></i> Dashboard</a></li>
          <li><a href="#"><i class="icon-edit"></i> Reports</a></li>
          <li><a href="#"><i class="icon-user"></i> Account Settings</a></li>
          <!-- <li><a href="#"><i class="icon-comment"></i> Comments</a></li>
          <li><a href="#"><i class="icon-picture"></i> Gallery</a></li>
          <li><a href="#"><i class="icon-calendar"></i> Calendar</a></li> -->
          <li class="nav-header">Work Opportunities</li>
          <li><a href="PostNewJob.php"><i class="icon-edit"></i>Post Job</a></li>
                    <li><a href="#"><i class="icon-certificate"></i>Manage Jobs</a></li>

          <li><a href="#"><i class="icon-briefcase"></i>Screening Tool</a></li>
          <li><a href="#"><i class="icon-barcode"></i>Question Bank</a></li>

          <li class="nav-header">Manage My Interns</li>
          <li><a class="cookie-delete" href="#"><i class="icon-wrench"></i> Current Interns</a></li>
          <li><a class="sidenav-style-1" href="#"><i class="icon-align-left"></i>Prior Interns</a></li>
          <li><a class="sidenav-style-2" href="#"><i class="icon-align-right"></i>Recommend</a></li>

        </ul>
        </div>
      </div><!--/.well -->
    </div><!--/span-->
    
    <!-- Bread Crumb Navigation -->
	<div class="span10">
      <div>
        <ul class="breadcrumb">
          <li>
            <a href="#">Home</a> <!-- <span class="divider">/</span> -->
          </li>
        </ul>
      </div>

      <!-- Geographic Page Visit Map -->
     <!-- <div class="row-fluid">
        <div><div id="dashboard-visit-map" style="width: 926.2px; height: 463.1px; position: relative; "><iframe name="Drawing_Frame_89245" id="Drawing_Frame_89245" width="842" height="421" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div></div></div></div>
      </div> -->
	  
      <div class="row-fluid">
      	 <!-- Portlet Set 1 -->
         <div class="span4 column" id="col1">
         	 <!-- Portlet: Browser Usage Graph -->
             <div class="box" id="box-0">
              <h4 class="box-header round-top">LetsIntern Skill Pool Distribution
                <!--  <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a> -->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                            <div id="dashboard-browser-chart" style="position: relative; "><div dir="ltr"><svg width="299" height="200" style="overflow: hidden; "><defs id="defs"></defs><g><text text-anchor="start" x="57" y="22.5" font-family="Arial" font-size="10" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">Skill Pools</text></g><g><rect x="187" y="38" width="55" height="100" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><rect x="187" y="38" width="55" height="23" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="201" y="46.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Management</text><text text-anchor="start" x="201" y="59.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Social Media</text></g><rect x="187" y="38" width="10" height="10" stroke="none" stroke-width="0" fill="#3366cc"></rect></g><g><rect x="187" y="67" width="55" height="23" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="201" y="75.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Engineering - IT</text><text text-anchor="start" x="201" y="88.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Non IT</text></g><rect x="187" y="67" width="10" height="10" stroke="none" stroke-width="0" fill="#dc3912"></rect></g><g><rect x="187" y="96" width="55" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="201" y="104.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Content Writing</text></g><rect x="187" y="96" width="10" height="10" stroke="none" stroke-width="0" fill="#ff9900"></rect></g><g><rect x="187" y="112" width="55" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="201" y="120.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">NGO</text></g><rect x="187" y="112" width="10" height="10" stroke="none" stroke-width="0" fill="#109618"></rect></g><g><rect x="187" y="128" width="55" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="201" y="136.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Design</text></g><rect x="187" y="128" width="10" height="10" stroke="none" stroke-width="0" fill="#990099"></rect></g></g><g><path d="M114,100L114,43A57,57,0,0,1,128.75268557084368,155.0577720984769L114,100A0,0,0,0,0,114,100" stroke="#ffffff" stroke-width="1" fill="#3366cc"></path><text text-anchor="start" x="130.11143710962384" y="99.40410160098483" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ffffff">45.8%</text></g><g><path d="M114,100L58.94222790152311,114.7526855708437A57,57,0,0,1,114,43L114,100A0,0,0,0,0,114,100" stroke="#ffffff" stroke-width="1" fill="#990099"></path><text text-anchor="start" x="73.79415792470047" y="84.15887712088707" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ffffff">29.2%</text></g><g><path d="M114,100L73.69491347236679,140.30508652763322A57,57,0,0,1,58.94222790152311,114.7526855708437L114,100A0,0,0,0,0,114,100" stroke="#ffffff" stroke-width="1" fill="#109618"></path></g><g><path d="M114,100L99.24731442915632,155.0577720984769A57,57,0,0,1,73.69491347236679,140.30508652763322L114,100A0,0,0,0,0,114,100" stroke="#ffffff" stroke-width="1" fill="#ff9900"></path></g><g><path d="M114,100L128.75268557084368,155.0577720984769A57,57,0,0,1,99.24731442915632,155.0577720984769L114,100A0,0,0,0,0,114,100" stroke="#ffffff" stroke-width="1" fill="#dc3912"></path></g><g></g></svg></div><div></div></div>
                  </div>
              </div>
            </div><!--/span-->
         </div>
         
         <!-- Portlet Set 2 -->
         <div class="span4 column ui-sortable" id="col2">
             <!-- Portlet: Page Visit Graph -->
             <div class="box" id="box-1">
              <h4 class="box-header round-top"><?echo $objEmployer->CompanyName;?> - Talent Pool
                <!--  <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a>-->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
      <div id="dashboard-visit-chart" style="position: relative; "><div dir="ltr"><svg width="349" height="200" style="overflow: hidden; "><defs id="defs"><clippath id="_ABSTRACT_RENDERER_ID_0"><rect x="57" y="38" width="185" height="124"></rect></clippath></defs><g><text text-anchor="start" x="57" y="22.5" font-family="Arial" font-size="10" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">Followers &amp; Talent Pool</text></g><g><rect x="252" y="38" width="37" height="26" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><rect x="252" y="38" width="37" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="266" y="46.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Followers</text></g><rect x="252" y="38" width="10" height="10" stroke="none" stroke-width="0" fill="#3366cc"></rect></g><g><rect x="252" y="54" width="37" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="266" y="62.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Talent</text><rect x="266" y="54" width="23" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect></g><rect x="252" y="54" width="10" height="10" stroke="none" stroke-width="0" fill="#dc3912"></rect></g></g><g><rect x="57" y="38" width="185" height="124" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g clip-path="url(#_ABSTRACT_RENDERER_ID_0)"><g><rect x="57" y="161" width="185" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect><rect x="57" y="130" width="185" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect><rect x="57" y="100" width="185" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect><rect x="57" y="69" width="185" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect><rect x="57" y="38" width="185" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect></g><g><rect x="57" y="161" width="185" height="1" stroke="none" stroke-width="0" fill="#333333"></rect></g><g><path d="M75.9,84.625L112.69999999999999,71.55625L149.5,110.7625L186.29999999999998,82.31875L223.1,59.25625000000001" stroke="#3366cc" stroke-width="2" fill-opacity="1" fill="none"></path><path d="M75.9,130.75L112.69999999999999,126.1375L149.5,75.4L186.29999999999998,119.9875L223.1,119.9875" stroke="#dc3912" stroke-width="2" fill-opacity="1" fill="none"></path></g></g><g></g><g><g><text text-anchor="middle" x="75.9" y="176.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Jan</text></g><g><text text-anchor="middle" x="112.69999999999999" y="176.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Feb</text></g><g><text text-anchor="middle" x="149.5" y="176.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Mar</text></g><g><text text-anchor="middle" x="186.29999999999998" y="176.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Apr</text></g><g><text text-anchor="middle" x="223.1" y="176.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">May</text></g><g><text text-anchor="end" x="47" y="165" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#444444">0</text></g><g><text text-anchor="end" x="47" y="134.25" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#444444">400</text></g><g><text text-anchor="end" x="47" y="103.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#444444">800</text></g><g><text text-anchor="end" x="47" y="72.75" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#444444">1,200</text></g><g><text text-anchor="end" x="47" y="42" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#444444">1,600</text></g></g></g><g></g></svg></div><div></div></div>
                  </div>
              </div>
            </div><!--/span-->
         </div>

      	 <!-- Portlet Set 3 -->
         <div class="span4 column ui-sortable" id="col3">
             <!-- Portlet: Site Activity Gauges -->
             <div class="box" id="box-2">
              <h4 class="box-header round-top">Trending Job Types - August 2012
                  <!--<a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a>-->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                    <div id="dashboard-new-registrations-gauge-chart" style="position: relative; height: 174px; "><table style="border: 0px; padding: 0px; margin: 0px; " cellpadding="2" cellspacing="0" align="center"><tbody><tr style="border: 0px; padding: 0px; margin: 0px; "><td style="border: 0px; padding: 0px; margin: 0px; width: 95px; "><div dir="ltr"><svg width="95" height="95" style="overflow: hidden; "><defs id="defs"></defs><g><circle cx="47" cy="47" r="43" stroke="#333333" stroke-width="1" fill="#cccccc"></circle><circle cx="47" cy="47" r="38" stroke="#e0e0e0" stroke-width="2" fill="#f7f7f7"></circle><path d="M78.91190410538375,34.48876329958696A34,34,0,0,1,79.83592155403522,58.00657780874821L71.75194116552642,55.37993335656115A25.5,25.5,0,0,0,71.05892807903781,37.74157247469021Z" stroke="none" stroke-width="0" fill="#ff9900"></path><path d="M79.83592155403522,58.006577808748204A34,34,0,0,1,71.54163056034261,71.54163056034261L65.53122292025698,65.53122292025694A25.5,25.5,0,0,0,71.75194116552642,55.37993335656116Z" stroke="none" stroke-width="0" fill="#dc3912"></path><text text-anchor="middle" x="47.5" y="39" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#333333">Internships</text><text text-anchor="start" x="30.034462504692275" y="66.71553749530773" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">0</text><text text-anchor="end" x="64.96553749530774" y="66.7155374953077" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">100</text><path d="M21.40921097076478,63.48845608030804L18.510234411960866,65.26495120034227M18.3976706013683,56.9559200278734L15.164078445964783,58.00657780874822M16.994329587766284,49.90084832927206L13.604810653073649,50.16760925474673M17.276736777788784,42.71310536976894L13.918596419765315,42.181228188632154M22.744079972126602,29.513771279850324L19.99342219125178,27.515301422055916M27.626889721096365,24.231577452639062L25.41876635677374,21.64619716959896M33.607890707969865,20.235200359835943L32.0643230088554,17.205778177595494M40.356571866009304,17.74548043583109L39.56285762889922,14.439422706478993M54.64342813399069,17.74548043583109L55.43714237110076,14.439422706478993M61.39210929203013,20.23520035983594L62.93567699114459,17.20577817759549M67.37311027890362,24.231577452639055L69.58123364322626,21.646197169598953M72.25592002787339,29.513771279850314L75.0065778087482,27.515301422055906M77.72326322221122,42.713105369768925L81.08140358023468,42.18122818863214M78.00567041223371,49.90084832927204L81.39518934692636,50.16760925474671M76.6023293986317,56.95592002787338L79.83592155403522,58.006577808748204M73.59078902923524,63.48845608030802L76.48976558803915,65.26495120034224" stroke="#666666" stroke-width="1" fill-opacity="1" fill="none"></path><path d="M28.266695551725906,66.7333044482741L23.458369439657385,71.54163056034261M22.37047671569299,37.09101063966957L16.088095894616245,34.488763299586964M47.49999999999999,20.299999999999997L47.49999999999999,13.5M72.629523284307,37.09101063966956L78.91190410538375,34.48876329958696M66.73330444827411,66.73330444827407L71.54163056034264,71.54163056034258" stroke="#333333" stroke-width="2" fill-opacity="1" fill="none"></path><g><text text-anchor="middle" x="47.5" y="77" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#000000">80</text><path d="M79.10602689904441,42.4940971187126C47.87231402679575,49.850698250616425,37.8092736074465,50.23969377571053,37.623116594048625,49.06434465040231C37.43695958065075,47.888995525094096,47.12768597320425,45.149301749383575,79.10602689904441,42.4940971187126" stroke="#c63310" stroke-width="1" fill-opacity="0.7" fill="#dc3912"></path><circle cx="47" cy="47" r="5" stroke="#666666" stroke-width="1" fill="#4684ee"></circle></g></g></svg></div><div></div></td><td style="border: 0px; padding: 0px; margin: 0px; width: 95px; "><div dir="ltr"><svg width="95" height="95" style="overflow: hidden; "><defs id="defs"></defs><g><circle cx="47" cy="47" r="43" stroke="#333333" stroke-width="1" fill="#cccccc"></circle><circle cx="47" cy="47" r="38" stroke="#e0e0e0" stroke-width="2" fill="#f7f7f7"></circle><path d="M78.91190410538375,34.48876329958696A34,34,0,0,1,79.83592155403522,58.00657780874821L71.75194116552642,55.37993335656115A25.5,25.5,0,0,0,71.05892807903781,37.74157247469021Z" stroke="none" stroke-width="0" fill="#ff9900"></path><path d="M79.83592155403522,58.006577808748204A34,34,0,0,1,71.54163056034261,71.54163056034261L65.53122292025698,65.53122292025694A25.5,25.5,0,0,0,71.75194116552642,55.37993335656116Z" stroke="none" stroke-width="0" fill="#dc3912"></path><text text-anchor="middle" x="47.5" y="39" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#333333">Tasks</text><text text-anchor="start" x="30.034462504692275" y="66.71553749530773" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">0</text><text text-anchor="end" x="64.96553749530774" y="66.7155374953077" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">100</text><path d="M21.40921097076478,63.48845608030804L18.510234411960866,65.26495120034227M18.3976706013683,56.9559200278734L15.164078445964783,58.00657780874822M16.994329587766284,49.90084832927206L13.604810653073649,50.16760925474673M17.276736777788784,42.71310536976894L13.918596419765315,42.181228188632154M22.744079972126602,29.513771279850324L19.99342219125178,27.515301422055916M27.626889721096365,24.231577452639062L25.41876635677374,21.64619716959896M33.607890707969865,20.235200359835943L32.0643230088554,17.205778177595494M40.356571866009304,17.74548043583109L39.56285762889922,14.439422706478993M54.64342813399069,17.74548043583109L55.43714237110076,14.439422706478993M61.39210929203013,20.23520035983594L62.93567699114459,17.20577817759549M67.37311027890362,24.231577452639055L69.58123364322626,21.646197169598953M72.25592002787339,29.513771279850314L75.0065778087482,27.515301422055906M77.72326322221122,42.713105369768925L81.08140358023468,42.18122818863214M78.00567041223371,49.90084832927204L81.39518934692636,50.16760925474671M76.6023293986317,56.95592002787338L79.83592155403522,58.006577808748204M73.59078902923524,63.48845608030802L76.48976558803915,65.26495120034224" stroke="#666666" stroke-width="1" fill-opacity="1" fill="none"></path><path d="M28.266695551725906,66.7333044482741L23.458369439657385,71.54163056034261M22.37047671569299,37.09101063966957L16.088095894616245,34.488763299586964M47.49999999999999,20.299999999999997L47.49999999999999,13.5M72.629523284307,37.09101063966956L78.91190410538375,34.48876329958696M66.73330444827411,66.73330444827407L71.54163056034264,71.54163056034258" stroke="#333333" stroke-width="2" fill-opacity="1" fill="none"></path><g><text text-anchor="middle" x="47.5" y="77" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#000000">55</text><path d="M54.970251643388956,16.384162547274343C49.81424041054647,48.05559996597705,46.32266656671419,57.50149918696529,45.16554636144095,57.223699203976764C44.008426156167715,56.94589922098824,45.18575958945353,46.94440003402295,54.970251643388956,16.384162547274343" stroke="#c63310" stroke-width="1" fill-opacity="0.7" fill="#dc3912"></path><circle cx="47" cy="47" r="5" stroke="#666666" stroke-width="1" fill="#4684ee"></circle></g></g></svg></div><div></div></td><td style="border: 0px; padding: 0px; margin: 0px; width: 95px; "><div dir="ltr"><svg width="95" height="95" style="overflow: hidden; "><defs id="defs"></defs><g><circle cx="47" cy="47" r="43" stroke="#333333" stroke-width="1" fill="#cccccc"></circle><circle cx="47" cy="47" r="38" stroke="#e0e0e0" stroke-width="2" fill="#f7f7f7"></circle><path d="M78.91190410538375,34.48876329958696A34,34,0,0,1,79.83592155403522,58.00657780874821L71.75194116552642,55.37993335656115A25.5,25.5,0,0,0,71.05892807903781,37.74157247469021Z" stroke="none" stroke-width="0" fill="#ff9900"></path><path d="M79.83592155403522,58.006577808748204A34,34,0,0,1,71.54163056034261,71.54163056034261L65.53122292025698,65.53122292025694A25.5,25.5,0,0,0,71.75194116552642,55.37993335656116Z" stroke="none" stroke-width="0" fill="#dc3912"></path><text text-anchor="middle" x="47.5" y="39" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#333333">Brand Ambassador</text><text text-anchor="start" x="30.034462504692275" y="66.71553749530773" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">0</text><text text-anchor="end" x="64.96553749530774" y="66.7155374953077" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">100</text><path d="M21.40921097076478,63.48845608030804L18.510234411960866,65.26495120034227M18.3976706013683,56.9559200278734L15.164078445964783,58.00657780874822M16.994329587766284,49.90084832927206L13.604810653073649,50.16760925474673M17.276736777788784,42.71310536976894L13.918596419765315,42.181228188632154M22.744079972126602,29.513771279850324L19.99342219125178,27.515301422055916M27.626889721096365,24.231577452639062L25.41876635677374,21.64619716959896M33.607890707969865,20.235200359835943L32.0643230088554,17.205778177595494M40.356571866009304,17.74548043583109L39.56285762889922,14.439422706478993M54.64342813399069,17.74548043583109L55.43714237110076,14.439422706478993M61.39210929203013,20.23520035983594L62.93567699114459,17.20577817759549M67.37311027890362,24.231577452639055L69.58123364322626,21.646197169598953M72.25592002787339,29.513771279850314L75.0065778087482,27.515301422055906M77.72326322221122,42.713105369768925L81.08140358023468,42.18122818863214M78.00567041223371,49.90084832927204L81.39518934692636,50.16760925474671M76.6023293986317,56.95592002787338L79.83592155403522,58.006577808748204M73.59078902923524,63.48845608030802L76.48976558803915,65.26495120034224" stroke="#666666" stroke-width="1" fill-opacity="1" fill="none"></path><path d="M28.266695551725906,66.7333044482741L23.458369439657385,71.54163056034261M22.37047671569299,37.09101063966957L16.088095894616245,34.488763299586964M47.49999999999999,20.299999999999997L47.49999999999999,13.5M72.629523284307,37.09101063966956L78.91190410538375,34.48876329958696M66.73330444827411,66.73330444827407L71.54163056034264,71.54163056034258" stroke="#333333" stroke-width="2" fill-opacity="1" fill="none"></path><g><text text-anchor="middle" x="47.5" y="77" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#000000">34</text><path d="M25.594492610281954,24.173003922514837C49.234945333262964,45.87077788788972,55.21294372591837,53.97507521815897,54.34547105928689,54.78968627421411C53.477998392655415,55.604297330269254,45.765054666737036,49.12922211211028,25.594492610281954,24.173003922514837" stroke="#c63310" stroke-width="1" fill-opacity="0.7" fill="#dc3912"></path><circle cx="47" cy="47" r="5" stroke="#666666" stroke-width="1" fill="#4684ee"></circle></g></g></svg></div><div></div></td></tr></tbody></table></div>
                  </div>
              </div>
            </div><!--/span-->
         </div>
      </div>     
      
      
    <!-- <div class="row-fluid">
        <!-- Calendar -- >
        <div class="span12">
         	 <!-- Portlet: Event Calandar (Fixed) -- >
             <div class="box" id="box-0">
              <h4 class="box-header round-top">Event Calendar
                  <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a>
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                    <div id="calendar" class="fc"><table class="fc-header" style="width:100%"><tbody><tr><td class="fc-header-left"><span class="fc-button fc-button-prev fc-state-default fc-corner-left"><span class="fc-button-inner"><span class="fc-button-content">&nbsp;◄&nbsp;</span><span class="fc-button-effect"><span></span></span></span></span><span class="fc-button fc-button-next fc-state-default fc-corner-right"><span class="fc-button-inner"><span class="fc-button-content">&nbsp;►&nbsp;</span><span class="fc-button-effect"><span></span></span></span></span><span class="fc-header-space"></span><span class="fc-button fc-button-today fc-state-default fc-corner-left fc-corner-right fc-state-disabled"><span class="fc-button-inner"><span class="fc-button-content">today</span><span class="fc-button-effect"><span></span></span></span></span></td><td class="fc-header-center"><span class="fc-header-title"><h2>August 2012</h2></span></td><td class="fc-header-right"><span class="fc-button fc-button-month fc-state-default fc-corner-left fc-state-active"><span class="fc-button-inner"><span class="fc-button-content">month</span><span class="fc-button-effect"><span></span></span></span></span><span class="fc-button fc-button-agendaWeek fc-state-default"><span class="fc-button-inner"><span class="fc-button-content">week</span><span class="fc-button-effect"><span></span></span></span></span><span class="fc-button fc-button-agendaDay fc-state-default fc-corner-right"><span class="fc-button-inner"><span class="fc-button-content">day</span><span class="fc-button-effect"><span></span></span></span></span><span class="fc-header-space"></span></td></tr></tbody></table><div class="fc-content" style="position: relative; min-height: 1px; "><div class="fc-view fc-view-month fc-grid" style="position: relative; " unselectable="on"><table class="fc-border-separate" style="width:100%" cellspacing="0"><thead><tr class="fc-first fc-last"><th class="fc-sun fc-widget-header fc-first" style="width: 140px; ">Sun</th><th class="fc-mon fc-widget-header" style="width: 140px; ">Mon</th><th class="fc-tue fc-widget-header" style="width: 140px; ">Tue</th><th class="fc-wed fc-widget-header" style="width: 140px; ">Wed</th><th class="fc-thu fc-widget-header" style="width: 140px; ">Thu</th><th class="fc-fri fc-widget-header" style="width: 140px; ">Fri</th><th class="fc-sat fc-widget-header fc-last">Sat</th></tr></thead><tbody><tr class="fc-week0 fc-first" style=""><td class="fc-sun fc-widget-content fc-day0 fc-first fc-other-month"><div style="min-height: 51px; "><div class="fc-day-number">29</div><div class="fc-day-content"><div style="position: relative; height: 21px; ">&nbsp;</div></div></div></td><td class="fc-mon fc-widget-content fc-day1 fc-other-month"><div><div class="fc-day-number">30</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-tue fc-widget-content fc-day2 fc-other-month"><div><div class="fc-day-number">31</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-wed fc-widget-content fc-day3"><div><div class="fc-day-number">1</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-thu fc-widget-content fc-day4"><div><div class="fc-day-number">2</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-fri fc-widget-content fc-day5"><div><div class="fc-day-number">3</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-sat fc-widget-content fc-day6 fc-last"><div><div class="fc-day-number">4</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td></tr><tr class="fc-week1" style=""><td class="fc-sun fc-widget-content fc-day7 fc-first"><div style="min-height: 50px; "><div class="fc-day-number">5</div><div class="fc-day-content"><div style="position: relative; height: 0px; ">&nbsp;</div></div></div></td><td class="fc-mon fc-widget-content fc-day8"><div><div class="fc-day-number">6</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-tue fc-widget-content fc-day9"><div><div class="fc-day-number">7</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-wed fc-widget-content fc-day10"><div><div class="fc-day-number">8</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-thu fc-widget-content fc-day11"><div><div class="fc-day-number">9</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-fri fc-widget-content fc-day12"><div><div class="fc-day-number">10</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-sat fc-widget-content fc-day13 fc-last"><div><div class="fc-day-number">11</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td></tr><tr class="fc-week2" style=""><td class="fc-sun fc-widget-content fc-day14 fc-first"><div style="min-height: 50px; "><div class="fc-day-number">12</div><div class="fc-day-content"><div style="position: relative; height: 42px; ">&nbsp;</div></div></div></td><td class="fc-mon fc-widget-content fc-day15"><div><div class="fc-day-number">13</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-tue fc-widget-content fc-day16"><div><div class="fc-day-number">14</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-wed fc-widget-content fc-day17"><div><div class="fc-day-number">15</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-thu fc-widget-content fc-day18"><div><div class="fc-day-number">16</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-fri fc-widget-content fc-day19"><div><div class="fc-day-number">17</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-sat fc-widget-content fc-day20 fc-last"><div><div class="fc-day-number">18</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td></tr><tr class="fc-week3" style=""><td class="fc-sun fc-widget-content fc-day21 fc-first"><div style="min-height: 50px; "><div class="fc-day-number">19</div><div class="fc-day-content"><div style="position: relative; height: 42px; ">&nbsp;</div></div></div></td><td class="fc-mon fc-widget-content fc-day22"><div><div class="fc-day-number">20</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-tue fc-widget-content fc-day23 fc-state-highlight fc-today"><div><div class="fc-day-number">21</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-wed fc-widget-content fc-day24"><div><div class="fc-day-number">22</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-thu fc-widget-content fc-day25"><div><div class="fc-day-number">23</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-fri fc-widget-content fc-day26"><div><div class="fc-day-number">24</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-sat fc-widget-content fc-day27 fc-last"><div><div class="fc-day-number">25</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td></tr><tr class="fc-week4" style=""><td class="fc-sun fc-widget-content fc-day28 fc-first"><div style="min-height: 50px; "><div class="fc-day-number">26</div><div class="fc-day-content"><div style="position: relative; height: 21px; ">&nbsp;</div></div></div></td><td class="fc-mon fc-widget-content fc-day29"><div><div class="fc-day-number">27</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-tue fc-widget-content fc-day30"><div><div class="fc-day-number">28</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-wed fc-widget-content fc-day31"><div><div class="fc-day-number">29</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-thu fc-widget-content fc-day32"><div><div class="fc-day-number">30</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-fri fc-widget-content fc-day33"><div><div class="fc-day-number">31</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-sat fc-widget-content fc-day34 fc-last fc-other-month"><div><div class="fc-day-number">1</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td></tr><tr class="fc-week5 fc-last" style=""><td class="fc-sun fc-widget-content fc-day35 fc-first fc-other-month"><div style="min-height: 54px; "><div class="fc-day-number">2</div><div class="fc-day-content"><div style="position: relative; height: 0px; ">&nbsp;</div></div></div></td><td class="fc-mon fc-widget-content fc-day36 fc-other-month"><div><div class="fc-day-number">3</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-tue fc-widget-content fc-day37 fc-other-month"><div><div class="fc-day-number">4</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-wed fc-widget-content fc-day38 fc-other-month"><div><div class="fc-day-number">5</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-thu fc-widget-content fc-day39 fc-other-month"><div><div class="fc-day-number">6</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-fri fc-widget-content fc-day40 fc-other-month"><div><div class="fc-day-number">7</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-sat fc-widget-content fc-day41 fc-last fc-other-month"><div><div class="fc-day-number">8</div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td></tr></tbody></table><div style="position:absolute;z-index:8;top:0;left:0"><div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right" style="position: absolute; z-index: 8; left: 425.99998474121094px; width: 134px; top: 53px; "><div class="fc-event-inner fc-event-skin"><span class="fc-event-title">All Day Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left" style="position: absolute; z-index: 8; left: 566.9999847412109px; width: 424.00001525878906px; top: 156px; "><div class="fc-event-inner fc-event-skin"><span class="fc-event-title">Long Event</span></div></div><div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right" style="position: absolute; z-index: 8; left: 849.0000457763672px; width: 137px; top: 177px; "><div class="fc-event-inner fc-event-skin"><span class="fc-event-time">4p</span><span class="fc-event-title">Repeating Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-right" style="position: absolute; z-index: 8; left: 0px; width: 138px; top: 220px; "><div class="fc-event-inner fc-event-skin"><span class="fc-event-title">Long Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right" style="position: absolute; z-index: 8; left: 284.99998474121094px; width: 134px; top: 220px; "><div class="fc-event-inner fc-event-skin"><span class="fc-event-time">10:30a</span><span class="fc-event-title">Meeting</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right" style="position: absolute; z-index: 8; left: 849.0000457763672px; width: 137px; top: 220px; "><div class="fc-event-inner fc-event-skin"><span class="fc-event-time">4p</span><span class="fc-event-title">Repeating Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right" style="position: absolute; z-index: 8; left: 425.99998474121094px; width: 134px; top: 220px; "><div class="fc-event-inner fc-event-skin"><span class="fc-event-time">7p</span><span class="fc-event-title">Birthday Party</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right" style="position: absolute; z-index: 8; left: 284.99998474121094px; width: 134px; top: 241px; "><div class="fc-event-inner fc-event-skin"><span class="fc-event-time">12p</span><span class="fc-event-title">Lunch</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><a href="http://google.com/" class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right" style="position: absolute; z-index: 8; left: 284.99998474121094px; width: 275px; top: 284px; "><div class="fc-event-inner fc-event-skin"><span class="fc-event-title">Click for Google</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></a></div></div></div></div>
                  </div>
              </div>
            </div><!--/span-- >
         </div>
      </div> -->

	  <div class="row-fluid">
         <!-- Portlet Set 4 -->
         <div class="span4 column ui-sortable" id="col4">
             <!-- Portlet: Site Activity Gauges -->
             <div class="box" id="box-3">
              <h4 class="box-header round-top">Existing Students
                 <!-- <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a> -->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                    <ul class="dashboard-member-activity">
                      <li>
                        <a href="#">
                          <img src="images/member_ph.png" class="dashboard-member-activity-avatar"></a>
                          <strong><a href="#">Rahul Kumar
                          </a></strong> <br>
                          Marketing Intern<br>
                          <strong>Status:</strong> <span class="label label-success">Working</span>

                        
                      </li>
                      <li>
                        <a href="#">
<img src="images/member_ph.png" class="dashboard-member-activity-avatar"></a>
                          <strong><a href="#">Prasad Venkat
                          </a></strong> <br>
                          Scial Media Intern<br>
                          <strong>Status:</strong> <span class="label label-warning">Assignment Ended</span>                        
                      </li>
                      <li>
                        <a href="#">
<img src="images/member_ph.png" class="dashboard-member-activity-avatar"></a>
                          <strong><a href="#">Tiger Khan
                          </a></strong> <br>
                          Volunteer<br>
                          <strong>Status:</strong> <span class="label label-info">Declined Offer</span>                        
                        
                      </li>
                    </ul>
                  </div>
              </div>
            </div><!--/span-->
         </div>
         
         <!-- Portlet Set 5 -->
         <div class="span4 column ui-sortable" id="col5">
             <!-- Portlet: Site Activity Gauges -->
             <div class="box" id="box-4">
              <h4 class="box-header round-top">Activity Statistics
<!--                  <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a>-->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                    <ul class="dashboard-statistics">
                      <li>
                        <a href="#">
                          <i class="icon-arrow-up"></i>                               
                          <span class="green">10</span>
                          Ongoing Internships                                    
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="icon-arrow-down"></i>
                          <span class="red">12</span>
                          Open Tasks
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="icon-minus"></i>
                          <span class="blue">34</span>
                          Open Jobs                                    
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="icon-fire"></i>
                          <span class="yellow">420</span>
                          Followers                        
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="icon-arrow-up"></i>                               
                          <span class="green">120</span>
                          Talent Pool Members                           
                        </a>
                      </li>
                   
                    </ul>
                  </div>
              </div>
            </div><!--/span-->
        </div>    
        <!-- Portlet Set 6 -->
		<div class="span4 column ui-sortable" id="col6">
             <!-- Portlet: Site Activity Gauges -->
             <div class="box" id="box-5">
              <h4 class="box-header round-top">Lets Connect
                 <!-- <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a> -->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                    <ul class="dashboard-member-activity">
                      <li>
                        <a href="#">
                          <img src="images/member_ph.png" class="dashboard-member-activity-avatar">
                          <span class="blue">Message by <strong>Rajesh Nambiar</strong> on 21/07/2012</span></a>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean bibendum, est at congue gravida...</p>                                
                        
                      </li>
                      <li>
                        <a href="#">
                          <img src="images/member_ph.png" class="dashboard-member-activity-avatar">
                          <span class="blue">Message by <strong>LetsIntern</strong> on 21/07/2012</span></a>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean bibendum, est at congue gravida...</p>                                
                        
                      </li>
                    </ul>
                  </div>
              </div>
            </div><!--/span-->
         </div>
      </div>         
        
	  <!-- Table -->
      <div class="row-fluid">
      
        <div class="span12">
         	 <!-- Portlet: Browser Usage Graph -->
             <div class="box" id="box-0">
              <h4 class="box-header round-top">Recent Jobs
               <!--   <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a> -->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                     <div id="datatable_wrapper" class="dataTables_wrapper" role="grid"><div class="row-fluid"><div class="span6"><div id="datatable_length" class="dataTables_length"><label><select size="1" name="datatable_length" aria-controls="datatable"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records per page</label></div></div><div class="span6"><div class="dataTables_filter" id="datatable_filter"><label>Search: <input type="text" aria-controls="datatable"></label></div></div></div><table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered bootstrap-datatable dataTable" id="datatable" aria-describedby="datatable_info">
                          <thead>
                              <tr role="row">
								  <th class="header headerSortDown" role="columnheader" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 174px; height: 34px;" aria-sort="ascending" aria-label="Job Title: activate to sort column descending">
								  Job Title</th>
								  <th class="header" role="columnheader" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 172px; height: 34px;" aria-label="Date registered: activate to sort column ascending">
								  Application Deadline</th>
								  <th class="header" role="columnheader" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 89px; height: 34px;" aria-label="Role: activate to sort column ascending">Role</th>
								  <th class="header" role="columnheader" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 99px; height: 34px;" aria-label="Status: activate to sort column ascending">Status</th>
								  <th class="header" role="columnheader" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 371px; height: 34px;" aria-label="Actions: activate to sort column ascending">Actions</th></tr>
                          </thead>
                             
                      <?  
                      //Recent jobs (no pagination)
                      $i=0;
                      foreach($objJobCardArray as $tempJobCard){
                      	
                        if( ($i++) % 2)
                        	$class = "even";
							                                      
						else
							$class = "odd";
						     
                      	echo "<tbody role=\"alert\" aria-live=\"polite\" aria-relevant=\"all\"><tr class=\"$class\">
                                <td class=\"sorting_1\">$tempJobCard->Title</td>
                                <td class=\"center\">$tempJobCard->ApplicationDeadline</td>
                                <td class=\"center \">$tempJobCard->FunctionString</td>
                                <td class=\"center\">
                                    <span class=\"label\">$tempJobCard->Status</span>
                                </td>
                                <td class=\"center\">
                                    <a class=\"btn btn-success\" href=\"#\">
                                        <i class=\"icon-zoom-in icon-white\"></i>  
                                        View                                            
                                    </a>
                                    <form method='post' action='EditJob.php'><input type='hidden' name=\"jobID\" value='$tempJobCard->ID'/><button class=\"btn btn-info\" type=\"submit\"><i class=\"icon-edit icon-white\"></i>Edit</button></form>                                                                               
                                    
                                    <a class=\"btn btn-danger\" href=\"#\">
                                        <i class=\"icon-trash icon-white\"></i> 
                                        Close
                                    </a>
                                    

                                </td>";
                           }
                            /*</tr><tr class="odd">
                                <td class="  sorting_1">Social Media Marketing</td>
                                <td class="center ">2011/02/01</td>
                                <td class="center ">Admin</td>
                                <td class="center ">
                                    <span class="label">Closed</span>
                                </td>
                                <td class="center ">
                                    <a class="btn btn-success" href="#">
                                        <i class="icon-zoom-in icon-white"></i>  
                                        View                                            
                                    </a>
                                    <a class="btn btn-info" href="#">
                                        <i class="icon-edit icon-white"></i>  
                                        Edit                                            
                                    </a>
                                    <a class="btn btn-danger" href="#">
                                        <i class="icon-trash icon-white"></i> 
                                        Delete
                                    </a>
                                </td>
                            </tr><tr class="even">
                                <td class="  sorting_1">Graphic Design Internship</td>
                                <td class="center ">2010/01/21</td>
                                <td class="center ">Staff</td>
                                <td class="center ">
                                    <span class="label label-success">Active</span>
                                </td>
                                <td class="center ">
                                    <a class="btn btn-success" href="#">
                                        <i class="icon-zoom-in icon-white"></i>  
                                        View                                            
                                    </a>
                                    <a class="btn btn-info" href="#">
                                        <i class="icon-edit icon-white"></i>  
                                        Edit                                            
                                    </a>
                                    <a class="btn btn-danger" href="#">
                                                                            <i class="icon-trash icon-white"></i> 
                                        Delete
                                    </a><a class="btn btn-inverse" href="#">
                                        <i class="icon-arrow-right icon-white"></i> 
                                        Start Screening
                                    </a>
                                </td>*/
                            echo "</tr></tbody></table><div class=\"row-fluid\"><div class=\"span6\"><div class=\"dataTables_info\" id=\"datatable_info\">Showing 1 to 10 of 16 entries</div></div><div class=\"span6\"><div class=\"dataTables_paginate paging_bootstrap pagination\"><ul><li class=\"prev disabled\"><a href=\"#\">← Previous</a></li><li class=\"active\"><a href=\"#\">1</a></li><li><a href=\"#\">2</a></li><li class=\"next\"><a href=\"#\">Next → </a></li></ul></div></div></div></div>";
                            ?>            
                  </div>
              </div>
            </div><!--/span-->
         </div>
      </div>  
 
    </div><!--/span-->
  </div><!--/row-->

  <footer>
    <p>© LetsIntern Career Services Pvt. Ltd.&nbsp; 2012</p>
  </footer>
    <div id="box-config-modal" class="modal hide fade in" style="display: none;">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Adjust widget</h3>
      </div>
      <div class="modal-body">
        <p>This part can be customized to set box content specifix settings!</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">Save Changes</a>
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
      </div>
    </div>
</div><!--/.fluid-container-->
	<!-- javascript Templates
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->    
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Google API -->
    <script type="text/javascript" src="scripts/jsapi"></script>
     
    <!-- jQuery -->
    <script src="scripts/jquery.min.js"></script>
    
    <!-- Data Tables -->
    <script src="scripts/jquery.dataTables.js"></script>
    
    <!-- jQuery UI Sortable -->
    <script src="scripts/jquery.ui.core.min.js"></script>
	<script src="scripts/jquery.ui.widget.min.js"></script>
	<script src="scripts/jquery.ui.mouse.min.js"></script>
	<script src="scripts/jquery.ui.sortable.min.js"></script>
    <script src="scripts/jquery.ui.widget.min.js"></script>
    
    <!-- jQuery UI Draggable & droppable -->
    <script src="scripts/jquery.ui.draggable.min.js"></script>
    <script src="scripts/jquery.ui.droppable.min.js"></script>

    <!-- Bootstrap -->
    <script src="scripts/bootstrap.min.js"></script>
    <script src="scripts/bootbox.min.js"></script>

	<!-- Bootstrap Date Picker -->
    <script src="scripts/bootstrap-datepicker.js"></script>

		
    <!-- jQuery Cookie -->    
    <script src="scripts/jquery.cookie.js"></script>
    
    <!-- Full Calender -->
    <script type="text/javascript" src="scripts/fullcalendar.min.js"></script>
    
    <!-- CK Editor -->
	<script type="text/javascript" src="scripts/ckeditor.js"></script>
	<script type="text/javascript" src="scripts/jquery.js"></script>
    
    <!-- Chosen multiselect -->
    <script type="text/javascript" language="javascript" src="scripts/chosen.jquery.min.js"></script>  
    
    <!-- Uniform -->
    <script type="text/javascript" language="javascript" src="scripts/jquery.uniform.min.js"></script>
    
    <!-- MultiFile Upload -->
    <!-- Error messages for the upload/download templates -->
	<script>
    var fileUploadErrors = {
        maxFileSize: 'File is too big',
        minFileSize: 'File is too small',
        acceptFileTypes: 'Filetype not allowed',
        maxNumberOfFiles: 'Max number of files exceeded',
        uploadedBytes: 'Uploaded bytes exceed file size',
        emptyResult: 'Empty file upload result'
    };
    </script>
    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/html">
    {% for (var i=0, files=o.files, l=files.length, file=files[0]; i<l; file=files[++i]) { %}
        <tr class="template-upload fade">
            <td class="preview"><span class="fade"></span></td>
            <td class="name">{%=file.name%}</td>
            <td class="size">{%=o.formatFileSize(file.size)%}</td>
            {% if (file.error) { %}
                <td class="error" colspan="2"><span class="label label-important">Error</span> {%=fileUploadErrors[file.error] || file.error%}</td>
            {% } else if (o.files.valid && !i) { %}
                <td>
                    <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
                </td>
                <td class="start">{% if (!o.options.autoUpload) { %}
                    <button class="btn btn-primary">
                        <i class="icon-upload icon-white"></i> Start
                    </button>
                {% } %}</td>
            {% } else { %}
                <td colspan="2"></td>
            {% } %}
            <td class="cancel">{% if (!i) { %}
                <button class="btn btn-warning">
                    <i class="icon-ban-circle icon-white"></i> Cancel
                </button>
            {% } %}</td>
        </tr>
    {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/html">
    {% for (var i=0, files=o.files, l=files.length, file=files[0]; i<l; file=files[++i]) { %}
        <tr class="template-download fade">
            {% if (file.error) { %}
                <td></td>
                <td class="name">{%=file.name%}</td>
                <td class="size">{%=o.formatFileSize(file.size)%}</td>
                <td class="error" colspan="2"><span class="label label-important">Error</span> {%=fileUploadErrors[file.error] || file.error%}</td>
            {% } else { %}
                <td class="preview">{% if (file.thumbnail_url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery"><img src="{%=file.thumbnail_url%}"></a>
                {% } %}</td>
                <td class="name">
                    <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}">{%=file.name%}</a>
                </td>
                <td class="size">{%=o.formatFileSize(file.size)%}</td>
                <td colspan="2"></td>
            {% } %}
            <td class="delete">
                <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                    <i class="icon-trash icon-white"></i> Delete
                </button>
                <input type="checkbox" name="delete" value="1">
            </td>
        </tr>
    {% } %}
    </script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="scripts/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="scripts/load-image.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="scripts/canvas-to-blob.min.js"></script>
    <script src="scripts/bootstrap-image-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="scripts/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
	<script src="scripts/jquery.fileupload.js"></script>
    <!-- The File Upload image processing plugin -->
    <script src="scripts/jquery.fileupload-ip.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="scripts/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="scripts/main.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
    <!--[if gte IE 8]><script src="scripts/blueimp-jQuery-File-Upload/js/cors/jquery.xdr-transport.js"></script><![endif]-->
    
    <!-- Simplenso scripts -->
    <script src="scripts/simplenso.js"></script><script src="scripts/saved_resource" type="text/javascript"></script><script src="scripts/format+en,default,geochart.I.js" type="text/javascript"></script><script src="scripts/saved_resource(1)" type="text/javascript"></script><script src="scripts/corechart.js" type="text/javascript"></script><script src="scripts/saved_resource(2)" type="text/javascript"></script><script src="scripts/gauge.js" type="text/javascript"></script>
  
<div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">FireFox</div><div style="position: absolute; display: none; "><div style="background-color: infobackground; padding: 1px; border: 1px solid infotext; font-size: 10px; margin: 10px; font-family: Arial; background-position: initial initial; background-repeat: initial initial; ">Unique</div></div><div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">Un...</div></body><span id="skype_highlighting_settings" display="none" autoextractnumbers="1"></span><object id="skype_plugin_object" location.href="http://wbpreview.com/previews/WB00958H8/index.html" location.hostname="wbpreview.com" style="position: absolute; visibility: hidden; left: -100px; top: -100px; " width="0" height="0" type="application/x-vnd.skype.click2call.chrome.5.7.0"></object>
</html>
