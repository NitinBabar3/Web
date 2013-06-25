<?
//author letstech01

include '../LI.BusinessManagement/ScreeningTestManagement.php';
include '../LI.Entities/ScreeningTest.php';
include '../LI.Entities/Question.php';
include '../Utilities/Utilities.php';

$SubCategoryId = $_POST["SubCategoryId"];
//$arrayAddedQuestion = ($_POST["arrayAddedQuestion"]);
$arrayQuestionId = json_decode($_POST["arrayQuestionId"]);
$testTitle = $_POST["testTitle"];
$CreatedByUserId = $_POST["UserId"];
//echo $SubCategoryId."<br/>".var_dump($arrayQuestionId)."<br/>".$testTitle;

$testTitleDuration = explode(",",$testTitle);
$testTitle = $testTitleDuration[0];
$duration = $testTitleDuration[1];
$SubCategoryId = 3;



$objScreeningTest = new ScreeningTest();
$objScreeningTest->TestTitle = $testTitle;
$objScreeningTest->Duration = $duration;
$objScreeningTest->CreatedByUserId = $CreatedByUserId;
$objScreeningTest->SubCategoryId = $SubCategoryId;

$objScreeningTestManagement = new ScreeningTestManagement();
$testId = $objScreeningTestManagement->InsertNewTestReturnTestId($objScreeningTest);

$objScreeningTestManagement->InsertTestQuestion($testId, $arrayQuestionId);
echo $testId;

?>