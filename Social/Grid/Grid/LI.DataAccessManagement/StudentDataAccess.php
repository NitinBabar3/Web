<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmployerManagementDataAccess
 *
 * @author letstech01
 */

class StudentDataAccess {
    function InsertNewStudent($objStudent){
	    //print_r($objStudent);
        $arrayStudent = Utilities::ObjectToArray($objStudent);
        $stringStudent = Utilities::ArrayToString($arrayStudent);
        $param = strtok($stringStudent, "|");
        $param_value = strtok("|");  
		//var_dump($param);		
		//var_dump($param_value);		
        MySQLDataAdapter::Insert('student', $param, $param_value);        
    }
	function InsertNewUser($objStudent){
	    //print_r($objStudent);
        $arrayStudent = Utilities::ObjectToArray($objStudent);
        $stringStudent = Utilities::ArrayToString($arrayStudent);
        $param = strtok($stringStudent, "|");
        $param_value = strtok("|");  
		//var_dump($param);		
		//var_dump($param_value);		
        MySQLDataAdapter::Insert('useraccount', $param, $param_value);        
    }
	 function InsertStudentPreferences($objStudent){
	    //print_r($objStudent);
        $arrayStudent = Utilities::ObjectToArray($objStudent);
        $stringStudent = Utilities::ArrayToString($arrayStudent);
        $param = strtok($stringStudent, "|");
        $param_value = strtok("|");  
		//var_dump($param);		
		//var_dump($param_value);		
        MySQLDataAdapter::Insert('preferences', $param, $param_value);        
    }
	function UpdateStudent($objStudent){
	    //print_r($objStudent);
        $arrayStudent = Utilities::ObjectToArray($objStudent);
        $stringStudent = Utilities::ArrayToString($arrayStudent);
        $param = strtok($stringStudent, "|");
        $param_value = strtok("|");  
		//var_dump($param);		
		//var_dump($param_value);		
        MySQLDataAdapter::Update('student', $param, $param_value,"UserId='$objStudent->UserId'");        
    }
	function FollowCompany($objStudent){
	    //print_r($objStudent);
        $arrayStudent = Utilities::ObjectToArray($objStudent);
        $stringStudent = Utilities::ArrayToString($arrayStudent);
        $param = strtok($stringStudent, "|");
        $param_value = strtok("|");  
		//var_dump($param);		
		//var_dump($param_value);		
        MySQLDataAdapter::Insert('followers', $param, $param_value);        
    }
	function Apply($objStudent){
	    //print_r($objStudent);
        $arrayStudent = Utilities::ObjectToArray($objStudent);
        $stringStudent = Utilities::ArrayToString($arrayStudent);
        $param = strtok($stringStudent, "|");
        $param_value = strtok("|");  
		//var_dump($param);		
		//var_dump($param_value);		
        MySQLDataAdapter::Insert('application', $param, $param_value);        
    }
	function StudentApplications($objStudent){
	    	
		$function=MySQLDataAdapter::GetAppliedStudentDetailsByStudentId($objStudent->StudentId);  
		print_r($function);
       	return $result;
		//return Utilities::HashTableToArray($function, $param_string);
    }
	function UpdateStudentApplication($objStudent){
	    	
		//print_r($objStudent);
        $arrayStudent = Utilities::ObjectToArray($objStudent);
        $stringStudent = Utilities::ArrayToString($arrayStudent);
        $param = strtok($stringStudent, "|");
        $param_value = strtok("|");  
		//var_dump($param);		
		//var_dump($param_value);		
        MySQLDataAdapter::Update('application', "Deleted", "1","JobId='$objStudent->JobId' AND StudentID='$objStudent->StudentId'");        
    }
	function UpdateStudentStatus($objStudent){
	    	
		//print_r($objStudent->UserId);
		//print_r($objStudent);
        $arrayStudent = Utilities::ObjectToArray($objStudent);
        $stringStudent = Utilities::ArrayToString($arrayStudent);
        $param = strtok($stringStudent, "|");
        $param_value = strtok("|");  
		//var_dump($param);		
		//var_dump($param_value);		
        MySQLDataAdapter::Update('student', "status",$objStudent->Status,"UserId='$objStudent->UserId'");        
    }
}

?>
