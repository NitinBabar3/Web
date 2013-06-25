<?
include '../LI.BusinessManagement/JobApplicationManagement.php';
include '../Utilities/Utilities.php';

$filename = $_POST['filename'];

$objJobApplicationManagement = new JobApplicationManagement();
$objJobApplicationManagement->PostAudioFileName($filename);

?>