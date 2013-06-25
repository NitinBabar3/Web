<?
//author letstech01
include '../LI.BusinessManagement/ScreeningTestManagement.php';
include '../LI.Entities/ScreeningTest.php';
include '../LI.Entities/Question.php';
include '../Utilities/Utilities.php';
	
	$subCategoryId = $_GET["SubCategoryId"];
	$objScreeningTestManagement = new ScreeningTestManagement();
	$objAllTestByAdminForSubcategory = $objScreeningTestManagement->GetAllScreeningTestsFromAdminBySubCategory($subCategoryId);

	echo json_encode($objAllTestByAdminForSubcategory);
?>