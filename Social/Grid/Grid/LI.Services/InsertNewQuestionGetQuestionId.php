<?

include '../LI.BusinessManagement/ScreeningTestManagement.php';
include '../Utilities/Utilities.php';

//author letstech01

		$json = $_POST['Question'];
	
	$question = json_decode($json);
	$objScreeningTestManagement = new ScreeningTestManagement();
	$questionId = $objScreeningTestManagement->InsertNewQuestionReturnQuestionId($question);
	echo $questionId;	
?>