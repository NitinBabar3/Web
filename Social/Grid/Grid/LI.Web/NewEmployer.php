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
</head>
<body>
	
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
include '../Utilities/Utilities.php';
include '../LI.Entities/Employer.php';
include '../LI.Entities/UserAccount.php';
include '../LI.BusinessManagement/UserManagement.php';
include '../LI.BusinessManagement/EmployerManagement.php';

	if(isset($_POST["Email"])){
    try{
        
            $objUser = Utilities::CreateUserObjectAsEmployer($_POST["Password"], $_POST["Email"]);
            $objUserManagement = new UserManagement();
            $objUser->ActivationCode = Utilities::GenerateRandomString(15);
            $objUser->ID = $objUserManagement->InsertNewUser($objUser);
            //$objUser->ID = Utilities::GetUserIdOfNewUser($objUser->Email);

            $location_string_id = implode(",",$_POST["location"]);

            $class_attributes = Utilities::GetEntityClassAttributes("Employer");
               $objEmployer = new Employer();
            for($i=0;$i<sizeof($class_attributes);$i++){
                if(isset($_POST[$class_attributes[$i]]))
                    $objEmployer->$class_attributes[$i] = $_POST[$class_attributes[$i]];          
            }
            $objEmployer->UserId = $objUser->ID;
            if ($_FILES["logo"]["error"] > 0){
                //Handle this error.
                echo "no";
            }
            else{
                $logo_name = Utilities::UploadImage($_FILES["logo"]["tmp_name"], $_FILES["logo"]["name"], $_FILES["logo"]["size"],$objEmployer->UserId);
                $objEmployer->Logo = $logo_name;
            }
            $datetime = Utilities::GetCurrentDateTimeMySQLFormat();
            $objEmployer->UpdatedOn = $datetime;
            $objEmployer->SubscriptionTypeId=1;
            $objEmployer->LocationIdString = $location_string_id;
            $objEmployerManagement = new EmployerManagement();        
            $objEmployerManagement->InsertNewEmployer($objEmployer);
            
            Utilities::SendEmailForAccountActivation($objUser->Email, $objUser->ActivationCode);
			
    }
    
    catch(Exception $ex){
        echo $ex->getMessage();
        die;        
    }
    }
else{
	echo "<br/>Maybe you're lost. It suggested you get out of our page";
	die;
}
?>
			<br/>Thank you for registering with LetsIntern, we have sent you a link on your email address <?echo $objEmployer->Email; ?>
			Please follow the link to activate your account.
			<form action = "#" method="post" name="resendActivationLink">
				<input type = "hidden" value=<?$objEmployer->email?> name = "employerEmail">
				<input type = "button" class="btn btn-primary" value="Resend Activation Link">
			</form>
		</div>
	</div>
</body>
</html>