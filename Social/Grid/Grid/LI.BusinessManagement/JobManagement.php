<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JobManagement
 *
 * @author letstech01
 */
 

include '../../LI.DataAccessManagement/JobManagementDataAccess.php';

class JobManagement {
    function GetJobByEmployerId($employerId){
        try{
            $objJobManagementDataAccess = new JobManagementDataAccess();
            return($objJobManagementDataAccess->GetJobByEmployerId($employerId));            
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }

	function GetJobBySearch($obj){
        try{
			//echo "m in business layer";
            $objJobManagementDataAccess = new JobManagementDataAccess();
            return($objJobManagementDataAccess->GetJobBySearch($obj));            
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
     //14th aug
    function GetStudentApplicationByJobId($jobId){
        try{
            $objJobManagementDataAccess = new JobManagementDataAccess();
            return $objJobManagementDataAccess->GetStudentApplicationByJobId($jobId);
        }
        catch (Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function GetAllJobsPostedByEmployerByEmployerId($employerId){
        try{
            $objJobManagementDataAccess = new JobManagementDataAccess();
            $hashTableJobCard = $objJobManagementDataAccess->GetAllJobsPostedByEmployerByEmployerId($employerId);
            $param_array = Utilities::GetEntityClassAttributes('JobCard');
            $objJobCardArray = Utilities::HashTableToArrayOfObjects($hashTableJobCard, $param_array, "JobCard");
            $objJobCardArray = Utilities::GetJobCardObjectWithIdStringsReplacedByAttributes($objJobCardArray);
            return $objJobCardArray;
            
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function InsertJob($objJob)
    {
        try{
            $objJobManagementDataAccess = new JobManagementDataAccess();
            $objJobManagementDataAccess->InsertJob($objJob);            
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    /*function GetAllJobsPostedByEmployerWithStudentApplication($employerId){
        try{
            $objJobManagementDataAccess = new JobManagementDataAccess();
            $hashTableJobCard = $objJobManagementDataAccess->GetAllJobsPostedByEmployerWithStudentApplication($employerId);
            $param_array = Utilities::GetEntityClassAttributes('JobCard');
            $objJobCardArray = Utilities::HashTableToArrayOfObjects($hashTableJobCard, $param_array, "JobCard");

            $savedIndex=0;
            $objTemp = new JobCard();
            for($i=0;$i<sizeof($objJobCardArray);$i++){
                if($objJobCardArray[$i]->ID == $objJobCardArray[$savedIndex]->ID){
                    $objJobCardArray[$savedIndex]->NoOfApplications++;
                    switch ($objJobCardArray[$i]->ApplicationStatus){
                        case "Applied": $objJobCardArray[$savedIndex]->Applied++;
                            break;
                        case "Rejected": $objJobCardArray[$savedIndex]->Rejected++;
                            break;
                        case "Selected": $objJobCardArray[$savedIndex]->Selected++;
                            break;
                        case "OnHold": $objJobCardArray[$savedIndex]->OnHold++;
                            break;
                    }
                }
                else{        

                    $objTemp = $objJobCardArray[$savedIndex];
                    $objTempArray[] = $objTemp;
                    $savedIndex = $i;
                    $objJobCardArray[$savedIndex]->NoOfApplications++;
                    switch ($objJobCardArray[$i]->ApplicationStatus){
                        case "Applied": $objJobCardArray[$savedIndex]->Applied++;
                            break;
                        case "Rejected": $objJobCardArray[$savedIndex]->Rejected++;
                            break;
                        case "Selected": $objJobCardArray[$savedIndex]->Selected++;
                            break;
                        case "OnHold": $objJobCardArray[$savedIndex]->OnHold++;
                            break;
                    }

                }

            }
            
            $objJobCardArrayToReturn = Utilities::GetJobCardObjectWithIdStringsReplacedByAttributes($objTempArray);
            return $objJobCardArrayToReturn;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }*/
    
    function GetAllJobsPostedByEmployerWithStudentApplication($employerId){
        try{
            $objJobManagementDataAccess = new JobManagementDataAccess();
            $hashTableJobDetails = $objJobManagementDataAccess->GetAllJobsPostedByEmployerWithStudentApplication($employerId);
            $param_array = Utilities::GetEntityClassAttributes('JobCard');
            $objTempArray = Utilities::HashTableToArrayOfObjects($hashTableJobDetails,$param_array,"JobCard");            
            return Utilities::GetJobCardObjectWithIdStringsReplacedByAttributes($objTempArray);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function CloseJobByJobId($jobId){
        try{
            $objJobManagementDataAccess = new JobManagementDataAccess();
            $objJobManagementDataAccess->CloseJobByJobId($jobId);
        }   
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function DisplayJob() {
        try{
            $objJobManagementDataAccess = new JobManagementDataAccess();
            $objArray = $objJobManagementDataAccess->GetInfo();
            return $objArray;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	function GetJobDetailsByJobId($jobId){
		try{
			$objJobManagementDataAccess = new JobManagementDataAccess();
			return $objJobManagementDataAccess->GetJobDetailsByJobId($jobId);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function EditJob($objJob){
		try{
			$objJobManagementDataAccess = new JobManagementDataAccess();
			$objJobManagementDataAccess->EditJob($objJob);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function GetAllJobsPostedByEmployerByEmployerId1($employerId){
        try{
            $objJobManagementDataAccess = new JobManagementDataAccess();
            $hashTableJobCard = $objJobManagementDataAccess->GetAllJobsPostedByEmployerByEmployerId($employerId);
            $param_array = Utilities::GetEntityClassAttributes('JobCard');			
            $objJobCardArray = Utilities::HashTableToArrayOfObjects($hashTableJobCard, $param_array, "JobCard");			
            $objJobCardArray = Utilities::GetJobCardObjectWithIdStringsReplacedByAttributes($objJobCardArray);
            return $objJobCardArray;
            
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	function GetAllJobsPostedByEmployerWithStudentApplication1($employerId){
        try{
            $objJobManagementDataAccess = new JobManagementDataAccess();
            $hashTableJobDetails = $objJobManagementDataAccess->GetAllJobsPostedByEmployerWithStudentApplication1($employerId);
            $param_array = Utilities::GetEntityClassAttributes('JobCard');
            $objTempArray = Utilities::HashTableToArrayOfObjects($hashTableJobDetails,$param_array,"JobCard");            
            return Utilities::GetJobCardObjectWithIdStringsReplacedByAttributes($objTempArray);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	function GetJobDetailsByJobId1($jobId){
		try{
			$objJobManagementDataAccess = new JobManagementDataAccess();
			return $objJobManagementDataAccess->GetJobDetailsByJobId1($jobId);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function GetListFromTableByParameter($table,$param_value){
			try{
				$objJobManagementDataAccess = new JobManagementDataAccess();
				$list_from_db = $objJobManagementDataAccess->GetListFromTableByParameter($table, $param_value);
            	while($row = mysql_fetch_array($list_from_db)){
                	$list[$row["ID"]] = $row[$param_value];
        		}
				return $list;	
			}
			catch(Exception $ex){
				throw $ex->getMessage();
			}
			
	}
	
	function GetJobSubCategoryListByCategoryId($categoryId){
			try{
				$objJobManagementDataAccess = new JobManagementDataAccess();
				$list_from_db = $objJobManagementDataAccess->GetJobSubCategoryListByCategoryId($categoryId);
				while($row = mysql_fetch_array($list_from_db)){
					$list[$row["ID"]] = $row['SubCategoryName'];
				}
				return $list;
			}
			catch(Exception $ex){
				throw $ex->getMessage();
			}
	}
}

?>
