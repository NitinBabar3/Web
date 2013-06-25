<?
//author letstech01
include '../LI.BusinessManagement/ScreeningTestManagement.php';
include '../LI.Entities/ScreeningTest.php';
include '../LI.Entities/Question.php';
include '../Utilities/Utilities.php';
	
	$subCategoryId = $_GET["SubCategoryId"];
	$userId = $_GET["UserId"];
	$objScreeningTestManagement = new ScreeningTestManagement();
	$objEmployerQuestionBank = $objScreeningTestManagement->GetEmployerQuestionByUserIdAndSubCategoryId($userId, $subCategoryId);
	
	$objScreeningTest = new ScreeningTest();
	$objScreeningTest->Question =$objEmployerQuestionBank; 
	echo json_encode($objScreeningTest);
?>