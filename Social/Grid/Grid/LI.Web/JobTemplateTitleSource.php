<?
//author letstech01

include '../LI.BusinessManagement/JobTemplateManagement.php';
include '../LI.Entities/iJobTemplate.php';
include '../Utilities/Utilities.php';

	$subCategoryId = $_GET["SubCategoryId"];
	$jobTypeId = $_GET["JobTypeId"];

	//$subCategoryId=3;
	//$jobTypeId=1;
	
	$objJobTemplateManagement = new JobTemplateManagement();
	$objJobTemplateInArray = $objJobTemplateManagement->GetJobTemplateDetailsBySubCategoryIdAndJobTypeId($subCategoryId, $jobTypeId);
	echo json_encode($objJobTemplateInArray);
?>