

<!DOCTYPE html>
<!-- saved from url=(0050)http://wbpreview.com/previews/WB00958H8/index.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title> Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="HTML5 Admin Simplenso Template">
  <meta name="author" content="ahoekie">

  <!-- Bootstrap -->
  <link href="../LI.Web/css/bootstrap.css" rel="stylesheet" id="main-theme-script">
  <link href="../LI.Web/css/default.css" rel="stylesheet" id="theme-specific-script">
  <link href="../LI.Web/css/bootstrap-responsive.css" rel="stylesheet">

  <!-- Full Calender -->
  <link rel="stylesheet" type="text/css" href="../LI.Web/css/fullcalendar.css">

  <!-- Bootstrap Date Picker --> 
  <link href="../LI.Web/css/datepicker.css" rel="stylesheet">
  
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="../LI.Web/css/jquery.fileupload-ui.css">
  
  <!-- Bootstrap Image Gallery styles -->
  <link rel="stylesheet" href="../LI.Web/css/bootstrap-image-gallery.min.css">
  
  <!-- Uniform -->
  <link rel="stylesheet" type="text/css" media="screen,projection" href="../LI.Web/css/uniform.default.css">
  
  <!-- Chosen multiselect -->
  <link type="text/css" href="../LI.Web/css/chosen.intenso.css" rel="stylesheet">   

  <!-- Simplenso -->
  <link href="../LI.Web/css/simplenso.css" rel="stylesheet">
  


<!-- Frame navigation script-->
<script type="text/javascript">
 function callFrame(loc,labelId){
    document.getElementById('mainFrame').src = loc;
    var i=0;
    for (i =1;i<=9;i++){
    	var idElement = "sideLabel"+i;
    	document.getElementById(idElement).setAttribute("class", "");
    }
    document.getElementById(labelId).setAttribute("class", "active");
}
</script>

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
      <a class="brand" href="#">Demo</a>
      
      
      
     
    </div>
  </div>
</div>
<!-- Main Content Area | Side Nav | Content -->    
<div class="container-fluid">
  <div class="row-fluid">
    <!-- Side Navigation -->
    <div class="span2">
              
      <div class="sidebar-nav">
      	<div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list"> 
          <li class="nav-header">Main</li>        
          <li id="sideLabel0" ><a href="#" id="dashboardSideNav" onclick="callFrame('Managecourse/Managecourse.php','sideLabel0')"><i class="icon-edit"></i> Summary</a></li>
          <li id="sideLabel1" ><a href="#" id="dashboardSideNav" onclick="callFrame('details.php','sideLabel1')"><i class="icon-edit"></i> Detail</a></li>
          
          
        </ul>
        </div>
      </div><!--/.well -->
    </div><!--/span-->
    
    <!-- Bread Crumb Navigation -->
	<div class="span10">
    	<div>
    		<iframe id="mainFrame" class="well span12" height="700px" ></iframe>
    	</div>  
	 
    
  
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
</div></body>
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
