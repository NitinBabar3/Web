<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ScreeningTestManagement
 *
 * @author letstech01 -- copied by Ankit !! Thanks Karan :P
 */
include '../LI.DataAccessManagement/ScreeningTestDataAccess.php';
//include("../LI.Entities/Question.php");
class ScreeningTestManagement {
    
    function InsertNewScreeningTest($objScreeningTest){
        try{
            $objScreeningTestManagementDataAccess = new ScreeningTestManagementDataAccess();
            $objScreeningTestManagementDataAccess->InsertNewScreeningTest($objScreeningTest);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function GetScreeningTestDetails($testId){
        try{
            $objScreeningTestManagementDataAccess = new ScreeningTestDataAccess();
            return $objScreeningTestManagementDataAccess->GetScreeningTestDetails($testId);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
	function GetAllScreeningTestsFromAdminBySubCategory($subCategoryId){
        try{
    		$objScreeningTestDataAccess = new ScreeningTestDataAccess();
			return $objScreeningTestDataAccess->GetAllScreeningTestsFromAdminBySubCategory($subCategoryId); 
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	
	function InsertNewTestReturnTestId($objScreeningTest){
    	try{
    		$objScreeningTestDataAccess = new ScreeningTestDataAccess();
			return $objScreeningTestDataAccess->InsertNewTestReturnTestId($objScreeningTest);
    	}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
    }
	
	function GetEmployerQuestionByUserIdAndSubCategoryId($userId,$subCategoryId){
		try{
    		$objScreeningTestDataAccess = new ScreeningTestDataAccess();
			return $objScreeningTestDataAccess->GetEmployerQuestionByUserIdAndSubCategoryId($userId, $subCategoryId);
    	}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
    }
	
	function InsertNewQuestionReturnQuestionId($question){
		try{
			$objScreeningTestDataAccess = new ScreeningTestDataAccess();
			return $objScreeningTestDataAccess->InsertNewQuestionReturnQuestionId($question);						
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function InsertTestQuestion($testId,$arrayQuestionId){
		try{
			$query = "INSERT into test_questions (TestId,QuestionID,Deleted) values";
			for($i=0;$i<sizeof($arrayQuestionId);$i++){
				$tempQuery = "('$testId','$arrayQuestionId[$i]',0)";
				if($i==sizeof($arrayQuestionId)-1)
					$query = $query.$tempQuery;
				else {
					$query = $query.$tempQuery.",";
				}					
			}
			$objScreeningTestDataAccess = new ScreeningTestDataAccess();
			$objScreeningTestDataAccess->InsertTestQuestion($query);
			
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function GetScreeningTestDetailsByTestId($testId){
        try{
            $objScreeningTestManagementDataAccess = new ScreeningTestDataAccess();
            return $objScreeningTestManagementDataAccess->GetScreeningTestDetailsByTestId($testId);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
  
}

?>
