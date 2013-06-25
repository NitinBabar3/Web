<?
include '../LI.Entities/Student.php';
include '../LI.Entities/Application.php';
include '../LI.Entities/Answer.php';
include '../LI.Entities/ScreeningTest.php';
include '../Utilities/Utilities.php';
include '../LI.BusinessManagement/ScreeningTestManagement.php';
include '../LI.Entities/Question.php';

$testId = $_GET["TestId"];
			$objScreeningTestManagement = new ScreeningTestManagement();
            echo json_encode($objScreeningTestManagement->GetScreeningTestDetailsByTestId($testId));
?>