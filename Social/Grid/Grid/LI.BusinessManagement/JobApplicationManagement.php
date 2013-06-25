<?php

include("../LI.DataAccessManagement/ApplicationManagementDataAccess.php");

//include("../Utilities/Utilities.php");

class JobApplicationManagement
{
    function NewApplication($objApplication)
    {
        try{
            $objApplicationManagementDataAccess= new ApplicationManagementDataAccess();
            $objApplicationManagementDataAccess->JobApplication($objApplication);
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            die;        
        }
    }
	
	function GetAllApplicationsByJobId($jobId){
		try{
			$objApplicationManagementDataAccess= new ApplicationManagementDataAccess();
            return $objApplicationManagementDataAccess->GetAllApplicationsByJobId($jobId);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function ChangeApplicationStatusByApplicationIdAndNewStatus($applicationId,$newStatus){
		try{
			$objApplicationManagementDataAccess= new ApplicationManagementDataAccess();
            $objApplicationManagementDataAccess->ChangeApplicationStatusByApplicationIdAndNewStatus($applicationId, $newStatus);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function ChangeApplicationRatingByApplicationIdAndNewRating($applicationId,$newRating){
		try{
			$objApplicationManagementDataAccess= new ApplicationManagementDataAccess();
            $objApplicationManagementDataAccess->ChangeApplicationRatingByApplicationIdAndNewRating($applicationId, $newRating);			
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function PostAudioFileName($filename){
		try{
			$filenameTokens = explode("-", $filename);
			$filename = "audio/".$filename.".wav";
			$applicationId = $filenameTokens[1];
			$questionId = $filenameTokens[2];
			
			$objApplicationManagementDataAccess= new ApplicationManagementDataAccess();
            $objApplicationManagementDataAccess->PostAudioFileName($filename,$applicationId,$questionId);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	function PostApplication($objApplication){
		try{
			$objApplicationManagementDataAccess= new ApplicationManagementDataAccess();
            $objApplicationManagementDataAccess->PostApplication($objApplication);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
}
?>

