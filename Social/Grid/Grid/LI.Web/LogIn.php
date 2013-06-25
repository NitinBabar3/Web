<?
	include '../LI.BusinessManagement/UserManagement.php';
	include '../LI.Entities/UserAccount.php';
	include '../Utilities/Utilities.php';
	
	$objUserManagement = new UserManagement();
	$objUser = new UserAccount();
	$objUser->Email = $_POST["Email"];
	$objUser->Password = $_POST["Password"];
	$objUser = $objUserManagement->ValidateUser($objUser);
	if ($objUser == "invalid"){
		echo "Sorry mate.. You Ain't allowed in here!";
	}
	else{
		Utilities::RegisterSession($objUser);
		print_r($_SESSION["letssession"]);
	}

?>
