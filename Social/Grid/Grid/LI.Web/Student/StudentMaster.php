
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">  
	<head>
		<title>Letsintern :: Welcome</title>
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/demos.css">
		<link href="<?php echo ParentPath;?>css/letsintern.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo ParentPath;?>scripts/jquery-1.5.1.js"></script>
		<script src="<?php echo ParentPath;?>scripts/jquery.ui.core.js"></script>
		<script src="<?php echo ParentPath;?>scripts/jquery.ui.widget.js"></script>
		<script src="<?php echo ParentPath;?>scripts/jquery.ui.datepicker.js"></script>
		<script> 
			$(function() {
				$( "#datepicker" ).datepicker();
			});
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
	<?php  
	include('bootstrap_lib.php');
	include('GlobalVars.php');
	include Utility_Path.'Utilities.php';
	?>
	
	<table align="center" colspan="2">
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
    <td style="padding-left:510px;">
     
      <!-- Main content section  -->
      <form id="formID" class="formular" method="post" action="CheckAdminMaster.php">
      <table border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          	<table border="0" cellspacing="0" height="29px" width="100%" cellpadding="0" align="left">
              <tr>
              	<td align="right" valign="middle" style="background-image:url(letsdev01/img/blue_left_curve.png)">&nbsp;</td>
                <td width="100%" align="center" valign="middle" class="main_menu_bg">		
					<b>&nbsp;&nbsp;Letsintern </b>
				</td>
				<td align="left" valign="middle" style="background-image:url(letsdev01/img/blue_right_curve.png)">&nbsp;</td>                				
			  </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td align="center">
          	<table border="0" cellspacing="0" cellpadding="0" align="center" class="login">
            	<tr>
            		<td align="center">
            			<table border="0" cellspacing="2" cellpadding="2" width="100%">
				             
							 <tr>
				               <td colspan="4">&nbsp;</td>
							 </tr>
							<tr>
				               <td style="padding-left:25px;" colspan="4">&nbsp;Student :</td>
							   <td>
							   <?php 
								
									$student_list = Utilities::GetListFromTableByParameter('student','Email');
								    sort($student_list);
									echo "&nbsp;".Utilities::GetAdminHTMLDropdownFromList($student_list, "txt_first_name");
                    
								
							   ?>
							   </td>
				            </tr>
				            <tr>
				               <td colspan="4">&nbsp;</td>
							 </tr>
							 
				             <tr>
				               <td  style="padding-left:25px;" colspan="4">&nbsp;Password :</td>
							   <td><input type="password" name="txt_password" id="txt_password" class="validate[required] text-input"></td>
				            </tr>
							<tr>
				              <td colspan="4">&nbsp;</td>
							</tr>
							  <tr>
							   <td>&nbsp;</td>
				               <td>&nbsp;</td>
							 </tr>
							  <tr>
							   <td>&nbsp;</td>
				               <td>&nbsp;
							 </tr>
				            <tr>
				              <td colspan="4">&nbsp;</td>

				              <td align="left">
							  <input class="submit" type="submit" value="Login"/>&nbsp;
							 
							  </td>
				            </tr>
							<tr>
				              <td colspan="10" class="loginbotborder">&nbsp;</td>
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
	<script src="http://static.ak.connect.facebook.com/connect.php/en_US" type="text/javascript"></script>																														<!-- file FOR FBConnect-->
	<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script> 
	</body>
	</html>