<?
include '../LI.BusinessManagement/JobApplicationManagement.php';
include '../Utilities/Utilities.php';


	$jsonApplication = $_POST['application'];
	
	$objApplication = json_decode($jsonApplication);
	$objJobApplicationManagement = new JobApplicationManagement();
	$objJobApplicationManagement->PostApplication($objApplication);	
?>