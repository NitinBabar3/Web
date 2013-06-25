<?
	/*if(isset($_POST['Email']) && isset($_POST['Password'])){
		if($_POST['Email'] == 'lidev' && $_POST['Password'] == 'LI@dm!n12'){
			
		} 
		else{
			echo "You're not allowed in here";
			die;
		}
	}*/
	include("GlobalVars.php");
	include Utility_Path."Utilities.php";
	error_reporting(0);
	$user_exists=Utilities::CheckloginBetatester($_POST["txt_first_name"],$_POST["txt_password"]);
	//echo $user_exists;
	
	$TesterID=explode("-",$user_exists);
	
	if($TesterID[1]=="0" || $TesterID[1]=="")
	{
		header("Location:student-signup.php?err=1");
	}
	Utilities::LogBetatesterLogin($TesterID[1]);      //log activity into betatesteractivity table with timestamps
?>
<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">	
	<head>
		<title>Lets Intern Log In Page</title>
		<link href="../css/bootstrap.css" rel="stylesheet" id="main-theme-script">
  		<link href="../css/default.css" rel="stylesheet" id="theme-specific-script">
  		<link href="../css/bootstrap-responsive.css" rel="stylesheet">
  		<!--Validation-->
  		<link href="../css/bootstrap.validate.css" rel="stylesheet" id="main-theme-script">
  		<script src="../scripts/bootstrap.validate.js"></script>
  		
	</head>
	<body>
<!-- Navigation-->		
		<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="#">LetsIntern</a>
     </div>
    </div>
  </div><br/>
<!-- Main body -->
<div class="container">
	<div class = 'row'>
	<div class = "well span5 " >		
		<h4>Employer Pages</h4>
		<a href = '../Employer/Registration.php'>Employer Registration</a><br/>
		<a href = '../Employer/LogIn.php'>Login page</a><br/>
		<a href = '../Employer/iPostNewJob.php'>Job Posting Page</a><br/>
		<a href = '../Employer/iAssignTest.php'>Assign Test</a><br/>
		<a href = '../Employer/CreateTest.php'>Create Test</a><br/>
		<a href = '../Employer/ScreeningTool.php'>Screening Tool</a><br/>		
	</div>
	<div class = "well span5 " >		
		<h4>Student Pages</h4><br>
		<fb:login-button scope='read_stream,publish_stream' onlogin='window.location="student.php";'  autologoutlink="false" v="1" size="medium"></fb:login-button>
		<br/>
		<?php 
		session_start();
		unset($_SESSION['letssession']); //If only one session variable is used
		session_destroy();
		?>
		<br>
		<br/>
	</div>
	</div>
</div>
<script src="http://static.ak.connect.facebook.com/connect.php/en_US" type="text/javascript"></script>																														<!-- file FOR FBConnect-->
<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script> 
  
<!-- xd_receiver.htm needed for cross domain communication and transfer data btwn facebook and our site
     It enable communication between our site and FB .allows FB.init() -->
 <!--<script language="javascript" src="http://www.socialannex.com/connect_demo_nitin/notborn_fb_connect.js"></script>-->
 <script language="javascript">
 FB.init("265042800264814", "http://dev.letsintern.com/xd_receiver.htm", { permsToRequestOnConnect : "email,offline_access,publish_stream" });
</script>
	</body>
</html>