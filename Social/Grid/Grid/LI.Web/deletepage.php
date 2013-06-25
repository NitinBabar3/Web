<?php 
//echo $_GET["qid"];
//echo $_GET["uid"];
include("../LI.BusinessManagement/QuestionManagement.php");
include("../Utilities/Utilities.php");
$questionid=$_GET["qid"];
$objQuestionManagement= new QuestionManagement();
$objQuestionManagement->DeleteQuestion($questionid);
?>