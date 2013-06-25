<?php 
	include("GlobalVars.php");
	error_reporting(0);
	include Utility_Path.'Utilities.php';
	include Entity_Path.'Preferences.php';
	include Entity_Path.'UserAccount.php';
	include Business_Path.'StudentManagement.php'; 
	//echo $_POST["LocationId"];
	/*Script invocation to business layer using objects to layers*/
	$objStudent= new Student();					        //Entity class instance
	$objStudent->FacebookId=$_POST["UserId"];	
	$objStudent->Name=$_POST["Name"];	
	$objStudent->Email=$_POST["Email"];
	$objStudent->LocationId=$_POST["LocationId"];
	$objStudent->CurrentYear=$_POST["CurrentYear"];
	$objStudent->DOB=$_POST["DOB"];
	//echo $_POST["DOB"];
	$objStudent->Gender=$_POST["Gender"];
	$objStudent->MobileNo=$_POST["MobileNo"];
	$objStudent->PinCode=$_POST["PinCode"];
	$objStudent->ProfileTitle=$_POST["ProfileTitle"];	
	$objStudent->CollegeId=$_POST["College"];
	$objStudent->PictureTypeID="1";
	$objStudent->CurrentCourseId=$_POST["Course"];
	$student_categories=implode(",",$_POST["Category"]);
	$objStudent->Status="1";
	$objStudent->JobCategory=$student_categories;
	$objStudent->UpdatedOn=date("Y-m-d h:i:s");
	$objStudent->UpdateBy=$_POST["Name"];
	$objuser= new UserAccount();		
	//$objuser->ID=$_POST["UserId"];
	$objuser->UserTypeId="1";
	$objuser->Email=$_POST["Email"];
	$objuser->LastLogin=date("Y m d h:i:s");
	//print_r($objStudent);die;
	$objStudentcall= new StudentManagement();				  //Object of business layer
	$objStudentcall->register_student($objStudent);  //method of business layer with object data passed
	
	$objusercall= new StudentManagement();				     //Object of business layer
	$objusercall->InsertNewUser($objuser);  		//method of business layer with object data passed
	
	
	/*Script invocation to business layer using objects to layers*/
	$objpreferences= new Preferences();					        //Entity class instance
	$objpreferences->UserID=$_POST["UserId"];	
	Utilities::RegisterStudentSession($_POST["UserId"]);
	$category=implode(",",$_POST["Category"]);
	
	//$location=implode(",",$_POST["location"]);
	//$type=implode(",",$_POST["Type"]);
	
	$objpreferences->JobCategoryID=$category;	

	$objpreferences->LocationIDString=$_POST["location"];	
	//$objpreferences->JobTypeID=$type;	
	$objpreferences->AddedOn=date("Y-m-d h:i:s");	
	$objpreferences->UpdatedOn=date("Y-m-d h:i:s");
	$objStudentpreferences= new StudentManagement();		
	$objStudentpreferences->register_student_preferences($objpreferences);  //method of business layer with object data passed

	$obj= new Student();					        //Entity class instance
	
	$obj->Email=$_POST["Email"];
	Utilities::RegisterSession($obj);
	if($_SESSION["letssession"]=="")
	{
		header("Location:facebook_demo.php");
	}
	
	
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
        
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <!link rel="stylesheet" type="text/css" href="css/demos.css">
                
        <script type="text/javascript">                                         
          
               
                $(function() {
                $("#datepicker1").datepicker({showOn: 'both'});
                $("#datepicker2").datepicker({showOn: 'both'});
                $("#datepicker3").datepicker({showOn: 'both'});
                });
             
        </script>
        <style type="text/css">

            .test {
                font-family: cursive;
                font-size: 20px;
            }     

        </style>
		<script>
		var skill_set=[];
		// The following code should be stored in the HTML head section
			function disp_text()
			{
				//alert("hi");
				var w = document.formID.skills.selectedIndex;
				var selected_text = document.formID.skills.options[w].text;
				//alert(selected_text);
				skill_set.push(selected_text);
				if(skill_set.length==4)
				{
					alert("Maximum skills added.Proceed.");
				}
				else
				{
					document.getElementById("add_skills").value=skill_set+"\n";
					document.formID.skills.options[w].disabled="true";
				}
		   }
		   
		</script>
		<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
		<!--<link rel="stylesheet" href="css/template.css" type="text/css"/>-->
		<script src="<?php echo ParentPath;?>scripts/jquery-1.7.2.min.js" type="text/javascript">
		</script>
		<script src="<?php echo ParentPath;?>scripts/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
		</script>
		<script src="<?php echo ParentPath;?>scripts/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
		</script>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine();
		});

		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	</script>
		
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=308043509284541";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>	
		
	
	</head>
	<body>
	<?php include("bootstrap_lib.php");?>
	
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
	</table>
	<!-- outer table -->
<table cellspacing="0" cellpadding="0" class="outerlogin" align="center">
  <tr>
    <td>
     
      <!-- Main content section  -->
      <form id="formID" name="formID" class="formular" method="post" action="studentCompletion.php">
      <table border="0" cellspacing="0" cellpadding="0" align="center">
	  
        <tr>
          <td>
          	<table border="0" cellspacing="0" height="29px" width="100%" cellpadding="0" align="left">
              <tr>
              	<td align="right" valign="middle">&nbsp;</td>
                <td width="100%" align="center" valign="middle" class="main_menu_bg">		
					&nbsp;&nbsp;<br><br>
					Good !! Just some more details & we are ready..
					
				</td>
				<td align="left" valign="middle">&nbsp;</td>                				
			  </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td align="center">
          	<table border="0" cellspacing="0" cellpadding="0" align="center">
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
							 <td style="padding-left:100px;" align="left">
									<table border="0" width="200px;">
									<tr>
									 <td valign="top" style="padding-left:25px;">&nbsp;
									 <img src="http://graph.facebook.com/<?php echo $_POST["UserId"];?>/picture?type=large"  height="90" width="90" border="0"/>&nbsp;&nbsp;
									 <input type="hidden" name="UserID" value="<?php echo $_POST["UserId"];?>">
									 </td>
									</tr>
									<tr>
				                    <td style="padding-left:25px;"><?php echo $_POST["Name"]; ?><input type="hidden" name="UserName" value="<?php echo $_POST["Name"]; ?>"></td>
				                    </tr>
									<tr>
				                    <td style="padding-left:25px;"><?php echo $_POST["Gender"]; ?><input type="hidden" name="UserGender" value="<?php echo $_POST["Gender"]; ?>"></td>
				                    </tr>
									<tr>
				                    <td style="padding-left:25px;"><?php echo $_POST["Email"]; ?><input type="hidden" name="UserEmail" value="<?php echo $_POST["Email"]; ?>"></td>
				                    </tr>
									<tr>
										<td>&nbsp;<input type="hidden" name="CollegeId" value="<?php echo $_POST["CollegeId"]; ?>"></td>
									</tr>
									<tr>
										<td>&nbsp;<input type="hidden" name="CurrentYear" value="<?php echo $_POST["CurrentYear"]; ?>"></td>
									</tr>
									
									 <tr>
										<td>&nbsp;<input type="hidden" name="UserCourse" value="<?php echo $_POST["Course"]; ?>"></td>
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
							 
							 <td style="padding-left:5px;padding-right:105px;" align="left">
									
									<table>
									<tr>
								    <td colspan="4">&nbsp;
								    
							   
							</tr>
							<tr>
				               <td colspan="10">&nbsp;
							   <form name="test">
							   <legend><h5>Key Skills * (only 3)</h5></legend>
							    <?	
									$skills_list = Utilities::GetListFromTableByParameter('skills','SkillName');
									sort($$skills_list);
								    echo "&nbsp;".Utilities::GetHTMLJavascriptMultipleListFromList($skills_list, "skills");
								?>
								
								<textarea name="add_skills" required="required" onfocusout="confirmPass()" id="add_skills" rows="4" cols="14"></textarea> 
								
							   </form>
							   
							</tr>
							 
							  <tr>
				               <td colspan="4">&nbsp;</td>
							 </tr>
							<tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							<tr>
				              <td>&nbsp;<input type="hidden" name="UserId" id="UserId" value="<?php echo $fb_user_id;  ?>">
							  <input type="hidden" name="user_email" id="user_email" value="<?php echo $_POST["Email"];  ?>">
							  </td>

				              <td align="left">
							  <input class="btn" type="submit" value="Done"/>&nbsp;
							  <!--<a href="student-step-2.php">Skip this step</a>-->
							  </td>
				            </tr>
							  <tr>
				               <td colspan="4">&nbsp;</td>
							 </tr>
							  
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
							 
							</table>
							 </td>
							 </tr>
							 <tr>
				              
						   </tr> 
							
				            <tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							
				             
							<tr>
				               <td colspan="4">&nbsp;</td>
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

	
	</body>
	</html>