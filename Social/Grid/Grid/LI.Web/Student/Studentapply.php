<?php 		
			include('GlobalVars.php');
			
			include Entity_Path.'StudentApplication.php';
			include Business_Path.'StudentManagement.php';
			include Utility_Path.'Utilities.php';
			$obj=new StudentApplication();
			$obj->JobId=$_POST["JobId"];
			session_start();
			//print_r($_SESSION["letssession"]);
			//echo $_SESSION["letssession"]["FacebookId"];
			//die;
			$obj->StudentId=$_SESSION["letssession"]["FacebookId"];
			$obj->User_id=$_SESSION["letssession"]["FacebookId"];
			$obj->UserTypeId="1";
			$obj->AppliedOn=date("Y-m-d h:i:s");
			$obj->ApplicationStatus="Pending";
			
			$studentdata=Utilities::GetStudentInfo($_SESSION["letssession"]["FacebookId"]);
			
			$obj->Email=$studentdata["Email"];
			$obj_student=new StudentManagement();
			$obj_student->Apply($obj);
			
			//print_r($obj);die;
			$studentdata=Utilities::GetStudentApplication($obj->StudentId,$obj->JobId);
			//print_r($studentdata);
			//die;//echo $studentdata["ID"];
			$ApplicationID=$studentdata["ID"];
			//echo $ApplicationID;
			//$getStudent=Utilities::GetStudent($obj->Email);
			
			$student=Utilities::UpdateSession($obj,$ApplicationID);
			//print_r($_SESSION["letssession"]);die;
			//die;
			//header("Location:StudentApplications.php");
			header("Location:TakeTest.php");
?>