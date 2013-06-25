<?
include '../LI.BusinessManagement/JobApplicationManagement.php';
include '../Utilities/Utilities.php';

$applicationId = $_POST["applicationId"];
$newRating = $_POST["newApplicationRating"];


$objJobApplicationManagement= new JobApplicationManagement();
$objJobApplicationManagement->ChangeApplicationRatingByApplicationIdAndNewRating($applicationId, $newRating);
?>