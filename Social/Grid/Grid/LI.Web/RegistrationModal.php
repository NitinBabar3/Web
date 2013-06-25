<?
include '../Utilities/Utilities.php';
?>
<!DOCTYPE html>
<!-- saved from url=(0050)http://wbpreview.com/previews/WB00958H8/index.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Lets Intern - Registration Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="HTML5 Admin Simplenso Template">
  <meta name="author" content="ahoekie">

  <!-- Bootstrap -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link type="text/css" href="css/default.css" rel="stylesheet">
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/bootstrap.validate.css" rel="stylesheet" id="main-theme-script">
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
  <!-- Validation scripts-->
	<script src="scripts/bootstrap.validate.js"></script>
</head>
<body>
	<!-- Button to trigger modal --> 
	<div class = "span4">
	<a href="#EmployerRegistrationStep1" id="modalBoxButton" role="button" class="btn" data-toggle="modal">Sign Up as Employer</a>
	</div>
		<!-- Modal -->
		<form class="form-horizontal" id="employerRegistrationForm" action="#" method="post" ><fieldset>
	<div class="modal hide" id="EmployerRegistrationStep1">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Employer Registration Form</h3>
    <h6>To sign up as employer please complete the following steps...</h6>
  </div>
  <div class="modal-body">
    	
					<div class="control-group">
						<label class="control-label" for="inputEmail">Email</label>
						<div class="controls">
							<input type="text" name="Email" id="inputEmail" placeholder="Email" required="required" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputPassword">Password</label>
						<div class="controls">
							<input type="password" name="Password" id="inputPassword" placeholder="Password">
						</div>
					</div>

  </div>
  <div class="modal-footer">
  	<a href='#' data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" class="btn btn-danger">Cancel</a>
    <a href="#EmployerRegistrationStep2" data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" class="btn btn-primary">Next</a>
    
  </div>
</div>
<div class="modal hide" id="EmployerRegistrationStep2">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Step 2</h3>
    
  </div>
  <div class="modal-body">

					<div class="control-group">
						<label class="control-label" for="companyName">Company Name</label>
						<div class="controls">
							<input type="text" id="companyName" name="CompanyName" placeholder="Eg. Facebook.com">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="description">Description</label>
						<div class="controls">
							<textarea id="description" name="Description" placeholder="Eg. A social netwoking platform connecting people across the world!"></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="contactPerson">Contact Person</label>
						<div class="controls">
							<input type="text" id="contactPerson" name="ContactPerson" placeholder="Eg. John Smith">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="contactNo">Contact Number</label>
						<div class="controls">
							<input type="text" id="contactNo" name="ContactNo" placeholder="Eg.9898989898">
						</div>
					</div>  
</div>
  <div class="modal-footer">
  	<a href='#' data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" class="btn btn-danger">Cancel</a>
  	<a href='#EmployerRegistrationStep1' data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" class="btn btn-warning">Previous</a>    
    <a href="#EmployerRegistrationStep3" data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" class="btn btn-primary">Next</a>
    
  </div>
</div>
<div class="modal hide" id="EmployerRegistrationStep3">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Almost there...</h3>
    
  </div>
  <div class="modal-body">
    	
					<div class="control-group">
						<label class="control-label" >Company Type</label>
						<div class="controls">
							<?
							$company_type_list = Utilities::GetListFromTableByParameter('company', 'CompanyType');
							echo Utilities::GetHTMLDropdownFromList($company_type_list, "CompanyTypeId");
							?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="">Domain</label>
						<div class="controls">
							<?
							$industry_type_list = Utilities::GetListFromTableByParameter('industry','IndustryType');
							echo Utilities::GetHTMLDropdownFromList($industry_type_list, "Industry");
							?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="">Location</label>
						<div class="controls">
							<?
							$city_list = Utilities::GetListFromTableByParameter('location','CityName');
							echo Utilities::GetHTMLMultipleListFromList($city_list, "location");
							?>
						</div>
					</div>

  </div>
  <div class="modal-footer">
  	<a href='#' data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" class="btn btn-danger">Cancel</a>
  	<a href='#EmployerRegistrationStep2' data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" class="btn btn-warning">Previous</a>
    <a href="#EmployerRegistrationStep4" data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" class="btn btn-primary">Next</a>
    
  </div>
</div>
	<div class="modal hide" id="EmployerRegistrationStep4">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Ok.. We're here!</h3>    
  </div>
  <div class="modal-body">
    	<form class="form-horizontal" action="NewEmployer.php" method="post">
					<div class="control-group">
						<label class="control-label" for="website">Website</label>
						<div class="controls">
							<input type="text" name="Website" id="website" required="required" placeholder="Eg. www.facebook.com">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="logo">Logo</label>
						<div class="controls">
							<input type="file" name="Logo" id="logo" placeholder="">
						</div>
					</div>
  </div>
  <div class="modal-footer">
  	<a href='#' data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" class="btn btn-danger">Cancel</a>
  	<a href='#EmployerRegistrationStep3' data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" class="btn btn-warning">Previous</a>    
    <input type="submit" class="btn btn-success" value="Done"/>
	

   
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
</html>