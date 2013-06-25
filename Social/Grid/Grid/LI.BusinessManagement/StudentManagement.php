<?php

include '../../LI.Entities/Student.php';
include '../../LI.DataAccessManagement/StudentDataAccess.php';
	
	/*
	Name        :: Add student 
	Description :: Add student by creating object and sending to daat access.Use entity class in the way
	Author      :: Nitin Babar 
	*/
class StudentManagement {

			function register_student($obj) 
			{
				try{
					
					$objStudentDataAccess = new StudentDataAccess();  //create instance of Student data access
					$objStudentDataAccess->InsertNewStudent($obj);   //Obj is object with all dat passed from UI call
					
				}
				
				catch(Exception $ex){
					echo $ex->getMessage();
					die;        
				}
			}
			function InsertNewUser($obj) 
			{
				try{
					
					$objStudentDataAccess = new StudentDataAccess();  //create instance of Student data access
					$objStudentDataAccess->InsertNewUser($obj);   //Obj is object with all dat passed from UI call
					
				}
				
				catch(Exception $ex){
					echo $ex->getMessage();
					die;        
				}
			}
			function register_student_preferences($obj) 
			{
				try{
					
					$objStudentDataAccess = new StudentDataAccess();  //create instance of Student data access
					$objStudentDataAccess->InsertStudentPreferences($obj);   //Obj is object with all dat passed from UI call
					
				}
				
				catch(Exception $ex){
					echo $ex->getMessage();
					die;        
				}
			}
			function UpdateStudent($obj) 
			{
				try{
					
					$objStudentDataAccess = new StudentDataAccess();  //create instance of Student data access
					$objStudentDataAccess->UpdateStudent($obj);   //Obj is object with all dat passed from UI call
					
				}
				
				catch(Exception $ex){
					echo $ex->getMessage();
					die;        
				}
			}
			function StartFollowing($obj) 
			{
				try{
					
					$objStudentDataAccess = new StudentDataAccess();  //create instance of Student data access
					$objStudentDataAccess->FollowCompany($obj);   //Obj is object with all dat passed from UI call
					
				}
				
				catch(Exception $ex){
					echo $ex->getMessage();
					die;        
				}
			}
			function Apply($obj) 
			{
				try{
					
					$objStudentDataAccess = new StudentDataAccess();  //create instance of Student data access
					$objStudentDataAccess->Apply($obj);   //Obj is object with all dat passed from UI call
					
				}
				
				catch(Exception $ex){
					echo $ex->getMessage();
					die;        
				}
			}
			function StudentApplications($obj) 
			{
				try{
					
					$objStudentDataAccess = new StudentDataAccess();  //create instance of Student data access
					$result=$objStudentDataAccess->StudentApplications($obj);   //Obj is object with all dat passed from UI call
					//print_r($result);
					return $result;
				}
				
				catch(Exception $ex){
					echo $ex->getMessage();
					die;        
				}
			}
			function UpdateStudentApplication($obj) 
			{
				try{
					
					$objStudentDataAccess = new StudentDataAccess();  //create instance of Student data access
					$objStudentDataAccess->UpdateStudentApplication($obj);   //Obj is object with all dat passed from UI call
					
				}
				
				catch(Exception $ex){
					echo $ex->getMessage();
					die;        
				}
			}
			function UpdateStudentStatus($obj) 
			{
				try{
					
					$objStudentDataAccess = new StudentDataAccess();  //create instance of Student data access
					$objStudentDataAccess->UpdateStudentStatus($obj);   //Obj is object with all dat passed from UI call
					
				}
				
				catch(Exception $ex){
					echo $ex->getMessage();
					die;        
				}
			}
}
?>