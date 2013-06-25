<?php

include '../LI.BusinessManagement/ScreeningTestManagement.php';
include '../LI.Entities/ScreeningTest.php';
include '../Utilities/Utilities.php';
include '../LI.Entities/Question.php';

$testId = $_GET["testId"];

$objScreeningTestManagement = new ScreeningTestManagement();
$objScreeningTest = $objScreeningTestManagement->GetScreeningTestDetails($testId);
// Testing
echo json_encode($objScreeningTest);

?>
