<?php 
	  //include '../LI.Entities/Student.php';
	  include('GlobalVars.php');
	  include Business_Path.'StudentManagement.php';
	  include Utility_Path.'Utilities.php';
	
	  $objapplication=new Student();
	  $objapplication->FacebookId=$_GET["StudentId"];
	  $objapplication->Status=$_GET["status"]; 
	  
	  $obj=new NewStudent();
	  $obj->UpdateStudentStatus($objapplication);
	  
	  
	  
?>