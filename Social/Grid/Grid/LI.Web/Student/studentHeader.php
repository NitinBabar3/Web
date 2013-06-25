<?php
				/*Template for including all student classes */
				
				/*$StudentBusinessPath="../LI.BusinessManagement";
				$UtilityPath="../LI.Utilities";
				function StudentBusinessLayers() 
				{
					include $BusinessPath.'/StudentManagement.php';
					
				}
				spl_autoload_register('StudentBusinessLayers');
				*/
				/*Student include template ends*/
				error_reporting(0);
				session_start();
				include("GlobalVars.php");
				include Utility_Path.'Utilities.php';
				/*Script for Facebook hooking*/
				include('facebook.php');

				$get_vars=Utilities::GetGlobalvars();
				$facebook = new Facebook($get_vars[0], $get_vars[1]);          //Oth loc has API Key and 1st has secret key
				
				//$facebook->require_frame();
				if($_GET["state"]!="")
				{
					$user_id=$_GET["state"];
				}
				else
				{
					$user_id = $facebook->require_login();
				}
				//echo $user_id;
				Utilities::RegisterStudentSession($user_id);
				//print_r($_SESSION["letssession"]);
			    $counter=isset($_SESSION["letssession"]);
			    if(!isset($_SESSION['letssession']))
			    {
					header("Location:PageList.php");
			    }
?><html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">  
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
      <fb:login-button onlogin='window.location="PageList.php";'  autologoutlink="true" v="1" size="medium">Connect to Lets Intern</fb:login-button>
	 
	  </div>
		<div class="nav-collapse pull-right"><ul class="nav">   
		   <li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Account:Basic
						<b class="caret"></b>
				  </a>
				  <ul class="dropdown-menu">
					  <li><a href="#">Upgrade to Premium</a></li>


					  <li class="divider"></li>
					  <li><a href="#">Why Upgrade</a></li>
				  </ul>
			  </li></ul>
			  
		</div>
      <div class="nav-collapse">

     <ul class="nav">
                    <li>
                    <a href="StudentDashboard.php"><i class="icon-home icon-white"></i>  My Dashboard</a>
                    </li>
                    <li><a href="#"><i class="icon-road icon-white"></i> My Career Home</a></li>
                    <li><a href="work_opportunities.php"><i class="icon-briefcase icon-white"></i> My Work</a></li>
                    <li><a href="#"><i class="icon-book icon-white"></i> My Learning</a></li>
                    <li><a href="#"><i class="icon-wrench icon-white"></i> My Settings</a></li>
			
            <li><a href="StudentApplications.php"><i class="icon-headphones icon-white"></i>Student Applications</a></li>  
			  <li><a href="StudentWorkHistory.php"><i class="icon-headphones icon-white"></i>Work History</a></li>  
          <li><a href="#"><i class="icon-headphones icon-white"></i>Lets Talk</a></li>  
    
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
 <tr>
    <td style="padding-left:435px;"><h4 class="box-header round-top"></h4></td>
    <td colspan="2" align="left" style="padding-left:1px;">
	</td>               <!-- FBXML tag for button-->
  </tr>
  <script src="http://static.ak.connect.facebook.com/connect.php/en_US" type="text/javascript"></script>																														<!-- file FOR FBConnect-->
<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script> 
  
<!-- xd_receiver.htm needed for cross domain communication and transfer data btwn facebook and our site
     It enable communication between our site and FB .allows FB.init() -->
 <!--<script language="javascript" src="http://www.socialannex.com/connect_demo_nitin/notborn_fb_connect.js"></script>-->
 <script language="javascript">
 FB.init("265042800264814", "http://dev.letsintern.com/LI.Web/xd_receiver.htm", { permsToRequestOnConnect : "email,offline_access,user_address" });
</script>