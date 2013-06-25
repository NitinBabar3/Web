<?php 
    include("studentHeader.php"); 
	//print_r($_SESSION["letssession"]);
    //Utilities::RegisterStudentSession($_GET["token"]);
	include Business_Path.'StudentManagement.php'; 

?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">  			
<html>
	<head>
		<title>Lets Intern Log In Page</title>
		<link href="<?php echo ParentPath;?>css/bootstrap.css" rel="stylesheet" id="main-theme-script">
  		<link href="<?php echo ParentPath;?>css/default.css" rel="stylesheet" id="theme-specific-script">
  		<link href="<?php echo ParentPath;?>css/bootstrap-responsive.css" rel="stylesheet">
  		
  		
  		<!--Validation-->
  		<link href="<?php echo ParentPath;?>css/bootstrap.validate.css" rel="stylesheet" id="main-theme-script">
  		<script src="<?php echo ParentPath;?>scripts/bootstrap.validate.js"></script>
  	 <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.5.1.min.js"></script>
		<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
		 <script>
      $(document).ready(function(){

        $("#Search").click(function() {
          $.ajax({
            type: "POST",
            dataType: 'json',
            url: "callajax.php",
            cache: false,
            async: true,
            success: onSuccess
          });
        });
        
        function onSuccess(data)
        {
          $("#ajaxResult").empty();
          $("#mobileDeviceTemplate").tmpl(data).appendTo("#ajaxResult");
        }

      });
    </script>
    <script id="mobileDeviceTemplate" type="text/x-jquery-tmpl">
      <li>
        <strong>${manufacturer}:</strong> ${mobileDevice}
      </li>
    </script>    
		<link rel="stylesheet" href="<?php echo ParentPath;?>css/validationEngine.jquery.css" type="text/css"/>
		<!--<link rel="stylesheet" href="css/template.css" type="text/css"/>-->
		<script src="<?php echo ParentPath;?>scripts/jquery-1.7.2.min.js" type="text/javascript">
		</script>
		<script src="<?php echo ParentPath;?>scripts/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
		</script>
		<script src="<?php echo ParentPath;?>scripts/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
		</script>	
	</head>
	<body>
	
	<br/>
<!-- Main body -->
<div class="container">
	<div class = "well span5 offset2" >
	<form id="formID" class="formular" method="post" action="search.php">
      <table border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          	<table border="0" cellspacing="0" height="29px" width="100%" cellpadding="0" align="left">
              <tr>
              	<td align="right" valign="middle" style="background-image:url(/sureline/img/blue_left_curve.png)">&nbsp;</td>
                <td width="100%" align="center" valign="middle" class="main_menu_bg">		
					<b>&nbsp;&nbsp;Work opportunities</b>
				</td>
				<td align="left" valign="middle" style="background-image:url(/sureline/img/blue_right_curve.png);width:550px;">&nbsp;</td>                				
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
				               <td colspan="4">&nbsp;<input type="hidden" name="user_id" id="user_id" value="<?php echo $_POST["UserId"];?>"></td>
							 </tr>
							 <tr>
				               <td colspan="4">&nbsp;</td>
							 </tr>
							<!--<tr>
				               <td style="padding-left:25px;" colspan="4">&nbsp;Keyword :<font color="red">*</font></td>
							   <td><input type="text" placeholder="Enter.." class="validate[required] text-input" name="txt_first_name" id="txt_first_name"></td>
				            </tr>-->
				            <tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							
							
							<tr>
				               <td style="padding-left:25px;" colspan="4">&nbsp;Location :<font color="red">*</font></td>
							   <td>
							   
							   <?
									$city_list = Utilities::GetListFromTableByParameter('location','CityName');
									sort($city_list);
								    echo "&nbsp;".Utilities::GetHTMLDropdownFromList($city_list, "location");
						
								?>
							   </td>
				            </tr>
							<tr>
				               <td style="padding-left:25px;" colspan="4">&nbsp;Course :<font color="red">*</font></td>
							   <td>
							   <?
									$course_type_list = Utilities::GetListFromTableByParameter('jobtype','Type');
								    sort($course_type_list);
									//print_r($course_type_list);
									echo "&nbsp;".Utilities::GetHTMLcheckboxFromList($course_type_list, "Type");
                    
								?>
							   
							   </td>
				            </tr>
							<tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							
							<tr>
				               <td style="padding-left:105px;" colspan="6">&nbsp;<input type="submit" id="Search" name="Search" value="Search"></td>
							   
				            </tr>
							<?php 
							
							?>
							<tr>
				               <td colspan="4">&nbsp;</td>
							</tr>
							
							<tr>
				               <td style="padding-left:25px;" colspan="4">&nbsp;</td>
							   <td><div id="job"></div></td>
							</tr>
							
							  <tr>
				               <td colspan="4">&nbsp;</td>
							 </tr>
							 
				           
							<tr>
				              <td colspan="10" class="loginbotborder">&nbsp;</td>
				              </tr>
				            <tr>
							   <td>&nbsp;</td>
				              <td align="left" colspan="6" class="logincopyright" >Letsintern.</td>
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
	</div>
</div>
	</body>
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
    <script src="scripts/bootsbox.min.js"></script>
    

	<!-- Bootstrap Date Picker -->
    <script src="scripts/bootstrap-datepicker.js"></script>
    <script src="scripts/bootstrap.min.carousel.extension.js"></script>

		
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
<script src="http://static.ak.connect.facebook.com/connect.php/en_US" type="text/javascript"></script>																														<!-- file FOR FBConnect-->
<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script> 
  
<!-- xd_receiver.htm needed for cross domain communication and transfer data btwn facebook and our site
     It enable communication between our site and FB .allows FB.init() -->
 <!--<script language="javascript" src="http://www.socialannex.com/connect_demo_nitin/notborn_fb_connect.js"></script>-->
 <script language="javascript">
 FB.init("183118518486965", "http://118.139.171.92/letsdev01/xd_receiver.htm", { permsToRequestOnConnect : "email,offline_access,user_address" });
</script>
</html>