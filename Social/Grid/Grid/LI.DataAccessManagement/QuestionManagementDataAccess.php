<?php

class QuestionManagementDataAccess
{
    function PostQuestionAndOptions($objQuestion,$answer)
    {
        try
        {
            $array = Utilities::ObjectToArray($objQuestion);
            $string = Utilities::ArrayToString($array);
            $param= strtok($string, "|");
            $param_value=strtok("|");
            $table="question";
            MySQLDataAdapter::Insert($table,$param,$param_value);
            
            $query ="SELECT LAST_INSERT_ID() FROM question ORDER BY ID LIMIT 1,1";
            $a= MySQLDataAdapter::Query($query);
            $b= mysql_result($a,0);
            
            if($objQuestion->QuestionType=="MCQ")
            {
                for($i=0;$i<4;$i++)
                {
                    $str="INSERT INTO questionoptions (QuestionID,OptionText,isCorrect)VALUES(%d,'%s',%d)";
                    $query=sprintf($str,$b,$answer[$i]->OptionText,$answer[$i]->IsCorrect);
                    $a=  MySQLDataAdapter::Query($query);
                }
            }
            else if($objQuestion->QuestionType=="T/F")
            {
                if ($answer== "True")
                {
                    $str="INSERT INTO questionoptions (QuestionID,OptionText,isCorrect)VALUES(%d,'True',1)";
                    $query=sprintf($str,$b);
                    $a=  MySQLDataAdapter::Query($query);
                    $str="INSERT INTO questionoptions (QuestionID,OptionText,isCorrect)VALUES(%d,'False',0)";
                    $query=sprintf($str,$b);
                    $a=  MySQLDataAdapter::Query($query);
                }
                else if($answer == "False")
                {
                    $str="INSERT INTO questionoptions (QuestionID,OptionText,isCorrect)VALUES(%d,'False',1)";
                    $query=sprintf($str,$b);
                    $a=  MySQLDataAdapter::Query($query);
                    $str="INSERT INTO questionoptions (QuestionID,OptionText,isCorrect)VALUES(%d,'True',0)";
                    $query=sprintf($str,$b);
                    $a=  MySQLDataAdapter::Query($query);
                }    
            }
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            die;        
        }
    }
    
    function UpdateQuestionAndOptions($objQuestion,$answer,$QuestionId)
    {
        try
        {
            $str="Update question set QuestionText='$objQuestion->QuestionText',
                  FunctionID= $objQuestion->FunctionId,QuestionType='$objQuestion->QuestionType',
                  CreatedByUserId=$objQuestion->CreatedByUserId,CreatedOn='$objQuestion->CreatedOn' where ID=$QuestionId";
            
            $result= MySQLDataAdapter::Query($str);
            $b=$QuestionId;
            $str="Delete from questionoptions where QuestionID = $QuestionId ";
            $result= MySQLDataAdapter::Query($str);
            
            
            if($objQuestion->QuestionType=="MCQ")
            {
                for($i=0;$i<4;$i++)
                {
                    $str="INSERT INTO questionoptions (QuestionID,OptionText,isCorrect)VALUES(%d,'%s',%d)";
                    $query=sprintf($str,$b,$answer[$i]->OptionText,$answer[$i]->IsCorrect);
                    $a=  MySQLDataAdapter::Query($query);
                }
            }
            else if($objQuestion->QuestionType=="T/F")
            {
                if ($answer== "True")
                {
                    $str="INSERT INTO questionoptions (QuestionID,OptionText,isCorrect)VALUES(%d,'True',1)";
                    $query=sprintf($str,$b);
                    $a=  MySQLDataAdapter::Query($query);
                    $str="INSERT INTO questionoptions (QuestionID,OptionText,isCorrect)VALUES(%d,'False',0)";
                    $query=sprintf($str,$b);
                    $a=  MySQLDataAdapter::Query($query);
                }
                else if($answer == "False")
                {
                    $str="INSERT INTO questionoptions (QuestionID,OptionText,isCorrect)VALUES(%d,'False',1)";
                    $query=sprintf($str,$b);
                    $a=  MySQLDataAdapter::Query($query);
                    $str="INSERT INTO questionoptions (QuestionID,OptionText,isCorrect)VALUES(%d,'True',0)";
                    $query=sprintf($str,$b);
                    $a=  MySQLDataAdapter::Query($query);
                }    
            }
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            die;        
        }
    }
    
    function GetInfoQuestionsByUserID($UserId)
    {
        try {
                
                //echo $UserType."<br/>";
                
                $query="select t.Type from useraccount a inner join usertype t on a.UserTypeId = t.ID Where a.Deleted=0 and t.Deleted=0 and a.ID=$UserId";
                $result=  MySQLDataAdapter::Query($query);
                $UserType=  mysql_fetch_assoc($result);
                $Type=$UserType["Type"];
            
                if($Type=="Admin")
                {
                    $query="SELECT  question.ID,question.QuestionText,question.QuestionType,question.CreatedByUserId,       					  jobfunctions.Function from question
                        INNER JOIN jobfunctions ON jobfunctions.ID=question.FunctionID WHERE question.Deleted=0";
                
                    $result=  MySQLDataAdapter::Query($query);
                }
                else {
                        $str="SELECT  question.ID,question.QuestionText,question.QuestionType,question.CreatedByUserId,jobfunctions.Function from question
                                INNER JOIN jobfunctions ON jobfunctions.ID=question.FunctionID WHERE question.Deleted=0 AND CreatedByUserId = %d";
                        $query=sprintf($str,$UserId);
                        $result=  MySQLDataAdapter::Query($query);
                }
                $objQuestionWithOptionsArray= array();
                $i=0;
                while ($row = mysql_fetch_object($result)) {
                    $obj=new QuestionWithOptions();

                    $obj->ID= $row->ID;
                    $obj->QuestionText=$row->QuestionText;
                    $obj->Function=$row->Function;
                    $obj->QuestionType= $row->QuestionType;
                    $obj->CreatedByUserId= $row->CreatedByUserId;

                    if($obj->QuestionType=="MCQ")
                    {
                        $str = "SELECT * FROM questionoptions WHERE QuestionID=%d AND Deleted=0";
                        $query = sprintf($str, $obj->ID);
                        $result1 = MySQLDataAdapter::Query($query);
                        $objOptionArray = array();
                        $j = 0;
                        while ($row = mysql_fetch_object($result1)) {
                            $obj1 = new QuestionOption();
                            $obj1->OptionText = $row->OptionText;
                            $obj1->IsCorrect = $row->isCorrect;
                            $objOptionArray[$j] = $obj1;
                            $j++;
                        }
                        $obj->OptionArray=$objOptionArray;
                    }
                    else if($obj->QuestionType=="T/F")
                    {
                        $str = "SELECT * FROM questionoptions WHERE QuestionID=%d AND Deleted=0";
                        $query = sprintf($str, $obj->ID);
                        $result1 = MySQLDataAdapter::Query($query);
                        $objOptionArray = array();
                        $j = 0;
                        while ($row = mysql_fetch_object($result1)) {
                            $obj1 = new QuestionOption();
                            $obj1->OptionText = $row->OptionText;
                            $obj1->IsCorrect = $row->isCorrect;

                            $objOptionArray[$j] = $obj1;
                            $j++;
                        }
                        $obj->OptionArray=$objOptionArray;
                    }

                    $objQuestionWithOptionsArray[$i]=$obj;
                    $i++;
                }

                return $objQuestionWithOptionsArray;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }
    }
    
    function DeleteQuestionByQuestionID($questionid)
    {
        try {
            
            $table="question";
            $str = "ID=%d";
            $condition=sprintf($str,$questionid);
            MySQLDataAdapter::Delete($table, $condition);
            
            $table="questionoptions";
            $str = "QuestionID=%d";
            $condition=sprintf($str,$questionid);
            MySQLDataAdapter::Delete($table, $condition);
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }
    }
    
    
}


?>
