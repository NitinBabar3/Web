<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JobManagementDataAccess
 *
 * @author letstech01
 */

class JobManagementDataAccess {
    function GetJobByEmployerId($employerId){
        try{
            $param_string = Utilities::GetEntityClassAttributesInString('job');
            $hash_table_job = MySQLDataAdapter::Read('job', $param_string, "EmployerId=".$employerId);
            return Utilities::HashTableToArray($hash_table_job, $param_string);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	
	function GetJobBySearch($obj){
	
		
		//echo $obj->JobTypeId;
		$jobtype=implode(',',$obj->JobTypeId);
		$jobs="(".$jobtype.")";
		//echo $obj->LocationIdString;die;
		
		/*SELECT * FROM job
			INNER JOIN jobfunctions
			WHERE jobfunctions.ID IN ('4','5','6','8')
			AND LocationIDString LIKE '%2'*/
		
		
        try{
            $param_string = Utilities::GetEntityClassAttributesInString('job');
			//print_r($param_string);
			
			 $sql="SELECT $param_string FROm job WHERE JobTypeId IN ".$jobs." OR LocationIDString LIKE '%,".$obj->LocationIdString.",%'";
			
			//echo  $sql;
            $hash_table_job = MySQLDataAdapter::Read('job', $param_string,"JobTypeId IN ".$jobs." OR LocationIDString LIKE '%,".$obj->LocationIdString.",%'");
			//print_r($hash_table_job);
			return Utilities::HashTableToArray($hash_table_job, $param_string);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function GetStudentApplicationByJobId($jobId){
        try{
            
            $hashTableResult = MySQLDataAdapter::GetAppliedStudentDetailsByJobId($jobId);            
            $arrayResult = Utilities::HashTableToArrayWithoutParamString($hashTableResult);                                   
            $count=0;
            $skill[$count] = $arrayResult["0"]["SkillName"];
            $rating[$count] = $arrayResult["0"]["SelfRating"];            
            for($i=1;$i<sizeof($arrayResult);$i++){
                if($arrayResult[$i]["ID"] == $arrayResult[$i-1]["ID"]){
                    $skill[$count] = $skill["$count"].", ".$arrayResult[$i]["SkillName"];
                    $rating[$count] = $rating[$count].", ".$arrayResult[$i]["SelfRating"];     
                }
                else{
                    $count++;
                    $skill[$count] = $arrayResult[$i]["SkillName"];
                    $rating[$count] = $arrayResult[$i]["SelfRating"];
                }            
            }           
            
            foreach($arrayResult[0] as $param=>$param_value)
                $arrayToReturn[0][$param] = $param_value;                                            
            
            
            $count=1;
            for ($i=1;$i<sizeof($arrayResult);$i++){
                    if($arrayResult[$i]["ID"] != $arrayResult[$i-1]["ID"]){
                        foreach($arrayResult[$i] as $param => $param_value)
                            $arrayToReturn[$count][$param] = $param_value;                        
                        $count++;
                    }                                        
            
            
            }
            for ($i=0;$i<sizeof($skill);$i++){
                $arrayToReturn[$i]["SkillName"] = $skill[$i];
                $arrayToReturn[$i]["SelfRating"] = $rating[$i];
            }
            
            return $arrayToReturn;
        }
        catch (Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function GetAllJobsPostedByEmployerByEmployerId($employerId){
        try{
            $entityClassAttributes = Utilities::GetEntityAttributesWithClassNamePreceeding('Job');            
            
            $entityClassAttributes = $entityClassAttributes.",employer.CompanyName,employer.Logo,jobtype.Type,compensation.CompensationType";
            $hashTableJobCard = MySQLDataAdapter::Read('job,jobtype,employer,compensation', $entityClassAttributes, "EmployerId=".$employerId." AND job.EmployerId=employer.ID AND job.JobTypeId = jobtype.ID AND job.CompensationTypeId = compensation.ID");
            return $hashTableJobCard;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function GetInfo()
    {
        try{         
                $jobClassAttributes = Utilities::GetEntityClassAttributesInString("Job");
                $table="job";
                $param_value="Deleted = '0'";

                $hashJobDetails = MySQLDataAdapter::Read($table, $jobClassAttributes, $param_value);

                $objArray= array();
                $i=0;
                while ($row = mysql_fetch_object($hashJobDetails)) {
                    $obj=new Job();
                    $obj->ID= $row->ID;                     //ID
                    $obj->Title= $row->Title;               //Title
                    $obj->Description =$row->Description;   //Description

                    $str=$row->LocationIdString;            
                    $a = strtok($str,",");
                    //$obj->LocationIdString= $a;
                    $location1=MySQLDataAdapter::Read("location","CityName","ID=$a");
                    $result= mysql_fetch_assoc($location1);
                    $locationNameString=$result["CityName"];
                    //echo $locationNameString;
                    $num=strlen($row->LocationIdString);
                    $j= $num/2;
                    $num=$num-$j-1;
                    for(;$num>0;$num--)
                    {   //select CityName from location where id in(1,2,3);
                        $b = strtok(",");
                        //echo "<br>".$b;
                        $lo=MySQLDataAdapter::Read("location","CityName","ID=$b");
                        $result= mysql_fetch_assoc($lo);
                        $locationNameString=$locationNameString.",".$result["CityName"];
                    } 
                    $obj->LocationIdString=$locationNameString;

                    
                    $obj->StartDate=$row->StartDate;                //Start Date
                    $obj->EndDate=$row->EndDate;                    //End Date
                    $obj->ApplicationDeadline=$row->ApplicationDeadline;  //Application 
                    
                    $str=$row->FunctionIdString;        
                    $a = strtok($str,",");
                    //$obj->LocationIdString= $a;
                    $function1=MySQLDataAdapter::Read("jobfunctions","Function","ID=$a");
                    $result= mysql_fetch_assoc($function1);
                    $functionNameString=$result["Function"];
                    //echo $locationNameString;
                    $num=strlen($row->FunctionIdString);
                    $j= $num/2;
                    $num=$num-$j-1;
                    for(;$num>0;$num--)
                    {
                        $b = strtok(",");
                        //echo "<br>".$b;
                        $lo=MySQLDataAdapter::Read("jobfunctions","Function","ID=$b");
                        $result= mysql_fetch_assoc($lo);
                        $functionNameString=$functionNameString.",".$result["Function"];
                    }
                    $obj->FunctionIdString = $functionNameString;   //Function

                    $objArray[$i]=$obj;
                    $i++;
                }

                return $objArray;   //return object of job to be displayed
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            die;        
        }
    } 
    
    /*function GetAllJobsPostedByEmployerWithStudentApplication($employerId){
        try{
            $entityClassAttributes = Utilities::GetEntityAttributesWithClassNamePreceeding('Job');            
            
            $entityClassAttributes = $entityClassAttributes.",employer.CompanyName,employer.Logo,jobtype.Type,compensation.CompensationType,application.StudentID,student.Name,application.ApplicationStatus";
            $condition = "EmployerId=".$employerId." AND job.EmployerId=employer.ID AND job.JobTypeId = jobtype.ID AND job.CompensationTypeId = compensation.ID AND application.JobId = job.ID AND student.ID = application.StudentID AND student.Deleted=0 AND job.Deleted=0 AND application.Deleted=0 AND employer.Deleted=0 ORDER BY job.ID";
            $hashTableJobCard = MySQLDataAdapter::Read('job,jobtype,employer,compensation,student,application', $entityClassAttributes,$condition );
            return $hashTableJobCard;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }*/
    
    function GetAllJobsPostedByEmployerWithStudentApplication($employerId){
        try{    
            //$entityAttributes = Utilities::GetEntityAttributesWithClassNamePreceeding('Job');            
            $query = "select job.* ,employer.CompanyName,employer.Logo,jobfunctions.Function,jobtype.Type,compensation.CompensationType,
            (select count(*) from application where application.JobId = job.ID) as NoOfApplications,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Applied\") as Applied,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Rejected\") as Rejected,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Pending Screening Test\") as PendingScreeningTest,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Shortlisted\") as Shortlisted,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Selected\") as Selected 
            from job,jobfunctions,employer,jobtype,compensation
            where employer.ID = job.EmployerId 
            AND job.JobTypeId = jobfunctions.ID
            AND job.EmployerID =".$employerId."
            AND jobtype.ID = job.JobTypeId
			AND compensation.ID = job.CompensationTypeId
            AND job.Deleted = 0 AND employer.Deleted = 0";
            
            return MySQLDataAdapter::Query($query);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function CloseJobByJobId($jobId){
        try{            
            $query = "update job set Status = 'closed' where ID = $jobId";
            MySQLDataAdapter::Query($query);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	
	function InsertJob($objJob)
    {
        try{
            $array = Utilities::ObjectToArray($objJob);
            $string = Utilities::ArrayToString($array);
            $param= strtok($string, "|");
            $param_value=strtok("|");
            $table="job";
            MySQLDataAdapter::Insert($table,$param,$param_value);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	function GetJobDetailsByJobId($jobId) {
		try {
			$query = "select job.* ,employer.CompanyName,employer.Logo,jobfunctions.Function,jobtype.Type,compensation.CompensationType,
						(select count(*) from application where application.JobId = job.ID) as NoOfApplications,
						(select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Applied\") as Applied,
						(select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Rejected\") as Rejected,
						(select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Pending Screening Test\") as PendingScreeningTest,
						(select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Shortlisted\") as Shortlisted,
						(select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Selected\") as Selected
						from job,jobfunctions,employer,jobtype,compensation
						where employer.ID = job.EmployerId
						AND job.JobTypeId = jobfunctions.ID
						AND job.ID = $jobId
						AND jobtype.ID = job.JobTypeId
						AND compensation.ID = job.CompensationTypeId
						AND job.Deleted = 0 AND employer.Deleted = 0";
			$hashTableJob = MySQLDataAdapter::Query($query);
			
			$arrayJob = Utilities::HashTableToArrayWithoutParamString($hashTableJob);
			
			$locationIdString = "(" . implode(',', explode(',', $arrayJob[0]["LocationIdString"])) . ")";
			$functionIdString = "(" . implode(',', explode(',', $arrayJob[0]["FunctionIdString"])) . ")";
			$skillIdString = "(" . implode(',', explode(',', $arrayJob[0]["RequiredSkillIdString"])) . ")";
			$academicRequirementIdString = "(" . implode(',', explode(',', $arrayJob[0]["AcademicRequirement"])) . ")";

			$query = "select Title,
						(select group_concat(CityName) from location where location.ID in $locationIdString) as LocationString,
						(select group_concat(Function) from jobfunctions where jobfunctions.ID in $functionIdString) as FunctionString,
						(select group_concat(AcademicRequirement) from academicrequirement where academicrequirement.ID in $academicRequirementIdString) as AcademeicRequirementString,
						(select group_concat(SkillName) from skills where skills.ID in $skillIdString) as SkillString
						from job where job.ID = $jobId";

			$hashTableAttributeString = MySQLDataAdapter::Query($query);
			$arrayAttributeString = Utilities::HashTableToArrayWithoutParamString($hashTableAttributeString);
			$arrayJob[0]["LocationString"] = $arrayAttributeString[0]["LocationString"];			
			$arrayJob[0]["FunctionString"] = $arrayAttributeString[0]["FunctionString"];
			$arrayJob[0]["SkillString"] = $arrayAttributeString[0]["SkillString"];
			$arrayJob[0]["AcademicRequirementString"] = $arrayAttributeString[0]["AcademeicRequirementString" ];
				return(Utilities::ArrayToObject($arrayJob, new JobCard()));
			}
			catch(Exception $ex) {
				throw $ex -> getMessage();
			}
		}
		
		function EditJob($objJob){
			try{
				$entityClassAttributesArray = Utilities::GetEntityClassAttributes("Job");

				$queryInner = $entityClassAttributesArray[1]."='".$objJob->$entityClassAttributesArray[1]."'";
				for($i=2;$i<sizeof($entityClassAttributesArray)-1;$i++){				
				$queryInner = $queryInner.",".$entityClassAttributesArray[$i]."='".$objJob->$entityClassAttributesArray[$i]."'";
				}	
				$query = "UPDATE job SET ".$queryInner." where ID=".$objJob->ID;								
				MySQLDataAdapter::Query($query);
			}

			catch(Exception $ex){
				throw $ex->getMessage();
				}
		}
		
		function GetJobDetailsByJobId1($jobId) {
		try {
			$query = "select job.* ,employer.CompanyName,employer.Logo,jobtype.Type,compensation.CompensationType,jobcategory.CategoryName,jobsubcategory.SubCategoryName,          
			(select count(*) from application where application.JobId = job.ID) as NoOfApplications,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Applied\") as Applied,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Rejected\") as Rejected,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Pending Screening Test\") as PendingScreeningTest,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Shortlisted\") as Shortlisted,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Selected\") as Selected 
            from job,employer,jobtype,compensation,jobcategory,jobsubcategory
            where employer.ID = job.EmployerId 
            AND job.JobTypeId = jobtype.ID
			AND jobcategory.ID = job.CategoryId
			AND jobsubcategory.ID = job.SubCategoryID
            AND job.ID =".$jobId."
            AND jobtype.ID = job.JobTypeId
			AND compensation.ID = job.CompensationTypeId
            AND job.Deleted = 0 AND employer.Deleted = 0";
			$hashTableJob = MySQLDataAdapter::Query($query);
			
			$arrayJob = Utilities::HashTableToArrayWithoutParamString($hashTableJob);
			
			$locationIdString = "(" . implode(',', explode(',', $arrayJob[0]["LocationIdString"])) . ")";
			$functionIdString = "(" . implode(',', explode(',', $arrayJob[0]["FunctionIdString"])) . ")";
			$skillIdString = "(" . implode(',', explode(',', $arrayJob[0]["RequiredSkillIdString"])) . ")";
			$academicRequirementIdString = "(" . implode(',', explode(',', $arrayJob[0]["AcademicRequirement"])) . ")";

			$query = "select Title,
						(select group_concat(CityName) from location where location.ID in $locationIdString) as LocationString,
						(select group_concat(Function) from jobfunctions where jobfunctions.ID in $functionIdString) as FunctionString,
						(select group_concat(AcademicRequirement) from academicrequirement where academicrequirement.ID in $academicRequirementIdString) as AcademeicRequirementString,
						(select group_concat(SkillName) from skills where skills.ID in $skillIdString) as SkillString
						from job where job.ID = $jobId";

			$hashTableAttributeString = MySQLDataAdapter::Query($query);
			$arrayAttributeString = Utilities::HashTableToArrayWithoutParamString($hashTableAttributeString);
			$arrayJob[0]["LocationString"] = $arrayAttributeString[0]["LocationString"];			
			$arrayJob[0]["FunctionString"] = $arrayAttributeString[0]["FunctionString"];
			$arrayJob[0]["SkillString"] = $arrayAttributeString[0]["SkillString"];
			$arrayJob[0]["AcademicRequirementString"] = $arrayAttributeString[0]["AcademeicRequirementString" ];
				return(Utilities::ArrayToObject($arrayJob, new JobCard()));
			}
			catch(Exception $ex) {
				throw $ex -> getMessage();
			}
		}
		
		function GetAllJobsPostedByEmployerWithStudentApplication1($employerId){
        try{    
            //$entityAttributes = Utilities::GetEntityAttributesWithClassNamePreceeding('Job');            
            $query = "select job.* ,employer.CompanyName,employer.Logo,jobtype.Type,compensation.CompensationType,jobcategory.CategoryName,jobsubcategory.SubCategoryName,          
			(select count(*) from application where application.JobId = job.ID) as NoOfApplications,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Applied\") as Applied,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Rejected\") as Rejected,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Pending Screening Test\") as PendingScreeningTest,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Shortlisted\") as Shortlisted,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Selected\") as Selected 
            from job,employer,jobtype,compensation,jobcategory,jobsubcategory
            where employer.ID = job.EmployerId 
            AND job.JobTypeId = jobtype.ID
			AND jobcategory.ID = job.CategoryId
			AND jobsubcategory.ID = job.SubCategoryID
            AND job.EmployerId =".$employerId."
            AND jobtype.ID = job.JobTypeId
			AND compensation.ID = job.CompensationTypeId
            AND job.Deleted = 0 AND employer.Deleted = 0";
            
            return MySQLDataAdapter::Query($query);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    	}

		function GetListFromTableByParameter($table,$param_value){
			try{
				return MySQLDataAdapter::GetListFromTableByParameter($table,$param_value);
            		
			}
			catch(Exception $ex){
				throw $ex->getMessage();
			}
			
		}
		
		function GetJobSubCategoryListByCategoryId($categoryId){
			try{
				$query="SELECT ID,SubCategoryName FROM jobsubcategory where CategoryId=".$categoryId;
                return MySQLDataAdapter::Query($query);
			}
			catch(Exception $ex){
				throw $ex->getMessage();
			}
		}
		

	}

?>
