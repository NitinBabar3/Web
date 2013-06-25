<?php
	include('GlobalVars.php');
	include '../../Utilities/Utilities.php';
	include Business_Path.'StudentManagement.php';
	$user=$_POST["txt_first_name"];
	error_reporting(0);
	$get=Utilities::CheckAdminMaster($user);
	//print_r($get);die;
	$obj_student=new Student();
	$obj_student->FacebookId=$get;
	//$obj_student->Email=$user;
	//print_r($obj_student);die;
	Utilities::RegisterStudentSession($obj_student);
	//print_r($_SESSION["letssession"]);
	header('Location:StudentDashboard.php?state='.$get);
?>