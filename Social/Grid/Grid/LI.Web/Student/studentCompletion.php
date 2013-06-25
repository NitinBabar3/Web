<?php 
    include("GlobalVars.php");
	include Utility_Path.'Utilities/Utilities.php';
	include Entity_Path.'Preferences.php';
	include Business_Path.'StudentManagement.php'; 

	/*
	$objStudent= new StudentWorkex();	
	$objStudent->StudentId=$_POST["UserId"];
	$objStudent->LocationID=$_POST["LocationId"];
	$objStudent->JobTypeID=$_POST["category"];
	$objStudent->Title=$_POST["txt_title"];
	$objStudent->CompanyName=$_POST["txt_employer"];
	//print_r($objStudent);
	$test=Utilities::StudentWorkExperience($objStudent);
	*/
	$objStudentattributes= new Student();	
	$objStudentattributes->FacebookId=$_POST["UserId"];
	$objStudentattributes->ProfileTitle=$_POST["ProfileTitle"];
	$objStudentattributes->CollegeId=$_POST["COllegeId"];
	$objStudentattributes->Course=$_POST["Course"];
	$objStudentattributes->LocationID=$_POST["LocationId"];
	$objStudentattributes->MarksXth=$_POST["Xthmarks"];
	$objStudentattributes->MarksXIIth=$_POST["XIIthmarks"];
	if($_FILES["File"]["name"]!="")
	{
		$objStudentattributes->Picture=$_FILES["File"]["name"];
	}
	//print_r($objStudentattributes);
	
	move_uploaded_file($_FILES["File"]["tmp_name"],"images/students/" . $_FILES["File"]["name"]);
	
	$objStudentclass= new StudentManagement();		
	
	$query="UPDATE student SET ProfileTitle='".$_POST["ProfileTitle"]."',
							Picture='".$_FILES["File"]["name"]."',
							MarksXth='".$_POST["Xthmarks"]."',
							MarksXIIth='".$_POST["XIIthmarks"]."'
							WHERE FacebookID='".$_POST["UserId"]."'";
	//echo $query;				
	mysql_query($query);
	
	//$objStudentclass->UpdateStudent($objStudentattributes);
	
	/*Script invocation to business layer using objects to layers*/
	/*$objStudent= new Student();					        //Entity class instance

	//print_r($_POST["skills"]);	
	$objpreferences= new Preferences();					        //Entity class instance
	
	$skills=implode(",",$_POST["skills"]);
	
	$objpreferences->InternshipID=$skills;	
	
	$objStudentpreferences= new NewStudent();		
	$objStudentpreferences->UpdateStudent($objpreferences);*/
	

?>
<!DOCTYPE html>
<!-- saved from url=(0050)http://wbpreview.com/previews/WB00958H8/index.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Lets Intern - Edit Profile Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="HTML5 Admin Simplenso Template">
  <meta name="author" content="ahoekie">

  <!-- Bootstrap -->
  
	<!-- confirm password-->
	<script type="text/javascript">
		function confirmPass() {
        var pass = document.getElementById("inputPassword").value
        var confPass = document.getElementById("inputConfirmPassword").value
        if(pass != confPass) {
            alert('Wrong confirm password !');
        }
    }

	</script>	
	
	<script>
		var skills=[];
		// The following code should be stored in the HTML head section
			function disp_text()
			{
				//alert("hi");
				var w = document.formID.jobfunctions.selectedIndex;
				var selected_text = document.formID.jobfunctions.options[w].text;
				//alert(selected_text);
				skills.push(selected_text);
				//document.write(skills);
				//alert(count(skills);
				if(skills.length=="4")
				{
					alert("Ab bas kar be scholar..");
				}
				else 
				{
					document.getElementById("add_skills").value=skills+"\n";
				}
		   }
		   
		
		function SetStatus(val)
		{
			
			 var UserId=document.getElementById("UserId").value;
			 //alert(val);
			 var sel = document.getElementById('user_status');
		     var sv = sel.options[sel.selectedIndex].value;
             //alert(sv);			
			if (window.XMLHttpRequest)
			{
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					//document.getElementById("test").innerHTML=xmlhttp.responseText;
			    
				}
			}
			
			//alert("StudentStatus.php?status="+sv+"&StudentId="+UserId);
			xmlhttp.open("GET","StudentStatus.php?status="+sv+"&StudentId="+UserId,true);
			xmlhttp.send();		
		}
		</script>
</head>
<body>
<?php 
	//include('facebook.php');
	include("bootstrap_lib.php");
	include("studentHeader.php");
	
	
	//error_reporting(1);

	
    //$get_data=array('uid, last_name, first_name','contact_email','education_history','relationship_status','sex','work_history');
	$user_details = $facebook->api_client->users_getInfo($user_id, 'uid, last_name, first_name,contact_email,sex,birthday');
	
	
	
	//$user_details = $facebook->api_client->users_getInfo($user_id, 'uid', 'last_name', 'first_name','email');
	$user_location = $facebook->api_client->users_getInfo($user_id, 'current_location');
	$user_education = $facebook->api_client->users_getInfo($user_id, 'education_history');
	$user_work_history = $facebook->api_client->users_getInfo($user_id, 'work_history');
	
	$fb_user_id = $user_details[0]["uid"];
	$fb_first_name = $user_details[0]["first_name"];
	$fb_last_name =  $user_details[0]["last_name"];
	$user_email=$user_details[0]["contact_email"];
	$fb_sex =  $user_details[0]["sex"];
	$fb_bday =  $user_details[0]["birthday"];
	//echo $user_email."-".$fb_bday;
	$user_city=$user_location[0]["current_location"]["city"];
	$user_email =  $user_details[0]["contact_email"];
	
	$studentdata=Utilities::GetStudentInfo($fb_user_id);
	//print_r($studentdata);
	$studentcollegedata=Utilities::GetStudentCollegeInfo($studentdata[0]);
	//print_r($studentcollegedata);
	$studentskillsdata=Utilities::GetStudentSkills($fb_user_id);
	print_r($studentskillsdata);
?>	
	<form id="formID" name="formID" class="formular" method="post" action="studentCompletion.php">
	<?php 
		  Utilities::RegisterStudentSession($fb_user_id);
	      $studentdata=Utilities::GetStudentInfo($fb_user_id);
		  $studentcollegedata=Utilities::GetStudentCollegeInfo($studentdata[0]);
	?>
	<br/>
<!-- main body-->
<h3>&nbsp;&nbsp;Hurray !! Your Profile is complete.</h3>

	<div class = "container-fluid well" >
	
    	<div class="row-fluid">
    	<div class="span5" style="padding-left:100px;height: 330px">
    				
					<form class="form-horizontal" id="employerRegistrationForm" action="NewEmployer.php" method="post" ><fieldset>   
					<br/><div class="control-group">
						<label class="control-label" for="inputEmail"></label>
						<div class="controls">
						<?php if($_FILES["File"]["name"]!="") {
						
						?>
						<img src="<?php echo ParentPath;?>images/students/<?php echo $_FILES["File"]["name"];?>"  height="90" width="90" border="0"/>
						
						<?php 
						}
						else
						{
						?>
						<img src="http://graph.facebook.com/<?php echo $fb_user_id;?>/picture?type=large"  height="90" width="90" border="0"/>
						<?php 
						}
						?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputPassword"></label>
						<div class="controls">
							<input type="text" class="input-medium" name="txt_user_name" id="txt_user_name" readonly required="required" onfocusout="confirmPass()"   value="<?php echo $fb_first_name." ".$fb_last_name;?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputPassword"></label>
						<div class="controls">
							<input type="text" readonly class="input-mini" name="txt_user_sex" readonly id="txt_user_sex" value="<?php echo $fb_sex;?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputConfirmPassword"></label>
						<div class="controls">
							<input type="text" name="txt_email"  class="input-medium" readonly id="txt_email" placeholder="your email" value="<?php echo $_POST["user_email"];?>" required="required" onfocusout="confirmPass()" value="<?php echo $_POST["txt_email"];?>">
						</div>
					</div>
					
		</div>
		
		<input type="hidden" name="UserId" id="UserId" value="<?php echo $fb_user_id;  ?>">

		    <?php 
								if($studentdata["CurrentYear"]=="1")
								{
									$year="First year";
								}
								else if($studentdata["CurrentYear"]=="2")
								{
									$year="Second year";
								}
								else if($studentdata["CurrentYear"]=="3")
								{
									$year="Third year";
								}
								else if($studentdata["CurrentYear"]=="4")
								{
									$year="Final year";
								}
								?>
			
			<div class = "span5" >
					<div class="control-group">
						&nbsp;
						<?php echo $year." at ".$studentcollegedata[0].",".$user_city; ?>
						<div class="controls">
						
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for=""></label>
						<div class="controls"></div>
					</div>
					<div class="control-group">
						<label class="control-label" for=""> &nbsp;&nbsp;</label>
						<label class="control-label" for=""></label>
						<div class="controls">
									<?php 
									
									 $objapplication=new Student();
									 $objapplication->UserId=$fb_user_id;;
									 
									
									$status=Utilities::GetStudentStatus($objapplication);
									//echo $status;
									
									
									$status_list = Utilities::GetListFromTableByParameter('StudentAvailabilityStatus','Status');
									sort($status_list);
								    echo "&nbsp;".Utilities::GetHTMLDropdownStudentStatus($status_list, "user_status",$status);
									
									?>
									</span><br><br>
									<br><br>&nbsp;Internships 0 | Virtual Internships 0 | Past Work details 0 
							<br>
						
						</div>
						<div class="test">
						
						</div>
					</div><br>
					<div class="control-group">
						
					</div><br>
					<div class="control-group">
						<label class="control-label" for=""></label>
						<div class="controls">
						
							
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
		    				
							  
									
				            <tr>
				               <td colspan="4">&nbsp;</td>
							</tr><tr>
							  
				               <td align="left">You can improve your profile from your <b>DASHBOARD</b> 
							   <br><br><span style="padding-left:100px;"> OR <br></span><br>
							   Go and Find <b>Work Opportunities</b> right away !
							   </td>
							 </tr>
							<tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							  <tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							  <tr>
				               <td style="padding-left:25px;">&nbsp;<br><br>Important !! Please read our terms of engagement,you will need to agree to access the goodies
							   &nbsp;</td>
							 </tr>
							  
									 <tr>
										<td style="padding-left:25px;">&nbsp;<br><br><input class="validate[required]" type="checkbox">&nbsp; I agree.&nbsp;LETS get STARTED&nbsp;
										<span style="padding-left:420px;">&nbsp;&nbsp;<br><br>
										
										<a href="StudentDashboard.php">Take me to my dashboard</a>
										<br><br>
										</span> </td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td><a href="work_opportunities.php">Show me some Work opportunities</a></td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
									</tr>
				            <tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
						</div>
					</div>
			</div>
			</div>
			</div>
</div>   
</fieldset></form>
		
	
</body>
<!--/.fluid-container-->
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
  
<div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">FireFox</div><div style="position: absolute; display: none; "><div style="background-color: infobackground; padding: 1px; border: 1px solid infotext; font-size: 10px; margin: 10px; font-family: Arial; background-position: initial initial; background-repeat: initial initial; ">Unique</div></div><div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">Un...</div></body><span id="skype_highlighting_settings" display="none" autoextractnumbers="1"></span><object id="skype_plugin_object" location.href="http://wbpreview.com/previews/WB00958H8/index.html" location.hostname="wbpreview.com" style="position: absolute; visibility: hidden; left: -100px; top: -100px; " width="0" height="0" type="application/x-vnd.skype.click2call.chrome.5.7.0"></object></html>
</form>
</html>