<?php 
	  include('studentHeader.php');
	  include Entity_Path.'Application.php';
	  include Business_Path.'StudentManagement.php';
	  
	  $objapplication=new Application();
	  $objapplication->StudentId=$_GET["StudentId"];
	  $objapplication->JobId=$_GET["JobId"]; 
	  
	  $obj=new StudentManagement();
	  $obj->UpdateStudentApplication($objapplication);
	  
	  
	  
?>