<html>
	<head>
		<title>Lets Intern Log In Page</title>
		<link href="css/bootstrap.css" rel="stylesheet" id="main-theme-script">
  		<link href="css/default.css" rel="stylesheet" id="theme-specific-script">
  		<link href="css/bootstrap-responsive.css" rel="stylesheet">
  		
  		
  		<!--Validation-->
  		<link href="css/bootstrap.validate.css" rel="stylesheet" id="main-theme-script">
  		<script src="scripts/bootstrap.validate.js"></script>
  		
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
  
  	<div class="container">
		<div class = "row">

<?php

include '../LI.BusinessManagement/UserManagement.php';
include '../LI.DataAccessManagement/MySqlDataAdapter/MySQLDataAdapter.php';

    if (isset($_GET["ac"])){
        $objUserManagement = new UserManagement();
        $objUserManagement->ActivateUser($_GET["ac"]);
                
    }
?>
			Congratulations!!.. Your account has now ben activated
			<br/>You are being redirected to the login page, please follow the link if you are not redirected.
			<a href = "LogIn.html" class="btn btn-success"></a>
		</div>
	</div>
	<? header("Location: LogIn.html"); ?>
</body>
</html>