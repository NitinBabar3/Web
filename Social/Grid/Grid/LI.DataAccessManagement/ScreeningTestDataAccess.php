<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//include_once("../Utilities/Utilities.php");


class ScreeningTestDataAccess {
    function InsertNewScreeningTest($objScreeningTest){
        $arrayScreeningTest = Utilities::ObjectToArray($objScreeningTest);
        $stringScreeningTest = Utilities::ArrayToString($arrayScreeningTest);
        $param = strtok($stringScreeningTest, "|");
        $param_value = strtok("|");           
        MySQLDataAdapter::Insert('employer', $param, $param_value);        
    }
    
       
    
     function GetScreeningTestDetails($testId){
        
        try{
          //  $ScreeningTestClassAttributes = Utilities::GetEntityClassAttributesInString("ScreeningTest");
                       $query = "select q.id
                                ,q.questionText
                                ,q.QuestionType
                                ,(select SubCategoryName from jobsubcategory where id = q.SubCategoryId) as SubCategoryId  
                                ,o.OptionText,o.id,o.isCorrect,(select concat(TestTitle,':',Duration) from test where id=1) as 'TestTitle:Duration'
                                from question q 
                                left join questionoptions o on q.id = o.QuestionID 
                                inner join test_questions t on q.id = t.QuestionID
                                where q.deleted=0 and o.deleted=0 and t.deleted=0
                                and t.testID =".$testId;
        
            $hashScreeningTestDetails =mysql_query($query);
            $QuestionIDs = array(); $i=0;
            while($each_row = mysql_fetch_array($hashScreeningTestDetails)){
            
               
                $QuestionIDs[$i] = $each_row[0];
                $Questions[$i]["questionid"] = $each_row[0];
                $Questions[$i]["questiontext"] = $each_row[1];
                $Questions[$i]["questiontype"] = $each_row[2];
                $Questions[$i]["subcategoryid"] = $each_row[3];
                $Questions[$i]["optionid"] = $each_row[5];
                $Questions[$i]["optiontext"] = $each_row[4];
                $Questions[$i]["iscorrect"] = $each_row[6];
                $testTitleDuration = $each_row[7];
                $i++;
            }
            
            $distinctQuestionID = array_unique($QuestionIDs);
            //print_r($Questions);
            
            $optionsArray = array();
            
            foreach($distinctQuestionID as $key=>$value)
            {
                foreach($Questions as $questionArray)
                {
                    $flagObjCreated = FALSE;
                   // array_clear($optionsArray);
                    if($questionArray["questionid"] == $value)
                    {
                        if(!$flagObjCreated)
                        {
                                $objQuestion = new Question();
                                $objQuestion->ID = $questionArray["questionid"];
                                $objQuestion->SubCategoryId = $questionArray["subcategoryid"];
                                $objQuestion->QuestionText = $questionArray["questiontext"];
                                $objQuestion->QuestionType = $questionArray["questiontype"];
                                $objQuestion->Deleted = 0;
                        }
                        
                        $option = new QuestionOption();
                        $option->ID = $questionArray["optionid"];
                        $option->OptionText = $questionArray["optiontext"];
                        $option->isCorrect = $questionArray["iscorrect"];
                        
                        $optionsArray[] = $option;
                        $objQuestion->Options = $optionsArray;
                    }
                }
                
                $objQuestionsArray[] = $objQuestion;
            }
            
            
            
            $testDetails = explode(":", $testTitleDuration);
            
            $objScreeningTest = new ScreeningTest();
            $objScreeningTest->ID = $testId;
            $objScreeningTest->TestTitle = $testDetails[0];
            $objScreeningTest->Duration = $testDetails[1];
            $objScreeningTest->Questions = $objQuestionsArray;
            $objScreeningTest->Deleted = 0;
            $objScreeningTest->createdByUserId ="NotAvailable";
            
            //print_r($objScreeningTest);
            
            return $objScreeningTest;
           
            
            
//            
//            $arrayScreeningTestDetails = Utilities::HashTableToArray($hashScreeningTestDetails, $ScreeningTestClassAttributes);
//            return Utilities::ArrayToObject($arrayScreeningTestDetails[0], new ScreeningTest);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
	function GetAllScreeningTestsFromAdminBySubCategory($subCategoryId){
		try{
			$query = "(Select test.ID as TestId,test.TestTitle,test.Duration,test.SubCategoryId,
                    question.ID as QuestionId,question.QuestionText,question.QuestionType,
                    questionoptions.ID as OptionId,questionoptions.OptionText,questionoptions.isCorrect
                    from test,useraccount,usertype,test_questions,question,questionoptions 
                    where test.SubCategoryID =".$subCategoryId."
                    AND useraccount.ID = test.CreatedByUserID
                    AND usertype.ID = useraccount.UserTypeId
                    AND usertype.Type = 'Admin'
                    AND test_questions.TestId = test.ID
                    AND question.QuestionType LIKE 'MCQ'
                    AND question.ID = test_questions.QuestionID
                    AND questionoptions.QuestionID = question.ID
                    AND test.Deleted=0
                    AND question.Deleted=0
                    AND questionoptions.Deleted=0 
                    ORDER BY test.ID) ORDER BY QuestionId";

                    $hashTableTestWithMCQ = MySQLDataAdapter::Query($query);

                    $query = "Select test.ID as TestId,test.TestTitle,test.Duration,test.SubCategoryId,
                    question.ID as QuestionId,question.QuestionText,question.QuestionType
                    from test,useraccount,usertype,test_questions,question 
                    where test.SubCategoryID =".$subCategoryId."
                    AND useraccount.ID = test.CreatedByUserID
                    AND usertype.ID = useraccount.UserTypeId
                    AND usertype.Type = 'Admin'
                    AND test_questions.TestId = test.ID
                    AND question.QuestionType NOT LIKE 'MCQ'
                    AND question.ID = test_questions.QuestionID
                    AND test.Deleted=0
                    AND question.Deleted=0
                    ORDER BY test.ID";

                    $hashTableTestWithoutMCQ = MySQLDataAdapter::Query($query);

                    $arrayTestWithMCQ = Utilities::HashTableToArrayWithoutParamString($hashTableTestWithMCQ);
                    $arrayTestWithoutMCQ = Utilities::HashTableToArrayWithoutParamString($hashTableTestWithoutMCQ);
                    //var_dump($arrayTestWithMCQ);
                    //var_dump($arrayTestWithoutMCQ);
					
					//sort($arrayTestWithMCQ,"QuestionId");
					//var_dump($arrayTestWithMCQ);die;
					$testIdFlag=0;$questionIdFlag=1;
					$quesCount=0;$firstQuestionFlag=1;
					$arrayTestDetails = array();
					foreach($arrayTestWithMCQ as $tempArrayWithMCQ){
						if($testIdFlag!=$tempArrayWithMCQ["TestId"]){
                                    if($testIdFlag!=0){
                                    		$tempTestDetails->Question = $arrayQuestionObj;
                                            $arrayTestDetails[] = $tempTestDetails;
                                    }
                                    $testIdFlag = $tempArrayWithMCQ["TestId"];
                                    $tempTestDetails = new ScreeningTest();
									$arrayQuestionObj = array();
									$questionIdArray = array();
                            
                                    $quesCount=0;
                                    $tempTestDetails->ID = $tempArrayWithMCQ["TestId"];
                                    $tempTestDetails->TestTitle = $tempArrayWithMCQ["TestTitle"];
                                    $tempTestDetails->Duration = $tempArrayWithMCQ["Duration"];
                                    $tempTestDetails->SubCategoryId = $tempArrayWithMCQ["SubCategoryId"];		
                        }
						for($i=0;$i<=$quesCount;$i++){
								if($firstQuestionFlag!=1){
                                            if(in_array($tempArrayWithMCQ["QuestionId"], $questionIdArray)){
                                                    $questionIdFlag=0;
                                                    break;
                                            }
								}
                        }
                            if($questionIdFlag==1){
                            	if($firstQuestionFlag!=1){
                            		$tempQuestion->Options = $arrayQuestionOptionObj;
									$arrayQuestionObj[] = $tempQuestion;									
                            	}
								$tempQuestion = new Question();
								$arrayQuestionOptionObj = array();
								$questionIdArray[] = $tempArrayWithMCQ["QuestionId"];
                            	$tempQuestion->ID = $tempArrayWithMCQ["QuestionId"];
                                $tempQuestion->QuestionText = $tempArrayWithMCQ["QuestionText"];
                                $tempQuestion->QuestionType = $tempArrayWithMCQ["QuestionType"];
                                $quesCount++;								
								$firstQuestionFlag=0;
	                         }
                            else {
                                 $questionIdFlag=1;
                            }
							
							$tempOption = new QuestionOption();
							$tempOption->QuestionId = $tempArrayWithMCQ["QuestionId"];
                            $tempOption->ID = $tempArrayWithMCQ["OptionId"];
                            $tempOption->OptionText = $tempArrayWithMCQ["OptionText"];
                            $tempOption->IsCorrect = $tempArrayWithMCQ["isCorrect"];
							$arrayQuestionOptionObj[] = $tempOption;
					}
					$tempTestDetails->Question = $arrayQuestionObj;
                    $arrayTestDetails[] = $tempTestDetails;


					$done=0;
					foreach ($arrayTestWithoutMCQ as $tempArrayWithoutMCQ) {
						$tempQuestion = new Question();
						$tempQuestion->ID = $tempArrayWithoutMCQ["QuestionId"];
						$tempQuestion->SubCategoryId = $tempArrayWithoutMCQ["SubCategoryId"];
						$tempQuestion->QuestionText = $tempArrayWithoutMCQ["QuestionText"];
						$tempQuestion->QuestionType = $tempArrayWithoutMCQ["QuestionType"];
						
						foreach($arrayTestDetails as $tempTestDetails){
							if ($tempTestDetails->ID == $tempArrayWithoutMCQ["TestId"]){
								$tempTestDetails->Question[] = $tempQuestion;
								$done=1;
							}
						}
						if($done==0){
							$tempTestDetails = new ScreeningTest();
							$tempTestDetails->ID = $tempArrayWithoutMCQ["TestId"];
                            $tempTestDetails->TestTitle = $tempArrayWithoutMCQ["TestTitle"];
                            $tempTestDetails->Duration = $tempArrayWithoutMCQ["Duration"];
                            $tempTestDetails->SubCategoryId = $tempArrayWithoutMCQ["SubCategoryId"];
							$tempTestDetails->Question[] = $tempQuestion;
							$arrayTestDetails[] = $tempTestDetails;
						}
						else{
							$done=0;							
						}	
					}
					
					return $arrayTestDetails;
                    			
		}
		catch(Exception $ex){
			
		}
	}

	/*function GetAllScreeningTestsFromAdminBySubCategory($subCategoryId){
        
        try{
          //  $ScreeningTestClassAttributes = Utilities::GetEntityClassAttributesInString("ScreeningTest");
                       $query = "select test.ID as TestId, q.id as QuestionId
                                ,q.questionText
                                ,q.QuestionType
                                ,(select SubCategoryName from jobsubcategory where id = q.SubCategoryId) as SubCategoryId  
                                ,o.OptionText,o.id,o.isCorrect,(select concat(TestTitle,':',Duration) from test where id=1) as 'TestTitle:Duration'
                                from test,question q
                                left join questionoptions o on q.id = o.QuestionID 
                                inner join test_questions t on q.id = t.QuestionID
                                where q.deleted=0 and o.deleted=0 and t.deleted=0
								and t.TestId = test.ID
                                and test.SubCategoryId =3
                                and test.ID=3
								ORDER by q.ID";
        
            $hashScreeningTestDetails =mysql_query($query);
            $QuestionIDs = array(); $i=0;
            while($each_row = mysql_fetch_array($hashScreeningTestDetails)){
            
               //var_dump($each_row);break;
                $QuestionIDs[$i] = $each_row["QuestionId"];
                $Questions[$i]["questionid"] = $each_row["QuestionId"];
                $Questions[$i]["questiontext"] = $each_row["questionText"];
                $Questions[$i]["questiontype"] = $each_row["QuestionType"];
                $Questions[$i]["subcategoryid"] = $each_row["SubCategoryId"];
                $Questions[$i]["optionid"] = $each_row["id"];
                $Questions[$i]["optiontext"] = $each_row["OptionText"];
                $Questions[$i]["iscorrect"] = $each_row["isCorrect"];
                $testTitleDuration = $each_row["TestTitle:Duration"];
                $i++;
            }
            //var_dump($Questions);die;
            $distinctQuestionID = array_unique($QuestionIDs);
            //print_r($Questions);
            
            $optionsArray = array();
            
            foreach($distinctQuestionID as $key=>$value)
            {
                foreach($Questions as $questionArray)
                {
                    $flagObjCreated = FALSE;
                   // array_clear($optionsArray);
                    if($questionArray["questionid"] == $value)
                    {
                        if(!$flagObjCreated)
                        {
                                $objQuestion = new Question();
                                $objQuestion->ID = $questionArray["questionid"];
                                $objQuestion->SubCategoryId = $questionArray["subcategoryid"];
                                $objQuestion->QuestionText = $questionArray["questiontext"];
                                $objQuestion->QuestionType = $questionArray["questiontype"];
                                $objQuestion->Deleted = "0";
                        }
                        
                        $option = new QuestionOption();
                        $option->ID = $questionArray["optionid"];
                        $option->OptionText = $questionArray["optiontext"];
                        $option->isCorrect = $questionArray["iscorrect"];

                        
                        $optionsArray[] = $option;
                        $objQuestion->Options = $optionsArray;
                    }
                }
                
                $objQuestionsArray[] = $objQuestion;
            }
            
            
            
            $testDetails = explode(":", $testTitleDuration);
            
            $objScreeningTest = new ScreeningTest();
            $objScreeningTest->ID = $testId;
            $objScreeningTest->TestTitle = $testDetails[0];
            $objScreeningTest->Duration = $testDetails[1];
            $objScreeningTest->Questions = $objQuestionsArray;
            $objScreeningTest->Deleted = 0;
            $objScreeningTest->createdByUserId ="NotAvailable";
            
            //print_r($objScreeningTest);
            
            return $objScreeningTest;
           
            
            
//            
//            $arrayScreeningTestDetails = Utilities::HashTableToArray($hashScreeningTestDetails, $ScreeningTestClassAttributes);
//            return Utilities::ArrayToObject($arrayScreeningTestDetails[0], new ScreeningTest);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }*/
    
    function InsertNewTestReturnTestId($objScreeningTest){
    	try{
    		$query = "insert into test (TestTitle,Duration,SubCategoryId,CreatedByUserID) values ('$objScreeningTest->TestTitle','$objScreeningTest->Duration','$objScreeningTest->SubCategoryId','$objScreeningTest->CreatedByUserId')";
					//	echo $query;
			MySQLDataAdapter::Query($query);
			return mysql_insert_id();
    	}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
    }
	
	function GetEmployerQuestionByUserIdAndSubCategoryId($userId,$subCategoryId){
		try{
    		$query = "Select question.ID as QuestionId,question.QuestionText,question.QuestionType,
                    questionoptions.ID as OptionId,questionoptions.OptionText,questionoptions.isCorrect
                    from question,questionoptions 
                    where question.SubCategoryID =".$subCategoryId."
					AND question.CreatedByUserID=".$userId."																
                    AND question.QuestionType LIKE 'MCQ'                    
                    AND questionoptions.QuestionID = question.ID                    
                    AND question.Deleted=0
                    AND questionoptions.Deleted=0 
                    ORDER BY QuestionId";
					
			$hashTableQuestionMCQ = MySQLDataAdapter::Query($query);
			
			$query = "Select question.ID as QuestionId,question.QuestionText,question.QuestionType                    
                    from question
                    where question.SubCategoryID =".$subCategoryId."
					AND question.CreatedByUserID=".$userId."																
                    AND question.QuestionType NOT LIKE 'MCQ'                                        
                    AND question.Deleted=0                    
                    ORDER BY QuestionId";
                    
            $hashTableQuestionNotMCQ = MySQLDataAdapter::Query($query);
			
			$arrayQuestionMCQ = Utilities::HashTableToArrayWithoutParamString($hashTableQuestionMCQ);
			$arrayQuestionNotMCQ = Utilities::HashTableToArrayWithoutParamString($hashTableQuestionNotMCQ);
			
					$questionIdFlag=1;
					$quesCount=0;$firstQuestionFlag=1;
					$arrayTestDetails = array();
					$questionIdArray=array();
					
					foreach($arrayQuestionMCQ as $tempArrayWithMCQ){
						for($i=0;$i<=$quesCount;$i++){
								if($firstQuestionFlag!=1){
	                                     if(in_array($tempArrayWithMCQ["QuestionId"], $questionIdArray)){
                                                    $questionIdFlag=0;											 
                                                    break;
                                            }
                                 }
                        }
                        
                            if($questionIdFlag==1){
                            	if($firstQuestionFlag!=1){

                            		$tempQuestion->Options = $arrayQuestionOptionObj;									
									$arrayQuestionObj[] = $tempQuestion;									
                            	}
								$tempQuestion = new Question();
								$arrayQuestionOptionObj = array();		
								$questionIdArray[] = $tempArrayWithMCQ["QuestionId"];						
                            	$tempQuestion->ID = $tempArrayWithMCQ["QuestionId"];
                                $tempQuestion->QuestionText = $tempArrayWithMCQ["QuestionText"];
                                $tempQuestion->QuestionType = $tempArrayWithMCQ["QuestionType"];
                                $quesCount++;
							
								$firstQuestionFlag=0;								
								
	                         }
                            else {
                                 $questionIdFlag=1;
                            }
							
							$tempOption = new QuestionOption();
							$tempOption->QuestionId = $tempArrayWithMCQ["QuestionId"];
                            $tempOption->ID = $tempArrayWithMCQ["OptionId"];
                            $tempOption->OptionText = $tempArrayWithMCQ["OptionText"];
                            $tempOption->IsCorrect = $tempArrayWithMCQ["isCorrect"];
							$arrayQuestionOptionObj[] = $tempOption;
							
							
					}	

					$tempQuestion->Options = $arrayQuestionOptionObj;
					$arrayQuestionObj[] = $tempQuestion;			
					

					$done=0;
					foreach ($arrayQuestionNotMCQ as $tempArrayWithoutMCQ) {
						$tempQuestion = new Question();
						$tempQuestion->ID = $tempArrayWithoutMCQ["QuestionId"];
						$tempQuestion->SubCategoryId = $tempArrayWithoutMCQ["SubCategoryId"];
						$tempQuestion->QuestionText = $tempArrayWithoutMCQ["QuestionText"];
						$tempQuestion->QuestionType = $tempArrayWithoutMCQ["QuestionType"];
						$arrayQuestionObj[] = $tempQuestion;
						
					}			
					return $arrayQuestionObj;
			
						
    	}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}

	function InsertNewQuestionReturnQuestionId($question){
		try{
			$arrayOptions = $question->Options;
 			$query = "INSERT INTO question (QuestionText,SubCategoryId,QuestionType,CreatedByUserId,Deleted) 
 				values"."('".$question->QuestionText."','".$question->SubCategoryId."','".$question->QuestionType."','".$question->CreatedByUserId."',0)";
 
 			MySQLDataAdapter::Query($query);
			$questionId = mysql_insert_id(); 
 			if($question->QuestionType == "MCQ"){
 				$queryOption = "INSERT into questionoptions (QuestionID,OptionText,isCorrect,Deleted) values ";
 				for($i=0;$i<sizeof($arrayOptions);$i++){
 					
 				$tempQueryForOption = "('$questionId','".$arrayOptions[$i]->OptionText."','".$arrayOptions[$i]->isCorrect."','0')";
				if($i==sizeof($arrayOptions)-1){
					$queryOption = $queryOption.$tempQueryForOption;
				}
				else{
				$queryOption = $queryOption.$tempQueryForOption.",";
			}		
		
 				}
 				MySQLDataAdapter::Query($queryOption);	
 			}
			return $questionId;
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}

	function InsertTestQuestion($query){
		try{				
			MySQLDataAdapter::Query($query);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function GetScreeningTestDetailsByTestId($testId){
		try{
    		$query = "Select test.TestTitle,test.Duration,question.ID as QuestionId,question.QuestionText,question.QuestionType,
                    questionoptions.ID as OptionId,questionoptions.OptionText,questionoptions.isCorrect
                    from question,questionoptions,test,test_questions 
                    where test.ID =".$testId."
					AND test_questions.TestId = test.ID
					AND question.ID = test_questions.QuestionId																
                    AND question.QuestionType LIKE 'MCQ'                    
                    AND questionoptions.QuestionID = question.ID                    
                    AND question.Deleted=0
                    AND questionoptions.Deleted=0 
                    ORDER BY QuestionId";
					
			$hashTableQuestionMCQ = MySQLDataAdapter::Query($query);
			
			$query = "Select question.ID as QuestionId,question.QuestionText,question.QuestionType                    
                    from question,test,test_questions
                    where test.ID =".$testId."
					AND test_questions.TestId = test.ID
					AND question.ID = test_questions.QuestionId
					AND question.QuestionType NOT LIKE 'MCQ'                                        
                    AND question.Deleted=0                    
                    ORDER BY QuestionId";
                    
            $hashTableQuestionNotMCQ = MySQLDataAdapter::Query($query);
			
			$arrayQuestionMCQ = Utilities::HashTableToArrayWithoutParamString($hashTableQuestionMCQ);
			$arrayQuestionNotMCQ = Utilities::HashTableToArrayWithoutParamString($hashTableQuestionNotMCQ);
			
					$questionIdFlag=1;
					$quesCount=0;$firstQuestionFlag=1;
					$arrayTestDetails = array();
					$questionIdArray=array();
					$screeningTest = new ScreeningTest();
					$screeningTest->TestTitle = $arrayQuestionMCQ[0]['TestTitle'];
					$screeningTest->Duration = $arrayQuestionMCQ[0]['Duration'];
					foreach($arrayQuestionMCQ as $tempArrayWithMCQ){
						for($i=0;$i<=$quesCount;$i++){
								if($firstQuestionFlag!=1){
	                                     if(in_array($tempArrayWithMCQ["QuestionId"], $questionIdArray)){
                                                    $questionIdFlag=0;											 
                                                    break;
                                            }
                                 }
                        }
                        
                            if($questionIdFlag==1){
                            	if($firstQuestionFlag!=1){

                            		$tempQuestion->Options = $arrayQuestionOptionObj;									
									$arrayQuestionObj[] = $tempQuestion;									
                            	}
								$tempQuestion = new Question();
								$arrayQuestionOptionObj = array();		
								$questionIdArray[] = $tempArrayWithMCQ["QuestionId"];						
                            	$tempQuestion->ID = $tempArrayWithMCQ["QuestionId"];
                                $tempQuestion->QuestionText = $tempArrayWithMCQ["QuestionText"];
                                $tempQuestion->QuestionType = $tempArrayWithMCQ["QuestionType"];
                                $quesCount++;
							
								$firstQuestionFlag=0;								
								
	                         }
                            else {
                                 $questionIdFlag=1;
                            }
							
							$tempOption = new QuestionOption();
							$tempOption->QuestionId = $tempArrayWithMCQ["QuestionId"];
                            $tempOption->ID = $tempArrayWithMCQ["OptionId"];
                            $tempOption->OptionText = $tempArrayWithMCQ["OptionText"];
                            $tempOption->IsCorrect = $tempArrayWithMCQ["isCorrect"];
							$arrayQuestionOptionObj[] = $tempOption;
							
							
					}	

					$tempQuestion->Options = $arrayQuestionOptionObj;
					$arrayQuestionObj[] = $tempQuestion;			
					

					$done=0;
					foreach ($arrayQuestionNotMCQ as $tempArrayWithoutMCQ) {
						$tempQuestion = new Question();
						$tempQuestion->ID = $tempArrayWithoutMCQ["QuestionId"];
						$tempQuestion->SubCategoryId = $tempArrayWithoutMCQ["SubCategoryId"];
						$tempQuestion->QuestionText = $tempArrayWithoutMCQ["QuestionText"];
						$tempQuestion->QuestionType = $tempArrayWithoutMCQ["QuestionType"];
						$arrayQuestionObj[] = $tempQuestion;
						
					}
					$screeningTest->Questions = $arrayQuestionObj;
					return $screeningTest;			
						
    	}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	    
}

?>
