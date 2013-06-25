<?
include '../LI.BusinessManagement/JobApplicationManagement.php';
include '../Utilities/Utilities.php';

$applicationId = $_POST["applicationId"];
$newStatus = $_POST["newApplicationStatus"];


$objJobApplicationManagement= new JobApplicationManagement();
$objJobApplicationManagement->ChangeApplicationStatusByApplicationIdAndNewStatus($applicationId, $newStatus);

?>