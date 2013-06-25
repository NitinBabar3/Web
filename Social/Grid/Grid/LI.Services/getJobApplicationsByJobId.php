<?
include '../LI.Entities/Student.php';
include '../LI.Entities/Application.php';
include '../LI.Entities/Answer.php';
include '../Utilities/Utilities.php';
include '../LI.BusinessManagement/JobApplicationManagement.php';

$jobId = $_GET["JobId"];
$objJobApplicationManagement = new JobApplicationManagement();
$arrayApplication = $objJobApplicationManagement->GetAllApplicationsByJobId($jobId);

echo json_encode($arrayApplication);
?>