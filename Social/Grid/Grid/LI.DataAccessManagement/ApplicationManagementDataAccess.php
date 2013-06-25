<?php
//include_once("../Utilities/Utilities.php");
class ApplicationManagementDataAccess { 
    
    function JobApplication($objApplication)
    {
        try{
            $array = Utilities::ObjectToArray($objApplication);
            $string = Utilities::ArrayToString($array);
            $param= strtok($string, "|");
            $param_value=strtok("|");
            $table="application";
            MySQLDataAdapter::Insert($table,$param,$param_value);
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            die;        
        }
    }
	
	function GetAllApplicationsByJobId($jobId){
		try{
			 $query = "SELECT application.Id as ApplicationId, application.StudentId,application.ApplicationStatus,application.AppliedOn,application.ApplicationRating,
                    student.CurrentYear,course.CourseName,student.Picture,location.CityName,
                    college.CollegeName,collegetype.Type as CollegeType,
                    answer.OptionID,answer.QuestionId,
                    questionoptions.isCorrect,
                    (select count(question.ID) 
                    from question,test_questions,job
                    where job.ID =".$jobId." 
                    AND test_questions.TestId = job.ScreeningTestId 
                    AND question.QuestionType LIKE 'MCQ' 
                    AND question.ID = test_questions.QuestionId) as NumberOfMCQ
                    from application,answer,student,college,collegetype,questionoptions,course,location 
                    where answer.OptionID = questionoptions.ID
                    AND application.JobId =".$jobId."
                    AND answer.ApplicationId = application.ID
                    AND answer.OptionID = questionoptions.ID
                    AND student.ID = application.StudentId
                    AND college.ID = student.CollegeId
                    AND collegetype.CollegeTypeID = college.CollegeType
                    AND course.ID = student.CurrentCourseId
                    AND location.ID = student.LocationId
                    AND answer.Deleted=0 AND application.Deleted=0 AND student.Deleted=0";

                    $hashTableAnswersMCQ = MySQLDataAdapter::Query($query);

                    $query = "SELECT application.Id as ApplicationId, application.StudentId,
                    answer.QuestionId,answer.ResponseText,question.QuestionType
                    from application,answer,question
                    where application.JobId =".$jobId."
                    AND answer.ApplicationId = application.ID
                    AND question.ID = answer.QuestionId
                    AND question.QuestionType NOT LIKE 'MCQ'
                    AND answer.Deleted=0 AND application.Deleted=0";

                    $hashTableAnswersNotMCQ = MySQLDataAdapter::Query($query);
                    //var_dump($hashTableWithoutAnswersMCQ);

                    $arrayAnswersMCQ = Utilities::HashTableToArrayWithoutParamString($hashTableAnswersMCQ); 
                    $arrayAnswersNotMCQ = Utilities::HashTableToArrayWithoutParamString($hashTableAnswersNotMCQ);

                    //var_dump($arrayAnswersMCQ);
                    //var_dump($arrayAnswersNotMCQ);

                    $arrayApplication = array();
                    $applicationIdFlag=0;$firstQuestionFlag=1;
                    foreach($arrayAnswersMCQ as $tempAnswersMCQ){
                            if($applicationIdFlag!=$tempAnswersMCQ["ApplicationId"]){
                                    if($firstQuestionFlag!=1){
                                            $tempApplication->Marks = $marks;
                                            $tempApplication->Answers = $arrayAnswer;
                                            $tempApplication->Student = $tempStudent;
                                            $arrayApplication[] = $tempApplication;
                                    }
                                    $arrayAnswer = array();
                                    $applicationIdFlag = $tempAnswersMCQ["ApplicationId"];
                                    $tempApplication = new Application();
									$tempApplication->ApplicationRating = $tempAnswersMCQ["ApplicationRating"];
                                    $tempApplication->ID = $tempAnswersMCQ["ApplicationId"];
                                    $tempApplication->ApplicationStatus = $tempAnswersMCQ["ApplicationStatus"];
                                    $tempApplication->AppliedOn = $tempAnswersMCQ["AppliedOn"];
                                    $tempApplication->StudentId = $tempAnswersMCQ["StudentId"];
                                    $tempStudent = new StudentDetailsFree();
                                    $tempStudent->ID =  $tempAnswersMCQ["StudentId"];
                                    $tempStudent->Location =  $tempAnswersMCQ["CityName"];
                                    $tempStudent->Picture =  $tempAnswersMCQ["Picture"];
                                    $tempStudent->College =  $tempAnswersMCQ["CollegeName"];
                                    $tempStudent->CurrentCourse =  $tempAnswersMCQ["CourseName"];
                                    $tempStudent->CurrentYear =  $tempAnswersMCQ["CurrentYear"];
                                    $tempStudent->CollegeType = $tempAnswersMCQ["CollegeType"];
                                    $marks = 0;
                                    $tempApplication->NumberOfMCQ = $tempAnswersMCQ["NumberOfMCQ"];
                                    $firstQuestionFlag=0;
                            }
                            $tempAnswer = new Answer();
                            $tempAnswer->ApplicationId=$tempAnswersMCQ["ApplicationId"];
                            $tempAnswer->OptionId=$tempAnswersMCQ["OptionID"];
                            $tempAnswer->QuestionId = $tempAnswersMCQ["QuestionId"];
							$tempAnswer->QuestionType = "MCQ";
                            $marks+=$tempAnswersMCQ["isCorrect"];
                            $arrayAnswer[] = $tempAnswer;

                    }
                    $tempApplication->Marks = $marks;
                    $tempApplication->Answers = $arrayAnswer;
                    $tempApplication->Student = $tempStudent;
                    $arrayApplication[] = $tempApplication;



                    foreach($arrayAnswersNotMCQ as $tempAnswersNotMCQ){
                            if($tempArrayApplication->ID != $tempAnswersNotMCQ["ApplicationId"]){
                                    foreach($arrayApplication as $tempArrayApplication){
                                            if($tempArrayApplication->ID == $tempAnswersNotMCQ["ApplicationId"]){
                                                    break;
                                            }
                                    }	
                            }
                            if($tempArrayApplication->Answers!="NULL")
                                    $arrayAnswer = $tempArrayApplication->Answers;
                            else 
                                    $arrayAnswer = array();

                            $tempAnswer = new Answer();
                            $tempAnswer->ResponseText = $tempAnswersNotMCQ["ResponseText"];
                            $tempAnswer->QuestionId = $tempAnswersNotMCQ["QuestionId"];
							$tempAnswer->QuestionType = $tempAnswersNotMCQ["QuestionType"];
                            $arrayAnswer[] = $tempAnswer; 
                            $tempArrayApplication->Answers = $arrayAnswer;
                    }
			return $arrayApplication;
		}
		catch(Exception $ex){
			throw $ex;
		}
	}

	function ChangeApplicationStatusByApplicationIdAndNewStatus($applicationId,$newStatus){
		try{
			$query = "Update application set ApplicationStatus = '$newStatus' where ID=".$applicationId;			
			MySQLDataAdapter::Query($query);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function ChangeApplicationRatingByApplicationIdAndNewRating($applicationId,$newRating){
		try{
			$query = "Update application set ApplicationRating = $newRating where ID=".$applicationId;								
			MySQLDataAdapter::Query($query);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function PostAudioFileName($filename,$applicationId,$questionId){
		try{
			$query = "SELECT ID from answer where ResponseText = '$filename'";
			$alreadyAnswered = MySQLDataAdapter::Query($query);
			$alreadyAnsweredId = mysql_fetch_array($alreadyAnswered);
			if($alreadyAnsweredId != false)
			{
				$id = $alreadyAnsweredId[0];
				$query = "Update answer set Deleted = 1 where ID=$id";
				MySQLDataAdapter::Query($query);
			}

			
			$query = "INSERT into answer(QuestionId,ResponseText,ApplicationID,Deleted) values ('$questionId','$filename','$applicationId',0)";
			echo $query;
			MySQLDataAdapter::Query($query);
		}
		catch(Exceptiont $ex){
			throw $ex->getMessage();
		}
	}
	
	function PostApplication($objApplication){
		try{
			$applicationId = $objApplication->ID;
			$query = "INSERT into answer (QuestionId,OptionID,ResponseText,ApplicationID,Deleted) values";
			for ($i=0;$i<sizeof($objApplication->Answers);$i++) {
				$tempQuery = "('".$objApplication->Answers[$i]->QuestionId."','".$objApplication->Answers[$i]->OptionId."','".$objApplication->Answers[$i]->ResponseText."','".$applicationId."',0)";
				if($i==sizeof($objApplication->Answers)-1){
					$query = $query.$tempQuery;
				}
				else{
					$query = $query.$tempQuery.",";
				}
			}	
			MySQLDataAdapter::Query($query);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
    
}

?>
