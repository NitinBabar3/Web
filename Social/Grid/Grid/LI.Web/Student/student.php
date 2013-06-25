<?php 
	include("GlobalVars.php");
	//die;
	/*Script for Facebook hooking*/
	include('facebook.php');
	include Utility_Path.'Utilities.php';
	include Entity_Path.'Student.php';
	
	$get_vars=Utilities::GetGlobalvars();
	$facebook = new Facebook($get_vars[0], $get_vars[1]);          //Oth loc has API Key and 1st has secret key
	//$facebook->require_frame();
	$user_id = $facebook->require_login();
	
	//$get_data=array('uid, last_name, first_name','contact_email','education_history','relationship_status','sex','work_history');
	$user_details = $facebook->api_client->users_getInfo($user_id, 'uid, last_name, first_name,contact_email,sex,birthday_date');
	
	
	
	//$user_details = $facebook->api_client->users_getInfo($user_id, 'uid', 'last_name', 'first_name','email');
	$user_location = $facebook->api_client->users_getInfo($user_id, 'current_location');
	//$user_education = $facebook->api_client->users_getInfo($user_id, 'education_history');
	//$user_work_history = $facebook->api_client->users_getInfo($user_id, 'work_history');
	
	$fb_user_id = $user_details[0]["uid"];
	$fb_first_name = $user_details[0]["first_name"];
	$fb_last_name =  $user_details[0]["last_name"];
	$user_email=$user_details[0]["contact_email"];
	$fb_sex =  $user_details[0]["sex"];
	$fb_bday =  $user_details[0]["birthday_date"];
	//echo $user_email."-".$fb_bday;
	$user_email =  $user_details[0]["contact_email"];
	
	/* Check to find out existting facebook user*/
	//echo $fb_user_id;
	$fbuser_exists=Utilities :: FBUserExists($fb_user_id);
	//echo "--".$fbuser_exists;die;
	
	$obj_student=new Student();
	$obj_student->FacebookId=$fb_user_id;
	 //$obj_student->Email=$studentdata["Email"];
	 //print_r($obj_student);die;
	Utilities::RegisterStudentSession($obj_student);
	//print_r($_SESSION["letssession"]);die;
	if($fbuser_exists!="0")
	{
		
		header("Location:StudentDashboard.php");
	}
	
	
	//end check
    /*End Script for Facebook hooking*/
	
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">  
	<head>
		<title>Letsintern :: Welcome</title>
		<link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/demos.css">
		<link href="<?php echo ParentPath;?>css/letsintern.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo ParentPath;?>scripts/jquery-1.5.1.js"></script>
        <script src="<?php echo ParentPath;?>scripts/jquery.ui.core.js"></script>
        <script src="<?php echo ParentPath;?>scripts/jquery.ui.widget.js"></script>
        <script src="<?php echo ParentPath;?>scripts/jquery.ui.datepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/jquery-ui.css">
        <!link rel="stylesheet" type="text/css" href="css/demos.css">
        <script type="text/javascript">                                         
				$(function() {
                $("#DOB").datepicker({showOn: 'both'});
                
                });
        </script>
        <style type="text/css">

            .test {
                font-family: cursive;
                font-size: 20px;
            }     

        </style>
		
		<script type="text/javascript">
	function showCollege(str)
	{
	if (str.length==0)
  { 
  document.getElementById("livesearch").innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
	//alert(xmlhttp.responseText);
    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  //alert("GetCollegeList.php?q="+str);
xmlhttp.open("GET","GetColleges.php?q="+str,true);
xmlhttp.send();
	}
	</script>
	<script>
	function SetCollege(college)
	{
		  //alert(college);
		  document.getElementById("College").value=college;
	}
	</script>

	</head>
	<body>
		
	

	<?php include("bootstrap_lib.php");?>
	<div class="">
	<table align="center" colspan="2">
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
		<!--<div style="width:500px; height:auto; font-size:small;">
			<div class="demo">
				<p>Select the date: <input type="text" id="datepicker"></p> 
			</div>
		</div>-->
	</td>
	</tr>	
	</table>
	<!-- outer table -->
	<table cellspacing="0" cellpadding="0" class="outerlogin" align="center">
	  <tr>
		<td>
     
      <!-- Main content section  -->
      <form id="formID" class="formular" method="post" action="student-step-2.php">
      <table border="0" cellspacing="0" cellpadding="0" align="center">
	  
        <tr>
          <td>
          	<table border="0" cellspacing="0" height="29px" width="100%" cellpadding="0" align="left">
              <tr>
              	<td align="right" valign="middle" style="background-image:url(/sureline/img/blue_left_curve.png)">&nbsp;</td>
                <td width="100%" align="center" valign="middle" class="main_menu_bg">		
					&nbsp;&nbsp;<br><br>
					
					   
					  
					<div class="alert alert-block">
					<?php if($_GET["register"]=="") 
					{ ?>  
					  <!--<button type="button" class="close" data-dismiss="alert">�</button>-->
					  <h4>Fetching facebook data..</h4> <br>
						<br><br>Hey <?php echo $fb_first_name; ?>! This is what Facebook told about you..:-)<br>
						If you are not happy,please change it.
					<?php
					} 
					else 
					{
					?>
						 <h4>Welcome to Lets..Your career home from skills to placements</h4> <br>
						
					<?php
					} 
					?>
					</div>
					
				</td>
				<td align="left" valign="middle" style="background-image:url(/sureline/img/blue_right_curve.png);width:550px;">&nbsp;</td>                				
			  </tr>
            </table>
          </td>
        </tr>
		
        <tr>
          <td align="center">
          	<table border="0"  cellspacing="0" cellpadding="0" align="center">
            	<tr>
            		<td align="center">
            			<table border="0" cellspacing="2" cellpadding="2" width="100%">
						
							   <tr>
				               <td colspan="4">&nbsp;</td>
							 </tr>
							 <tr>
				               <td colspan="4">&nbsp;</td>
							 </tr>
							 <tr>
							 <td style="padding-left:200px;" align="left">
									<table border="0" width="200px;">
									<tr>
									 <td valign="top" style="padding-left:25px;">&nbsp;
									 <?php 
									if($_GET["register"]!="")
									 {
									 
									 }
									 else
									 {
									 ?>
									 <img src="http://graph.facebook.com/<?php echo $fb_user_id;?>/picture?type=large"  height="90" width="90" border="0"/>&nbsp;&nbsp;</td>
									 <?php 
									 }
									 ?>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
				                    <td colspan="2">&nbsp;Gender:&nbsp;<input type="text" readonly class="input-mini"  size="6" maxlength="6" name="Gender" id="Gender" value="<?php if($fb_sex!="") {echo $fb_sex; } else {}?>"></td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
				                    <td>&nbsp;Email :&nbsp;<input type="text"  required="required" onfocusout="confirmPass()"  size="10" class="input-medium" maxlength="30"  name="Email" value=""  id="Email" class="validate[required,custom[email]] text-input">
									</td>
				                   </tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									</table>
							 </td>
							 
							 <td style="padding-left:2px;padding-right:100px;" align="left">
									<fieldset>
									<legend><i class="icon-search icon-white"></i><b>This is me<b/></legend>
									<table>
									<tr>
									<td style="padding-left:2px;">&nbsp;<h5>User</h5>:<font color="red">*</font></td>
									<td><input type="text" class="input-small" required="required" onfocusout="confirmPass()" name="Name" id="Name" value="<?php if($fb_first_name!="" && $fb_last_name!="") { echo $fb_first_name." ".$fb_last_name; } else { } ?>" class="validate[required] text-input" ></td>
				            
									</tr>
									
							<tr>
				               <td style="padding-left:5px;">&nbsp;<h5>Mobile</h5>:</td>
							   <td valign="middle"><input type="text" required="required" onfocusout="confirmPass()"  name="MobileNo" id="MobileNo" value=""></td>
				            </tr>
							
							<tr>
				               <td style="padding-left:5px;">&nbsp;<h5>DOB</h5>:<font color="red">*</font></td>
							   <td><input type="text"  class="" name="DOB" id="DOB" required="required" onfocusout="confirmPass()" value=""></td>
				            </tr>
							<tr>
				               <td style="padding-left:2px;">&nbsp;<h5>Location</h5>:<font color="red">*</font></td>
							   <td>
							   
							   <!--<input type="text" value="<?php //echo $user_city;?>" class="validate[required,custom[onlyLetterNumber]] text-input" name="txt_location" id="txt_location">
							   OR -->
							   <?
									$city_list = Utilities::GetListFromTableByParameter('location','CityName');
									sort($city_list);
								    echo "&nbsp;".Utilities::GetHTMLDropdownFromList($city_list, "LocationId");
								
								?><!--<input type="text" id="suggest14" name="LocationId"/>-->
							   </td>
				            </tr>
							<tr>
				               <td style="padding-left:2px;">&nbsp;Pincode :<font color="red">*</font></td>
							   <td><input type="text" value="" required="required" onfocusout="confirmPass()" name="PinCode" id="PinCode" value=""></td>
				            </tr>
									
							
							<tr>
				               <td style="padding-left:5px;">&nbsp;Title :<font color="red">*</font></td>
							   <td><input type="text" required="required" onfocusout="confirmPass()" name="ProfileTitle" id="ProfileTitle"></td>
				            </tr>
				           	<tr>
				               <td style="padding-left:5px;">&nbsp;Job Category:<font color="red">*</font></td>
							   <td>
							    <?
									$job_category_list = Utilities::GetListFromTableByParameter('jobcategory','CategoryName');
									sort($job_category_list);
								    echo "&nbsp;".Utilities::GetHTMLMultipleListFromList($job_category_list, "Category");
                    
								?>
							   </td>
				            </tr>
							
							<tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							<tr>
				               <td style="padding-left:2px;"><h5>Course:</h5><font color="red">*</font></td>
							   <td>
							   <?
									$course_list = Utilities::GetListFromTableByParameter('course','CourseName');
								    sort($course_list);
									echo "&nbsp;".Utilities::GetHTMLDropdownFromList($course_list, "Course");
                    
								?>
							   
							   </td>
				            </tr>
							<tr>
				               <td style="padding-left:2px;">&nbsp;<h5>Specialization</h5>:</td>
							   <td>
							   <?
									$city_list = Utilities::GetListFromTableByParameter('coursespecialization','Name');
									sort($city_list);
								    echo "&nbsp;".Utilities::GetHTMLDropdownFromList($city_list, "coursespecialization");
									
								?>
								
							   </td>
				            </tr>
							<tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							<tr>
				               <td style="padding-left:5px;">&nbsp;College :<font color="red">*</font></td>
							   <td>
							   <div id="MatchedCollege"><input type="text" name="College"  required="required" onfocusout="confirmPass()" id="College" size="50" onkeyup="showCollege(this.value)" /></div>
							   <div id="livesearch"></div>
							   </td>
				            </tr>
							<tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							<tr>
				               <td style="padding-left:5px;">&nbsp;Year :<font color="red">*</font></td>
							   <td>
							    <select name="CurrentYear"  required="required" onfocusout="confirmPass()">
							   <?php ?>
								  <option value="">Select Year</option>
								   <option value="1">First Year</option>
								   <option value="2">Second year</option>
								   <option value="3">Third Year</option>
								   <option value="4">Final Year</option>
								  
								</select>
							   </td>
				            </tr>
							<tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							
							<tr>
				              <td>&nbsp;<input type="hidden" name="UserId" id="UserId" value="<?php echo $fb_user_id;  ?>"></td>

				              <td align="left">
							  <input class="submit" type="submit" value="Done"/>&nbsp;
							  <!--<a href="student-step-2.php">Skip this step</a>-->
							  </td>
				            </tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							  <tr>
				               <td colspan="4">&nbsp;</td>
							 </tr>
							 
									</table>
							 </td>
							 </tr>
							 <tr>
				              
						   </tr> 
							<tr>
				               <td colspan="2" align="right">&nbsp;
							   <div class="alert alert-success">
								  Well done! You successfully created your basic profile.
								</div>
							   </td>
							</tr>
							
				             
							<tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							<tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							
							
							
							
				            
							<tr>
				              <td colspan="10" class="loginbotborder">&nbsp;</td>
				              </tr>
				            <tr>
							   <td>&nbsp;</td>
				              <td align="left" colspan="4" class="logincopyright" >Letsintern.</td>
				            </tr>
				        </table>
						</fieldset>
				     </td>
				  </tr>   
          </table></td>
        </tr>
          
          <!-- Task table -->
          <!-- // Task table -->
		
	      
      </table>
	  </form>
      <!-- // Main content section  --></td>
    
	  </tr>
	</table>
	<script src="http://static.ak.connect.facebook.com/connect.php/en_US" type="text/javascript"></script>																														<!-- file FOR FBConnect-->
	<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script> 
	
  
<!-- xd_receiver.htm needed for cross domain communication and transfer data btwn facebook and our site
     It enable communication between our site and FB .allows FB.init() -->

	<script type="text/javascript">
	 FB.init("265042800264814","http://dev.letsintern.com/LI.Web/xd_receiver.htm");    											<!-- The Api Key Identifies Application to Facebook-->
	</script>
	</div>
	</body>
	</html>