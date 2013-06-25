<?php include("studentHeader.php");
 
	include Entity_Path.'Preferences.php';
	include Entity_Path.'UserAccount.php';
	include Business_Path.'StudentManagement.php'; 
	
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
  <link href="<?php echo ParentPath;?>css/bootstrap.css" rel="stylesheet">
  <link type="text/css" href="<?php echo ParentPath;?>css/default.css" rel="stylesheet">
  <link href="<?php echo ParentPath;?>css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo ParentPath;?>css/bootstrap.validate.css" rel="stylesheet" id="main-theme-script">
  <!-- Full Calender -->
  <link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/fullcalendar.css">

  <!-- Bootstrap Date Picker --> 
  <link href="<?php echo ParentPath;?>css/datepicker.css" rel="stylesheet">
  
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="<?php echo ParentPath;?>css/jquery.fileupload-ui.css">
  
  <!-- Bootstrap Image Gallery styles -->
  <link rel="stylesheet" href="<?php echo ParentPath;?>css/bootstrap-image-gallery.min.css">
  
  <!-- Uniform -->
  <link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo ParentPath;?>css/uniform.default.css">
  
  <!-- Chosen multiselect -->
  <link type="text/css" href="<?php echo ParentPath;?>css/chosen.intenso.css" rel="stylesheet">   

  <!-- Simplenso -->
  <link href="<?php echo ParentPath;?>css/simplenso.css" rel="stylesheet">
  <!-- Validation scripts-->
	<script src="scripts/bootstrap.validate.js"></script>
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
		   function getCollege(location)
		   {
				//alert(location);
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
					document.getElementById("colleges").innerHTML=xmlhttp.responseText;
			    
				}
			}
			//alert("StudentForms.php?LocationID="+location);
			xmlhttp.open("GET","StudentForms.php?LocationID="+location,true);
			xmlhttp.send();	
		   }
		   function EmploymentDetails()
		   {
				document.formID.txt_employer.disabled="false";
				document.formID.txt_category.disabled="false";
				document.formID.txt_location.disabled="false";
		   }
		</script>
</head>
<body>
<?php
	session_start();
?>	
	<form id="formID" name="formID" class="formular" enctype="multipart/form-data" method="post" action="studentCompletion.php">
	
	<br/>
<!-- main body-->
<h3>Edit Profile</h3>

	<div class = "container-fluid well" >

    	
    	<div class="row-fluid">
    	
		<input type="hidden" name="UserId" id="UserId" value="<?php echo $_SESSION["letssession"]["FacebookId"];  ?>">

		
			
			<div class = "span6" >
			
			
			<div class="control-group">
						<label class="control-label" >
						<?php
						//include("../LI.Entities/Student.php");
						$objstudent=new Student();
						//echo $_GET["UserID"];
						$objstudent->FacebookId=$_SESSION["letssession"]["FacebookId"];
						$StudentCard = Utilities::GetStudentCard($objstudent->FacebookId);
						echo $StudentCard;	

						$studentdata=Utilities::GetStudentInfo($_SESSION["letssession"]["FacebookId"]);
						//print_r($studentdata);
						$studentcollegedata=Utilities::GetStudentCollegeInfo($studentdata[0]);
						//print_r($studentcollegedata);
						//echo $studentcollegedata["ID"];
						$studentskillsdata=Utilities::GetStudentSkills($_SESSION["letssession"]["FacebookId"]);
						//print_r($studentskillsdata);
						//echo "-->".$studentdata[3];
						?>
						</label></div>
					<div class="control-group">
						<label class="control-label" >Upload new photo :</label>
						<div class="controls">
						<input type="file" class="" id="File" name="File">
					</div>
					<div class="control-group">
						<label class="control-label" >Title :</label>
						<div class="controls">
						<input type="text" class="" id="ProfileTitle" name="ProfileTitle" value="<?php echo $studentdata[4]; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" >City :</label>
						<div class="controls">
						<?
									$city_list = Utilities::GetListFromTableByParameter('location','CityName');
									sort($city_list);
								    echo "&nbsp;".Utilities::GetHTMLDropdownWithSelected($city_list, "LocationId",$studentdata[3]);
								
						?>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="">College :</label>
						<div class="controls" id="colleges">
							<?		//echo $studentcollegedata["ID"];
									$city_list = Utilities::GetListFromTableByParameter('college','CollegeName');
									sort($city_list);
								    echo "&nbsp;".Utilities::GetHTMLDropdownWithSelected($city_list, "CollegeId",$studentcollegedata["ID"]);
									
							?>&nbsp;&nbsp;<input type="text" class="input-mini" name="txt_college_marks" id="txt_college_marks" value="" required="required" onfocusout="confirmPass()">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="">Course :</label>
						<div class="controls">
						<?			//print_r($studentcollegedata[0]);
									$course_list = Utilities::GetListFromTableByParameter('course','CourseName');
								    sort($course_list);
									echo "&nbsp;".Utilities::GetHTMLDropdownWithSelected($course_list, "Course",$studentdata[2]);
                    
						?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="">X marks :</label>
						<div class="controls">
						<input type="text" name="Xthmarks" size="10" class="input-mini" id="MarksXth" value="<?php echo $studentdata[8]; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="">XII / Diploma marks :</label>
						<div class="controls">
						<input type="text" name="XIIthmarks" size="10" class="input-mini" id="MarksXIIth" value="<?php echo $studentdata[9]; ?>">
						</div>
					</div>
					<div class="control-group">
						<!--<input type="checkbox" name="employed" Onclick="EmploymentDetails()" id="employed" value='0'>&nbsp; Tick if No Employment details
					--></div>
					<div class="control-group">
						<label class="control-label" for="">Last Employer :
						
						</label>
						<div class="controls">
						<input type="text" name="txt_employer" size="10"  class="input-large" id="txt_employer" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="">Title :
						
						</label>
						<div class="controls">
						<input type="text" name="txt_title" size="10"  class="input-large" id="txt_title" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="">Location :</label>
						<div class="controls">
						 <?
									$city_list = Utilities::GetListFromTableByParameter('location','CityName');
									sort($city_list);
								    echo "&nbsp;".Utilities::GetHTMLDropdownFromList($city_list, "LocationId");
								
						?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="">Category :</label>
						<div class="controls">
						 <?	
									$skills_list = Utilities::GetListFromTableByParameter('jobcategory','CategoryName');
									sort($skills_list);
								    echo "&nbsp;".Utilities::GetHTMLDropdownFromList($skills_list, "category");
						?>
						</div>
					</div>
					
					<br>
					<div class="control-group">
						<label class="control-label" for="">Prefered Jobs :</label>
						<div class="controls"><br>
						<?
									$job_function_list = Utilities::GetListFromTableByParameter('jobcategory','CategoryName');
									sort($job_function_list);
								    echo "&nbsp;".Utilities::GetHTMLcheckboxFromList($job_function_list, "skills");
						?>
							<br>
							
						</div>
					</div><br>
					<div class="control-group">
						<label class="control-label" for="">Key Skills * (only 3) :</label>
						<div class="controls">
						<form name="test">
							    <br>
							     <?	
									$skills_list = Utilities::GetListFromTableByParameter('skills','SkillName');
									sort($skills_list);
								    echo "&nbsp;".Utilities::GetHTMLJavascriptMultipleListFromList($skills_list, "skills");
								?>
								
								<textarea name="add_skills" id="add_skills" rows="4" cols="14"></textarea> 
						</form>
							<br>
							
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
		    				<input type="submit" class="btn btn-success btn-large" value="Update"/>
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
    <script type="text/javascript" src="../scripts/jsapi"></script>
     
    <!-- jQuery -->
    <script src="../scripts/jquery.min.js"></script>
    
    <!-- Data Tables -->
    <script src="../scripts/jquery.dataTables.js"></script>
    
    <!-- jQuery UI Sortable -->
    <script src="../scripts/jquery.ui.core.min.js"></script>
	<script src="../scripts/jquery.ui.widget.min.js"></script>
	<script src="../scripts/jquery.ui.mouse.min.js"></script>
	<script src="../scripts/jquery.ui.sortable.min.js"></script>
    <script src="../scripts/jquery.ui.widget.min.js"></script>
    
    <!-- jQuery UI Draggable & droppable -->
    <script src="../scripts/jquery.ui.draggable.min.js"></script>
    <script src="../scripts/jquery.ui.droppable.min.js"></script>

    <!-- Bootstrap -->
    <script src="../scripts/bootstrap.min.js"></script>
    <script src="../scripts/bootbox.min.js"></script>

	<!-- Bootstrap Date Picker -->
    <script src="../scripts/bootstrap-datepicker.js"></script>

		
    <!-- jQuery Cookie -->    
    <script src="../scripts/jquery.cookie.js"></script>
    
    <!-- Full Calender -->
    <script type="text/javascript" src="../scripts/fullcalendar.min.js"></script>
    
    <!-- CK Editor -->
	<script type="text/javascript" src="../scripts/ckeditor.js"></script>
	<script type="text/javascript" src="../scripts/jquery.js"></script>
    
    <!-- Chosen multiselect -->
    <script type="text/javascript" language="javascript" src="../scripts/chosen.jquery.min.js"></script>  
    
    <!-- Uniform -->
    <script type="text/javascript" language="javascript" src="../scripts/jquery.uniform.min.js"></script>
    
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
    <script src="../scripts/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="../scripts/load-image.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="../scripts/canvas-to-blob.min.js"></script>
    <script src="../scripts/bootstrap-image-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="../scripts/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
	<script src="../scripts/jquery.fileupload.js"></script>
    <!-- The File Upload image processing plugin -->
    <script src="../scripts/jquery.fileupload-ip.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="../scripts/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="../scripts/main.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
    <!--[if gte IE 8]><script src="scripts/blueimp-jQuery-File-Upload/js/cors/jquery.xdr-transport.js"></script><![endif]-->
    
    <!-- Simplenso scripts -->
    <script src="../scripts/simplenso.js"></script><script src="../scripts/saved_resource" type="text/javascript"></script><script src="scripts/format+en,default,geochart.I.js" type="text/javascript"></script><script src="scripts/saved_resource(1)" type="text/javascript"></script><script src="scripts/corechart.js" type="text/javascript"></script><script src="scripts/saved_resource(2)" type="text/javascript"></script><script src="scripts/gauge.js" type="text/javascript"></script>
  
<div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">FireFox</div><div style="position: absolute; display: none; "><div style="background-color: infobackground; padding: 1px; border: 1px solid infotext; font-size: 10px; margin: 10px; font-family: Arial; background-position: initial initial; background-repeat: initial initial; ">Unique</div></div><div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">Un...</div></body><span id="skype_highlighting_settings" display="none" autoextractnumbers="1"></span><object id="skype_plugin_object" location.href="http://wbpreview.com/previews/WB00958H8/index.html" location.hostname="wbpreview.com" style="position: absolute; visibility: hidden; left: -100px; top: -100px; " width="0" height="0" type="application/x-vnd.skype.click2call.chrome.5.7.0"></object></html>
</form>
</html>